<?php
include("../includes/common.php");
include("../includes/sendSms/sms.php");

$act = isset($_GET['act']) ? daddslashes($_GET['act']) : null;

@header('Content-Type: application/json; charset=UTF-8');

if (!checkRefererHost()) exit('{"code":403}');

function isPhoneNumber($str)
{
    // 使用正则表达式匹配中国大陆手机号格式（11位数字，以1开头）
    $pattern = "/^1[3456789]\d{9}$/";
    if (preg_match($pattern, $str)) {
        return true; // 字符串为手机号
    } else {
        return false; // 字符串不是手机号
    }
}


switch ($act) {
    case 'login':
        /**
         * 添加手机验证码登陆逻辑
         *
         *
         */
        $phone = daddslashes($_POST['phone']);
        $code = daddslashes($_POST['code']);
        $user = daddslashes($_POST['user']);
        $pass = daddslashes($_POST['pass']);
        if ($conf['captcha_open_login'] == 1 && $conf['captcha_open'] == 1) {
            if (isset($_POST['geetest_challenge']) && isset($_POST['geetest_validate']) && isset($_POST['geetest_seccode'])) {
                if (!isset($_SESSION['gtserver'])) exit('{"code":-1,"msg":"验证加载失败"}');
                $GtSdk = new \lib\GeetestLib($conf['captcha_id'], $conf['captcha_key']);

                $data = array(
                    'user_id' => $cookiesid,
                    'client_type' => "web",
                    'ip_address' => $clientip
                );

                if ($_SESSION['gtserver'] == 1) {   //服务器正常
                    $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $data);
                    if ($result) {
                        //echo '{"status":"success"}';
                    } else {
                        exit('{"code":-1,"msg":"验证失败，请重新验证"}');
                    }
                } else {  //服务器宕机,走failback模式
                    if ($GtSdk->fail_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'])) {
                        //echo '{"status":"success"}';
                    } else {
                        exit('{"code":-1,"msg":"验证失败，请重新验证"}');
                    }
                }
            } else {
                exit('{"code":2,"type":1,"msg":"请先完成验证"}');
            }
        } elseif ($conf['captcha_open_login'] == 1 && $conf['captcha_open'] == 2) {
            if (isset($_POST['token'])) {
                $client = new \lib\CaptchaClient($conf['captcha_id'], $conf['captcha_key']);
                $client->setTimeOut(2);
                $response = $client->verifyToken($_POST['token']);
                if ($response->result) {
                    /**token验证通过，继续其他流程**/
                } else {
                    /**token验证失败**/
                    exit('{"code":-1,"msg":"验证失败，请重新验证"}');
                }
            } else {
                exit('{"code":2,"type":2,"appid":"' . $conf['captcha_id'] . '","msg":"请先完成验证"}');
            }
        } elseif ($conf['captcha_open_login'] == 1 && $conf['captcha_open'] == 3) {
            if (isset($_POST['token'])) {
                if (vaptcha_verify($conf['captcha_id'], $conf['captcha_key'], $_POST['token'], $clientip)) {
                    /**token验证通过，继续其他流程**/
                } else {
                    /**token验证失败**/
                    exit('{"code":-1,"msg":"验证失败，请重新验证"}');
                }
            } else {
                exit('{"code":2,"type":3,"appid":"' . $conf['captcha_id'] . '","msg":"请先完成验证"}');
            }
        }
        if ((!$user && !$pass) && ($phone && $code)) {
            $srow = $DB->getRow("SELECT zid FROM pre_site WHERE phone=:phone LIMIT 1", [':phone' => $phone]);
            if ($srow) {
                //已注册
                //判断验证码是否正确，正确查表检值设session进入用户页面，错误exit('1');
                if (checkItem($phone) && (getItem($phone) == $code)) {

                    $row = $DB->getRow("SELECT zid,user,pwd,status FROM pre_site WHERE phone=:phone LIMIT 1", [':phone' => $phone]);
//                    $row = $DB->getRow("SELECT zid,user,pwd,status FROM pre_site WHERE user=:user LIMIT 1", [':user' => $user]);
                    if ($row['status'] == 0) {
                        exit('{"code":-1,"msg":"当前账号已被封禁！"}');
                    }
                    $user = $row['user'];
                    $pass = $row['pwd'];
                    $session = md5($user . $pass . $password_hash);
                    $token = authcode("{$row['zid']}\t{$session}", 'ENCODE', SYS_KEY);
                    ob_clean();
                    setcookie("user_token", $token, time() + 604800, '/');
                    log_result('分站登录', 'User:' . $user . ' IP:' . $clientip, null, 1);
                    if ($_SESSION['Oauth_qq_openid'] && $_SESSION['Oauth_qq_token']) {
                        if ($_SESSION['Oauth_qq_type'] == 'wx') {
                            $typename = '微信';
                            $typecolumn = 'wx_openid';
                        } else {
                            $typename = 'QQ';
                            $typecolumn = 'qq_openid';
                        }
                        $DB->exec("UPDATE pre_site SET {$typecolumn}=:qq_openid,lasttime=NOW() WHERE zid=:zid", [':qq_openid' => $_SESSION['Oauth_qq_openid'], ':zid' => $row['zid']]);
                        unset($_SESSION['Oauth_qq_type']);
                        unset($_SESSION['Oauth_qq_openid']);
                        unset($_SESSION['Oauth_qq_token']);
                        unset($_SESSION['Oauth_qq_nickname']);
                        unset($_SESSION['Oauth_qq_faceimg']);
                        exit('{"code":0,"msg":"绑定QQ快捷登录成功！"}');
                    } else {
                        $DB->exec("UPDATE pre_site SET lasttime=NOW() WHERE zid=:zid", [':zid' => $row['zid']]);
                        delItem($phone);
                        exit('{"code":0,"msg":"登陆用户中心成功！"}');
                    }


                } else {
                    exit('{"code":-1,"msg":"验证码错误！"}');
                }
            } else {
                //没有注册，跳注册页，删除验证码，注册重新发送
                // Header("Location reg.php");
                delItem($phone);
                exit('{"code":-1,"msg":"该手机号还未注册，请前往注册！"}');
            }
        } elseif ((!$phone && !$code) && ($user && $pass)) {
            // ///////////////////////////////////////////////////////////////////////////////////////////////
            $row = $DB->getRow("SELECT zid,user,pwd,status FROM pre_site WHERE user=:user LIMIT 1", [':user' => $user]);
            if ($row && $user === $row['user'] && $pass === $row['pwd']) {
                if ($row['status'] == 0) {
                    exit('{"code":-1,"msg":"当前账号已被封禁！"}');
                }
                $session = md5($user . $pass . $password_hash);
                $token = authcode("{$row['zid']}\t{$session}", 'ENCODE', SYS_KEY);
                ob_clean();
                setcookie("user_token", $token, time() + 604800, '/');
                log_result('分站登录', 'User:' . $user . ' IP:' . $clientip, null, 1);
                if ($_SESSION['Oauth_qq_openid'] && $_SESSION['Oauth_qq_token']) {
                    if ($_SESSION['Oauth_qq_type'] == 'wx') {
                        $typename = '微信';
                        $typecolumn = 'wx_openid';
                    } else {
                        $typename = 'QQ';
                        $typecolumn = 'qq_openid';
                    }
                    $DB->exec("UPDATE pre_site SET {$typecolumn}=:qq_openid,lasttime=NOW() WHERE zid=:zid", [':qq_openid' => $_SESSION['Oauth_qq_openid'], ':zid' => $row['zid']]);
                    unset($_SESSION['Oauth_qq_type']);
                    unset($_SESSION['Oauth_qq_openid']);
                    unset($_SESSION['Oauth_qq_token']);
                    unset($_SESSION['Oauth_qq_nickname']);
                    unset($_SESSION['Oauth_qq_faceimg']);
                    exit('{"code":0,"msg":"绑定QQ快捷登录成功！"}');
                } else {
                    $DB->exec("UPDATE pre_site SET lasttime=NOW() WHERE zid=:zid", [':zid' => $row['zid']]);
                    exit('{"code":0,"msg":"登陆用户中心成功！"}');
                }
            } else {
                exit('{"code":-1,"msg":"用户名或密码不正确！"}');
            }
        }


        break;
    case 'connect':
        if (!$conf['login_qq'] && !$conf['login_wx']) exit('{"code":-1,"msg":"当前站点未开启QQ或微信快捷登录"}');
        $type = isset($_POST['type']) ? $_POST['type'] : exit('{"code":-1,"msg":"no type"}');
        $back = isset($_POST['back']) ? $_POST['back'] : null;
        if ($type == 'qq' && $conf['login_qq'] == 2) {
            $result = ['code' => 0, 'url' => 'connect.php?type=qq'];
            if ($back) {
                $_SESSION['Oauth_back'] = $back;
            } elseif (isset($_SESSION['Oauth_back'])) {
                unset($_SESSION['Oauth_back']);
            }
        } else {
            $Oauth = new \lib\Oauth($conf['login_apiurl'], $conf['login_appid'], $conf['login_appkey']);
            $res = $Oauth->login($type);
            if (isset($res['code']) && $res['code'] == 0) {
                $result = ['code' => 0, 'url' => $res['url']];
                if ($back) {
                    $_SESSION['Oauth_back'] = $back;
                } elseif (isset($_SESSION['Oauth_back'])) {
                    unset($_SESSION['Oauth_back']);
                }
            } elseif (isset($res['code'])) {
                $result = ['code' => -1, 'msg' => $res['msg']];
            } else {
                $result = ['code' => -1, 'msg' => '快捷登录接口请求失败'];
            }
        }
        exit(json_encode($result));
        break;
    case 'uploadimg':
        adminpermission('shop', 2);
        if ($_POST['do'] == 'upload') {
            $type = $_POST['type'];
            $filename = $type . '_' . md5_file($_FILES['file']['tmp_name']) . '.png';
            $fileurl = 'assets/img/Product/' . $filename;
            if (copy($_FILES['file']['tmp_name'], ROOT . 'assets/img/Product/' . $filename)) {
                exit('{"code":0,"msg":"succ","url":"' . $fileurl . '"}');
            } else {
                exit('{"code":-1,"msg":"上传失败，请确保有本地写入权限"}');
            }
        }
        exit('{"code":-1,"msg":"null"}');
        break;
    case 'unbind':
        if (!$islogin2) exit('{"code":-1,"msg":"未登录"}');
        if (!$conf['login_qq'] && !$conf['login_wx']) exit('{"code":-1,"msg":"当前站点未开启QQ或微信快捷登录"}');
        $type = isset($_POST['type']) ? $_POST['type'] : exit('{"code":-1,"msg":"no type"}');
        if ($type == 'wx') {
            $typename = '微信';
            $typecolumn = 'wx_openid';
        } else {
            $typename = 'QQ';
            $typecolumn = 'qq_openid';
        }
        if ($DB->exec("update `pre_site` set `{$typecolumn}`=NULL where `zid`='{$userrow['zid']}'")) {
            exit('{"code":0,"msg":"您已成功解绑' . $typename . '！"}');
        } else {
            exit('{"code":-1,"msg":"解绑' . $typename . '失败！' . $DB->error() . '"}');
        }
        break;
    case 'quickreg':
        if (!$conf['login_qq'] && !$conf['login_wx']) exit('{"code":-1,"msg":"当前站点未开启QQ或微信快捷登录"}');
        if (!$_SESSION['Oauth_qq_openid'] || !$_SESSION['Oauth_qq_token']) exit('{"code":-1,"msg":"请返回重新登录"}');
        if (!$_POST['submit']) exit('{"code":-1,"msg":"access"}');
        $type = isset($_POST['type']) ? $_POST['type'] : exit('{"code":-1,"msg":"no type"}');
        $user = $type . '_' . random(8);
        $pwd = $_SESSION['Oauth_qq_token'];
        $openid = $_SESSION['Oauth_qq_openid'];
        $nickname = $_SESSION['Oauth_qq_nickname'];
        if (strlen($nickname) > 32) $nickname = mb_strcut($nickname, 0, 32);
        $faceimg = $_SESSION['Oauth_qq_faceimg'];
        if ($type == 'wx') {
            $typecolumn = 'wx_openid';
            $pwd = md5($pwd);
        } else {
            $typecolumn = 'qq_openid';
        }

        $sql = "insert into `pre_site` (`upzid`,`power`,`domain`,`domain2`,`user`,`pwd`,`{$typecolumn}`,`nickname`,`faceimg`,`rmb`,`qq`,`sitename`,`keywords`,`description`,`addtime`,`lasttime`,`status`) values (:upzid,0,NULL,NULL,:user,:pwd,:qq_openid,:nickname,:faceimg,'0',NULL,NULL,NULL,NULL,NOW(),NOW(),'1')";
        $data = [':upzid' => $siterow['zid'] ? $siterow['zid'] : 0, ':user' => $user, ':pwd' => $pwd, ':qq_openid' => $openid, ':nickname' => $nickname, ':faceimg' => $faceimg];
        if ($DB->exec($sql, $data)) {
            $zid = $DB->lastInsertId();
            unset($_SESSION['Oauth_qq_type']);
            unset($_SESSION['Oauth_qq_openid']);
            unset($_SESSION['Oauth_qq_token']);
            unset($_SESSION['Oauth_qq_nickname']);
            unset($_SESSION['Oauth_qq_faceimg']);
            $DB->exec("UPDATE `pre_orders` SET `userid`='" . $zid . "' WHERE `userid`='" . $cookiesid . "'");
            $session = md5($user . $pwd . $password_hash);
            $token = authcode("{$zid}\t{$session}", 'ENCODE', SYS_KEY);
            ob_clean();
            setcookie("user_token", $token, time() + 604800, '/');
            log_result('分站登录', 'User:' . $user . ' IP:' . $clientip, null, 1);
            exit('{"code":0,"msg":"注册用户成功","zid":"' . $zid . '"}');
        } else {
            exit('{"code":-1,"msg":"注册用户失败！' . $DB->error() . '"}');
        }
        break;
    case 'checkdomain':
        $qz = daddslashes($_GET['qz']);
        $domain = $qz . '.' . daddslashes($_GET['domain']);
        $srow = $DB->getRow("SELECT zid FROM pre_site WHERE domain=:domain OR domain2=:domain LIMIT 1", [':domain' => $domain]);
        if ($srow) exit('1');
        else exit('0');
        break;
    case 'checkuser':
        $user = trim($_GET['user']);
        $srow = $DB->getRow("SELECT zid FROM pre_site WHERE user=:user LIMIT 1", [':user' => $user]);
        if ($srow) exit('1');
        else exit('0');
        break;
    case 'checkphone':
        $phone = trim($_GET['phone']);
        $srow = $DB->getRow("SELECT zid FROM pre_site WHERE phone=:phone LIMIT 1", [':phone' => $phone]);
        if ($srow) exit('1');
        else exit('0');
        break;
    case 'reguser':

        if ($islogin2 == 1) exit('{"code":-1,"msg":"您已登陆！"}');
        elseif ($conf['user_open'] == 0) exit('{"code":-1,"msg":"当前站点未开启用户注册功能！"}');
        $user = trim(htmlspecialchars(strip_tags(daddslashes($_POST['user']))));
        $pwd = trim(htmlspecialchars(strip_tags(daddslashes($_POST['pwd']))));
        $qq = trim(daddslashes($_POST['qq']));
        $phone = trim(htmlspecialchars(strip_tags(daddslashes($_POST['phone']))));
        $hashsalt = isset($_POST['hashsalt']) ? $_POST['hashsalt'] : null;
        $code = isset($_POST['code']) ? $_POST['code'] : null;

        if ($conf['verify_open'] == 1 && (empty($_SESSION['addsalt']) || $hashsalt != $_SESSION['addsalt'])) {
            exit('{"code":-1,"msg":"验证失败，请刷新页面重试"}');
        }
        if (!preg_match('/^[a-zA-Z0-9\x7f-\xff]+$/', $user)) {
            exit('{"code":-1,"msg":"用户名只能为英文、数字与汉字！"}');
        } elseif ($DB->getRow("SELECT zid FROM pre_site WHERE user=:user LIMIT 1", [':user' => $user])) {
            exit('{"code":-1,"msg":"用户名已存在！"}');
        } elseif (strlen($pwd) < 6) {
            exit('{"code":-1,"msg":"密码不能低于6位"}');
        } elseif (strlen($qq) < 5 || !preg_match('/^[0-9]+$/', $qq)) {
            exit('{"code":-1,"msg":"QQ格式不正确！"}');
        } elseif ($pwd == $user) {
            exit('{"code":-1,"msg":"用户名和密码不能相同！"}');
        }
        if ($conf['captcha_open'] == 1) {
            if (isset($_POST['geetest_challenge']) && isset($_POST['geetest_validate']) && isset($_POST['geetest_seccode'])) {
                if (!isset($_SESSION['gtserver'])) exit('{"code":-1,"msg":"验证加载失败"}');
                $GtSdk = new \lib\GeetestLib($conf['captcha_id'], $conf['captcha_key']);

                $data = array(
                    'user_id' => $cookiesid,
                    'client_type' => "web",
                    'ip_address' => $clientip
                );

                if ($_SESSION['gtserver'] == 1) {   //服务器正常
                    $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $data);
                    if ($result) {
                        //echo '{"status":"success"}';
                    } else {
                        exit('{"code":-1,"msg":"验证失败，请重新验证"}');
                    }
                } else {  //服务器宕机,走failback模式
                    if ($GtSdk->fail_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'])) {
                        //echo '{"status":"success"}';
                    } else {
                        exit('{"code":-1,"msg":"验证失败，请重新验证"}');
                    }
                }
            } else {
                exit('{"code":2,"type":1,"msg":"请先完成验证"}');
            }
        } elseif ($conf['captcha_open'] == 2) {
            if (isset($_POST['token'])) {
                $client = new \lib\CaptchaClient($conf['captcha_id'], $conf['captcha_key']);
                $client->setTimeOut(2);
                $response = $client->verifyToken($_POST['token']);
                if ($response->result) {
                    /**token验证通过，继续其他流程**/
                } else {
                    /**token验证失败**/
                    exit('{"code":-1,"msg":"验证失败，请重新验证"}');
                }
            } else {
                exit('{"code":2,"type":2,"appid":"' . $conf['captcha_id'] . '","msg":"请先完成验证"}');
            }
        } elseif ($conf['captcha_open'] == 3) {
            if (isset($_POST['token'])) {
                if (vaptcha_verify($conf['captcha_id'], $conf['captcha_key'], $_POST['token'], $clientip)) {
                    /**token验证通过，继续其他流程**/
                } else {
                    /**token验证失败**/
                    exit('{"code":-1,"msg":"验证失败，请重新验证"}');
                }
            } else {
                exit('{"code":2,"type":3,"appid":"' . $conf['captcha_id'] . '","msg":"请先完成验证"}');
            }
        } elseif (isset($phone) && isset($code)) {
            if (!checkItem($phone)) exit('{"code":-1,"msg":"验证码错误！"}');
            if (getItem($phone) != $code) exit('{"code":-1,"msg":"验证码错误！"}');
        }
        // include("../includes/redis/redis.php");

        // exit('{"code":'. getItem($phone) .',"msg":'. $code.'}');
        /*
         *
         * 重写注册验证
         *
         *
         *
         * */
        //改为手机验证注册
//    elseif (!$code || strtolower($code) != $_SESSION['vc_code']) {
//		unset($_SESSION['vc_code']);
//		exit('{"code":2,"msg":"验证码错误！"}');
//	}
        //增加手机号
        $sql = "insert into `pre_site` (`upzid`,`power`,`domain`,`domain2`,`user`,`pwd`,`phone`,`rmb`,`qq`,`sitename`,`keywords`,`description`,`anounce`,`bottom`,`modal`,`addtime`,`lasttime`,`status`) values (:upzid,0,NULL,NULL,:user,:pwd,:phone,'0',:qq,NULL,NULL,NULL,NULL,NULL,NULL,NOW(),NOW(),'1')";
        $data = [':upzid' => $siterow['zid'] ? $siterow['zid'] : 0, ':user' => $user, ':pwd' => $pwd, ':phone' => $phone, ':qq' => $qq];
        if ($DB->exec($sql, $data)) {
            $zid = $DB->lastInsertId();
            unset($_SESSION['addsalt']);
            $DB->exec("UPDATE `pre_orders` SET `userid`='" . $zid . "' WHERE `userid`='" . $cookiesid . "'");
            $session = md5($user . $pwd . $password_hash);
            $token = authcode("{$zid}\t{$session}", 'ENCODE', SYS_KEY);
            ob_clean();
            setcookie("user_token", $token, time() + 604800, '/');
            log_result('分站登录', 'User:' . $user . ' IP:' . $clientip, null, 1);
            delItem($phone);//注册成功删除key
            exit('{"code":1,"msg":"注册用户成功","zid":"' . $zid . '"}');
        } else {
            exit('{"code":-1,"msg":"注册用户失败！' . $DB->error() . '"}');
        }
        break;
    case 'paysite':
        if ($islogin2 == 1 && $userrow['power'] > 0) exit('{"code":-1,"msg":"您已开通过站点！"}');
        elseif ($conf['fenzhan_buy'] == 0) exit('{"code":-1,"msg":"当前站点未开启自助开通站点功能！"}');
        if ($is_fenzhan == true) {
            if ($siterow['power'] == 2) {
                if ($siterow['ktfz_price'] > 0) {
                    $conf['fenzhan_price'] = $siterow['ktfz_price'];
                }
                if ($conf['fenzhan_cost2'] <= 0) {
                    $conf['fenzhan_cost2'] = $conf['fenzhan_price2'];
                }
                if ($siterow['ktfz_price2'] > 0 && $siterow['ktfz_price2'] >= $conf['fenzhan_cost2']) {
                    $conf['fenzhan_price2'] = $siterow['ktfz_price2'];
                }
            } elseif ($siterow['power'] == 1) {
                $upzid = $siterow['upzid'];
                while ($upzid > 0) {
                    $sql2 = "SELECT `power`, `ktfz_price`, `ktfz_price2`, `upzid` FROM `shua_site` WHERE `zid`='{$upzid}'";
                    $siterow2 = $DB->query($sql2)->fetch(PDO::FETCH_ASSOC);
                    if ($siterow2['power'] == 2) {
                        if ($siterow2['ktfz_price'] > 0) {
                            $conf['fenzhan_price'] = $siterow2['ktfz_price'];
                        }
                        if ($conf['fenzhan_cost2'] <= 0) {
                            $conf['fenzhan_cost2'] = $conf['fenzhan_price2'];
                        }
                        if ($siterow2['ktfz_price2'] > 0 && $siterow2['ktfz_price2'] >= $conf['fenzhan_cost2']) {
                            $conf['fenzhan_price2'] = $siterow2['ktfz_price2'];
                        }
                        break;
                    } else {
                        $upzid = $siterow2['upzid'];
                    }
                }
                // 如果找到根站点（`upzid=0`）仍未找到代理商站点，则使用默认的分站价格和成本。
                if ($upzid == 0) {
                    if ($conf['fenzhan_price'] <= 0) {
                        $conf['fenzhan_price'] = 100;
                    }
                    if ($conf['fenzhan_cost2'] <= 0) {
                        $conf['fenzhan_cost2'] = $conf['fenzhan_price2'];
                    }
                }
            }
        }
        $kind = intval($_POST['kind']);
        $qz = trim(strtolower(daddslashes($_POST['qz'])));
        $domain = trim(strtolower(htmlspecialchars(strip_tags(daddslashes($_POST['domain'])))));
        $user = trim(htmlspecialchars(strip_tags(daddslashes($_POST['user']))));
        $pwd = trim(htmlspecialchars(strip_tags(daddslashes($_POST['pwd']))));
        $name = trim(htmlspecialchars(strip_tags(daddslashes($_POST['name']))));
        $qq = trim(daddslashes($_POST['qq']));
        $hashsalt = isset($_POST['hashsalt']) ? $_POST['hashsalt'] : null;
        $domain = $qz . '.' . $domain;
        if ($conf['verify_open'] == 1 && (empty($_SESSION['addsalt']) || $hashsalt != $_SESSION['addsalt'])) {
            exit('{"code":-1,"msg":"验证失败，请刷新页面重试"}');
        }
        if ($kind != 0 && $kind != 1 && $kind != 2) {
            exit('{"code":-1,"msg":"分站类型错误！"}');
        } elseif (empty($_POST['domain'])) {
            exit('{"code":-1,"msg":"域名后缀不能为空，请主站站长在后台设置:分站可用域名"}');
        } elseif (strlen($qz) < 3 || strlen($qz) > 10 || !preg_match('/^[a-z0-9\-]+$/', $qz)) {
            exit('{"code":-1,"msg":"域名前缀不合格，至少3位数！"}');
        } elseif (!preg_match('/^[a-zA-Z0-9\_\-\.]+$/', $domain)) {
            exit('{"code":-1,"msg":"域名格式不正确！"}');
        } elseif ($DB->getRow("SELECT zid FROM pre_site WHERE domain=:domain OR domain2=:domain LIMIT 1", [':domain' => $domain]) || $qz == 'www' || $domain == $_SERVER['HTTP_HOST'] || in_array($domain, explode(',', $conf['fenzhan_remain']))) {
            exit('{"code":-1,"msg":"此前缀已被使用！"}');
        }
        if (!$islogin2) {
            if (!preg_match('/^[a-zA-Z0-9\x7f-\xff]+$/', $user)) {
                exit('{"code":-1,"msg":"用户名只能为英文、数字与汉字！"}');
            } elseif ($DB->getRow("SELECT zid FROM pre_site WHERE user=:user LIMIT 1", [':user' => $user])) {
                exit('{"code":-1,"msg":"用户名已存在！"}');
            } elseif (strlen($pwd) < 6) {
                exit('{"code":-1,"msg":"密码不能低于6位"}');
            } elseif (strlen($name) < 2) {
                exit('{"code":-1,"msg":"网站名称太短！"}');
            } elseif (strlen($qq) < 5 || !preg_match('/^[0-9]+$/', $qq)) {
                exit('{"code":-1,"msg":"QQ格式不正确！"}');
            } elseif ($pwd == $user) {
                exit('{"code":-1,"msg":"用户名和密码不能相同！"}');
            }
        }
        $fenzhan_expiry = $conf['fenzhan_expiry'] > 0 ? $conf['fenzhan_expiry'] : 12;
        $endtime = date("Y-m-d H:i:s", strtotime("+ {$fenzhan_expiry} months", time()));
        $trade_no = date("YmdHis") . rand(111, 999);
        if ($kind == 2) {
            $need = addslashes($conf['fenzhan_price2']);
        } else {
            $need = addslashes($conf['fenzhan_price']);
        }
        if ($need == 0) {
            if ($conf['captcha_open_free'] == 1 && $conf['captcha_open'] == 1) {
                if (isset($_POST['geetest_challenge']) && isset($_POST['geetest_validate']) && isset($_POST['geetest_seccode'])) {
                    if (!isset($_SESSION['gtserver'])) exit('{"code":-1,"msg":"验证加载失败"}');
                    $GtSdk = new \lib\GeetestLib($conf['captcha_id'], $conf['captcha_key']);

                    $data = array(
                        'user_id' => $cookiesid,
                        'client_type' => "web",
                        'ip_address' => $clientip
                    );

                    if ($_SESSION['gtserver'] == 1) {   //服务器正常
                        $result = $GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $data);
                        if ($result) {
                            //echo '{"status":"success"}';
                        } else {
                            exit('{"code":-1,"msg":"验证失败，请重新验证"}');
                        }
                    } else {  //服务器宕机,走failback模式
                        if ($GtSdk->fail_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'])) {
                            //echo '{"status":"success"}';
                        } else {
                            exit('{"code":-1,"msg":"验证失败，请重新验证"}');
                        }
                    }
                } else {
                    exit('{"code":2,"type":1,"msg":"请先完成验证"}');
                }
            } elseif ($conf['captcha_open_free'] == 1 && $conf['captcha_open'] == 2) {
                if (isset($_POST['token'])) {
                    $client = new \lib\CaptchaClient($conf['captcha_id'], $conf['captcha_key']);
                    $client->setTimeOut(2);
                    $response = $client->verifyToken($_POST['token']);
                    if ($response->result) {
                        /**token验证通过，继续其他流程**/
                    } else {
                        /**token验证失败**/
                        exit('{"code":-1,"msg":"验证失败，请重新验证"}');
                    }
                } else {
                    exit('{"code":2,"type":2,"appid":"' . $conf['captcha_id'] . '","msg":"请先完成验证"}');
                }
            } elseif ($conf['captcha_open_free'] == 1 && $conf['captcha_open'] == 3) {
                if (isset($_POST['token'])) {
                    if (vaptcha_verify($conf['captcha_id'], $conf['captcha_key'], $_POST['token'], $clientip)) {
                        /**token验证通过，继续其他流程**/
                    } else {
                        /**token验证失败**/
                        exit('{"code":-1,"msg":"验证失败，请重新验证"}');
                    }
                } else {
                    exit('{"code":2,"type":3,"appid":"' . $conf['captcha_id'] . '","msg":"请先完成验证"}');
                }
            }
            $keywords = $conf['keywords'];
            $description = $conf['description'];
            if ($islogin2 == 1) {
                $sql = "UPDATE `pre_site` SET `power`=:power,`domain`=:domain,`sitename`=:sitename,`title`=:title,`keywords`=:keywords,`description`=:description,`kfqq`=`qq`,`endtime`=:endtime WHERE `zid`=:zid";
                $data = [':power' => $kind, ':domain' => $domain, ':sitename' => $name, ':title' => $conf['title'], ':keywords' => $keywords, ':description' => $description, ':endtime' => $endtime, ':zid' => $userrow['zid']];
                $DB->exec($sql, $data);
                $zid = $userrow['zid'];
            } else {
                $sql = "INSERT INTO `pre_site` (`upzid`,`power`,`domain`,`domain2`,`user`,`pwd`,`rmb`,`qq`,`sitename`,`title`,`keywords`,`description`,`kfqq`,`addtime`,`endtime`,`status`) VALUES (:upzid, :power, :domain, NULL, :user, :pwd, :rmb, :qq, :sitename, :title, :keywords, :description, :kfqq, NOW(), :endtime, 1)";
                $data = [':upzid' => $siterow['zid'] ? $siterow['zid'] : 0, ':power' => $kind, ':domain' => $domain, ':user' => $user, ':pwd' => $pwd, ':rmb' => '0.00', ':qq' => $qq, ':sitename' => $name, ':title' => $conf['title'], ':keywords' => $keywords, ':description' => $description, ':kfqq' => $qq, ':endtime' => $endtime];
                $DB->exec($sql, $data);
                $zid = $DB->lastInsertId();
            }
            if ($zid) {
                $_SESSION['newzid'] = $zid;
                unset($_SESSION['addsalt']);
                if (!$islogin2) $DB->exec("UPDATE `pre_orders` SET `userid`='" . $zid . "' WHERE `userid`='" . $cookiesid . "'");
                $DB->exec("UPDATE `pre_orders` SET `zid`='" . $zid . "' WHERE `userid`='" . $zid . "'");
                exit('{"code":1,"msg":"开通站点成功","zid":"' . $zid . '"}');
            } else {
                exit('{"code":-1,"msg":"开通站点失败！' . $DB->error() . '"}');
            }
        } else {
            if ($islogin2 == 1) {
                $input = 'update|' . $userrow['zid'] . '|' . $kind . '|' . $domain . '|' . $name . '|' . $endtime;
            } else {
                $input = 'add|' . $kind . '|' . $domain . '|' . $user . '|' . $pwd . '|' . $name . '|' . $qq . '|' . $endtime;
            }
            $sql = "INSERT INTO `pre_pay` (`trade_no`,`tid`,`zid`,`input`,`num`,`name`,`money`,`ip`,`userid`,`addtime`,`status`) VALUES (:trade_no, :tid, :zid, :input, :num, :name, :money, :ip, :userid, NOW(), 0)";
            $data = [':trade_no' => $trade_no, ':tid' => -2, ':zid' => $siterow['zid'] ? $siterow['zid'] : 1, ':input' => $input, ':num' => 1, ':name' => '自助开通站点', ':money' => $need, ':ip' => $clientip, ':userid' => $cookiesid];
            if ($DB->exec($sql, $data)) {
                unset($_SESSION['addsalt']);
                exit('{"code":0,"msg":"提交订单成功！","trade_no":"' . $trade_no . '","need":"' . $need . '","pay_alipay":"' . $conf['alipay_api'] . '","pay_wxpay":"' . $conf['wxpay_api'] . '","pay_qqpay":"' . $conf['qqpay_api'] . '","pay_rmb":"' . $islogin2 . '","user_rmb":"' . $userrow['rmb'] . '"}');
            } else {
                exit('{"code":-1,"msg":"提交订单失败！' . $DB->error() . '"}');
            }
        }
        break;
    case 'thing':
        $rs = $DB->query("SELECT * FROM pre_tools WHERE `pro`='{$userrow['zid']}' order by addtime desc");
        $data = array();
        while ($res = $rs->fetch()) {
            $data[] = array('id' => $res['tid'], 'cid' => $res['cid'], 'status' => $res['close'], 'addtime' => $res['addtime'], 'sales' => $res['sales'], 'name' => $res['name']);
        }
        $result = array("code" => 0, "msg" => "succ", "data" => $data);
        exit(json_encode($result));
        break;

    case 'regcode':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $phone = $_POST["phone"];
            $phone_verify = $_POST["phone_verify"];//图形验证码
            if (empty($phone) || !isPhoneNumber($phone)) {
                exit('{"code":-4,"msg":"Phone Error!"}');
            } else {
                // exit('{"code":-4,"msg":"' . $phone . '"}');
                if ($phone_verify != $_SESSION["vc_code"]) exit('{"code":-4,"msg":"验证码错误!"}');

                try {
                    $mobile_code = SmsRandom(4, 1);
                    $res = SendDuanXin($phone, $mobile_code);
                    if ($res == 2) exit('{"code":1,"msg":"验证码发送成功，注意查收！"}');
                    exit('{"code":-4,"msg":"发送失败，请联系管理员！"}');

                } catch (\Throwable $th) {
                    //throw $th;
                    exit('{"code":-4,"msg":"' . $th . '"}');
                }
            }
        } else {
            exit('{"code":-4,"msg":"Not Post！"}');
        }


        break;


    default:
        exit('{"code":-4,"msg":"acg"}');
        break;
}



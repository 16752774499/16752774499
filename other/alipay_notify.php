<?php
/* *
 * 支付宝异步通知页面
 */

require_once("./inc.php");
require_once(SYSTEM_ROOT."alipay/AlipayTradeService.php");

//计算得出通知验证结果
$alipaySevice = new AlipayTradeService($config); 
//$alipaySevice->writeLog(var_export($_POST,true));
$verify_result = $alipaySevice->check($_POST);

if($verify_result && ($conf['alipay_api']==1||$conf['alipay_api']==3)) {//验证成功
	//商户订单号

	$out_trade_no = daddslashes($_POST['out_trade_no']);

	//支付宝交易号

	$trade_no = daddslashes($_POST['trade_no']);

	//交易状态
	$trade_status = $_POST['trade_status'];

	//买家支付宝
	$buyer_id = daddslashes($_POST['buyer_id']);

	//交易金额
	$total_amount = $_POST['total_amount'];

	$srow=$DB->getRow("SELECT * FROM pre_pay WHERE trade_no='{$out_trade_no}' LIMIT 1");

    if ($_POST['trade_status'] == 'TRADE_SUCCESS' && $srow['status']==0) {
		//付款完成后，支付宝系统发送该交易状态通知
		if($DB->exec("UPDATE `pre_pay` SET `status` ='1' WHERE `trade_no`='{$out_trade_no}'")){
			$DB->exec("UPDATE `pre_pay` SET `endtime` ='$date',`api_trade_no` ='$trade_no' WHERE `trade_no`='{$out_trade_no}'");
			
			$payorder=$DB->getRow("SELECT * FROM pre_pay WHERE trade_no='{$out_trade_no}' LIMIT 1");
			if($payorder['name']=='自助开通分站' || $payorder['name']=='自助开通站点'){
			 processOrder2($srow);   
			}else{
		     processOrder($srow);
			}
		}
    }

	echo "success";
}
else {
    //验证失败
    echo "fail";
}

function processOrder2($srow, $is_fenzhan = true)
{
    
	global $islogin2;
	global $DB;
	global $date;
	global $conf;
	$input = explode("|", $srow['input']);
	if ($srow['tid'] == -1) {
		$zid = intval($srow['input']);
		changeUserMoney($zid, $srow['money'], true, "充值", "你在线充值了" . $srow['money'] . "元余额");
		if ($conf['fenzhan_gift']) {
			$fenzhan_gift = explode('|', $conf['fenzhan_gift']);
			$fenzhan_gift_arr = array();
			foreach ($fenzhan_gift as $row) {
				$arr = explode(':', $row);
				$fenzhan_gift_arr[$arr[0]] = $arr[1];
			}
			krsort($fenzhan_gift_arr);
			foreach ($fenzhan_gift_arr as $key => $value) {
				if ($srow['money'] >= $key) {
					$money = round($value, 2);
				}
			}
			if ($money < $srow['money'] && $money > 0) {
				changeUserMoney($zid, $money, true, "返利", "你在线充值了" . $srow['money'] . "元余额，本次返利" . $money . "元已到账，感谢充值！");
			}
		}
		return true;
	}
	if ($srow['tid'] == -2) {
		$type = addslashes($input[0]);
		if ($type == "update") {
			$zid = intval($input[1]);
			$kind = intval($input[2]);
			$domain = addslashes($input[3]);
			$sitename = addslashes($input[4]);
			$endtime = addslashes($input[5]);
			$upzid = intval($srow['zid']);
			$fenzhan_free = $conf['fenzhan_free'] && $srow['money'] > $conf['fenzhan_free'] ? $conf['fenzhan_free'] : 0;
			$title = addslashes($conf['title']);
			$keywords = addslashes($conf['keywords']);
			$description = addslashes($conf['description']);
			if ($conf['fenzhan_html'] == 1) {
				$anounce = addslashes($conf['anounce']);
				$alert = addslashes($conf['alert']);
			}
			$sql="UPDATE `pre_site` SET `power`=:power,`domain`=:domain,`sitename`=:sitename,`title`=:title,`keywords`=:keywords,`description`=:description,`anounce`=:anounce,`alert`=:alert,`endtime`=:endtime WHERE `zid`=:zid";
			$data = [':power'=>$kind, ':domain'=>$domain, ':sitename'=>$sitename, ':title'=>$title, ':keywords'=>$keywords, ':description'=>$description, ':anounce'=>$anounce, ':alert'=>$alert, ':endtime'=>$endtime, ':zid'=>$zid];
			$DB->exec($sql, $data);
		} elseif($type == "add") {
			$kind = intval($input[1]);
			$domain = addslashes($input[2]);
			$user = addslashes($input[3]);
			$pwd = addslashes($input[4]);
			$sitename = addslashes($input[5]);
			$qq = addslashes($input[6]);
			$endtime = addslashes($input[7]);
			$upzid = intval($srow['zid']);
			$fenzhan_free = $conf['fenzhan_free'] && $srow['money'] > $conf['fenzhan_free'] ? $conf['fenzhan_free'] : 0;
			$keywords = addslashes($conf['keywords']);
			$description = addslashes($conf['description']);
         
			$sql="INSERT INTO `pre_site` (`upzid`,`power`,`domain`,`user`,`pwd`,`rmb`,`qq`,`sitename`,`description`,`anounce`,`alert`,`kfqq`,`addtime`,`endtime`,`status`) VALUES (:upzid, :power, :domain, :user, :pwd, :rmb, :qq, :sitename, :description, NULL, NULL, :kfqq, NOW(), :endtime, 1)";
			$data = [':upzid'=>$upzid, ':power'=>$kind, ':domain'=>$domain, ':user'=>$user, ':pwd'=>$pwd, ':rmb'=>$fenzhan_free, ':qq'=>$qq, ':sitename'=>$sitename, ':description'=>$description, ':kfqq'=>$qq, ':endtime'=>$endtime];
			
			
		
			$DB->exec($sql, $data);
			$zid = $DB->lastInsertId();
			if (strlen($srow['userid']) == 32) {
				$DB->exec("update `pre_orders` set `userid`='" . $zid . "' where `userid`='" . $srow['userid'] . "'");
			}
		}
		if ($fenzhan_free > 0) {
			addPointRecord($zid, $fenzhan_free, "赠送", "你首次开通分站获赠" . $fenzhan_free . "元余额");
		}
		if ($srow['zid'] > 1) {
			$siterow = $DB->getColumn("SELECT power FROM pre_site WHERE zid='" . $srow['zid'] . "' limit 1");
			if ($siterow == 2 && $kind == 1) {
				$money = round($srow['money'] - $fenzhan_free, 2);
				fx($money,$srow['zid']);
				changeUserMoney($srow['zid'], $money*0.9, true, "提成", "你网站的用户开通分站站长,获得" . $money*0.9 . "元提成");
			} else {
				if ($kind == 1 && $conf['fenzhan_cost'] > 0 && $srow['money'] > $conf['fenzhan_cost']) {
					$money = round($srow['money'] - $conf['fenzhan_cost'], 2);
					fx($money,$srow['zid']);
					changeUserMoney($srow['zid'], $money*0.9, true, "提成", "你网站的用户开通分站,获得" . $money*0.9 . "元提成");
				} else {
					if ($kind == 2 && $conf['fenzhan_cost2'] > 0 && $srow['money'] > $conf['fenzhan_cost2']) {
						$money = round($srow['money'] - $conf['fenzhan_cost2'], 2);
						fx($money,$srow['zid']);
						changeUserMoney($srow['zid'], $money*0.9, true, "提成", "你网站的用户开通顶级合伙人,获得" . $money*0.9 . "元提成");
						
						
					}
				}
			}
		}
		return true;
	}
	if ($srow['tid'] == -3) {
		$cart_num = count($input);
		for ($i = 0; $i < $cart_num; $i++) {
			$cart_id = $input[$i];
			if (intval($cart_id) < 1) {
				continue;
			}
			$cart_item = $DB->getRow("SELECT * FROM `pre_cart` WHERE `id`='" . $cart_id . "' LIMIT 1");
			if ($cart_item && $cart_item['input']) {
				if ($cart_id > 0 && $cart_num > 0) {
					$cart_item = $DB->getRow("SELECT * FROM `pre_cart` WHERE `id`='" . $cart_id . "' LIMIT 1");
					$tools = $DB->getRow("SELECT * FROM `pre_tools` WHERE `tid`='" . $cart_item['tid'] . "' LIMIT 1");
					$input = explode("|", $cart_item['input']);
					$cost = $tools['price'] * $cart_item['num'];
					$DB->exec("INSERT INTO `pre_orders` (`tid`,`zid`,`input`,`input2`,`input3`,`input4`,`input5`,`value`,`userid`,`addtime`,`tradeno`,`money`,`cost`,`status`,`djzt`) VALUES ('" . $cart_item['tid'] . "','" . $srow['zid'] . "','" . addslashes($input[0]) . "','" . addslashes($input[1]) . "','" . addslashes($input[2]) . "','" . addslashes($input[3]) . "','" . addslashes($input[4]) . "','" . $cart_item['num'] . "','" . $srow['userid'] . "','" . $date . "','cart" . $srow['trade_no'] . "','" . $cart_item['money'] . "','" . $cost . "','0','" . ($tools['is_curl'] == 2 ? 2 : 0) . "')");
					$orderid = $DB->lastInsertId();
					if (do_goods($orderid)) {
						$DB->exec("UPDATE `pre_cart` SET `endtime`='" . $date . "',`status`='1' WHERE `id`='" . $cart_id . "'");
						$invitelog_row = $DB->getRow("SELECT * FROM `pre_invitelog` WHERE `id` = '" . $srow['inviteid'] . "' LIMIT 1");
						$invite_row = $DB->getRow("SELECT * FROM `pre_invite` WHERE `id` = '" . $invitelog_row['iid'] . "' LIMIT 1");
						$inviteshop_row = $DB->getRow("SELECT * FROM `pre_inviteshop` WHERE `id` = '" . $invite_row['nid'] . "' LIMIT 1");
						if ($srow['inviteid'] > 0 && $conf['invite_tid'] && ($inviteshop_row['value'] > 0 && $srow['money'] >= $inviteshop_row['value'])) {
							if ($invitelog_row && $invitelog_row['status'] == 0 && $invite_row && $invite_row['status'] == 0 && $inviteshop_row && $invite_row['active'] == 1) {
								$qq = $DB->getColumn("SELECT qq FROM `pre_invite` WHERE `id` = '" . $invitelog_row['nid'] . "' LIMIT 1");
								$DB->exec("INSERT INTO `pre_orders` (`tid`,`zid`,`input`,`value`,`status`,`djzt`,`money`,`cost`,`tradeno`,`addtime`,`endtime`) VALUES (" . $inviteshop_row['tid'] . ",'" . $srow['zid'] . "','" . $qq . "',1,0,2,'0','0','invite" . $srow['trade_no'] . "','" . $date . "','" . $date . "')");
								$invite_orderid = $DB->lastInsertId();
								do_goods($invite_orderid);
								if ($inviteshop_row['times'] == 0) {
									$DB->exec("UPDATE `pre_invite` SET `status` = '1' WHERE `id` = '" . $invitelog_row['id'] . "'");
								}
								$DB->exec("UPDATE `pre_invitelog` SET `orderid` = '" . $invite_orderid . "',`status` = 1 WHERE `id` = '" . $srow['inviteid'] . "'");
							}
						}
					}
				}
			}
		}
		return true;
	}
	$tools = $DB->getRow("SELECT * FROM `pre_tools` WHERE `tid`='" . $srow['tid'] . "' LIMIT 1");
	$status = 0;
	$cost = $tools['price'] * $srow['num'];
	$DB->exec("INSERT INTO `pre_orders` (`tid`,`zid`,`input`,`input2`,`input3`,`input4`,`input5`,`value`,`userid`,`addtime`,`tradeno`,`money`,`cost`,`status`,`djzt`) VALUES ('" . $srow['tid'] . "','" . $srow['zid'] . "','" . addslashes($input[0]) . "','" . addslashes($input[1]) . "','" . addslashes($input[2]) . "','" . addslashes($input[3]) . "','" . addslashes($input[4]) . "','" . $srow['num'] . "','" . $srow['userid'] . "','" . $date . "','" . $srow['trade_no'] . "','" . $srow['money'] . "','" . $cost . "','" . $status . "','" . ($tools['is_curl'] == 2 ? 2 : 0) . "')");
	$orderid = $DB->lastInsertId();
	if (!$orderid) {
		return false;
	}
	if ($srow['zid'] > 1 && $srow['money'] > 0 && $is_fenzhan == true) {
		$price_obj = new \lib\Price($srow['zid']);
		$price_obj->setToolInfo($srow['tid'], $tools);
		$price_obj->setToolProfit($srow['tid'], $srow['num'], $tools['name'], $srow['money'], $orderid, $srow['userid']);
	}
	$num = $tools['value'] * $srow['num'];
	if ($num <= 0) {
		$num = 1;
	}
	if ($tools['is_curl'] == 1) {
		$result = do_curl($tools['curl'], $input, $num, $tools['name'], $tools['money'], $orderid, $tools['goods_param']);
		if ($result = json_decode($result, true)) {
			if ($result['code'] == 0) {
				$status = 1;
			} else {
				$status = 0;
			}
		} else {
			$status = 1;
		}
		$param = "url:" . $tools['curl'] . " data:" . http_build_query($input);
		log_result("自动访问URL", $param, $result, 0);
	} else {
		if ($tools['is_curl'] == 2 && $srow['blockdj'] == 0) {
			$inputsname = $tools['inputs'] ? $tools['input'] . "|" . $tools['inputs'] : $tools['input'];
			$shequ = $DB->getRow("SELECT * FROM `pre_shequ` WHERE `id`='" . $tools['shequ'] . "' limit 1");
			if ($shequ && $shequ['type'] && $shequ['username'] && $shequ['password']) {
				$result = third_call($shequ['type'], $shequ, 'do_goods', [$tools['goods_id'], $tools['goods_type'], $tools['goods_param'], $num, $input, $srow['money'], $srow['trade_no'], $inputsname]);
				$param = $shequ['type'] . ":" . $tools['shequ'] . " goods_id:" . $tools['goods_id'] . " num:" . $num . " data:" . http_build_query($input);
				if ($result['faka'] == true) {
					$kmdata = '';
					foreach ($result['kmdata'] as $km_arr) {
						$DB->query("INSERT INTO `pre_faka` (`tid`,`km`,`pw`,`orderid`,`addtime`,`usetime`) VALUES ('" . $srow['tid'] . "','" . $km_arr['card'] . "','" . $km_arr['pass'] . "','" . $orderid . "',NOW(),NOW())");
						if (!empty($km_arr['pass'])) {
							$kmdata = $kmdata . ("卡号：" . $km_arr['card'] . " 密码：" . $km_arr['pass'] . "<br/>");
						} else {
							$kmdata = $kmdata . ($km_arr['card'] . "<br/>");
						}
					}
					$DB->exec("UPDATE `pre_orders` SET `status`='1',`djzt`='3',`result`='" . $kmdata . "',`djorder`='" . $result['id'] . "' WHERE `id`='" . $orderid . "'");
					if (!empty($kmdata)) {
						if (is_numeric($input[0]) && strlen($input[0]) <= 10) {
							$to = $input[0] . "@qq.com";
						} else {
							if (strpos($input[0], "@")) {
								$to = $input[0];
							}
						}
						if (checkEmail($to)) {
							$sub = $conf['sitename'] . " 卡密购买提醒";
							$msg = $conf['faka_mail'];
							$msg = str_replace("[kmdata]", $kmdata, $msg);
							$msg = str_replace("[alert]", $tools['desc'], $msg);
							$msg = str_replace("[name]", $tools['name'], $msg);
							$msg = str_replace("[date]", $date, $msg);
							$msg = str_replace("[email]", $to, $msg);
							$msg = str_replace("[domain]", $_SERVER['HTTP_HOST'], $msg);
							$msg = str_replace("[sitename]", $conf['sitename'], $msg);
							send_mail($to, $sub, $msg);
						}
					}
				}
				log_result("社区对接", $param, $result, 0);
				if ($result['code'] == 0) {
					if (!strpos($_SERVER['PHPRC'], "phpStudy") && $shequ['status'] == 0) {
						$DB->exec("UPDATE `pre_shequ` SET status=1 WHERE `id`='" . $shequ['id'] . "'");
					}
					$status = $shequ['result'] ? $shequ['result'] : 1;
				} else {
					if ($conf['message_duijie'] == 1) {
						\lib\MessageSend::orderbuy_fail($tools['name'], $tools['input'], $tools['inputs'], $input, $srow['money'], $num, $srow['type'], 0, $param, $result);
					}
					$status = 0;
				}
			} else {
				$status = 0;
			}
		} else {
			if ($tools['is_curl'] == 3) {
				\lib\MessageSend::orderbuy($tools['name'], $tools['input'], $tools['inputs'], $input, $srow['money'], $num, $srow['type'], 0);
			} else {
				if ($tools['is_curl'] == 4) {
					$limit = $srow['num'];
					$rs = $DB->query("SELECT * FROM pre_faka WHERE `tid`='" . $srow['tid'] . "' AND orderid=0 LIMIT " . $limit . '');
					$kmdata = '';
					while ($res = $rs->fetch()) {
						if (!empty($res['pw'])) {
							$kmdata = $kmdata . ("卡号：" . $res['km'] . " 密码：" . $res['pw'] . "<br/>");
						} else {
							$kmdata = $kmdata . ($res['km'] . "<br/>");
						}
						$DB->exec("UPDATE `pre_faka` SET `orderid`='" . $orderid . "',`usetime`='" . $date . "' WHERE `kid`='" . $res['kid'] . "'");
					}
					if (is_numeric($input[0]) && strlen($input[0]) <= 10) {
						$to = $input[0] . "@qq.com";
					} else {
						if (strpos($input[0], "@")) {
							$to = $input[0];
						}
					}
					if (!empty($kmdata) && $to) {
						$status = 1;
						$DB->exec("UPDATE `pre_orders` SET `status`='1',`result`='" . $kmdata . "',`djzt`='3' WHERE `id`='" . $orderid . "'");
						$sub = $conf['sitename'] . " 卡密购买提醒";
						$msg = $conf['faka_mail'];
						$msg = str_replace("[kmdata]", $kmdata, $msg);
						$msg = str_replace("[alert]", $tools['alert'], $msg);
						$msg = str_replace("[name]", $tools['name'], $msg);
						$msg = str_replace("[date]", $date, $msg);
						$msg = str_replace("[email]", $to, $msg);
						$msg = str_replace("[domain]", $_SERVER['HTTP_HOST'], $msg);
						$msg = str_replace("[sitename]", $conf['sitename'], $msg);
						if (checkEmail($to)) {
							send_mail($to, $sub, $msg);
						}
					} else {
						$status = 0;
						$DB->exec("UPDATE `pre_orders` SET `status`='0',`djzt`='4' WHERE `id`='" . $orderid . "'");
					}
				} else {
					if ($tools['is_curl'] == 5) {
						$DB->exec("UPDATE `pre_orders` SET `status`='1',`djzt`='3',`result`='" . $tools['showcontent'] . "' WHERE `id`='" . $orderid . "'");
					}
				}
			}
		}
	}
	if ($tools['is_curl'] != 3) {
		\lib\MessageSend::orderbuy($tools['name'], $tools['input'], $tools['inputs'], $input, $srow['money'], $num, $srow['type'], $status);
	}
	if ($status > 0 && (!$result['faka']) || ($tools['is_curl'] != 4)) {
		$DB->exec("update `pre_orders` set `status`='" . $status . "',`djzt`='1',`djorder`='" . $result['id'] . "' where `id`='" . $orderid . "'");
	}

	$invitelog_row = $DB->getRow("SELECT * FROM `pre_invitelog` WHERE `id` = '" . $srow['inviteid'] . "' LIMIT 1");
	$invite_row = $DB->getRow("SELECT * FROM `pre_invite` WHERE `id` = '" . $invitelog_row['iid'] . "' LIMIT 1");
	$inviteshop_row = $DB->getRow("SELECT * FROM `pre_inviteshop` WHERE `id` = '" . $invite_row['nid'] . "' LIMIT 1");
	if ($srow['inviteid'] > 0 && $conf['invite_tid'] && ($inviteshop_row['value'] > 0 && $srow['money'] >= $inviteshop_row['value'])) {
		if ($invitelog_row && $invitelog_row['status'] == 0 && $invite_row && $invite_row['status'] == 0 && $inviteshop_row && $invite_row['active'] == 1) {
			$qq = $DB->getColumn("SELECT qq FROM `pre_invite` WHERE `id` = '" . $invitelog_row['nid'] . "' LIMIT 1");
			$DB->exec("INSERT INTO `pre_orders` (`tid`,`zid`,`input`,`value`,`status`,`djzt`,`money`,`cost`,`tradeno`,`addtime`,`endtime`) VALUES (" . $inviteshop_row['tid'] . ",'" . $srow['zid'] . "','" . $qq . "',1,0,2,'0','0','invite" . $srow['trade_no'] . "','" . $date . "','" . $date . "')");
			$invite_orderid = $DB->lastInsertId();
			do_goods($invite_orderid);
			if ($inviteshop_row['times'] == 0) {
				$DB->exec("UPDATE `pre_invite` SET `status` = '1' WHERE `id` = '" . $invitelog_row['iid'] . "'");
			}
			$DB->exec("UPDATE `pre_invitelog` SET `orderid` = '" . $invite_orderid . "',`status` = 1 WHERE `id` = '" . $srow['inviteid'] . "'");
		}
	}
	return $orderid;
}
function fx($money,$zid){
    global $DB;
    $row=$DB->getRow("SELECT * FROM shua_fxbl WHERE id=1 LIMIT 1"); 	  ///取出比例
		/*第一次寻找上级*/
		$userid_up = $DB->getRow("SELECT * FROM shua_site WHERE zid=$zid");
		$userid = $userid_up['zid'];  //给值到userid  下面开始循环第二层
        for ($i=0; $i<=20; $i++){
		if($userid > 0){
		$fxbl_lv = $row["lv$i"] / 100; //循环等级取出佣金比例	
		$fxbl_money = $money*0.1 *  $fxbl_lv;
		$fxbl_money=round($fxbl_money, 2);
		$userid_up = $DB->getRow("SELECT * FROM shua_site WHERE zid=$userid"); //查询当前用户的信息
		if($userid_up['power'] == 2){  //判断是否有上级且是否为合伙人
		changeUserMoney($userid, $fxbl_money ,true,'提成', '你的团队有人开通站点,获得'.$fxbl_money.'元提成');	
		}
		$userid = $userid_up['upzid'];
		if(!$userid){
		 break;   
		}
    }

  }
}
?>
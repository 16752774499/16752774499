<?php
/**
 * 快捷登录
**/
$is_defend=true;
include("../includes/common.php");
if(!$conf['login_qq'] && !$conf['login_wx'])sysmsg('当前站点未开启QQ或微信快捷登录');
if(isset($_GET['act']) && $_GET['act']=='qrlogin'){
	@header('Content-Type: application/json; charset=UTF-8');
	if(isset($_SESSION['findpwd_qq']) && $qq=$_SESSION['findpwd_qq']){
		$row=$DB->getRow("SELECT zid,user,pwd,status FROM pre_site WHERE qq=:qq LIMIT 1", [':qq'=>$qq]);
		unset($_SESSION['findpwd_qq']);
		if($row['user']){
			if($row['status']==0){
				exit('{"code":-1,"msg":"当前账号已被封禁！"}');
			}
			$session=md5($row['user'].$row['pwd'].$password_hash);
			$token=authcode("{$row['zid']}\t{$session}", 'ENCODE', SYS_KEY);
			setcookie("user_token", $token, time() + 604800, '/');
			log_result('分站登录', 'User:'.$row['user'].' IP:'.$clientip, null, 1);
			$DB->exec("UPDATE pre_site SET lasttime='$date' WHERE zid='{$row['zid']}'");
			exit('{"code":1,"msg":"登陆用户中心成功！","url":"./"}');
		}else{
			exit('{"code":-1,"msg":"当前QQ不存在，请确认你已注册过本站账号"}');
		}
	}else{
		exit('{"code":-2,"msg":"验证失败，请重新扫码"}');
	}
}elseif(($conf['login_qq']==1 || $conf['login_wx']==1) && $_GET['code'] && $_GET['type']){
	if($_GET['state'] != $_SESSION['Oauth_state']){
		sysmsg("<h2>The state does not match. You may be a victim of CSRF.</h2>");
	}
	$type = $_GET['type'];
	$Oauth = new \lib\Oauth($conf['login_apiurl'], $conf['login_appid'], $conf['login_appkey']);
	$arr = $Oauth->callback();
	if(isset($arr['code']) && $arr['code']==0){
		$openid=$arr['social_uid'];
		$access_token=$arr['access_token'];
		$nickname=$arr['nickname'];
		$faceimg=$arr['faceimg'];
	}elseif(isset($arr['code'])){
		sysmsg('<h3>error:</h3>'.$arr['errcode'].'<h3>msg  :</h3>'.$arr['msg']);
	}else{
		sysmsg('获取登录数据失败');
	}
	if($type=='wx'){
		$typename = '微信';
		$typecolumn = 'wx_openid';
	}else{
		$typename = 'QQ';
		$typecolumn = 'qq_openid';
	}

	$row=$DB->getRow("SELECT * FROM pre_site WHERE {$typecolumn}='{$openid}' limit 1");
	if($row){
		$user=$row['user'];
		$pass=$row['pwd'];
		if($islogin2==1){
			@header('Content-Type: text/html; charset=UTF-8');
			exit("<script language='javascript'>alert('当前{$typename}已绑定用户:{$user}，请勿重复绑定！');window.location.href='./uset.php?mod=user';</script>");
		}
		$session=md5($user.$pass.$password_hash);
		$token=authcode("{$row['zid']}\t{$session}", 'ENCODE', SYS_KEY);
		ob_clean();
		setcookie("user_token", $token, time() + 604800, '/');
		log_result('分站登录', 'User:'.$user.' IP:'.$clientip, null, 1);
		$DB->exec("UPDATE pre_site SET lasttime='$date' WHERE zid='{$row['zid']}'");
		if(isset($_SESSION['Oauth_back']) && $_SESSION['Oauth_back']=='index')$redirect = '../';
		elseif(isset($_SESSION['Oauth_back']) && $_SESSION['Oauth_back']=='recharge')$redirect = './recharge.php';
		elseif(isset($_SESSION['Oauth_back']) && $_SESSION['Oauth_back']=='workorder')$redirect = './workorder.php';
		else $redirect = './';
		exit("<script language='javascript'>window.location.href='{$redirect}';</script>");
	}elseif($islogin2==1){
		$sds=$DB->exec("update `pre_site` set `{$typecolumn}`='$openid' where `zid`='{$userrow['zid']}'");
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('已成功绑定{$typename}！');window.location.href='./uset.php?mod=user';</script>");
	}else{
		$_SESSION['Oauth_qq_type']=$type;
		$_SESSION['Oauth_qq_openid']=$openid;
		$_SESSION['Oauth_qq_token']=$access_token;
		$_SESSION['Oauth_qq_nickname']=$nickname;
		$_SESSION['Oauth_qq_faceimg']=$faceimg;
		@header('Content-Type: text/html; charset=UTF-8');
		if($_SESSION['Oauth_back'])$addstr = '&back='.$_SESSION['Oauth_back'];
		exit("<script language='javascript'>window.location.href='./connect.php?type={$type}{$addstr}';</script>");
	}
}elseif($islogin2==1){
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}elseif($conf['login_qq']!=2 && (!$_SESSION['Oauth_qq_openid'] || !$_SESSION['Oauth_qq_token'])){
	exit("<script language='javascript'>window.location.href='./login.php';</script>");
}

$type = $_GET['type'];

if($type=='wx'){
	$typename = '微信';
}elseif($type=='qq'){
	$typename = 'QQ';
}else{
	exit("<script language='javascript'>window.location.href='./login.php';</script>");
}

$title=$typename.'快捷登录';
include './head2.php';

if($_SESSION['Oauth_qq_faceimg']){
	$faceimg = $_SESSION['Oauth_qq_faceimg'];
}else{
	$faceimg = '//q4.qlogo.cn/headimg_dl?dst_uin='.$conf['kfqq'].'&spec=100';
}

if($_GET['act'] == 'new'){
	$subtitle = '请完善以下信息';
}elseif($_GET['act'] == 'bind'){
	$subtitle = '绑定已有账号';
}else{
	$subtitle = $typename.'快捷登录';
}

if($_SESSION['Oauth_back'])$addstr = '&back='.$_SESSION['Oauth_back'];
?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title><?php echo $subtitle?></title>
  <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../assets/simple/css/plugins.css">
  <link rel="stylesheet" href="../assets/simple/css/main.css">
  <link rel="stylesheet" href="../assets/css/common.css">
    <link href="//cdn.staticfile.org/layui/2.5.7/css/layui.css" rel="stylesheet"/>
  <script src="//cdn.staticfile.org/modernizr/2.8.3/modernizr.min.js"></script>
  <link rel="stylesheet" href="../assets/user/css/my.css">
   <script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdn.staticfile.org/layui/2.5.7/layui.all.js"></script>
  <!--[if lt IE 9]>
    <script src="//cdn.staticfile.org/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<?php if(checkmobile()){ ?>
<style>
html body{
    max-width: 1550px;
    margin: 0 auto;
}
a{ text-decoration:none;}
    .logosx{
            margin-top: 1.125rem;
    margin-left: 1.59375rem;
    width: 2rem;
    height: 2rem;
    align-self: flex-start;
    }
    .stitle{
            width: 100%;
        padding-left: 1.525rem;
    color: #<?php echo $conf['rgb01']; ?>;
    font-weight: 600;
    font-size: 18px;
    margin-top: .5rem;
    }
    .sinput{
            padding: 0.65625rem .80625rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border: 0.0625rem solid #D3D6DC;
    margin: 0px 30px;
    margin-top: 30px;
    height: 2.125rem;
    border-radius: 1.3125rem;
    }
    .sinput input{
        border:0px;
        width: 90%;
    }
    .loginbtn{
    height: 1.75rem;
    background: linear-gradient(90deg,#<?php echo $conf['rgb01']; ?> 0%,#<?php echo $conf['rgb01']; ?> 100%);
    border-radius: 1.53125rem;
    font-weight: 500;
    color: #fff;
    font-size: 14px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0px 50px;
    margin-top: 1.59375rem;
    }
    .btnxs{
        margin: 10px 25px;
        display: flex;
        justify-content: space-between;
    }
    .btnxs a{
        color: #<?php echo $conf['rgb01']; ?>;
    }
    .foots{
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }
    .foots a{
        color: #<?php echo $conf['rgb01']; ?>;
    }
    .geetest_btn{
           margin: 10px 5%;
    width: 90% !important;
    }
    .geetest_radar_btn{border-radius:26px !important;
         
    }
        .hometitle{
       width: 100%;
    text-align: center;
    color: #fff;
   background: linear-gradient(90deg,#<?php echo $conf['rgb01']; ?> 0%,#<?php echo $conf['rgb01']; ?> 100%);
    height: 40px;
    line-height: 40px;
    font-size: 15px;
    font-weight: 550;
    border-radius: 0 0 30px 30px;
    }
    .label {
            color: #868686;

    }
        .layui-layer-title {
        padding: 0 80px 0 20px;
        height: 42px;
        line-height: 42px;
        border-bottom: 0px solid #fff1dc;
        font-size: 14px;
        color: #333;
        overflow: hidden;
        background-color: #fff1dc;
        border-radius: 2px !important;
    }
    .layui-layer-btn .layui-layer-btn0 {
            border-color: #fff1dc;
        background-color: #fff1dc;
        color: #333;
        font-size: 13px;
        border-radius: 10px !important;
    }
</style>
<div class="center-block" style="float: none; background-color:#fff;padding:0;max-width: 550px;">
    <div class="hometitle"><a href="" style="color: #ffffff;"><?php echo $conf['sitename'];?></div></a>
        <div style="width: 5rem;height: 5rem;"></div>
            <p style="font-size: 13px;text-align:center">
                用注册时填写的QQ扫码即可<br>
                只有注册过账号的用户才可以使用快捷登录<br>
                若在用户中心修改过QQ号码，就使用修改后的号码登录
            </p>
            <br>
            <div align="center">
                <div id="qrimg"></div>
            </div>
            <br>
            <div class="foots" style="font-size: 14px;">
                <a href="login.php"><b>返回登录</b></a>
            </div>
            <div style="margin-top: 48.5rem;">&nbsp;</div>
            
<?php }else{ ?>

<style>
html body{
    max-width: 1550px;
    margin: 0 auto;
}
a{ text-decoration:none;}
    .logosx{
            margin-top: 1.125rem;
    margin-left: 1.59375rem;
    width: 2.59375rem;
    height: 2.09375rem;
    align-self: flex-start;
    }
    .stitle{
            width: 100%;
        padding-left: 1.525rem;
    color: #<?php echo $conf['rgb01']; ?>;
    font-weight: 600;
    font-size: 18px;
    margin-top: .5rem;
    }
    .sinput{
            padding: 0.65625rem .80625rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border: 0.0625rem solid #D3D6DC;
    margin: 0px 50px;
    margin-top: 30px;
    height: 2.125rem;
    border-radius: 1.3125rem;
    }
    .sinput input{
        border:0px;
        width: 90%;
    }
    .loginbtn{
    height: 1.75rem;
    background: linear-gradient(90deg,#<?php echo $conf['rgb01']; ?> 0%,#<?php echo $conf['rgb01']; ?> 100%);
    border-radius: 1.53125rem;
    font-weight: 500;
    color: #fff;
    font-size: 14px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0px 50px;
    margin-top: 1.59375rem;
    }
    .btnxs{
        margin: 10px 25px;
        display: flex;
        justify-content: space-between;
    }
    .btnxs a{
        color: #<?php echo $conf['rgb01']; ?>;
    }
    .foots{
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }
    .foots a{
        color: #<?php echo $conf['rgb01']; ?>;
    }
    .geetest_btn{
           margin: 10px 5%;
    width: 90% !important;
    }
    .geetest_radar_btn{border-radius:26px !important;
         
    }
        .hometitle{
       width: 100%;
    text-align: center;
    color: #fff;
   background: linear-gradient(90deg,#<?php echo $conf['rgb01']; ?> 0%,#<?php echo $conf['rgb01']; ?> 100%);
    height: 50px;
    line-height: 50px;
    font-size: 15px;
    font-weight: 550;
    border-radius: 0 0 30px 30px;
    }
    .label {
            color: #868686;

    }
</style>
<div class="center-block" style="float: none; background-color:#fff;padding:0;max-width: 550px;">
    <div class="hometitle"><a href="" style="color: #ffffff;"><?php echo $conf['sitename'];?></div></a>
        <div style="width: 5rem;height: 5rem;"></div>
            <p style="font-size: 13px;text-align:center">
                用注册时填写了QQ扫码即可<br>
                只有注册过账号的用户才可以使用<br>
                若在用户中心修改过QQ号码，就使用修改后的号码登录
            </p>
            <br>
            <div align="center">
                <div id="qrimg"></div>
            </div>
            <br>
            <div class="foots" style="font-size: 14px;">
                <a href="login.php"><b>返回登录</b></a>
            </div>
            <div style="margin-top: 65rem;">&nbsp;</div>
            
<?php }?>
<?php if($type=='qq' && $conf['login_qq']==2){?>

<?php }elseif($_GET['act'] == 'bind'){?>
          <form>
            <div class="input-group"><div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
              <input type="text" name="user" value="" class="form-control" required="required" placeholder="用户名"/>
            </div><br/>
            <div class="input-group"><div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
              <input type="password" name="pass" class="form-control" required="required" placeholder="密码"/>
            </div><br/>
			<?php if($conf['captcha_open_login']==1 && $conf['captcha_open']>=1){?>
			<input type="hidden" name="captcha_type" value="<?php echo $conf['captcha_open']?>"/>
			<?php if($conf['captcha_open']>=2){?><input type="hidden" name="appid" value="<?php echo $conf['captcha_id']?>"/><?php }?>
			<div id="captcha" style="margin: auto;"><div id="captcha_text">
                正在加载验证码
            </div>
            <div id="captcha_wait">
                <div class="loading">
                    <div class="loading-dot"></div>
                    <div class="loading-dot"></div>
                    <div class="loading-dot"></div>
                    <div class="loading-dot"></div>
                </div>
            </div></div>
			<div id="captchaform"></div>
			<br/>
			<?php }?>
            <div class="form-group">
			  <input type="button" value="立即绑定账号" id="submit_login" class="btn btn-primary btn-block"/>
            </div>
			<hr>
			<div class="form-group">
			<a href="javascript:history.back(-1)" class="btn btn-danger btn-rounded"><i class="fa fa-reply"></i>&nbsp;返回</a>
			<a href="findpwd.php" class="btn btn-info btn-rounded" style="float:right;"><i class="fa fa-unlock"></i>&nbsp;找回密码</a>
			</div>
          </form>
<?php }else{?>
			<hr>
            <p><a href="javascript:quickreg('<?php echo $type?>')" class="btn btn-info btn-block"><i class="fa fa-user-plus"></i>&nbsp;我是新用户，直接登录</a></p>
			<hr>
			<p><a href="connect.php?act=bind&type=<?php echo $type.$addstr?>" class="btn btn-default btn-block"><i class="fa fa-user-circle-o"></i>&nbsp;我是老用户，绑定已有账号</a></p>
			</div>
			<hr>
<?php }?>
          </form>
    </div>
  </div>
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<?php if($type=='qq' && $conf['login_qq']==2){?>
<script>
var islogin=1;
</script>
<script src="../assets/js/qrlogin.js?ver=<?php echo VERSION ?>"></script>
<?php }else{?>
<script src="../assets/js/login.js?ver=<?php echo VERSION ?>"></script>
<?php }?>
  <script>
function fuckyou(){
window.close(); 
window.location="about:blank"; 
}
function click(e) {
if (document.all) {
  if (event.button==2||event.button==3) { 
alert("欢迎光临寒舍，有什么需要帮忙的话，请与站长联系！谢谢您的合作！！！");
oncontextmenu='return false';
}
}
if (document.layers) {
if (e.which == 3) {
oncontextmenu='return false';
}
}
}
if (document.layers) {
fuckyou();
document.captureEvents(Event.MOUSEDOWN);
}
document.onmousedown=click;
document.oncontextmenu = new Function("return false;")
document.onkeydown =document.onkeyup = document.onkeypress=function(){ 
if(window.event.keyCode == 123) { 
fuckyou();
window.event.returnValue=false;
return(false); 
} 
}
</script>
</body>
</html>
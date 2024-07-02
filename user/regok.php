<?php
/**
 * 开通成功页面
**/
include("../includes/common.php");
$title='开通站点成功';
?>
<?php if($background_image){?>
<img src="<?php echo $background_image;?>" alt="Full Background" class="full-bg full-bg-bottom animation-pulseSlow" ondragstart="return false;" oncontextmenu="return false;">
<?php }?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>开通站点成功</title>
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
<style>body{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style></head>
<body>
<style>
    .layui-carousel, .layui-carousel>[carousel-item]>* {
        background-color:transparent;
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
<?php
if(isset($_GET['orderid'])){
	$orderid = daddslashes($_GET['orderid']);
	$row=$DB->getRow("SELECT * FROM pre_pay WHERE trade_no='{$orderid}' LIMIT 1");
	if(!$row || $row['status']==0 || $row['tid']!=-2)showmsg('订单不存在或未完成支付！',3);
	if(!$cookiesid || $row['userid']!=$cookiesid)showmsg('仅限查看自己开通的分站信息',3);
	$input=explode('|',$row['input']);
	$type = $input[0];
	if($type == 'update'){
		$zid = intval($input[1]);
		$row=$DB->getRow("SELECT * FROM pre_site WHERE zid='{$zid}' LIMIT 1");
		$kind = intval($row['power']);
		$domain = $row['domain'];
		$user = $row['user'];
		$pwd = $row['pwd'];
		$name = $row['sitename'];
		$qq = $row['qq'];
		$endtime = $row['endtime'];
	}else{
		$kind = intval($input[1]);
		$domain = daddslashes($input[2]);
		$user = daddslashes($input[3]);
		$pwd = daddslashes($input[4]);
		$name = daddslashes($input[5]);
		$qq = daddslashes($input[6]);
		$endtime = daddslashes($input[7]);
	}
	$sitepath = str_replace('/user','',$sitepath);
	$url = 'http://'.$domain.$sitepath.'/';
}elseif(isset($_GET['zid'])){
	$zid = intval($_GET['zid']);
	$row=$DB->getRow("SELECT * FROM pre_site WHERE zid='{$zid}' LIMIT 1");
	if(!$row || !$_SESSION['newzid'] || $_SESSION['newzid']!=$zid)showmsg('你所开通的分站信息不存在！',3);
	$kind = intval($row['power']);
	$domain = $row['domain'];
	$user = $row['user'];
	$pwd = $row['pwd'];
	$name = $row['sitename'];
	$qq = $row['qq'];
	$endtime = $row['endtime'];
	$sitepath = str_replace('/user','',$sitepath);
	$url = 'http://'.$domain.$sitepath.'/';
}else{
	showmsg('缺少参数',4);
}
?>

<div class="col-xs-12 col-sm-10 col-md-6 col-lg-4 center-block " style="float: none; background-color:#fff;padding:0;max-width: 550px;">
    <div class="block  block-all">
        <div class="block-white">
            <div class="block-back display-row align-center justify-between">
                <div style="border-width: .5px;
    border-radius: 100px;
    border-color: #dadbde;
    background-color: #f2f2f2;
    padding: 3px 7px;
    opacity: .8;align-items: center;justify-content: space-between;display: flex; flex-direction: row;height: 30px;">
                <a href="./"   class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.4rem" src="../assets/img/fanhui.png">&nbsp;
                </a>
                <div style="margin: 0px 8px; border-left: 1px solid rgb(214, 215, 217); height: 16px; border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-bottom-color: rgb(214, 215, 217);"></div>
                <a href="../" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.8rem" src="../assets/img/home1.png">&nbsp;
                </a>
            </div>
            <div style="font-size: 15px;">
            <font><a href="">开通站点成功</a></font>

            </div>
                </div>
        <div style="background: #f2f2f2; height: 10px"></div>
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
            <div class="my-cell-title display-row justify-between align-center">
                <div class="my-cell-title-l left-title" style="font-size:1.4rem">开通站点成功</div>
            </div>
			<div class="alert alert-success">
				恭喜您开通站点成功！<br>
				前往您的网址登录账号密码即可！<br>
				请牢记自己的账号密码！
			</div>
                <li class="list-group-item"><b>我的网址：</b><a style="color: #6495f2;" href="<?php echo $url?>" target="_blank"><?php echo $url?></a></li>
				<li class="list-group-item"><b>我的账号：</b><?php echo $user?></a></li>
				<li class="list-group-item"><b>我的密码：</b><?php echo $pwd?></a></li>
				<br /><br />
            </div>
		</div>
	</div>
</div>
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnserver?>assets/appui/js/plugins.js"></script>
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
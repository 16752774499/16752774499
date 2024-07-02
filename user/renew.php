<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>自助续期站点</title>
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

<?php
/**
 * 自助续期站点
**/
include("../includes/common.php");
$title='自助续期站点';

if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<?php
if($userrow['power']==0){
	showmsg('你没有权限使用此功能！',3);
}
if($userrow['power']==2){
	$price = $conf['fenzhan_price2'];
	if($userrow['upzid']>1){
		$ktfz_price2 = $DB->getColumn("SELECT ktfz_price2 FROM pre_site WHERE zid='{$userrow['upzid']}' LIMIT 1");
		if($ktfz_price2 && $ktfz_price2>0){
			$price = $ktfz_price2;
		}
	}
}else{
	$price = $conf['fenzhan_price'];
	if($userrow['upzid']>1){
		$ktfz_price = $DB->getColumn("SELECT ktfz_price FROM pre_site WHERE zid='{$userrow['upzid']}' LIMIT 1");
		if($ktfz_price && $ktfz_price>0){
			$price = $ktfz_price;
		}
	}
}
$fenzhan_expiry = $conf['fenzhan_expiry']>0?$conf['fenzhan_expiry']:12;
if($userrow['endtime']>date("Y-m-d")) $endtime = date("Y-m-d", strtotime("+ {$fenzhan_expiry} months", strtotime($userrow['endtime'])));
else $endtime = date("Y-m-d", strtotime("+ {$fenzhan_expiry} months"));
if($_GET['act']=='submit'){
	if($price>$userrow['rmb'])exit("<script language='javascript'>alert('你的余额不足，请充值！');window.location.href='./';</script>");
	$DB->exec("UPDATE `pre_site` SET `endtime`='$endtime',`rmb`=`rmb`-'{$price}' WHERE `zid`='{$userrow['zid']}'");
	addPointRecord($userrow['zid'], $price, '消费', '自助续期站点');
	exit("<script language='javascript'>alert('恭喜你成功续期到{$endtime}！');window.location.href='index.php';</script>");
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
                <a href="siteinfo.php"  class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.4rem" src="../assets/img/fanhui.png">&nbsp;
                </a>
                <div style="margin: 0px 8px; border-left: 1px solid rgb(214, 215, 217); height: 16px; border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-bottom-color: rgb(214, 215, 217);"></div>
                <a href="../" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.8rem" src="../assets/img/home1.png">&nbsp;
                </a>
            </div>
            <div style="font-size: 15px;">
            <font><a href="">自助续期站点</a></font>

            </div>
                </div>
            <div class="form-group form-group-transparent" style="background: #f2f2f2; padding:2px 0px;padding-left: 0px;margin: 0 0px;">
                <div class="input-group" style="width:100%">
                    <div class="input-group-addon">
                        自助续期站点
                    </div>
                    <div style="color:#696969" class="form-control form-control-left">余额：<?php echo $userrow['rmb']?>元</div>
                </div>
            </div>
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    当前到期时间
                                </div>
                    <input name="need" class="form-control" style="text-align: right;background:#fff;" value="<?php echo $userrow['endtime']?>" disabled="">
				</div>
			</div>
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    续期后到期时间
                                </div>
                    <input name="need" class="form-control" style="text-align: right;background:#fff;" value="<?php echo $endtime?>" disabled="">
				</div>
			</div>
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    续期所需费用
                                </div>
                    <input name="need" class="form-control" style="text-align: right;background:#fff;" value="￥<?php echo $price?>元"  disabled="">
				</div>
			</div>
		</div>
		
                <div class="text-center" style="padding: 30px 0;">
			<a class="btn submit_btn" style="width: 80%;padding:8px;" href="?act=submit">立即续期</a>
			
		</div>
	</div>
  </div>
</div>
<?php include './foot.php';?>
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
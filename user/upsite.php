
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>自助升级站点</title>
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
/**
 * 自助升级站点
**/
include("../includes/common.php");
$title='自助升级站点';

if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>

<?php
if(!$conf['fenzhan_upgrade'])showmsg('此功能维护中……');
if($userrow['power']==0){
	showmsg('你没有权限使用此功能！',3);
}
$price = $conf['fenzhan_upgrade'];
if($userrow['upzid']>1){
	$upsite = $DB->getRow("SELECT zid,power,ktfz_price2 FROM pre_site WHERE zid='{$userrow['upzid']}' LIMIT 1");
	if($upsite && $upsite['power']==2){
		if($upsite['ktfz_price2'] && $upsite['ktfz_price2']>0){
			$price = $upsite['ktfz_price2'];
		}
		$tc_point=round($price-$conf['fenzhan_cost2'], 2);
	}
}
if($_GET['act']=='submit'){
	if(!checkRefererHost())exit();
	if($price>$userrow['rmb'])exit("<script language='javascript'>alert('你的余额不足，请充值！');window.location.href='./';</script>");
	$DB->exec("UPDATE `pre_site` SET `power`=2,`rmb`=`rmb`-'{$price}' WHERE `zid`='{$userrow['zid']}'");
	addPointRecord($userrow['zid'], $price, '消费', '升级到顶级合伙人');
	if(isset($tc_point) && $tc_point>0){
	    
	    $zid=$upsite['zid'];
	    $row=$DB->getRow("SELECT * FROM shua_fxbl WHERE id=1 LIMIT 1"); 	  ///取出比例
		/*第一次寻找上级*/
		$userid_up = $DB->getRow("SELECT * FROM shua_site WHERE zid=$zid");
		$userid = $userid_up['zid'];  //给值到userid  下面开始循环第二层
        for ($i=0; $i<=20; $i++){
		if($userid > 0){
		$fxbl_lv = $row["lv$i"] / 100; //循环等级取出佣金比例	
		$fxbl_money = $tc_point*0.1 *  $fxbl_lv;
		$fxbl_money=round($fxbl_money, 2);
		$userid_up = $DB->getRow("SELECT * FROM shua_site WHERE zid=$userid"); //查询当前用户的信息
		if($userid_up['power'] == 2){  //判断是否有上级且是否为合伙人
		changeUserMoney($userid, $fxbl_money ,true,'提成', '你的团队有人升级站点,获得'.$fxbl_money.'元提成');	
		}
		$userid = $userid_up['upzid'];
		if(!$userid){
		 break;   
		}
    }

  }
	    
	    
		changeUserMoney($upsite['zid'], $tc_point*0.9, true, '提成', '你网站的用户升级站点,获得'.$tc_point*0.9.'元提成');
	}
	exit("<script language='javascript'>alert('恭喜你成功升级站点！');window.location.href='index.php';</script>");
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
                <a href="javascript:history.back()" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.4rem" src="../assets/img/fanhui.png">&nbsp;
                </a>
                <div style="margin: 0px 8px; border-left: 1px solid rgb(214, 215, 217); height: 16px; border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-bottom-color: rgb(214, 215, 217);"></div>
                <a href="../" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.8rem" src="../assets/img/home1.png">&nbsp;
                </a>
            </div>
            <div style="font-size: 15px;">
            <font><a href="">自助升级站点</a></font>

            </div>
                </div>
            <div  style="background: #f2f2f2; height: 10px"></div>
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
            <div class="my-cell-title display-row justify-between align-center">
                <div class="my-cell-title-l left-title" style="font-size:1.4rem">顶级合伙人介绍</div>
            </div>
            <div style="font-size: 1.3rem;color: #999999;padding: 5px 10px">
                <p><font color="black">说明 : </font> 顶级合伙人享旗下所有分站站长管理功能，无限极差赚取下级分站提成，平台内的项目成本最低至0.2元每件，升级顶级合伙人利润更高，收益更大！</p>
        <hr>
        <i class="my-cell-title-l left-title"></i><font color="black">可享受知识付费商品1折</span></p>
        <br>
        <i class="my-cell-title-l left-title"></i><font color="black">可自定义设定下级分站开通价格，下级商品成本价格</span></p>
        <br>
        <i class="my-cell-title-l left-title"></i><font color="black">可无限开通分站站长</span></p>
        <br>
        <i class="my-cell-title-l left-title"></i><font color="black">获得无限代分佣特权</span></p>
        <br>
        <i class="my-cell-title-l left-title"></i><font color="black">赠送全套专属推广引流软件</span></p>
        <br>
        <i class="my-cell-title-l left-title"></i><font color="black">赠送专属独立安卓+苹果双端APP客户端</span></p>

       <hr>
       
       <font color="black">警告：</span></p>
       <font color="black">分站升级仅适合分站站长升级顶级合伙人使用</span></p>
       <font color="black">如果您已经是顶级合伙人，无需再进行升级</span></p>
       <font color="black">升级前务必请您确认是否有升级顶级合伙人的需求</span></p>
       <font color="black">如果分站等级升级成功，升级所花费的费用概不退款</span></p>
</div></div>
<div style="background: #f2f2f2; height: 10px"></div>
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
            <div class="my-cell-title display-row justify-between align-center">
                    <div class="my-cell-title-l left-title" style="font-size:1.4rem">自助升级站点</div>
                    <div class="my-cell-title-r  display-row  align-center">
                        <span style="color: #939393;font-size:1.3rem">当前余额：<?php echo $userrow['rmb']?>元</span>
                    </div>
                </div>
		<div class="panel-body">
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">
						升级版本
					</div>
					<select name="kind" class="form-control"><option value="2">顶级合伙人</option></select>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon">
						升级所需
					</div>
					<input name="need" class="form-control" value="<?php echo $price?>" disabled="">
					<div class="input-group-addon">
						元
					</div>
				</div>
			</div>
                <div class="text-center" style="padding: 30px 0;">
			<a class="btn submit_btn" style="width: 80%;padding:8px;" href="?act=submit">立即升级</a>
		</div>
	</div>
   </div>
  </div>
<?php include './foot.php';?>
</script>
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
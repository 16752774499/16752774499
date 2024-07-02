<?php
if(!defined('IN_CRONLITE'))exit();
?>
<?php
/**
 * 在线抽奖
**/
include("../includes/common.php");
$title='在线抽奖';

if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./user/login.php';</script>");
?>
<style type="text/css">
<!--
.STYLE3 {font-size: 14px}
-->
</style>

<div class="wrapper">
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
  <title>在线抽奖</title>
  <meta name="keywords" content="<?php echo $conf['keywords']?>">
  <meta name="description" content="<?php echo $conf['description']?>">
  <link href="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/simple/css/plugins.css">
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/simple/css/main.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $cdnpublic ?>layui/2.5.7/css/layui.css"/>
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/simple/css/oneui.css">
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/css/common.css?ver=<?php echo VERSION ?>">
  <script src="<?php echo $cdnpublic?>modernizr/2.8.3/modernizr.min.js"></script>
<style>html{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style>
</head>
<style>
    body{
        max-width:550px;
        margin:0 auto;
      overflow: auto;height: auto !important;
    }
    .container {
        margin:10px 0px;
  width: 80%;
  text-align: center;
}

    
    .top{
      background-color: #<?php echo $conf['rgb01']; ?>;
      width: 100%;
      max-width: 550px;
      padding-bottom:15px;
      }
    .top1{
      background-color: #<?php echo $conf['rgb01']; ?>;
      width: 100%;
      max-width: 550px;0
      padding-bottom:10px;
      position: fixed;
      }
      .home{
              text-align: center;
    line-height: 25px;
        height: 25px;
        width: 25px;
        border-radius: 50%;
        background-color: #fff;
        position: fixed;
        top: 18px;
        margin-left: 18px;
      }
      .toptitle{
      font-weight:600;
      color:#fff;
      text-align: center;
      height: 60px;
      line-height: 65px;
      }
      .article-content img {
      max-width: 100% !important;
      }
      .main[data-v-cc2d9c72] {
      width: 93%;
      }
      .main {
      margin: 0 auto;
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
<body>
    
    <div class="top">
    <div class="top1" style="z-index:10000;">
        <a href="./" class="home">
            <i class="layui-icon layui-icon-return"></i>
        </a>
        <div class="toptitle" style="font-size: 15px;">
            <a href="" style="color: #ffffff;">在线抽奖</a>
        </div>
            </div>
                </div>
    <div class="likebox" style="padding-bottom: 4em;"></div>

<!--开通分站-->
<!--抽奖页面开始-->
        <div data-v-cc2d9c72 class="main">
<br>
            		  <?php  if($userrow['power']==2){?>
    <div class="tab-pane" id="gift">
                              <a class="btn btn-primary btn-block text-white" id="start" style="display:block;">开始</a>
                              <a class="btn btn-danger btn-block text-white" id="stop" style="display:none;">停止</a>
         <br>
                                 
		<div class="widget-content themed-background-flat text-right clearfix animation-pullup">
        <h4 id="roll" class="widget-heading h4"><font color="#<?php echo $conf['rgb01']; ?>" style="font-size: 15px;">点击上面开始按钮进行抽奖</font></h4>
</div><br>
		 <a style="font-size: 12px;">温馨提示：<br>&nbsp;&nbsp;&nbsp;抽中后点确定会跳转到商品页面，此时看到的价格依然是0元，继续点击购买商品会直接免费领取成功。</a><br>
<br>            <div  style="background: #8e8d8d; height: 0.1px"></div>
                    <br>
                    
                    <?php }?>
            		  <?php  if($userrow['power']==0 || $userrow['power']==1){?>
    <div class="tab-pane" id="gift">
                              <a href="user/regsite.php" class="btn btn-primary btn-block text-white"  style="display:block;font-size: 13px;" >您当前权限不足请先升级<br>升级到顶级合伙人即可使用此抽奖功能<br>【点我前往升级】</a>
         <br>
                    <?php }?>
                    
                    
		 <font color="#FF7F00">
		 <b>奖品内容一：</b>商品<?php echo $conf["cjmoney"];?>元购买价！<br>
		 <b>奖品内容二：</b>概率抽中仅需1元即可搭建本站1:1同款平台(价值998元)，抽中后需联系Q群客服！
		 </font><br>
                    <br>

            <div  style="background: #8e8d8d; height: 0.1px"></div>


                    <br>
		 
		 <font color="#FF7F00">
		 <b>抽奖规则一：</b>仅顶级合伙人能使用此抽奖功能！<br>
		 <b>抽奖规则二：</b>每人每天限抽3次！<br>
		 <b>抽奖规则三：</b>100%必中奖！<br>
		 <b>抽奖规则四：</b>利用本抽奖系统作弊的平台将会封停账号处理！<br>
		 <b>抽奖规则五：</b>免费抽的商品不支持提交售后反馈，如若提交默认完结！<br>
		 注：本规则会根据业务发展的需要适时作出调整和修改，最终解释权归平台所有。<br>
         <br><font color="#008000">抽奖心得：赶快邀请你的朋友来吧，听说推广网站有几率中大奖哦！</font>
         <button id="copy-btn" class="btn btn-success btn-xs" data-clipboard-text="我在这里参与抽奖，你也快来吧！地址：<?php echo $_SERVER['HTTP_HOST'];?>        （请复制网址到浏览器内打开）">点我复制推广链接</button>
</font>
                        <br><br>
                        <div class="giftlist" style="display:none;">
                          <li style="width: 100%;display: inline-block;border-radius: 5px;padding: 10px -10;box-shadow: 1px 1px 2px #e2dfdf;border:  1px solid #666666;">最新中奖记录：<ul class="list-group" id="pst_1"></ul></li>
                          
                        </div>
	</div><br>

<!--抽奖页面结束-->

</div>
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script src="<?php echo $cdnpublic?>clipboard.js/1.7.1/clipboard.min.js"></script>
<script>
var clipboard = new Clipboard('#copy-btn');
clipboard.on('success', function(e) {
layer.msg('复制成功，快去发给你的朋友吧！');
});
clipboard.on('error', function(e) {
layer.msg('复制失败，请长按链接后手动复制');
});
</script>
<script src="<?php echo $cdnserver?>assets/appui/js/plugins.js"></script>
<script src="<?php echo $cdnserver?>assets/appui/js/app.js"></script>
<script type="text/javascript">
var isModal=<?php echo empty($conf['modal'])?'false':'true';?>;
var homepage=true;
var hashsalt=<?php echo $addsalt_js?>;
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
<?php if($conf['classblock']==1 || $conf['classblock']==2 && checkmobile()==false)include TEMPLATE_ROOT.'default/classblock.inc.php'; ?>
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
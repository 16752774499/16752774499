<?php
if (!defined('IN_CRONLITE')) die();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh" style="font-size: 18px;">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta name="renderer" content="webkit"/>
    <meta name="force-rendering" content="webkit"/>
    <title><?php echo $conf['sitename'] . ($conf['title'] == '' ? '' : ' - ' . $conf['title']) ?></title>
    <meta name="keywords" content="<?php echo $conf['keywords'] ?>">
    <meta name="description" content="<?php echo $conf['description'] ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnpublic ?>layui/2.5.7/css/layui.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo $cdnserver ?>assets/store/css/cart.css"/>
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
      padding-bottom:10px;
      }
    .top1{
      background-color: #<?php echo $conf['rgb01']; ?>;
      width: 100%;
      max-width: 550px;
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
      font-weight:550;
      color:#fff;
      text-align: center;
      height: 50px;
      line-height: 65px;
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

    }
    .layui-layer{
    border-radius: 9px !important;
    }
    .layui-layer-title{
        border-radius: 9px !important;
    }
</style>
<body>
    
    <div class="top">
    <div class="top1">
        <a href="javascript:history.back()" class="home">
            <i class="layui-icon layui-icon-return"></i>
        </a>
        <div class="toptitle" style="font-size: 15px;">
            <a href="" style="color: #ffffff;">购物车</a>
        </div>
            </div>
               </div>
    <div class="likebox" style="padding-bottom: 4em;"></div>
<div class="clear"></div>
<div class="gwcbox">
    <div class="gwcbox_1" id="CartContent"></div>
    <div class="kbox"></div>

    <div class="hejiBox">
        <div class="heji" style="bottom: 0" >
            <div class="heji_1">
                <div class="gwccheck on"></div>
            </div>
            <div class="heji_2" style="color: #A6A6A6;font-size: 13.5px">全选</div>
            <div class="heji_3"><p style="color: #A6A6A6;font-size: 14px">合计：<span id="price_all" style="color: #ffa56a;font-size: 14px">￥0</span></p></div>
            <div class="heji_5">
                <a href="javascript:GoodsCart.submit()">结算</a>
            </div>
        </div>
    </div>

    <div id="CartNull" style="display: none">
        <div class="paysuccess">
            <div class="pay30">
                <img src="template/storenews/image/cart-empty.png" style="width: 50%;height:50%;margin-bottom: .5rem;">
                <p>~ 购物车内空空如也 ~</p><br>
            </div>
        </div>
    </div>


            <div></div>
            <div></div>
        </div>
    </div>

    

<script src="<?php echo $cdnpublic ?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>layui/2.5.7/layui.all.js"></script>
<script type="text/javascript">
var hashsalt=<?php echo $addsalt_js?>;
</script>
<script src="assets/store/js/cart.js?ver=<?php echo VERSION ?>"></script>
<script>
	GoodsCart.CartList();
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
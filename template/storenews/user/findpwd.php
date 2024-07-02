<?php
if (!defined('IN_CRONLITE')) die();
@header('Content-Type: text/html; charset=UTF-8');
list($background_image, $background_css) = \lib\Template::getBackground();
?>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>找回密码</title>
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
  <style>html{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style>
     </head>
<style>
    .layui-carousel, .layui-carousel>[carousel-item]>* {
        background-color:transparent;
    }
.label{
    color: unset;
    line-height: 1.8;
}
.account-main{
    height: 100% !important;
}
a {
    text-decoration:none;
}
a:hover{
    text-decoration:none;
}
.fui-modal{z-index: 20;}
</style>
<?php if(checkmobile()){ ?>
<style>
html body{
    max-width: 550px;
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
<body>
    <div class="hometitle"><a href="" style="color: #ffffff;"><?php echo $conf['sitename'];?></div></a>
        <div style="width: 5rem;height: 5rem;"></div>
            <p style="font-size: 13px;text-align:center">
                用注册时填写的QQ扫码即可
            </p>
            <br>
            <div align="center">
                <div id="qrimg"></div>
            </div>
            <br>
            <div class="foots" style="font-size: 14px;">
                <a href="login.php"><b>返回登录</b></a>
            </div>
            <br>
<?php }else{ ?>

<style>
html body{
    max-width: 550px;
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
        padding-left: 1.225rem;
    color: #<?php echo $conf['rgb01']; ?>;
    font-weight: 550;
    font-size: 1.825rem;
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
    height: 1.925rem;
    border-radius: 1.3125rem;
    }
    .sinput input{
        border:0px;
        width: 90%;
    }
    .loginbtn{
    height: 1.55rem;
    background: linear-gradient(90deg,#<?php echo $conf['rgb01']; ?> 0%,#<?php echo $conf['rgb01']; ?> 100%);
    border-radius: 1.53125rem;
    font-weight: 500;
    color: #fff;
    font-size: .5375rem;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0px 100px;
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
           margin: 0px 5%;
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
<body>
    <div class="hometitle"><a href="" style="color: #ffffff;"><?php echo $conf['sitename'];?></div></a>
        <div style="width: 5rem;height: 5rem;"></div>
            <p style="font-size: 13px;text-align:center">
                用注册时填写了QQ扫码即可
            </p>
            <br>
            <div align="center">
                <div id="qrimg"></div>
            </div>
            <br>
            <div class="foots" style="font-size: 14px;">
                <a href="login.php"><b>返回登录</b></a>
            </div>
            <br>
<?php } ?>

<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script src="../assets/js/qrlogin.js?ver=<?php echo VERSION ?>"></script>
<script>
function goback()
{
document.referrer === '' ?window.location.href = '/' :window.history.go(-1);
}
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
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>资源投稿</title>
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
<body>    <link rel="stylesheet" href="../assets/user/css/work.css">
<style>    
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
 * 
**/
$is_defend=true;
include("../includes/common.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
if($islogin2==1 && $userrow['power']>0){
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
                <a href="./"  class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.4rem" src="../assets/img/fanhui.png">&nbsp;
                </a>
                <div style="margin: 0px 8px; border-left: 1px solid rgb(214, 215, 217); height: 16px; border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-bottom-color: rgb(214, 215, 217);"></div>
                <a href="../" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.8rem" src="../assets/img/home1.png">&nbsp;
                </a>
            </div>
            <div style="font-size: 15px;">
            <font><a href="">资源投稿</a></font>

            </div>
                </div>
            <div  style="background: #f2f2f2; height: 10px"></div>
            <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;">
                <div class="my-cell-title display-row justify-between align-center" >
                    <div class="my-cell-title-l left-title" style="font-size:1.3rem">资源变现</div>
                    <div class="my-cell-title-r  display-row  align-center" >
                       
                    </div>
                </div>
            <div style="text-align:center">
                <div class="fz-view" style="padding: 0 5px">
                    <a class="fz-detail" style="width: 100%; height: 5rem;border-radius:5px;text-align:center;" href="contributes.php?my=add" >
                 <div class="fz-info display-row align-center justify-center"
                             style="background-image:linear-gradient(to right, rgba(252, 198, 108, 1), rgba(249, 138, 63, 1));border-radius:5px;width: 49%;margin:0 auto">
                            <i class="fa fa-plus" size="3" style="padding-right: 10px;color: #fff"></i>
                            <font size="3" color="#FFFFFF">立即投稿赚钱</font>
                        </div>
                    </a>
                    <!--a class="fz-detail" style="width: 49%; height: 5rem;border-radius:5px;" href="./?mod=img">
                        <div class="fz-info display-row align-center justify-center"
                             style="background-image:linear-gradient(to right, rgba(130, 193, 255, 1), rgba(148, 93, 246, 1));border-radius:5px;">
                            <i class="fa fa-plus" size="3" style="padding-right: 10px;color: #fff"></i>
                            <font size="3" color="#FFFFFF">上传至平台</font>
                        </div>
                    </a-->
                </div><br>
                <div >
                    <font size="2" color="#a9a9a9" style="line-height:2rem">因近期很多站长上传重复且无用的课程过多导致每天都要清理大量的无用课程，决定投稿功能暂时关闭</font>
                   <!--<font size="2" color="#a9a9a9" style="line-height:2rem">至投稿起审核时间大概3天左右，请耐心等待。</font>-->
                </div>
                <center>
                    <br>
                <div class="form-group align-center" style="border: 0px solid #f2f2f2;margin-bottom: 5px;text-align:center">
                    <input class="c-switch__input" id="switch1" type="checkbox" >
                    <!--                    on checked-->
                    <span class="c-switch__label" >
                        <span class="d1 ">勾选则代表已阅读并同意<a style="color: #3793ff;" onclick="openmsg1()">《投稿项目须知》</a>
                        </span>
                    </span>
                </div>
</center>
            </div>
            </div>
            <div style="height:4.5rem;line-height:4.5rem;  width: 100%;background: #fff;display: flex;text-align: center;border-top:  1px solid #f2f2f2;">
                <a id="contribute" style="width: 100%;height: 100%" onclick="tap_tab('contribute')">已投项目</a>
                <!--a id="thing" style="width: 50%;height: 100%" onclick="tap_tab('thing')">分站项目</a-->
            </div>

        </div>

        <div class="flowlist"><div id="list"></div></div>
    </div>
</div>

<script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
<script src="//cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script charset="utf-8" src="../assets/user/js/work.js"></script>
<script>
    document.documentElement.addEventListener('touchstart', function (event) {
        if (event.touches.length > 1) {
            event.preventDefault();
        }
    }, {
        passive: false
    });

    // 禁用双击放大
    var lastTouchEnd = 0;
    document.documentElement.addEventListener('touchend', function (event) {
        var now = Date.now();
        if (now - lastTouchEnd <= 300) {
            event.preventDefault();
        }
        lastTouchEnd = now;
    }, {
        passive: false
    });
    $(document).ready(function(){
        var type = 'contribute';
        tap_tab(type);
        openmsg();
    })
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

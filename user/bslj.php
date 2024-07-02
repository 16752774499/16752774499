<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>推广专用链接</title>
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

<body>
<?php
/**
 * 推广专用链接
**/
include("../includes/common.php");
$title='推广专用链接';

if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<style type="text/css">
<!--
.STYLE3 {font-size: 14px}
-->
</style>

<div class="wrapper">
<?php
if($userrow['power']==0){
	showmsg('你没有权限使用此功能！',3);
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
                <a href="javascript:history.back()"   class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.4rem" src="../assets/img/fanhui.png">&nbsp;
                </a>
                <div style="margin: 0px 8px; border-left: 1px solid rgb(214, 215, 217); height: 16px; border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-bottom-color: rgb(214, 215, 217);"></div>
                <a href="../" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.8rem" src="../assets/img/home1.png">&nbsp;
                </a>
            </div>
            <div style="font-size: 15px;">
            <font><a href="">推广专用链接</a></font>

            </div>
                </div>
            <div  style="background: #f2f2f2; height: 10px"></div>
            
            
            <div class="my-cell" style="margin-bottom: 0px;padding: 0 10px;">
                <div class="my-cell-title display-row justify-between align-center" style="padding: 1.7rem 0rem;" >
                    <div class="my-cell-title-l left-title" style="font-size:1.3rem">推广专用不死链接</div>
                    <div>
                </div>

            </div>
                <div style="padding: 12px 5px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.4rem">
                    <div class="li-list-item">
                        <div style="#000">使用本链接可以做到永久推广！无需更换，后台自适应最新地址！</div>
                    </div>
                    <br>
                    <div class="li-list-item">
                        <div class="item-title"><b>不死链接：</b></div>
                        <div class="item-info" style="width:50%">
                            <a href="javascript:;" id="copy-btn" style="color:red;" data-clipboard-text="<?php echo $conf['cos01'] ?>/?zid=<?php echo $zid?>"><?php echo $conf['cos01'] ?>/?zid=<?php echo $zid?></a>
                        </div>
                    </div>
                    <br>
                </div>

                <div style="padding: 10px 0;font-size: 1.3rem;color: #858585;">
                    <font color="#000">*当前展示的的网址为你的永久推广网址！<br>
                    *如果觉得长可以用短网址平台缩短即可！<br>
                    <a style="color: #ff0000;">*短链接推荐用：<b>小码短链接</b>，直接微信搜索小程序即可！</a><br>
                    *建议用推广海报做推广！</font>
                </div>

                <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="<?php echo $conf['cos01'] ?>/?zid=<?php echo $zid?>">
                    <div class="submit_btn" style="width:95%;height: 4.2rem;margin:10px auto;text-align: center;line-height: 4.2rem;border-radius: 30px">复制链接</div>
                </a>
                </div>

            
                        <div  style="background: #f2f2f2; height: 10px">

            </div>
                        <div class="my-cell" style="margin-bottom: 0px;padding: 0 10px;">
                <div class="my-cell-title display-row justify-between align-center" style="padding: 1.7rem 0rem;" >
                    <div class="my-cell-title-l left-title" style="font-size:1.3rem">不死推广链接介绍</div>
                </div>

                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                  
                <p>本链接采用最新技术，实时同步跳转您的【最新主域名】</p>
                <p>该链接使用<img src="../assets/img/urlok.png" width="15" height="15"><font color="green">腾讯绿标域名</font>，在微信QQ等环境不会导致停止访问的情况！非常高效！</p>
                <p>一次推广，终身<font color="red">不流失客户</font>，链接永久不变！</p>
                <br>
                <p>该功能可避免之前推广出去的【主域名】被墙而导致的客户流失！</p>
                <p>网站链接打不开怎么办？直接<font color="green">换换换！</font></p>
                </div>
            </div>
                    </div>
    </div>
</div>


<script src="//cdn.staticfile.org/clipboard.js/1.7.1/clipboard.min.js"></script>
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
var clipboard = new Clipboard('#copy-btn');
clipboard.on('success', function (e) {
	layer.msg('复制成功');
});
clipboard.on('error', function (e) {
	layer.msg('复制失败，请长按链接后手动复制');
});

$("#recreate_url").click(function(){
	var self = $(this);
	if (self.attr("data-lock") === "true") return;
	else self.attr("data-lock", "true");
	var ii = layer.load(1, {shade: [0.1, '#fff']});
	$.get("ajax_user.php?act=create_url&force=1", function(data) {
		layer.close(ii);
		if(data.code == 0){
			layer.msg('生成链接成功');
			$("#copy-btn").html(data.url);
			$("#copy-btn").attr('data-clipboard-text',data.url);
		}else{
			layer.alert(data.msg);
		}
		self.attr("data-lock", "false");
	}, 'json');
});
});
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
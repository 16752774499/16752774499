<?php
if (!defined('IN_CRONLITE')) die();
$qqlink = 'https://wpa.qq.com/msgrd?v=3&uin='.$conf['kfqq'].'&site=qq&menu=yes';
if($is_fenzhan && !empty($conf['kfwx']) && file_exists(ROOT.'assets/img/qrcode/wxqrcode_'.$siterow['zid'].'.png')){
	$qrcodeimg = './assets/img/qrcode/wxqrcode_'.$siterow['zid'].'.png';
	$qrcodename = '微信';
}elseif(!empty($conf['kfwx']) && file_exists(ROOT.'assets/img/wxqrcode.png')){
	$qrcodeimg = './assets/img/wxqrcode.png';
	$qrcodename = '微信';
}else{
	$qrcodeimg = '//api.qrserver.com/v1/create-qr-code/?size=250x250&margin=10&data='.urlencode($qqlink);
	$qrcodename = 'QQ';
}
?>
<!DOCTYPE html>
<html lang="zh" style="font-size: 20px;">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover,user-scalable=no">
    <script> document.documentElement.style.fontSize = document.documentElement.clientWidth / 750 * 40 + "px";</script>
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-param" content="_csrf">
    <title><?php echo $conf['sitename'] .($conf['title']==''?'':' - '.$conf['title']) ?></title>
    <meta name="keywords" content="<?php echo $conf['keywords'] ?>">
    <meta name="description" content="<?php echo $conf['description'] ?>">
    <!-- Vendor styles -->
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnpublic ?>layui/2.5.7/css/layui.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver; ?>assets/store/css/foxui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver; ?>assets/store/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver; ?>assets/store/css/foxui.diy.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver; ?>assets/store/css/iconfont.css">
	<style>html{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style>
</head>

<style>
  ::-webkit-scrollbar{ 
	display: none;
   /* background-color:transparent; */
}
    .custormer-page {
       padding-bottom: 2.7rem;
        background: #f3f3f3;
    }

    .custormer-page .fixed {
      
    }

    .custormer-page .box {
        width: 95%;
        /*height: 17rem;*/
        background: #fff;
        border-radius: 0.4rem;
        text-align: center;
       
    }

    .custormer-page .box p {
        line-height: 2rem;
        margin-top: 1rem;
        font-weight: bold;
        font-size: 0.8rem;
    }

    .custormer-page .box img {
        width: 13rem;
        height: 13rem;
    }

    .custormer-text {
        color: #969696;
        line-height: 2rem;
        font-size: 0.65rem;
        font-weight: bold;
    }

    .complaint {
        display: flex;
        flex-wrap: nowrap;
        align-items: center;
        color: #3c3d3e;
        width: 95%;
        height: 2rem;
        line-height: 2rem;
        justify-content: center;
        background: #e8e8e8;
        border-radius: 6px;
        margin: .5rem auto;
        
    }

    .complaint img {
        width: 1.5rem;
        margin-right: 0.2rem;
    }
    
    .custormer-page .box .box-btn{
        width: 100%;

    
        
    }
    .custormer-page .box .box-btn .box-btn-btn{
        width: 100%;
        height: 2.0rem;
        line-height: 2.0rem;
        text-align: center;
        background: -webkit-linear-gradient(left, rgba(91, 193, 241, 1.0), rgba(52, 151, 234, 1.0));
        color: #fff;
        border-radius:8px;
       
      
        
    }
    .custormer-page .box .box-top{
        width: 100%;
       
        display: flex;
        justify-content: space-between;
        margin: 10px 0 20px 0;
        font-size: 0.7rem;
        
    }
    .custormer-page .box .box-top .info{
        height: 5rem;
        width: 60%;
        display: flex;
        flex-direction: column;
		justify-content: space-between;
		 font-size: 0.7rem;
		border-right:1px solid #f3f3f3;

    }
    .custormer-page .box .box-top img{
        width: 5rem;
        height: 5rem;
    }
</style>


<body ontouchstart="" style="overflow: auto;height: 9rem; !important;max-width: 550px; margin:auto;">
<div id="body">
    <div class="custormer-page">
        <div style="width:100%" >
            <img style="width:100%" src="<?php echo $cdnserver?>template/storenews/image/user/kf_top.png"  />
        </div>
        <div class="box" style="margin:10px auto;padding:10px 20px">
            <div class="box-top">
                <div class="info">
                    <div style="width: 100%;display: flex;align-items:center">
                        <img style="width:30px;height:30px" src="<?php echo $cdnserver?>template/storenews/image/user/QQ.svg" />
                        <font style="padding-left:10px;font-weight:600">QQ客服</font>
                    </div>
                    <div style="width: 100%;display: flex;align-items:center">
                        <font style=" font-size: 0.75rem;color:#000"><?php echo $conf['kfqq'] ?></font>
                        <a href="javascript:;" class="wx_hao" data-clipboard-text="<?php echo $conf['kfqq'] ?>">
                            <img style="width:30px;height:30px;padding-left:10px" src="<?php echo $cdnserver?>template/storenews/image/user/fuzhi.svg" />
                        </a>
                    </div>
                    <div style="width:15px;height:2px;background-color:#e4e2e2"></div>
                    <div style="width: 100%;display: flex;align-items:center;font-size:12px;color:#9a9696">复制号码后打开QQ添加客服</div>
                </div>
                <img  src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq'] ?>&spec=100"/>
            </div>
            <div style="width:100%;height:10px; border-top: 1px solid #f3f3f3;"></div>
            <a class="box-btn" href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq'] ?>&site=qq&menu=yes" target="_blank">
                <div class="box-btn-btn" >打开QQ添加客服</div>
            </a>
        </div>
        <div class="box" style="margin:10px auto;padding:10px 20px">
            <div class="box-top">
                <div class="info">
                    <div style="width: 100%;display: flex;align-items:center">
                        <img style="width:30px;height:30px" src="<?php echo $cdnserver?>template/storenews/image/user/weixin.svg" />
                        <font style="padding-left:10px;font-weight:600">微信客服</font>
                    </div>
                    <div style="width: 100%;display: flex;align-items:center">
                        <font style=" font-size: 0.75rem;color:#000"><?php echo $conf['kfwx']; ?> </font>
                        <a href="javascript:;" class="wx_hao" data-clipboard-text="<?php echo $conf['kfwx']; ?>">
                            <img style="width:30px;height:30px;padding-left:10px" src="<?php echo $cdnserver?>template/storenews/image/user/fuzhi.svg" />
                        </a>
                        
                    </div>
                    <div style="width:15px;height:2px;background-color:#e4e2e2"></div>
                    <div style="width: 100%;display: flex;align-items:center;font-size:12px;color:#9a9696">复制号码后打开微信添加客服</div>
                </div>
                <img  src="<?php echo $qrcodeimg ?>">
            </div>
            <div style="width:100%;height:10px; border-top: 1px solid #f3f3f3;"></div>
            
            <a class="box-btn" onclick="openwx()">
                <div class="box-btn-btn" style="background: -webkit-linear-gradient(left, #52de87, #31cc56);">打开微信添加客服</div>
            </a>
        </div>
        
        <div>
       <?php  if($userrow['power']==1 || $userrow['power']==2){?>
                <a class="complaint" href="/user/uset.php?mod=site">
                    设置客服
                </a>
                                <?php }?>
            </div>        
        <div style="width:100%;text-align:center;font-size:0.65rem;color:#9a9696">- 如有疑问请咨询客服, 24小时竭诚为你服务 -</div>
    </div>
    <div class="fui-navbar" style="max-width: 550px;z-index: 100;">
        <a href="./" class="nav-item "><img src="./assets/user/img/home.png">  <span class="label">首页</span>
        </a>
        <a href="./?mod=query" class="nav-item "><img src="./assets/user/img/tab_order.png"> <span class="label">订单</span> </a>
    	<a href="./?mod=cart" class="nav-item " style="display:none"> <span class="icon icon-cart2"></span> <span class="label">购物车</span> </a>
        <a href="./?mod=kf" class="nav-item active"> <img src="./assets/user/img/tab_kefu_active.png"> <span class="label">客服</span>
        </a>
        <a href="./user/" class="nav-item "> <img src="./assets/user/img/tab_my.png"><span class="label">会员中心</span> </a>
    </div>


    
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic ?>layer/2.3/layer.js"></script>
<script src="<?php echo $cdnpublic ?>clipboard.js/1.7.1/clipboard.min.js"></script>
<script>
    var clipboard = new Clipboard('.wx_hao');
	clipboard.on('success', function (e) {
        layer.msg('复制成功');
    });
    clipboard.on('error', function (e) {
        layer.msg('复制失败');
    });
    function openwx(){
 
         locatUrl = "weixin://";

         if(/ipad|iphone|mac/i.test(navigator.userAgent)) {

            var ifr =document.createElement("iframe");

            ifr.src = locatUrl;

            ifr.style.display = "none";

            document.body.appendChild(ifr);

         }else{

            window.location.href = locatUrl;
         }

    }
</script>
<script>//禁止右键

 

function click(e) {

 

if (document.all) {

 

if (event.button==2||event.button==3) { alert("欢迎光临寒舍，有什么需要帮忙的话，请与站长联系！谢谢您的合作！！！");

 

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

 

document.captureEvents(Event.MOUSEDOWN);

 

}

 

document.onmousedown=click;

 

document.oncontextmenu = new Function("return false;")

 

document.onkeydown =document.onkeyup = document.onkeypress=function(){ 

 

if(window.event.keyCode == 12) { 

 

window.event.returnValue=false;

 

return(false); 

 

} 

 

}

 

</script>

 

 

 

  <script>//禁止F12

 

function fuckyou(){

 

window.close(); //关闭当前窗口(防抽)

 

window.location="about:blank"; //将当前窗口跳转置空白页

 

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
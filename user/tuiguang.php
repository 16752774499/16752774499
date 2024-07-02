<?php
$is_defend=true;
require '../includes/common.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$title = '推广赚钱';

?>

<?php
if($userrow['power']==0){
	showmsg('你没有权限使用此功能！',3);
}
if(!$userrow['domain'])showmsg('当前分站还未绑定域名',3);
$scriptpath = str_replace('\\','/',$_SERVER['SCRIPT_NAME']);
$scriptpath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$scriptpath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$url = 'http://'.$userrow['domain'].$scriptpath.'/';
if($conf['fanghong_api']>0){
	$turl = fanghongdwz($url);
	if($turl == $url){
		showmsg('防红地址生成失败，请联系站长更换接口',3);
	}elseif(strpos($turl,'/')===false){
		showmsg('防红地址生成失败:'.$turl,3);
	}
}else{
	$turl = $url;
}
?>
<html lang="zh-cn" style="" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths"><head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>推广海报</title>
  <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../assets/simple/css/plugins.css">
  <link rel="stylesheet" href="../assets/simple/css/main.css">
  <link rel="stylesheet" href="../assets/css/common.css">
    <link href="//cdn.staticfile.org/layui/2.5.7/css/layui.css" rel="stylesheet">
  <script src="//cdn.staticfile.org/modernizr/2.8.3/modernizr.min.js"></script>
  <link rel="stylesheet" href="../assets/user/css/my.css">
   <script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdn.staticfile.org/layui/2.5.7/layui.all.js"></script><link id="layuicss-laydate" rel="stylesheet" href="http://cdn.staticfile.org/layui/2.5.7/css/modules/laydate/default/laydate.css?v=5.0.9" media="all"><link id="layuicss-layer" rel="stylesheet" href="http://cdn.staticfile.org/layui/2.5.7/css/modules/layer/default/layer.css?v=3.1.1" media="all"><link id="layuicss-skincodecss" rel="stylesheet" href="http://cdn.staticfile.org/layui/2.5.7/css/modules/code.css" media="all">
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
            <font><a href="">推广海报</a></font>

            </div>
                </div>
            <div  style="background: #f2f2f2; height: 10px"></div>
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
            <div class="my-cell-title display-row justify-between align-center">
                <div class="my-cell-title-l left-title" style="font-size:1.3rem">推广海报</div>
            </div>
            <div style="font-size: 1.1rem;color: #999999;padding: 5px 10px">
                <p><font color="black">步骤一 : </font> 将以下图片保存至相册，在QQ好友、QQ群、QQ空间、微信好友、微信朋友圈、贴吧、论坛等地方发表！</p>
                <p><font color="black">步骤二 : </font> 用户扫描下面任意一张二维码均可进入您的网站，下单均可获得提成哦~</p>
                <p><font color="black">推广专用链接：</font><a style="font-size: 1.1rem;color: #999999;" href="./bslj.php" class="item-right">进入查看</a></p>
            </div>

        </div>
                    <div  style="background: #f2f2f2; height: 10px"></div>
        <div style="font-size: 1.1rem;color: #999999;padding: 0 10px;margin-top: 10px;text-align: center">
            <p>左右滑动查看更多推广海报</p>
        </div>
        <div class="layui-carousel" id="test1" lay-filter="test1" style="margin: 10px auto; width: 95%; height: 50vh;" lay-anim="" lay-indicator="outside" lay-arrow="always">
            <div carousel-item="" class="text-center">
                <div class="layui-this">
                    <img style=" height: 50vh" id="img_1" src="./timg/timg.php?id=1&url=<?php echo urlencode($conf['cos01'] . '?zid=' . $zid); ?>" alt="推广图1"></div>
                <div>
                    <img style=" height: 50vh" id="img_2" src="./timg/timg.php?id=2&url=<?php echo $conf['cos01'] ?>?zid=<?php echo $zid?>" alt="推广图2"></div>
                <div>
                    <img style=" height: 50vh" id="img_3" src="./timg/timg.php?id=3&url=<?php echo $conf['cos01'] ?>?zid=<?php echo $zid?>" alt="推广图3"></div>
                <div>
                    <img style=" height: 50vh" id="img_4" src="./timg/timg.php?id=4&url=<?php echo $conf['cos01'] ?>?zid=<?php echo $zid?>" alt="推广图4"></div>
                <div>
                    <img style=" height: 50vh" id="img_5" src="./timg/timg.php?id=5&url=<?php echo $conf['cos01'] ?>?zid=<?php echo $zid?>" alt="推广图5"></div>
                <div>
                    <img style=" height: 50vh" id="img_6" src="./timg/timg.php?id=6&url=<?php echo $conf['cos01'] ?>?zid=<?php echo $zid?>" alt="推广图6"></div>
                <div>
                    
            </div>
             </div>
        <div class="layui-carousel-ind"><ul><li class="layui-this"></li><li></li><li></li><li></li><li></li><li></li></ul></div><button class="layui-icon layui-carousel-arrow" lay-type="sub"></button><button class="layui-icon layui-carousel-arrow" lay-type="add"></button></div>
        <div class="text-center" style="padding: 20px 0;margin-top: 30px">
            <a type="submit" class="btn submit_btn" style="width: 80%;padding:8px;" onclick="CunTips()">保存海报</a>
        </div>
        <div style="font-size: 1.1rem;color: #999999;padding: 0 10px;text-align: center">
            <p style="text-align: center;"><span style="color: rgb(148 146 146); font-family: 微软雅黑, " microsoft="" font-size:="" text-align:="" background-color:="">© 版权所有 <?php echo $conf['sitename'] ?></span></p>
        </div>
	</div>
    </div>


<script type="text/javascript">
    var ins;
    var ins_index = 1;
    layui.use('carousel', function(){
        var carousel = layui.carousel;
        //建造实例
        ins =  carousel.render({
            elem: '#test1'
            ,width: '95%' //设置容器宽度
            ,height:'50vh'
           // ,anim:'fade'
            ,arrow: 'always' //始终显示箭头
            ,autoplay:false
            ,indicator:'outside'
        });
        carousel.on('change(test1)', function(obj){ //test1来源于对应HTML容器的 lay-filter="test1" 属性值
            ins_index = obj.index + 1
        });
    });
    $("#test1").on("touchstart", function (e) {
        var startX = e.originalEvent.targetTouches[0].pageX;//开始坐标X
        $(this).on('touchmove', function (e) {
            arguments[0].preventDefault();//阻止手机浏览器默认事件
        });
        $(this).on('touchend', function (e) {
            var endX = e.originalEvent.changedTouches[0].pageX;//结束坐标X
            e.stopPropagation();//停止DOM事件逐层往上传播
            if (endX - startX > 30) {
                ins.slide("sub");
            }
            else if (startX - endX > 30) {
                ins.slide("add");
            }
            $(this).off('touchmove touchend');
        });
    });


function CunTips() {
    var url = $('#img_'+ ins_index )[0].src;
    if (this.isIE()) { // IE
      window.open(url, '_blank')
    } else {
      let a = document.createElement('a') // 创建a标签
      let e = document.createEvent('MouseEvents') // 创建鼠标事件对象
      e.initEvent('click', false, false) // 初始化事件对象
      a.href = url // 设置下载地址
      a.download ='img_'+ ins_index // 设置下载文件名
      a.dispatchEvent(e)
    }
}
function isIE () {
      if (!!window.ActiveXObject || 'ActiveXObject' in window) {
        return true
      } else {
        return false
      }
}
function TgTips() {
	layer.alert('若您有更好的图文广告模板，文字广告语，均可联系客服进行投稿哦~<br>期待下一个投稿的您~！', {
		icon: 6,
		title: '小提示',
		skin: 'layui-layer-molv layui-layer-wxd'
	})
}
$(document).ready(function(){

})

layer.open({
    type:1,
    title: false,
    area: '33rem',
    shade: 0.5,
    skin: "layerdemo",
    shadeClose: false,
    closeBtn: 0,
    offset: '25%',
    content:
        '<div class="display-column  align-center"  style="position: relative" >'+
        '<div class="form-group-border-bottom text-center" style="height: 4.5rem;line-height: 4.5rem;font-weight: 550;width:100%;"><b>温馨提示</b></div>'+
        '<img onclick="layer.closeAll();"  style="height: 2rem;position: absolute;top:1rem;right:1rem" src="../assets/user/img/close.png">'+
        '<div style="padding:10px 15px;font-size: 1.3rem;color: #545454;line-height:2rem;letter-spacing:.1rem;">亲爱的用户，您好，很高兴为您服务！<p style="vertical-align: inherit; text-indent: 2em;"><span style="caret-color: red;" draggable="true">本平台采用的是领先同行业的活码海报系统，</span><span style="caret-color: red; text-indent: 2em;">如果您在今后使用本平台的过程中遇到打开网站提示异常或无法打开的情况，可以找个其他能打开的站长海报图。进入后登录你的账号，在</span><strong><span style="caret-color: red; text-indent: 2em; color: #FF0000;" >【会员中心-站点信息】</span></strong><span style="caret-color: red; text-indent: 2em; color: #FF0000;"><span style="caret-color: red; text-indent: 2em; color: #000000;">内</span></span><span style="caret-color: red; text-indent: 2em;">换个主站域名，修改域名后你的推广海报就会自动恢复了，之前推广出去的海报图和APP也不会失效。</span></p><p style="vertical-align: inherit; text-indent: 2em;"><span style="caret-color: red;">如果您在日常使用过程中觉得使用推广海报比较麻烦，可去在微信内搜索小程序<strong><span style="caret-color: red; color: #FF0000;">【草料二维码】</span></strong>，将你的推广海报解析成活码链接即可。</span></p><p style="vertical-align: inherit; text-indent: 2em;"><strong><span style="caret-color: red; color: #00CD00;">温馨提示：【活码海报图/活码链接可长期使用并且不会失效】。</span></strong></p></div>'+
        
        '<div align="center"><a onclick="layer.closeAll();" style="height:4.5rem;width: 100%;line-height: 4.5rem;font-size: 1.6rem;color:#378bd3;font-weight: 510">知道了</a></div>' +
        '</div>'+
        '</div>',

});



</script>

</body>
</html>

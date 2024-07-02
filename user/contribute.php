<?php
/**
 * 
**/
include("../includes/common.php");

if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$my=isset($_GET['my'])?$_GET['my']:null;
?>
<html lang="zh-cn" style="" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths"><head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>项目投稿</title>
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

<?php
if($userrow['power']==0){
	showmsg('你没有权限使用此功能！',3);
}
?>

<style>
    input::placeholder{
        text-align: right;
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
                <a href="tougao.php"  class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.4rem" src="../assets/img/fanhui.png">&nbsp;
                </a>
                <div style="margin: 0px 8px; border-left: 1px solid rgb(214, 215, 217); height: 16px; border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-bottom-color: rgb(214, 215, 217);"></div>
                <a href="../" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.8rem" src="../assets/img/home1.png">&nbsp;
                </a>
            </div>
            <div style="font-size: 15px;">
            <font><a href="">项目投稿</a></font>

            </div>
                </div>
 <?php
 if($my=='edit') {
 $tid=intval($_GET['tid']);
 $row=$DB->getRow("SELECT * FROM pre_tools WHERE tid='$tid' LIMIT 1");
 ?>
        <div class="form-group form-group-transparent" style="background: #f2f2f2;">
            <div class="input-group" style="width:100%">
                <div class="input-group-addon" style="color:#969494;font-size:13px;">
                   项目信息
                </div>
                <div></div>
            </div>
        </div>

        <form action="./contribute.php?my=edit_submit&tid=<?php echo $tid ?>" method="POST" onsubmit="return checkinput()">
       
            <div class="form-group form-group-transparent form-group-border-bottom">
                <div class="input-group" style="width:100%">
                    <div class="input-group-addon">
                        项目名称*
                    </div>
                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>" required="" placeholder="请输入项目名称">
                </div>
            </div>
            <div class="form-group form-group-transparent form-group-border-bottom">
                <div class="input-group" style="width:100%">
                    <div class="input-group-addon">
                        项目分类*
                    </div>
                    <select name="cid" id="cid" class="form-control" default="">
                        <option value="0">请选择</option>
                        <?php
$rs=$DB->query("SELECT * FROM pre_class WHERE active=1 ORDER BY sort ASC");
while($res = $rs->fetch())
{
	echo '<option value="'.$res['cid'].'">'.$res['name'].'</option>';
}
?>
                    </select>
                </div>
            </div>
            
            <div class="form-group form-group-transparent form-group-border-bottom">
                <div class="input-group" style="width:100%">
                    <div class="input-group-addon">
                        项目封面
                    </div>
                    <input type="file" id="file" onchange="fileUpload()" style="display:none;">
                    <input type="text" class="form-control" id="shopimg" name="shopimg" value="<?php echo $row['shopimg'] ?>" style="visibility: hidden;">
                    <span class="input-group-btn" style="padding-right: 10px">
                        <a href="javascript:fileSelect()" title="上传图片">
                             <img style="width: 8rem; height: 8rem; " id="fileimg" 
                             src="../<?php echo $row['shopimg']?>">
                        </a>
                   </span>
                   
                </div>
            </div>
            <div class="form-group form-group-transparent">
                <div class="input-group" style="width:100%">
                    <div class="input-group-addon">
                        项目简介
                    </div>
                    <div class="form-control  form-control-left" style="color:#696969">请尽量完善商品相关简介</div>
                </div>
            </div>
            <div class="form-group form-group-transparent">
                <div class="ke-container ke-container-default" style="width: 100%;"><textarea class="form-control" id="editor_id" name="desc" rows="3" style="width: 100%; display: none;" placeholder="当选择该商品时自动显示，支持HTML代码"><?php echo $row['desc']?></textarea>
            </div>
            <div class="form-group form-group-transparent">
                <div class="input-group" style="width:100%">
                    <div class="input-group-addon">
                        资源链接
                    </div>
                    <div style="color:#696969" class="form-control form-control-left">请输入正确有效的链接</div>
                </div>
            </div>
            <div class="form-group form-group-transparent form-group-border-bottom">
                <textarea class="form-control" name="goods_param" placeholder="请输入资源下载地址,如：百度网盘分享链接"><?php echo $row['goods_param']?></textarea>
            </div>
            <div class="form-group form-group-transparent form-group-border-bottom">
                <div class="input-group" style="width:100%">
                    <div class="input-group-addon">
                        联系微信*
                    </div>
                    <input type="text" class="form-control" name="wx_test" value="<?php echo $row['wx_test']?>" required="" placeholder="联系方式(微信号)">
                </div>
            </div>
            <div class="text-center" style="padding: 30px 0;background: #f2f2f2;">
                <input type="submit" class="btn submit_btn" style="width: 80%;padding:8px;background-image:linear-gradient(to right , rgba(252, 184, 67, 1.0), rgba(255, 134, 62, 1.0));" value="确定修改">
            </div>
        </form>
        
     </div>

<script>

</script> 

<?php
}
if($my=='edit_submit')
{
$tid=intval($_GET['tid']);
$name=daddslashes($_POST['name']);
$cid=daddslashes($_POST['cid']);
$shopimg=daddslashes($_POST['shopimg']);
$desc=daddslashes($_POST['desc']);
$goods_param=daddslashes($_POST['goods_param']);
$wx_test=daddslashes($_POST['wx_test']);

$rows=$DB->getRow("SELECT * FROM pre_tools WHERE tid='$tid' LIMIT 1");
if(!$rows)
	showmsg('当前记录不存在！',3);
    if($DB->exec("UPDATE `pre_tools` SET `name` ='".$name."', `cid` ='".$cid."',`shopimg` ='".$shopimg."',`desc` ='".$desc."',`goods_param` ='".$goods_param."',`wx_test` ='".$wx_test."' WHERE `tid` ='{$tid}' ")!==false){
			showmsg('修改成功！<br/><br/><a href="./tougao.php">>>返回列表</a>',1);
	}else{
		showmsg('修改失败！'.$DB->error(),4);
	}
}
?>

<?php
if($my=='delete')
{
$tid=intval($_GET['tid']);
$sql="DELETE FROM pre_tools WHERE tid='$tid' limit 1";
	if($DB->exec($sql)!==false){
		showmsg('删除成功！<br/><br/><a href="./tougao.php">>>返回列表</a>',1);
	}else{
		showmsg('删除失败！'.$DB->error(),4);
	}
}
?>
</div>

</div>



<script src="//cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="../assets/js/edit.js?ver=2055"></script>
<script charset="utf-8" src="../assets/kindeditor/kindeditor-all-min.js"></script>
<script charset="utf-8" src="../assets/kindeditor/zh-CN.js"></script>
<script>
    $(document).ready(function(){
        if($_GET.my == 'add'){
            openmsg()
        }
    });
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
var $_GET = (function(){
    var url = window.document.location.href.toString();
    var u = url.split("?");
    if(typeof(u[1]) == "string"){
        u = u[1].split("&");
        var get = {};
        for(var i in u){
            var j = u[i].split("=");
            get[j[0]] = j[1];
        }
        return get;
    } else {
        return {};
    }
})();

KindEditor.ready(function(K) {
	window.editor = K.create('#editor_id', {
		resizeType : 1,
		allowUpload : false,
		allowPreviewEmoticons : false,
		uploadJson : './ajax.php?act=article_upload',
		items : [
			'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat','formatblock','hr', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			'insertunorderedlist', '|', 'image','fullscreen','source','preview'],
        minHeight:200
	});
});

</script>

<div class="layui-layer-move">
</div>
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

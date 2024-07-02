<?php
/**
 * 分类管理
**/
include("../includes/common.php");
$title='分类管理';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='../user/login.php';</script>");

?>
<?php
if($userrow['power']==0){
	showmsg('你没有权限使用此功能！',3);
}
$classhide = explode(',',$userrow['class']);
?>
<html lang="zh-cn" style="" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths"><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="wap-font-scale" content="no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>分类管理</title>
  <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../assets/user/css/plugins.css">
  <link rel="stylesheet" href="../assets/user/css/main.css">
  <link rel="stylesheet" href="../assets/user/css/common.css">
    <link href="//cdn.staticfile.org/layui/2.5.7/css/layui.css" rel="stylesheet">
  <script src="//cdn.staticfile.org/modernizr/2.8.3/modernizr.min.js"></script>
  <link rel="stylesheet" href="../assets/user/css/my.css">
   <script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdn.staticfile.org/layui/2.5.7/layui.all.js"></script>
    <link id="layuicss-laydate" rel="stylesheet" href="//cdn.staticfile.org/layui/2.5.7/css/modules/laydate/default/laydate.css?v=5.0.9" media="all">
    <link id="layuicss-layer" rel="stylesheet" href="//cdn.staticfile.org/layui/2.5.7/css/modules/layer/default/layer.css?v=3.1.1" media="all">
    <link id="layuicss-skincodecss" rel="stylesheet" href="//cdn.staticfile.org/layui/2.5.7/css/modules/code.css" media="all">
    <style>body{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style>    <style>
    .form-control[disabled] {
        background-color: transparent;
    }
    .form-group-transparent {
    border-radius: 0;
    border: 0px solid transparent;
    padding: 3px 10;
    margin-bottom: 0px;
}
</style>
  <!--[if lt IE 9]>
    <script src="<?php echo $cdnpublic; ?>html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="<?php echo $cdnpublic; ?>respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body style="background-color:#333;">
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
            <font><a href="">分类管理</a></font>

            </div>
                </div>
            <div  style="background: #f2f2f2; height: 10px"></div>

            </div>
            <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;">
                <div class="my-cell-title display-row justify-between align-center">
                    <div class="my-cell-title-l left-title" style="font-size:1.3rem">分类管理</div>
                    <div class="my-cell-title-r  display-row  align-center">
                        <span style="color: #0a0c0d;font-size:1.3rem">是否显示</span>

                    </div>
                </div>

                <form id="classlist">
<?php if(checkmobile()){ ?>
                    <?php

$rs=$DB->query("SELECT * FROM pre_class WHERE active=1 AND cidr=0 ORDER BY sort ASC");
while($res = $rs->fetch())
{
    $cid=$res['cid'];
	echo '<div class="form-group form-group-transparent">
                            <div class="input-group display-row align-center" style="width:100%">
                               <img src="../'.$res['shopimg'].'" style="width: 24px;margin-right: 10px;
    margin-right: 5px;
    height: 24px;">
                                <input type="text" class="form-control" name="name'.$res['cid'].'" value="'.$res['name'].'" placeholder="分类名称" disabled="">
                                <div style="float:right;">'.(in_array($res['cid'],$classhide)?'<i class="fa fa-toggle-on fa-2x fa-flip-horizontal" style="color: #94a7c1" onclick="setActive('.$res['cid'].',1)"></i>':'<i class="fa fa-toggle-on fa-2x" style="color: #ffa56a" onclick="setActive('.$res['cid'].',0)"></i>').'
                                
                                </div>
                            </div>
                        </div>';
                        $rse=$DB->query("SELECT * FROM pre_class WHERE cidr='$cid'");
	    		   while( $restwo = $rse->fetch())
	    		   {
	    		       	echo '<div class="form-group form-group-transparent ">
                            <div class="input-group display-row align-center" style="width:100%">
                               
                                <input type="text" style="font-size: 13px;color: #9d9d9d;" class="form-control" name="name'.$restwo['cid'].'" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$restwo['name'].'" placeholder="分类名称" disabled="">
                                <div style="float:right;">'.(in_array($restwo['cid'],$classhide)?'':'').'
                                
                                </div>
                            </div>
                        </div>';
	    		   }
                        
}
?>
<?php }else{ ?>
                    <?php

$rs=$DB->query("SELECT * FROM pre_class WHERE active=1 AND cidr=0 ORDER BY sort ASC");
while($res = $rs->fetch())
{
    $cid=$res['cid'];
	echo '<div class="form-group form-group-transparent">
                            <div class="input-group display-row align-center" style="width:100%">
                               <img src="../'.$res['shopimg'].'" style="width: 24px;margin-right: 10px;
    margin-right: 5px;
    height: 24px;">
                                <input type="text" style="font-size: 13px;" class="form-control" name="name'.$res['cid'].'" value="'.$res['name'].'" placeholder="分类名称" disabled="">
                                <div style="float:right;">'.(in_array($res['cid'],$classhide)?'<i class="fa fa-toggle-on fa-2x fa-flip-horizontal" style="color: #94a7c1" onclick="setActive('.$res['cid'].',1)"></i>':'<i class="fa fa-toggle-on fa-2x" style="color: #0b9ff5" onclick="setActive('.$res['cid'].',0)"></i>').'
                                
                                </div>
                            </div>
                        </div>';
                        $rse=$DB->query("SELECT * FROM pre_class WHERE cidr='$cid'");
	    		   while( $restwo = $rse->fetch())
	    		   {
	    		       	echo '<div class="form-group form-group-transparent ">
                            <div class="input-group display-row align-center" style="width:100%">
                               
                                <input type="text" style="font-size: 13px;color: #9d9d9d;" class="form-control" name="name'.$restwo['cid'].'" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$restwo['name'].'" placeholder="分类名称" disabled="">
                                <div style="float:right;">'.(in_array($restwo['cid'],$classhide)?'':'').'
                                
                                </div>
                            </div>
                        </div>';
	    		   }
                        
}
?>
<?php }?>
                                    </form>

            </div>
        </div>
    </div>
</div>
<script src="<?php echo $cdnpublic; ?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic; ?>twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic; ?>layer/3.1.1/layer.js"></script>
<script src="<?php echo $cdnpublic; ?>assets/user/js/app.js"></script>
<script>
function setActive(cid,active) {
	$.ajax({
		type : 'GET',
		url : '../user/ajax_user.php?act=setClass&cid='+cid+'&active='+active,
		dataType : 'json',
		success : function(data) {
			window.location.reload();
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	});
}
window.onkeydown = window.onkeyup = window.onkeypress = function (event) {if (event.keyCode === 123) {event.preventDefault();window.event.returnValue = false;}};
function unmouse(){	document.oncontextmenu = new Function("return false;");document.onkeydown = document.onkeyup = document.onkeypress = function(event) {var e = event || window.event || arguments.callee.caller.arguments[0];if (e && (e.keyCode == 123 || (e.keyCode == 116 && e.type!='keypress'))) {e.returnValue = false;return (false);}}}unmouse()</script>
</body>
</html>
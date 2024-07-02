<?php
/**
 * 自助更换域名
**/
include("../includes/common.php");
$title='自助更换域名';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<?php
if($userrow['power']==0){
	showmsg('你没有权限使用此功能！',3);
}
if($conf['fenzhan_editd']==0)showmsg('未开启自助更换域名功能',3);

$price = $conf['fenzhan_editd'];

$domains=explode(',',$conf['fenzhan_domain']);
$select='';
foreach($domains as $domain){
	$select.='<option value="'.$domain.'">'.$domain.'</option>';
}
if(empty($select))showmsg('请先到后台分站设置，填写可选分站域名',3);

if($_GET['act']=='submit'){
	if(!checkRefererHost())exit();
	$qz = trim(strtolower(daddslashes($_POST['qz'])));
	$domain = trim(strtolower(htmlspecialchars(strip_tags(daddslashes($_POST['domain'])))));
	$domain = $qz . '.' . $domain;
	if (strlen($qz) < 3 || strlen($qz) > 10 || !preg_match('/^[a-z0-9\-]+$/',$qz)) {
		showmsg('域名前缀不合格，至少3位数！',3);
	} elseif (!preg_match('/^[a-zA-Z0-9\_\-\.]+$/',$domain)) {
		showmsg('域名格式不正确！',3);
	} elseif ($domain == $userrow['domain']) {
		showmsg('不能和之前的域名一样！',3);
	} elseif ($DB->getRow("SELECT zid FROM pre_site WHERE domain=:domain OR domain2=:domain LIMIT 1", [':domain'=>$domain]) || $qz=='www' || $domain==$_SERVER['HTTP_HOST'] || in_array($domain,explode(',',$conf['fenzhan_remain']))) {
		showmsg('此前缀已被使用！',3);
	}
	if($price>$userrow['rmb'])exit("<script language='javascript'>alert('你的余额不足，请充值！');window.location.href='./';</script>");
	$DB->exec("UPDATE `pre_site` SET `domain`=:domain,`rmb`=`rmb`-:rmb WHERE `zid`=:zid", [':domain'=>$domain, ':rmb'=>$price, ':zid'=>$userrow['zid']]);
	addPointRecord($userrow['zid'], $price, '消费', '自助更换域名');
	exit("<script language='javascript'>alert('成功更换域名为{$domain}，共花费{$price}元！');window.location.href='uset.php?mod=site';</script>");
}
?><html lang="zh-cn" style="" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths"><head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>自助更换域名</title>
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
<body><style>
    .form-control[disabled]{
        background-color:transparent;
        color: #999999;
    }
    form-control1::placeholder{
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
                <a href="javascript:history.back()" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.4rem" src="../assets/img/fanhui.png">&nbsp;
                </a>
                <div style="margin: 0px 8px; border-left: 1px solid rgb(214, 215, 217); height: 16px; border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-bottom-color: rgb(214, 215, 217);"></div>
                <a href="../" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.8rem" src="../assets/img/home1.png">&nbsp;
                </a>
            </div>
            <div style="font-size: 15px;">
            <font><a href="">自助更换域名</a></font>

            </div>
                </div>
        <form action="./cdomain.php?act=submit" method="post" role="form">
            <div class="block-white" style="padding:0 10px">
                <div class="form-group form-group-transparent" style="background: #f2f2f2; padding:8px 0px;padding-left: 10px;margin: 0 -10px;">
                    <div class="input-group" style="width:100%">
                        <div class="input-group-addon" style="color:#969494;font-size:13px;">
                            当前域名
                        </div>
                        <div></div>
                    </div>
                </div>
                <div class="form-group form-group-transparent form-group-border-bottom">
                    <div class="input-group" style="width:100%">
                        <input name="domain" class="form-control" value="<?php echo $userrow['domain']?>" disabled="">
                    </div>
                </div>
                <div class="form-group form-group-transparent" style="background: #f2f2f2; padding:8px 0px;padding-left: 10px;margin: 0 -10px;">
                    <div class="input-group" style="width:100%">
                        <div class="input-group-addon" style="color:#969494;font-size:13px;">
                            新的域名
                        </div>
                        <div></div>
                    </div>
                </div>
                <div class="form-group form-group-transparent form-group-border-bottom">
                    <div class="input-group" style="width:100%">
                        <div class="input-group-addon">
                            自定前缀
                        </div>
                        <input type="text" style="text-align: right" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" name="qz" class="form-control" required="" data-parsley-length="[2,8]" placeholder="输入自定义二级前缀">
                        <div class="input-group-addon" style="min-width: auto;padding:  6px">
                            <i class="fa fa-refresh" style="color: #3793FF;font-size:1.1rem;border-radius:50px;padding:.6rem;background: #f1f1f1" onclick="$('[name=\'qz\']').val(Math.random().toString(36).substr(6))"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group form-group-transparent form-group-border-bottom">
                    <div class="input-group" style="width:100%">
                        <div class="input-group-addon">
                            选择后缀
                        </div>
                        <select name="domain" style="text-align: right" class="form-control"><?php echo $select?></select>
                    </div>
                </div>
            </div>
            <input type="hidden" name="need" value="0.5" disabled="">

            <div class="text-center" style="padding: 30px 0;">
                <input type="submit" name="submit" class="btn submit_btn" style="width: 80%;padding:8px;" value=" <?php echo $price?>元 更换域名">
            </div>
        </form>


    </div>
</div>


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
	layer.msg('复制成功！');
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
	$.ajax({
		type : "GET",
		url : "ajax_user.php?act=create_url",
		dataType : 'json',
		async: true,
		success : function(data) {
			if(data.code == 0){
				$("#copy-btn").html(data.url);
				$("#copy-btn").attr('data-clipboard-text',data.url);
			}else{
				$("#copy-btn").html(data.msg);
			}
		}
	});
});
</script><div class="layui-layer-move"></div>
</body></html>
</body>

 

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
</html>
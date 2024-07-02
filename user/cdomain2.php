
<?php
/**
 * 自助更换备用域名
**/
include("../includes/common.php");
$title='自助更换备用域名';
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
	$domain2 = trim(strtolower(htmlspecialchars(strip_tags(daddslashes($_POST['domain2'])))));
	$domain2 = $qz . '.' . $domain2;
	if (strlen($qz) < 3 || strlen($qz) > 10 || !preg_match('/^[a-z0-9\-]+$/',$qz)) {
		showmsg('域名前缀不合格，至少3位数！',3);
	} elseif (!preg_match('/^[a-zA-Z0-9\_\-\.]+$/',$domain)) {
		showmsg('域名格式不正确！',3);
	} elseif ($domain2 == $userrow['domain2']) {
		showmsg('不能和之前的域名一样！',3);
	} elseif ($DB->getRow("SELECT zid FROM pre_site WHERE domain2=:domain2 OR domain=:domain LIMIT 1", [':domain'=>$domain]) || $qz=='www' || $domain==$_SERVER['HTTP_HOST'] || in_array($domain,explode(',',$conf['fenzhan_remain']))) {
		showmsg('此前缀已被使用！',3);
	}
	if($price>$userrow['rmb'])exit("<script language='javascript'>alert('你的余额不足，请充值！');window.location.href='./';</script>");
	$DB->exec("UPDATE `pre_site` SET `domain2`=:domain2,`rmb`=`rmb`-:rmb WHERE `zid`=:zid", [':domain2'=>$domain2, ':rmb'=>$price, ':zid'=>$userrow['zid']]);
	addPointRecord($userrow['zid'], $price, '消费', '自助更换域名');
	exit("<script language='javascript'>alert('成功更换域名为{$domain2}，共花费{$price}元！');window.location.href='uset.php?mod=site';</script>");
}
?>




<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>自助更换备用域名</title>
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
<body><style>
    .form-control[disabled]{
        background-color:transparent;
        color: #999999;
    }
    form-control1::placeholder{
        text-align: right;
    }
</style>
<div class="col-xs-12 col-sm-10 col-md-6 col-lg-4 center-block "
     style="float: none; background-color:#f2f2f2;padding:0">
    <div class="block  block-all">
            <div class="block-back block-white display-row align-center justify-between">
                
            <a onclick="document.referrer === '' ?window.location.href = './uset.php?mod=site' : window.history.back(-1);" class="font-weight display-row align-center">
                <img style="height: 2rem" src="../assets/user/img/close.png"></img>&nbsp;&nbsp;
                <font><a href="">自助更换备用域名</a></font>
            </a>
        </div>
        <form action="./cdomain2.php?act=submit" method="post" role="form">
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
                        <input name="domain2" class="form-control" 
                        
                        value="<?php echo $userrow['domain2']?>" disabled/>
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
                        <select name="domain2" style="text-align: right" class="form-control"><?php echo $select?></select>
                    </div>
                </div>
            </div>
            <input type="hidden" name="need"  value="0.5" disabled>

            <div class="text-center" style="padding: 30px 0;">
                <input type="submit" name="submit" class="btn submit_btn" style="width: 80%;padding:8px;" value="<?php echo $price?>元 更换域名">
            </div>
        </form>


    </div>
</div>

</body>
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
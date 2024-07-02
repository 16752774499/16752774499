<?php
if(!defined('IN_CRONLITE'))exit();

$id=intval($_GET['id']);
if(md5($id.SYS_KEY.$id)!==$_GET['skey'])exit("<script language='javascript'>alert('验证失败');history.go(-1);</script>");
$row=$DB->getRow("SELECT * FROM pre_orders WHERE id='$id' LIMIT 1");
if(!$row)exit("<script language='javascript'>alert('当前订单不存在！');history.go(-1);</script>");
$tool=$DB->getRow("SELECT * FROM pre_tools WHERE tid='{$row['tid']}' LIMIT 1");
if($tool['is_curl']!=4 && $row['djzt']!=3)exit("<script language='javascript'>alert('非发卡类商品！');history.go(-1);</script>");
$count = ($tool['value']>1?$tool['value']:1)*$row['value'];
$rs=$DB->query("SELECT * FROM pre_faka WHERE tid='{$row['tid']}' AND orderid='$id' ORDER BY kid ASC LIMIT {$count}");
$kmdata='';
$rcount=0;
while($res = $rs->fetch())
{
	$rcount++;
	if(!empty($res['pw'])){
		$kmdata.='卡号：'.$res['km'].' 密码：'.$res['pw']."\r\n";
	}else{
		$kmdata.=$res['km']."<br>";
	}
}
if(strlen($kmdata)>2)$kmdata=substr($kmdata,0,-2);
/*if($rcount<$count){
	$scount = $count-$rcount;
	$rs=$DB->query("SELECT * FROM pre_faka WHERE tid='{$row['tid']}' AND orderid=0 ORDER BY kid ASC LIMIT {$scount}");
	while($res = $rs->fetch())
	{
		if(!empty($res['pw'])){
			$kmdata.='卡号：'.$res['km'].' 密码：'.$res['pw']."\r\n";
		}else{
			$kmdata.=$res['km']."\r\n";
		}
		$DB->exec("update `pre_faka` set `orderid`='$id',`usetime`='$date' where `kid`='{$res['kid']}'");
	}
}*/
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>

    <title><?php echo $conf['sitename']?> - 卡密查看</title>
    <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/simple/css/plugins.css">
    <link rel="stylesheet" href="assets/simple/css/main.css">
    <link rel="stylesheet" href="assets/user/css/my.css">
    <script src="//cdn.staticfile.org/modernizr/2.8.3/modernizr.min.js"></script>
    <!--[if lt IE 9]>
      <script src="//cdn.staticfile.org/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="//cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>html{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style>
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
</style>
</head>
<body>
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
                <a href="javascript:history.back()"  class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.4rem" src="../assets/img/fanhui.png">&nbsp;
                </a>
                <div style="margin: 0px 8px; border-left: 1px solid rgb(214, 215, 217); height: 16px; border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-bottom-color: rgb(214, 215, 217);"></div>
                <a href="../" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.8rem" src="../assets/img/home1.png">&nbsp;
                </a>
            </div>
            <div style="font-size: 15px;">
            <font><a href="">卡密查看</a></font>

            </div>
                </div>
            <div  style="background: #f2f2f2; height: 10px"></div>
            <div class="my-cell" style="margin-bottom: 0px;padding:0;">

			<?php if(!empty($tool['alert'])){?>
			<div class="alert alert-info alert-dismissable">
				<?php echo $tool['alert']?>
			</div>
			<?php }?>
           <div class="my-cell" style="margin-bottom: 0px;padding:0;">
				<div style="font-weight: 700;padding:20px 10px"><?php echo $tool['name']?></div>

			<div class="form-group">
			<div id="txt_0" style="word-break:break-all;padding:10px;background: #f7f7f7;width: 100%;font-size: 1.5rem;min-height:15rem;color: #8b8a8a"><?php echo $kmdata?></div>
                <div style="font-weight: 700;padding:20px 10px" class="text-right">
                    <button class="btn form-group-border btn-rounded" style="color: #0b9ff5;" type="button" data-clipboard-action="copy" data-clipboard-target="#txt_0" id="clipboard_btn">复制全部</button>
                </div>
			</div>
        </div>
    </div>
 </div>

<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script src="<?php echo $cdnpublic?>FileSaver.js/2014-11-29/FileSaver.min.js"></script>
<script src="<?php echo $cdnpublic?>clipboard.js/1.7.1/clipboard.min.js"></script>
<script>
	$("#saveas-bt").on("click", function () {
		var txt = $("#txt_0").val();
		if (txt.indexOf('\r\n') < 0) {
			txt = txt.replace(/\n/g, "\r\n");
		}
		var fileName = (new Date()).toISOString().substr(0, 10) + ".txt";
		var blob = new Blob([txt], {type: "text/plain;charset=utf-8"});
		saveAs(blob, fileName);
	});
	var clipboard = new Clipboard('#clipboard_btn');
	clipboard.on('success', function (e) {
		layer.msg('复制成功')
	});
	clipboard.on('error', function (e) {
		layer.msg('复制失败')
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
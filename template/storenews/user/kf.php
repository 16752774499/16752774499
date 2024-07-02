<?php
if(!defined('IN_CRONLITE'))exit();

$thtime=date("Y-m-d").' 00:00:00';
$count1=$DB->getColumn("SELECT count(*) from pre_site");
$count2=$DB->getColumn("SELECT count(*) from pre_site where addtime>='$thtime'");
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
  <title><?php echo $conf['sitename']?> - 客服中心</title>
  <meta name="keywords" content="<?php echo $conf['keywords']?>">
  <meta name="description" content="<?php echo $conf['description']?>">
  <link href="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link href="<?php echo $cdnserver?>assets/beautify/css/public-style.main.css" rel="stylesheet">
      <link href="<?php echo $cdnpublic ?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo $cdnserver?>assets/simple/css/oneui.css">
	<script src="<?php echo $cdnpublic?>modernizr/2.8.3/modernizr.min.js"></script>
  <!--[if lt IE 9]>
    <script src="<?php echo $cdnpublic?>html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="<?php echo $cdnpublic?>respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
<?php echo $background_css?>
<style>
body{ font-size:14px; padding:0;margin:0 auto; position:relative; }
</style>
</head>
<body ontouchstart="" style="overflow: auto;height: 9rem; !important;max-width: 550px; margin:auto;">


<div class="panel-shadow panel-bor-top rdu-5x" style="position:relative;z-index:-2;">
	<div style="width:100px;background:#fff;margin:0 auto;text-align:center;">
		<img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']?>&spec=100" style="width:70px; height:70px;border-radius:50%;margin-top:10px;">
	</div>
	<div class="fgx"></div>
	<div class="pd-text cnt" style="border:none">
		<font color="#f00"><b>主 站 长</b></font><img src="./assets/beautify/img/gg-rz.jpg" style="height:15px;margin:-2px 0 0 5px;">
	</div>
	<ul class="two-df-naw">
		<li style="border-right:#ddd solid 1px;text-align:left;"><font color="#f00">站长QQ</font>：<font color="#0080ff"><?php echo $conf[ 'kfqq']?></font></li>
		<li style="text-align:left;"><font color="#f00">站长微信</font>：<font color="#0080ff"><?php echo $conf[ 'kfwx']?></font></li>
	</ul>
	<?php if($conf['appurl']){?>
	<div class="pd-text cnt tw1"><font color="#f00">APP下载</font>：<a href="<?php echo $conf['appurl']; ?>">点击下载</a></div>
	<?php }?>
</div>


<div class="panel-shadow panel-bor-top rdu-5x">
	<div style="text-align:center;padding:12px 0;"><img src="<?php echo $logo?>" style="width:100px;height:100px;"></div>
	<div class="cnt title-bj"><div class="title tw2"><b><?php echo $conf['sitename']?></b></div></div>
	<div class="sjx"></div>
	<div class="pd-text cnt tw1" style="border:none">本站网址：<a href="http://<?php echo $_SERVER['HTTP_HOST']?>">
		<font color="#0080ff">http://<?php echo $_SERVER['HTTP_HOST']?>
		</font></a>
	</div>
	<div class="pd-text">
		<div class="cnt" style="margin:5px 17% 10px 17%;padding-bottom:10px;border-bottom:#ff8000 solid 2px;color:#f00;">
本站于：<?php echo $conf['build']?> 正式成立
		</div>
		<div>我们是全网最专业的商城系统，商品齐全、货源稳定、价格低廉、售后保障。拥有丰富的人脉和资源，我们专注于优质商品，实时掌握市场的动态。</div>
		<div style="padding:8px 0; text-align:center;">
			<a href="./user/reg.php">
			<img style="width:80px; margin-right:20px;" src="./assets/beautify/img/gg-hyff.jpg">
			<img style="width:80px; margin-right:20px;" src="./assets/beautify/img/gg-cyjm.jpg">
			<img style="width:80px; " src="./assets/beautify/img/gg-gtzf.jpg"></a>
		</div>
		<div>
加入我们，只要你坚持，你不用担心不赚钱，不用担心货源不好，更不用担心我们跑路，我们即使不敢保证你月入上万，在网上赚个零花钱绝对没问题！
		</div>
		<div style="border-top:#ff8000 dashed 1px;padding:10px 17% 5px 17%;margin-top:10px;">
			<a class="btn btn-info btn-sm" href="javascript:history.back()"><i class="glyphicon glyphicon-home"></i> 返回上页</a>
			<a class="btn btn-info btn-sm" href="./" style="float:right;"><i class="glyphicon glyphicon-fire"></i> 网站首页</a>
		</div>
	</div>
</div>

</div>

<footer class="tw1" style="line-height:40px;width:100%;display:block;text-align:center;background: rgba(255, 255, 255, 0.7);border-top:#bbb solid 1px;color:#333;font-size:13px;">
版权所有@<?php echo $conf['sitename']?> 有你更精彩
</footer>

<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
<script type="text/javascript">
var isModal=false;
var homepage=true;
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>
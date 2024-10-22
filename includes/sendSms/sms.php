<?php
include("../includes/redis/redis.php");
//开启SESSION
session_start();

header("Content-type:text/html; charset=UTF-8");

//请求数据到短信接口，检查环境是否 开启 curl init。
function Post($curlPost, $url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_NOBODY, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
    $return_str = curl_exec($curl);
    curl_close($curl);
    return $return_str;
}

//将 xml数据转换为数组格式。
function xml_to_array($xml)
{
    $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
    if (preg_match_all($reg, $xml, $matches)) {
        $count = count($matches[0]);
        for ($i = 0; $i < $count; $i++) {
            $subxml = $matches[2][$i];
            $key = $matches[1][$i];
            if (preg_match($reg, $subxml)) {
                $arr[$key] = xml_to_array($subxml);
            } else {
                $arr[$key] = $subxml;
            }
        }
    }
    return $arr;
}

//random() 函数返回随机整数。
function SmsRandom($length = 6, $numeric = 0)
{
    PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
    if ($numeric) {
        $hash = sprintf('%0' . $length . 'd', mt_rand(0, pow(10, $length) - 1));
    } else {
        $hash = '';
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
        $max = strlen($chars) - 1;
        for ($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
    }
    return $hash;
}


function SendDuanXin($phone, $mobile_code)
{
    //短信接口地址
    $target = "http://106.ihuyi.com/webservice/sms.php?method=Submit";
    // 您本次操作的验证码【变量】，3分钟内有效，请勿泄露。
    $post_data = "account=C83816284&password=0ba9be8577cbb7840712606268b95f5b&mobile=" . $phone . "&content=" . rawurlencode("您本次操作的验证码" . $mobile_code . "，3分钟内有效，请勿泄露。");
    //查看用户名 登录用户中心->验证码通知短信>产品总览->API接口信息->APIID
    //查看密码 登录用户中心->验证码通知短信>产品总览->API接口信息->APIKEY
    $gets = xml_to_array(Post($post_data, $target));
    if ($gets['SubmitResult']['code'] == 2) {

        setItem($phone, $mobile_code);
        setExpire($phone, 180,0);
        setItem($phone, "exist", 1);

    }
    return $gets['SubmitResult']['code'];
}
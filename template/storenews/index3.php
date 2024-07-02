<?php
if (!defined('IN_CRONLITE')) die();


//获取用户真实IP
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
        $ip = getenv("REMOTE_ADDR");
    else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
        $ip = $_SERVER['REMOTE_ADDR'];
    else
        $ip = "unknown";

    $arr=$DB->getRow("select * from shua_ip where id=1 limit 1");
    $res=explode(',',$arr['ips']);
foreach($res as $k=>$v){
    $ips=explode('-',$v);
    if(in_ip_range($ip, $ips[0], $ips[1])) {
   header('Location:/404.html');
 } 
}
 

function in_ip_range($ip, $ip_one, $ip_two = false) {
 if(!$ip_two) {
  return $ip_one === $ip;
 }
 return ip2long($ip_one) * -1 >= ip2long($ip) * -1 && ip2long($ip_two) * -1 <= ip2long($ip) * -1;
}

if($_GET['buyok']==1||$_GET['chadan']==1){include_once TEMPLATE_ROOT.'store/query.php';exit;}
if(isset($_GET['tid']) && !empty($_GET['tid']))
{
	$tid=intval($_GET['tid']);
    $tool=$DB->getRow("select tid from pre_tools where tid='$tid' limit 1");
    if($tool)
    {
		exit("<script language='javascript'>window.location.href='./?mod=buy&tid=".$tool['tid']."';</script>");
    }
}

$cid = intval($_GET['cid']);
if(!$cid && !empty($conf['defaultcid']) && $conf['defaultcid']!=='0'){
	$cid = intval($conf['defaultcid']);
}
$ar_data = [];
$classhide = explode(',',$siterow['class']);
$re = $DB->query("SELECT * FROM `pre_class` WHERE `active` = 1 AND cidr=0 ORDER BY `sort` ASC ");

$qcid = "";
$cat_name = "";
while ($res = $re->fetch()) {
    if($is_fenzhan && in_array($res['cid'], $classhide))continue;
    if($res['cid'] == $cid){
    	$cat_name=$res['name'];
    	$qcid = $cid;
    }
    $ar_data[] = $res;
}


$class_show_num = intval($conf['index_class_num_style'])?intval($conf['index_class_num_style']):2; //分类展示几组


	$url=$_SERVER['HTTP_HOST'];
	$approw = $DB->find('apps','*',['domain'=>$url]);
	$id = $approw['id'];
	$appurl = '/?mod=app&id='.$id;
?>
<!DOCTYPE html>
<html lang="zh" style="font-size: 102.4px;">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no"/>
    <script> document.documentElement.style.fontSize = document.documentElement.clientWidth / 750 * 40 + "px";</script>
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-param" content="_csrf">
    <title><?php echo $hometitle?></title>
    <meta name="keywords" content="<?php echo $conf['keywords'] ?>">
    <meta name="description" content="<?php echo $conf['description'] ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver; ?>assets/store/css/foxui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver; ?>assets/store/css/foxui.diy.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver; ?>assets/store/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver; ?>assets/store/css/iconfont.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver; ?>assets/store/css/index.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnpublic ?>layui/2.5.7/css/layui.css">
    <link href="<?php echo $cdnpublic?>Swiper/6.4.5/swiper-bundle.min.css" rel="stylesheet">


    <style>html{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style>
    </head>
<style type="text/css">
    body {
        position: absolute;;

        margin: auto;
    }
    .fui-page.fui-page-from-center-to-left,
    .fui-page-group.fui-page-from-center-to-left,
    .fui-page.fui-page-from-center-to-right,
    .fui-page-group.fui-page-from-center-to-right,
    .fui-page.fui-page-from-right-to-center,
    .fui-page-group.fui-page-from-right-to-center,
    .fui-page.fui-page-from-left-to-center,
    .fui-page-group.fui-page-from-left-to-center {
        -webkit-animation: pageFromCenterToRight 0ms forwards;
        animation: pageFromCenterToRight 0ms forwards;
    }
    .fix-iphonex-bottom {
        padding-bottom: 34px;
    }
    .fui-goods-item .detail .price .buy {
        color: #fff;
        background: #1492fb;
        border-radius: 3px;
        line-height: 1.1rem;
    }
    .fui-goods-item .detail .sale {
        height: 1.7rem;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        font-size: 0.65rem;
        line-height: 0.9rem;
    }
     @media only screen and (max-width : 375px) {
        .hotxy::-webkit-scrollbar {
            display: none !important;
        }
    }
    .goods-category {
        display: flex;
        background: #fff;
        flex-wrap: wrap;
    }

    .goods-category li {
        width: 25%;
        list-style: none;
        margin: 0.4rem 0;
        color: #666;
        font-size: 0.65rem;

    }

    .goods-category li.active p {
        background: #1492fb;
        color: #fff;
    }

    body {
        padding-bottom: constant(safe-area-inset-bottom);
        padding-bottom: env(safe-area-inset-bottom);
    }

    .goods-category li p {
        width: 4rem;
        height: 2rem;
        text-align: center;
        line-height: 2rem;
        border: 1px solid #ededed;
        margin: 0 auto;
        -webkit-border-radius: 0.1rem;
        -moz-border-radius: 0.1rem;
        border-radius: 0.1rem;
    }
    .footer ul {
        display: flex;
        width: 100%;
        margin: 0 auto;
    }

    .footer ul li {
        list-style: none;
        flex: 1;
        text-align: center;
        position: relative;
        line-height: 2rem;
    }

    .footer ul li:after {
        content: '';
        position: absolute;
        right: 0;
        top: .8rem;
        height: 10px;
        border-right: 1px solid #999;


    }
 .hotxy {
        position: relative;
    }
    .hotxy .hotxy-item{
        font-size: 0.62rem;
        display: inline-block;
        width: 20%;
        text-align: center;
        margin-bottom: 10px;

    }
    .hotxy .hotxy-item-index{
        border-bottom: 3px solid #ff8000;
        font-weight: 700;

    }
    .footer ul li:nth-last-of-type(1):after {
        display: none;
    }

    .footer ul li a {
        color: #999;
        display: block;
        font-size: .6rem;
    }
.fui-goods-group.block .fui-goods-item .image {
     width: 100%; 
     margin: unset; 
     padding-bottom: unset; 
     <?php if(checkmobile()){ ?>
        height:5.2rem;
     <?php }else{ ?>
        height:7rem;
     <?php } ?>
     

}
.layui-flow-more{
        width: 100%;
    float: left;
}
.fui-goods-group .fui-goods-item .image img{
    border-radius:10px;    
}
.fui-goods-group .fui-goods-item .detail .minprice {
    font-size: .6rem;
}
.fui-goods-group .fui-goods-item .detail .name{
    height: 1.9rem;
}

.swiper-pagination-bullet {
  width: 20px;
  height: 20px;
  text-align: center;
  line-height: 20px;
  font-size: 12px;
  color: #000;
  opacity: 1;
  background: rgba(0, 0, 0, 0.2);
}

.swiper-pagination-bullet-active {
  color: #fff;
  background: #ed414a;
}
.swiper-pagination{
    position: unset;
}
.swiper-container{
    --swiper-theme-color: #ff6600;/* 设置Swiper风格 */
    --swiper-navigation-color: #007aff;/* 单独设置按钮颜色 */
    --swiper-navigation-size: 18px;/* 设置按钮大小 */
}
.goods_sort {
    position: relative;
    width: 100%;

    -webkit-box-align: center;
    padding: .4rem 0;
    background: #fff;
    -webkit-box-align: center;
    -ms-flex-align: center;
    -webkit-align-items: center;
}

.goods_sort:after {
    content: " ";
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    border-bottom: 1px solid #e7e7e7;
}

.goods_sort .item {
    position: relative;
    width: 1%;
    display: table-cell;
    text-align: center;
    font-size: 0.6rem;
    border-left: 1px solid #e7e7e7;
    color: #766e58;
}
.goods_sort .item .sorting {
    width: .2rem;
    height: .2rem;
    position: relative;
}
.goods_sort .item:first-child {
    border: 0;
}

.goods_sort .item.on .text {
    color: #766e58;
}
.goods_sort .item .sorting .icon {
    /*font-size: 11px;*/
    position: absolute;
    -webkit-transform: scale(0.5);
    -ms-transform: scale(0.5);
    transform: scale(0.5);
    color: #cccccc;
}

.goods_sort .item-price .sorting .icon-sanjiao1 {
    top: .13rem;
    left: 2;
}

.goods_sort .item-price .sorting .icon-sanjiao2 {
    top: -.13rem;
    left: 2;
}

    .goods_sort .item-price.DESC .sorting .icon-sanjiao1 {
        color: #766e58
    }

    .goods_sort .item-price.ASC .sorting .icon-sanjiao2 {
        color: #766e58
    }

    .content-slide .shop_active .icon-title {
        color: #766e58;
    }
    .content-slide .shop_active .mbg {
        background-color: #eff5fd;
    }

    .content-slide .shop_active img {
        filter: saturate(100%);
    }

.xz {
    background-color: #3399ff;
    color: white !important;
    border-radius: 5px;
}
.tab_con > ul > li.layui-this{
    background: linear-gradient(to right, #73b891, #53bec5);
    color: #fff;
    border-radius: 6px;
    text-align: center;
}

    .fui-notice:after {

        border: 0px solid #e2e2e2;

    }

    .fui-notice:before {

        border: 0px solid #e2e2e2;
    }

    #audio-play #audio-btn {
        width: 44px;
        height: 44px;
        background-size: 100% 100%;
        position: fixed;
        bottom: 5%;
        right: 6px;
        z-index: 111;
    }

    #audio-play .on {
        background: url('assets/img/music_on.png') no-repeat 0 0;
        -webkit-animation: rotating 1.2s linear infinite;
        animation: rotating 1.2s linear infinite;
    }

    #audio-play .off {
        background: url('assets/img/music_off.png') no-repeat 0 0
    }

    @-webkit-keyframes rotating {
        from {
            -webkit-transform: rotate(0);
            -moz-transform: rotate(0);
            -ms-transform: rotate(0);
            -o-transform: rotate(0);
            transform: rotate(0)
        }
        to {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg)
        }
    }

    @keyframes rotating {
        from {
            -webkit-transform: rotate(0);
            -moz-transform: rotate(0);
            -ms-transform: rotate(0);
            -o-transform: rotate(0);
            transform: rotate(0)
        }
        to {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg)
        }
    }


    @media only screen and (max-width : 375px) {
        .hotxy::-webkit-scrollbar {
            display: none !important;
        }
    }
    ::-webkit-scrollbar-thumb {

        background-color: #b0b0b0;
    }


    .search{
        text-align: left;
    }
    .search[placeholder]{
        font-size: 0.65rem;
    }

    .display-row {
        display: flex;
        flex-direction: row;
    }

    .display-column {
        display: flex;
        flex-direction: column;
    }



    .justify-center {
        justify-content: center;
    }

    .justify-between {
        justify-content: space-between;
    }
    .justify-around {
        justify-content: space-around;
    }

    .flex-wrap {
        flex-wrap: wrap;

    }
    .flex-nowrap{
        flex-wrap: nowrap;
    }
    .align-center {
        align-items: center;
    }
    .hotxy {
        position: relative;
    }
    .hotxy .hotxy-item{
        font-size: 0.62rem;
        display: inline-block;
        width: 20%;
        text-align: center;
        margin-bottom: 10px;

    }
    .hotxy .hotxy-item-index{
        border-bottom: 3px solid #ff8000;
        font-weight: 700;

    }

    .tab-top font{
        font-size: 0.65rem;

    }
    .tab-top-l-icon{
        color: #f4b538;
        font-size: 0.65rem
    }
    .tab-top-r-icon{
        color: #000;
        font-size: 0.65rem;
        font-weight: 800;
    }
    .tab-top-r{
        border-left: 1px solid #dddddd;
        padding-left: 10px;
    }
    .tab-bottom{
        width: 100%;

        padding: 0.8rem 0rem;
        font-size: 0.6rem;
        position: absolute;
        top: 2.0rem;
        left: 0;
        z-index: 1025;
        background: #fff;
        box-shadow: 0px 3px 5px #e2dfdf;
    }
    .tab-bottom-none{
        display:none;
    }
    .tab-bottom-item{
        padding: 0.2rem 0.5rem;
        background: #ebebeb;
        border-radius: 50px;
        margin-top: 5px;
        margin-left: 5px;

    }
    .tab-bottom-item-index{

        background: #1195da;
        color: #fff;

    }
    .tab-top {

        position: relative;
        height: 1.8rem;
        width: calc(100% - 0.8rem);
        padding: 0  0.5rem;
        margin: 0 auto;

        border: 1px solid #dddddd;
        background: #ffffff;
        /*filter: drop-shadow(0 0 5px rgba(0, 0, 0, .1));*/
        overflow: visible;
        border-radius: 10px;

    }
    .tab-top::before{

        content: "";
        position: absolute;
        width: 0;
        height: 0;
        top: -20px;
        left: 25%;
        border: 10px solid transparent;
        border-bottom-color: #dddddd;
        z-index: 9;
    }
    .tab-top::after {
        position: absolute;
        top: -19px;
        left: 25%;
        border: 10px solid transparent;
        border-bottom-color: #fff;
        display: block;
        content: '';
        z-index: 10;
    }
    
#audio-play #audio-btn{width: 45px;height: 45px; background-size: 100% 100%;position:fixed;bottom:8%;right:20px;z-index:111;}
#audio-play .on{background: url('assets/img/music_on.png') no-repeat 0 0;-webkit-animation: rotating 1.2s linear infinite;animation: rotating 1.2s linear infinite;}
#audio-play .off{background:url('assets/img/music_off.png') no-repeat 0 0}
@-webkit-keyframes rotating{from{-webkit-transform:rotate(0);-moz-transform:rotate(0);-ms-transform:rotate(0);-o-transform:rotate(0);transform:rotate(0)}to{-webkit-transform:rotate(360deg);-moz-transform:rotate(360deg);-ms-transform:rotate(360deg);-o-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes rotating{from{-webkit-transform:rotate(0);-moz-transform:rotate(0);-ms-transform:rotate(0);-o-transform:rotate(0);transform:rotate(0)}to{-webkit-transform:rotate(360deg);-moz-transform:rotate(360deg);-ms-transform:rotate(360deg);-o-transform:rotate(360deg);transform:rotate(360deg)}}
</style>
<body ontouchstart="" style="overflow: auto;height: auto !important;max-width: 550px;">
<div id="body">
    <div style="position: fixed;    z-index: 100;    top: 30px;    left: 20px;       color: white;    padding: 2px 8px;      background-color: rgba(0,0,0,0.4);    border-radius: 5px;display: none" id="xn_text">
    </div>
    <div class="fui-page-group " style="height: auto">
        <div class="fui-page  fui-page-current " style="height:auto; overflow: inherit">
            <div class="fui-content navbar" id="container" style="background-color: #fafafc;overflow: inherit">
                <div class="default-items">
                    <div class="fui-swipe">
                        <style>
                            .fui-swipe-page .fui-swipe-bullet {
                                background: #ffffff;
                                opacity: 0.5;
                            }

                            .fui-swipe-page .fui-swipe-bullet.active {
                                opacity: 1;
                            }
                        </style>
                        
                            
                        <div class="fui-swipe-wrapper" style="transition-duration: 500ms;">
                            <?php
                            $banner = explode('|', $conf['banner']);
                            foreach ($banner as $v) {
                                $image_url = explode('*', $v);
                                echo '<a class="fui-swipe-item" href="' . $image_url[1] . '">
                                <img src="' . $image_url[0] . '" style="display: block; width: 100%; height: auto;" />
                            </a>';
                            }
                            ?>
                        </div>
                        <div class="fui-swipe-page right round" style="padding: 0 5px; bottom: 5px; ">
                        </div>
                    </div>
                    
                    
                        
                        <a style="position:fixed;right:20px;bottom:24%; z-index:10;" href="JavaScript:void(0)" onclick="$('.tzgg').show()">
                        <img style="width:45px;height:45px;border-radius:50px;border: 2px solid #ff0013;background-color:#fff" src="../assets/store/images/gonggao1.png"/>
                        </a>

                        <a style="position:fixed;right:20px;bottom:17%; z-index:10; " href="/?mod=time">
                        <img style="width:45px;height:45px;border-radius:50px;border: 2px solid #ff8204;background-color:#fff" src="../assets/store/images/jrgx.png"/>
                        </a>

                        <a style="position:fixed;right:20px;bottom:10%; z-index:10;" href="<?php echo $conf['appurl']; ?>">
                        <img style="width:45px;height:45px;border-radius:50px;border: 2px solid #1195da;background-color:#fff" src="../assets/store/images/app1.png"/>
                        </a>
                        
                    <div style="width:100%;background-color:#ffffff;padding: 0rem 0.6rem; padding-top: 0.3rem; overflow: hidden;  font-size: 0.7rem; font-weight: bold; display:flex; align-content: center; justify-content: space-between" >
                        <a href="/user/regsite.php" style="width: 49%;height: 3.4rem;border-radius:8px;position: relative;background: rgba(255, 232 , 187, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 20%;left: 5%;z-index: 10">
                                <li style="color: #f5a810;font-size: 0.67rem;">开通分站赚钱</li>
                                <li style="color: #7c7c7c;font-size: 0.52rem;font-weight:0;line-height: 0.9rem">成为站长当老板</li>
                            </div>
                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="assets/store/images/zhunqian.png">
                        </a>

                        <a href="/?mod=article&id=8" style="width: 49%;height: 3.4rem;border-radius:8px;position: relative;background: rgba(183 , 230  , 253, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 20%;left: 5%;z-index: 10">
                                <li style="color: #45d0f6;font-size: 0.67rem;">平台赚钱模式</li>
                                <li style="color: #7c7c7c;font-size: 0.52rem;font-weight:0;line-height: 0.9rem">学习知识把钱赚</li>
                            </div>

                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="assets/store/images/tuandui.png">
                        </a>
                        <!--                        <a href="--><!--" style="width: 32%; height: 3.2rem;border-radius:5px;background-image:linear-gradient(to right, rgba(233, 95, 95, 1), rgba(239, 154, 183, 1));position: relative"  >-->
                        <!--                            <li style="position: absolute;top: 20%;left: 10%;color: #fff;"> 初级站长<br>升级</li>-->
                        <!--                            <img style="width:3.5rem;position: absolute;bottom:-20px;right: -20px;opacity: 0.7 " src="assets/store/index/shengji.png">-->
                        <!--                        </a>-->
                    </div>

                    <div style="width:100%;background-color:#fff;padding: 0rem 0.6rem;padding-top: 0.3rem; overflow: hidden;  font-size: 0.7rem; font-weight: bold; display:flex; align-content: center; justify-content: space-between;">
                    <div class="miaosha" onclick="javascrtpt:window.location.href='/user/regsite.php'" style="width: 100%;
    margin: 0px auto;
    position: relative;
    background-color: #fff5ef;
    border-radius: 7px;
    overflow: hidden;">
                        <div style="height: 70px;
    width: 100%;">
                        <div style="background-image: url(assets/store/images/lihe.png); background-size: 100% 80%; background-repeat: no-repeat;
    height: 88px;
    width: 100%;">
                        </div>
                            <div style="position: absolute;
    top: 45%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    left: 3%;
    width: 100%;
    height: 50px;
    color: #7d7c7a;">
                          <img src="/assets/img/huo.png" style="width: 40px;
    height: 100%;">
    <span style="font-size: 11px;
    margin-left: 10px;
    height: 90%;display: inline-grid;">
        <a style="font-size: 0.67rem; color: rgb(184, 70, 70); font-weight: 800; padding-top: 5px;">升级合伙人 享商品低至1元特权</a>
        <a style="color: #7d7c7a;">低成本无需囤货可改价格，资源自动更新</a>


                            </div>
                        </div>
                        </div>
                    </div>

                    <div style="width:100%;background-color:#ffffff;padding: 0rem 0.65rem; padding-top: 0.3rem; overflow: hidden;  font-size: 0.55rem; font-weight: bold; display:flex; align-content: center; justify-content: space-between" >
                        

                       <a href="/?mod=invite" style="width: 32%;height: 3.1rem;border-radius:5px;position: relative;background: rgba(217, 217, 217,0.4);overflow: hidden" ><br><div style="text-align:center;font-weight:0;line-height: 0.9rem;">
                           <img src="/assets/img/huoyan.png" style="width: 16px;">推广奖励
                                <li style="text-align:center;color: #7c7c7c;font-size: 0.45rem;font-weight:0;line-height: 0.9rem;">免费赚现金红包</li>
                            </div>
                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="<?php echo $cdnserver?>assets/store/images/pingmian.png">
                        </a>
                        
                       <a href="./user/qiandao.php" style="width: 32%;height: 3.1rem;border-radius:5px;position: relative;background: rgba(217, 217, 217,0.4);overflow: hidden" ><br><div style="text-align:center;font-weight:0;line-height: 0.9rem;">
                           <img src="/assets/img/huoyan.png" style="width: 16px;">每日签到
                                <li style="text-align:center;color: #7c7c7c;font-size: 0.45rem;font-weight:0;line-height: 0.9rem;">天天领现金奖励</li>
                            </div>
                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="<?php echo $cdnserver?>assets/store/images/pingmian.png">
                        </a>
                        
                       <a href="https://qm.qq.com/cgi-bin/qm/qr?k=z8pJ7YRGlmoAnDxGGVA5C2urHwt0ZxeT&jump_from=webapi&authKey=N3CPubh5FnxipXVVYS15NpWpXPCdeR3OLZvEc7DXbtN0NkIArsGUjGV/LiIjxzKr" target="_blank" style="width: 32%;height: 3.1rem;border-radius:5px;position: relative;background: rgba(217, 217, 217,0.4);overflow: hidden" onclick="return confirm('点击确定加入商城通知群！');"><br><div style="text-align:center;font-weight:0;line-height: 0.9rem;">
                           <img src="/assets/img/huoyan.png" style="width: 16px;">官方通知群
                                <li style="text-align:center;color: #7c7c7c;font-size: 0.45rem;font-weight:0;line-height: 0.9rem;">一手消息早知道</li>
                            </div>
                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="<?php echo $cdnserver?>assets/store/images/pingmian.png">
                        </a>
                        
                        
                        
                    </div>

                    <form action="" method="get" id="goods_search"><input type="hidden" value="yes" name="search">
                        <div class="fui-searchbar bar"
                             style="background-color: #ffffff;border-top: 0px solid #e7e7e7;padding: 0.1rem 0.5rem;">
                            <div class="searchbar center searchbar-active" style="height: 2.5rem" >

                                <div class="search-input" style="border:0px; border-radius:50px;  width:100%;  padding-left:0px;padding-right:0px; background-color: #efeff5;">

                                    <input type="text" style="background-color: rgba(0,0,0,0);height: 1.65rem;" class="search"
                                           value="" name="kw"
                                           placeholder="输入商品关键字" id="kw">
                                    </input>
                                </div>
                                <button type="submit"  class="searchbar-cancel searchbtn  " style="width:3.5rem;background-color:#1195da;height: 1.65rem; border-radius:0 50px 50px  0;color: #fff;"><a style="color: #f6f6f6;font-size: 14px;">搜索</a></button>

                            </div>
                        </div>
                    </form>

<?php
$thtime=date("Y-m-d").' 00:00:00';
$yesterday_time = date("Y-m-d",strtotime("-1 day")).' 00:00:00';
$numrows=$DB->getColumn("SELECT count(*) FROM pre_tools WHERE active=1");
$numrows1=$DB->getColumn("SELECT count(*) FROM pre_tools WHERE addtime>='$thtime'");
$numrows2=$DB->getColumn("SELECT count(*) FROM pre_tools WHERE addtime<='$thtime' AND addtime>'$yesterday_time'");
?>
        <section style="display:none;height: 30px;line-height: 1.6rem; background: #fff; display: flex;justify-content: space-between; align-items: center;" class="show_class ">
            <div style="width:10%"><img src="./assets/img/new2.png" style="height:22px"></div>
                <section style="display: inline-block;" class="">
                        <!--section class="135brush" data-brushtype="text" style="clear:both;margin:-18px 0px;color:#333;border-radius: 6px;padding:0px .5em;letter-spacing: 1.5px; ">
                            <span style="color: #f79646;">
                                <strong>
                                                                        <span style="color:#7d7c7a;font-size: 12px;">
                                        <span style="color: #767676;"><strong><span style="font-size: 15px;">
                                         <span class="catname_show">正在获取...</span></span>
                                        </span></strong></span>
                                    </span>
                                </strong>
                            </span>
                        </section-->
                    </section>
                  
            <span class="text" style="font-size: 13.5px;padding:0 10px">
                <span id="total">今日新增商品<?php echo ''.$numrows1.'' ?>件,昨日新增商品<?php echo ''.$numrows2.'' ?>件</span>
                    </span>
                </section>
                    <div  style="background: #f2f2f2;width: 100%; height: 1px"></div>


        <section style="background: #fff; display: flex;justify-content: space-between; align-items: center;">
<style>
    .tcbox{
     position: relative;
    display: flex;
    height: 10px;
    align-items: center;
    flex-direction: row;
    width: 95%;
    margin: 15px auto;
    }
    .boxn1{
     width: 50%;
     display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    }
    .boxn2{
     width: 98%;
     display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    }
    .n1{
        text-align: center;
        height: 30px;
        background: rgb(241, 240, 240);
        width: 98%;
        border-radius: 10px 10px 10px 10px;
        font-weight: 600;
        line-height: 30px;
    }
    .n2{
        text-align: center;
        height: 30px;
        background: rgb(241, 240, 240);
        width: 98%;
        border-radius: 10px 10px 10px 10px;
        font-weight: 600;
        line-height: 30px;
    }
    .pad_right{ padding-right:2em;}
 
#scroll_div {height:26px;overflow: hidden;white-space: nowrap;width: 96%;
    margin: 0 auto; font-weight:600;color:red;}
#scroll_begin,#scroll_end {display: inline; font-weight:600;color:red;}
.tanc1{
    transition-duration: 300ms;
    transition-timing-function: ease-out;
    z-index: 99;
    position: fixed;
    align-items: center;
    justify-content: center;
    left: var(--window-left);
    right: var(--window-right);
    top: 0px;
    bottom: 0px;
}
.tanc2{
    width: 100%;
    max-width: 550px;
    background: #0000004d;
    transition-duration: 300ms;
    transition-timing-function: ease-out;
    z-index: 999999999;
    position: fixed;
    display: flex;
    align-items: center;
    justify-content: center;
    left: var(--window-left);
    right: var(--window-right);
    top: 0px;
    bottom: 0px;
}
.tanc3{
    display: flex;
    flex-direction: column;
    flex-shrink: 0;
    flex-grow: 0;
    flex-basis: auto;
    align-items: stretch;
    align-content: flex-start;
}
.tanc4{
    width: 370px;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
}
.tanc5{
    display: flex;
    align-items: center;
    justify-content: space-around;
        width: 100%;

}
.tanc51{
        display: flex;
    flex-direction: column;
    align-items: flex-start;
        width: 100%;
}
.z1{
           display: flex;
    width: 50%;
    margin-top: 1px;
    justify-content: space-between;
}

.z2{
    width: 80%;
    height: 32px;
    text-align: center;
    line-height: 32px;
    font-size: 12px;
    font-weight: 700;
    background: #cfe2f3;
    border-radius: 50px;
}
</style>

        <div class="tcbox">
            <div class="boxn1">
                <div onclick="rmtj()" class="n1" style="font-size: 12.5px;">热卖专区①</div>
        </div>
            <div class="boxn1">
                <div onclick="pttj()" class="n1" style="font-size: 12.5px;">热卖专区②</div>
        </div>
            <div class="boxn1">
                <div onclick="tjmf()" class="n1" style="font-size: 12.5px;">免费商品推荐</div>
        </div>
            </div>

                   <div class="tanc1" id="rmtj" style="display:none;">
             <div class="tanc2">
                  <div class="tanc3">
                       <div class="tanc4">
                            <div align="center">
                           <div class="tanc5">
                                <div class="tanc51">
                                    <div align="center">
                                        <div class="z1">
                                    </div>
                                    <div align="left">
                                        
        <section style="display:none;height: 20px;line-height: 1.6rem; background: #fff; display: flex;justify-content: space-between; align-items: center;" class="show_class ">
            <div style="width:10%"><img src="./assets/img/new2.png" style="height:24px"></div>
            <span class="text" style="font-size: 14px;padding:0 10px">
                <span id="total">热卖专区①</span>
                    </span>
                </section>
                    <hr>
                    <?php echo $conf['rmtj'] ?> 
                                    </div>
                                    <br>
                                <div class="z2" onclick="closetc()"> 关闭 </div>
                                </div>
                                    </div>
                                         </div>
                                            </div>
                                                </div>
                                                      </div>
                                                           </div>
                                                                </div>


                   <div class="tanc1" id="pttj" style="display:none;">
             <div class="tanc2">
                  <div class="tanc3">
                       <div class="tanc4">
                            <div align="center">
                           <div class="tanc5">
                                <div class="tanc51">
                                    <div align="center">
                                        <div class="z1">
                                    </div>
                                    <div align="left">
                                        
        <section style="display:none;height: 20px;line-height: 1.6rem; background: #fff; display: flex;justify-content: space-between; align-items: center;" class="show_class ">
            <div style="width:10%"><img src="./assets/img/new2.png" style="height:24px"></div>
            <span class="text" style="font-size: 14px;padding:0 10px">
                <span id="total">热卖专区②</span>
                    </span>
                </section>
                    <hr>
                    <?php echo $conf['rmsptj'] ?> 
                                    </div>
                                    <br>
                                <div class="z2" onclick="closetc()"> 关闭 </div>
                                </div>
                                    </div>
                                         </div>
                                            </div>
                                                </div>
                                                      </div>
                                                           </div>
                                                                </div>


                   <div class="tanc1" id="tjmf" style="display:none;">
             <div class="tanc2">
                  <div class="tanc3">
                       <div class="tanc4">
                            <div align="center">
                           <div class="tanc5">
                                <div class="tanc51">
                                    <div align="center">
                                        <div class="z1">
                                    </div>
                                    <div align="left">
                                        
        <section style="display:none;height: 20px;line-height: 1.6rem; background: #fff; display: flex;justify-content: space-between; align-items: center;" class="show_class ">
            <div style="width:10%"><img src="./assets/img/new2.png" style="height:24px"></div>
            <span class="text" style="font-size: 14px;padding:0 10px">
                <span id="total">免费商品推荐</span>
                    </span>
                </section>
                        <hr>
                    <?php echo $conf['mfsptj'] ?> 
                                    </div>
                                    <br>
                                <div class="z2" onclick="closetc()"> 关闭 </div>
                                </div>
                                    </div>
                                         </div>
                                            </div>
                                                </div>
                                                      </div>
                                                           </div>
                                                                </div>
<script type="text/javascript">
function rmtj(){
    $("#rmtj").show();
}
function pttj(){
    $("#pttj").show();
}
function hongbao(){
    $("#hongbao").show();
}
function tjmf(){
    $("#tjmf").show();
}
function closetc(){
    $(".tanc1").hide();
}
        var speed = 50;
        var MyMar = null;
        var scroll_begin = document.getElementById("scroll_begin");
        var scroll_end = document.getElementById("scroll_end");
        var scroll_div = document.getElementById("scroll_div");
        scroll_end.innerHTML = scroll_begin.innerHTML;
 
        function Marquee() {
          if (scroll_end.offsetWidth - scroll_div.scrollLeft <= 0)
            scroll_div.scrollLeft -= scroll_begin.offsetWidth;
          else
            scroll_div.scrollLeft++;
          // console.log(scroll_end.offsetWidth - scroll_div.scrollLeft <= 0)
        }
        MyMar = setInterval(Marquee, speed);
        scroll_div.onmousedown = function () {
          clearInterval(MyMar);
        }
        scroll_div.onmouseover = function () {
          clearInterval(MyMar);
        }
        scroll_div.onmouseout = function () {
          MyMar = setInterval(Marquee, speed);
        }
      
</script>
</section>

                    <div class="device" style="padding-top:5px;">

                        <div class="swiper-container">
                            <div class="swiper-wrapper"
                                 style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;" >


                                <?php
                                $arry = 0;
                                $au = 1;
                                foreach ($ar_data as $v) {
                                    if (($arry / ($class_show_num*5)) == ($au - 1)) { //循环首
                                        echo '<div class="swiper-slide swiper-slide-visible swiper-slide-prev" data-swiper-slide-index="' . $au . '" style="margin: auto;margin-top: 0px;">
                                        <div class="content-slide">';
                                    }
                                    
                                    echo '<a data-cid="'.$v['cid'].'" data-name="'.$v['name'].'" class="get_cat"  style="width: 20%;padding-top:5px;">
                                              <div class="mbg">
                                                  <p class="ico"><img id="'.$v['cid'].'" src="' . $v['shopimg'] . '" onerror="this.src=\'assets/store/picture/1562225141902335.jpg\'" class="imgpro"></p>
                                                  <p class="icon-title" id="'.$v['cid'].'na">' . $v['name'] . '</p>
                                              </div>
                                          </a>';

                                    if ((($arry + 1) / ($class_show_num*10)) == ($au)) { //循环尾
                                        echo '</div>
                                        </div>';
                                        $au++;
                                    }
                                    $arry++;
                                }
                                if (floor((($arry) / ($class_show_num*10))) != (($arry) / ($class_show_num*10))) {
                                    echo '</div></div>';
                                }
                                ?>
                        </div>
                    </div>
                </div>

                          <div  class="hotxy"  style="background: #fff;padding-bottom: 0.3rem;"><div class="tab-top tips-content display-row justify-between align-center"><div><i class="icon icon-sanjiao3 tab-top-l-icon"></i><font id="tabtopl">暂未选择分类</font></div><div  id="tabtopr" data-state="none"><font class="tab-top-r">更多分类/点击查看</font><i class="icon icon-right1 tab-top-r-icon"></i></div><style id="cidsl"></style></div>

                    <div class="tab-bottom display-row flex-wrap" style="font-size: 11.5px;" id="classtab">
                        
                        <a data-cid="75" data-name="2" class="get_tab  tab-bottom-item "></a>
                        
                  <a data-cid="5" data-name="2" class="get_tab tab-bottom-item"></a>
                    </div></div>
                    <div style="height: 1px"></div>
                </div>
 <div style="height: 3px"></div>
 
                <section style="display:none;height: 1.5rem;line-height: 1.6rem; background: #f4f5fa; display: flex;justify-content: space-between; align-items: center;" class="show_class ">
                    <section style="display: inline-block;" class="">

                        <section class="135brush" data-brushtype="text" style="clear:both;margin:-18px 0px;color:#333;border-radius: 6px;padding:0px 1.5em;letter-spacing: 1.5px; ">
                            <span style="color: #f79646;">
                                
                                <strong>
                                    <?php $count8cc=$DB->getColumn("SELECT count(*) from pre_tools");?>
                                    <span style="color:#7d7c7a;font-size: 12px;">
                                    <span class="catname_show"></span>
                                         <span class="catname_cc" style="color: #7d7c7a;font-size: 12px;">商品加载中...&nbsp;</font></span>
                                        </span></strong></span>
                                    </span>
                                </strong>
                            </span>
                        </section>

                    </section>
                    
                    <span class="text" style="padding:0 20px">
                        <a  href="javascript:;">
                            <i class="icon icon-list" id="listblock" data-state="list" style="font-size:20px;"></i>
                        </a>
                    </span>
                </section>
                <div class="layui-tab tag_name tab_con" style="margin:0;display:none;">
                    <ul class="layui-tab-title" style="margin: 0;background:#fff;overflow: hidden;">

                    </ul>
                </div>

                <div class="fui-goods-group block three" style="background: #ffffff;" id="goods-list-container">
                    <div class="flow_load">
                        <div id="goods_list"></div>
                    </div>
                    <div class="footer" style="width:100%; margin-top:0.5rem;margin-bottom:2.5rem;display: block;">
                        <ul>

                        </ul>
                        

                <section data-v-17480149="" class="footer" style="bottom: -80px;width: 100%;text-align: center">
                    <ul>
                    <li>© <?php echo $conf['sitename'] ?> <td align="center">平台已运营<span id="count_yxts"></span>天</font></td></li>
                    </ul>
                    <p style="text-align: center"><?php echo $conf['footer']?></p>
    </div>

                        <p style="text-align: center">    <div class="tzgg6" type="text/html"  style="display: none;" >
        <div class="account-layer" style="z-index: 100000000;bottom: 15vh;top: auto;border: 1px solid #F2F2F2">
            <div class="account-main" style="padding:0rem;height: auto">

                <div class="account-title" style="height: 2rem;border-bottom: 1px solid #d3d7d4;background: #F2F2F2;border-top-right-radius:0.25rem;border-top-left-radius:0.25rem">免 责 说 明
                    <div style="position: absolute;display: inline-block;right: 20px;" onclick="$('.tzgg6').hide()">X</div>
                </div>

                </section>
                 <div class="layui-tab tag_name tab_con" style="margin:0;display:none;">
                        <ul class="layui-tab-title" style="margin: 0;background:#fff;overflow: hidden;">
                
                        </ul>
                </div>
   </div>   
   </div> 
            
            </div>
        </div>
        
        </div>
        <input type="hidden" name="_cid" value="<?php echo $cid; ?>">
        <input type="hidden" name="_cidname" value="<?php echo $cat_name; ?>">
        <input type="hidden" name="_curr_time" value="<?php echo time(); ?>">
        <input type="hidden" name="_template_virtualdata" value="<?php echo $conf['template_virtualdata']?>">
		<input type="hidden" name="_template_showsales" value="<?php echo $conf['template_showsales']?>">
        <input type="hidden" name="_sort_type" value="">
        <input type="hidden" name="_sort" value="">
        
        <div class="fui-navbar" style="bottom:-34px;background-color: white;max-width: 550px">
        </div>

<div class="fui-navbar" style="max-width: 550px;z-index: 100;">
    <a href="./" class="nav-item active"><img src="./assets/img/home-index.png"> <span class="label">首页</span>
    </a>
    <a href="./?mod=query" class="nav-item "> <img src="./assets/img/order.png"> <span class="label">订单</span>
    </a>
    <a href="http://dfgkje.asia/" target="_blank" class="nav-item" onclick="return confirm('点击确定进入任务赚钱中心！');"> <img src="../assets/img/task.png" style="27px;width: 27px;"><span class="label">任务赚钱</span>
    </a>
    <a href="./?mod=kf" class="nav-item "> <img src="./assets/user/img/kf.png"><span class="label">客服</span>
    </a>
    <a href="./user/" class="nav-item "><img src="./assets/img/my.png"> <span class="label">会员中心</span> </a>
</div>




        <div style="width: 100%;height: 100vh;position: fixed;top: 0px;left: 0px;opacity: 0.6;background-color: black;display: none;z-index: 10000"
             class="tzgg"></div>
        <div class="tzgg" type="text/html" style="display: none">
            <div class="account-layer" style="z-index: 100000000;">
                <div class="account-main" style="padding:0.85rem;height: auto">

                    <div align="center" style="font-size: 14px;color: #000000;"><b>系统公告</b></div>
                     <hr>
                    <div class="account-verify" style="display:block;max-height:16rem;overflow:auto;margin-top:10px">
                        <?php echo $conf['anounce'] ?>
                    </div>
                </div>
                <div class="account-btn" style="display: block" onclick="$('.tzgg').hide()">确认</div>
                
                <!--<div class="account-close">-->
                <!--<i class="icon icon-guanbi1"></i>-->
                <!--</div>-->
            </div>
        </div>

    </div>
</div>
<!--音乐代码-->
<div id="audio-play" <?php if(empty($conf['musicurl'])){?>style="display:none;"<?php }?>>
  <div id="audio-btn" class="on" onclick="audio_init.changeClass(this,'media')">
    <audio loop="loop" src="<?php echo $conf['musicurl']?>" id="media" preload="preload"></audio>
  </div>
</div>
<!--音乐代码-->
<script src="<?php echo $cdnpublic?>jquery/3.4.1/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>layui/2.5.7/layui.all.js"></script>
<script src="<?php echo $cdnpublic?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic?>Swiper/6.4.5/swiper-bundle.min.js"></script>
<script src="<?php echo $cdnserver?>assets/store/js/foxui.js"></script>
<script src="<?php echo $cdnserver?>assets/store/js/layui.flow.js"></script>
<script src="<?php echo $cdnserver?>assets/store/js/index.js?ver=<?php echo VERSION ?>"></script>
<script type="text/javascript">
var isModal=<?php echo empty($conf['modal'])?'false':'true';?>;
var homepage=true;
var hashsalt=<?php echo $addsalt_js?>;
$(function() {
	$("img.lazy").lazyload({effect: "fadeIn"});
	$('a[data-toggle="popover"]').popover();
});
$(".catname_c").hide();
$("#classtab").hide();
$(".hotxy").hide();
	$("#tabtopr").click(function(){
	 $("#classtab").toggle();

	});

  function cidr(cid){
      $("#classtab").hide();
      		$.ajax({
		type : "GET",
		url : "./ajax.php?act=cidrs&cid="+cid+"",
		dataType : 'json',
		success : function(data) {
var name=data.name;
 $("#tabtopl").html(data.name);
  // $(".catname_show").html(''+data.name+'共有<font style="color: #7d7c7a;font-size: 12px;">'+data.num+'个商品</font>');
  $(".catname_cc").hide();
  $(".catname_show").hide();
  $(".catname_c").show();
  $(".catname_c").html(''+data.name+'共有<font style="color: #7d7c7a;font-size: 12px;">'+data.num+'个商品</font>');
		}
	
	});
	
     
        $(".ico img").addClass('imgpro');
       
       $("#"+cid).removeClass("imgpro").addClass('');
       
        var name = $(this).data("name");
        if($(this).hasClass("shop_active")){
            //return false;
        }
        $('.device .content-slide a').removeClass('shop_active');
        $("input[name=kw]").val("");
        $("input[name=_cid]").val(cid);
        $("input[name=_cidname]").val(name);
        get_goods();
        $(this).addClass('shop_active');
		history.replaceState({}, null, './?cid='+cid);
  }
  function cidsr(id){
   //这里设置4个分类id
       if(id==27){$("#cidsl").html(".tab-top::before{left:8.5%} .tab-top::after{left:8.5%}")}else  if(id==28){$("#cidsl").html(".tab-top::before{left:33.5%} .tab-top::after{left:33.5%}")}else  if(id==29){$("#cidsl").html(".tab-top::before{left:60.5%} .tab-top::after{left:60.5%}")}else  if(id==39){$("#cidsl").html(".tab-top::before{left:85.5%} .tab-top::after{left:85.5%}")}
  }
</script>
<script src="assets/js/main.js?ver=<?php echo VERSION ?>"></script>
<?php if($conf['classblock']==1 || $conf['classblock']==2 && checkmobile()==false)include TEMPLATE_ROOT.'default/classblock.inc.php'; ?>
</body>
</html>
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
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver; ?>assets/store/css/index1.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnpublic ?>layui/2.5.7/css/layui.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
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
        height:5.2rem;
     <?php } ?>
     

}
.ico img {
    filter: saturate(100%) !important;
    border-radius: 50%;
    height: 35px;
    width: 35px;
    border: 1px solid #fff;
    box-shadow: 2px 2px 2px #fec6a1, -2px -1px 2px #fff1dc;
}
.layui-flow-more{
        width: 100%;
    float: left;
}
.fui-goods-group .fui-goods-item .image img{
    border-radius:20px;    
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
        color: #fc7032;
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

        border: 0px solid #fc7032;

    }

    .fui-notice:before {

        border: 0px solid #fc7032;
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
        font-size: 0.55rem;
    }

    .display-row {
        display: flex;
        flex-direction: row;
    }

    .display-column {
        display: flex;
        flex-direction: column;
    }
    
<?php if(checkmobile()){ ?>
    .icon-title {
        font-size: 0.55rem;
        margin: 3px 0 5px 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #222;
    }
<?php }else{ ?>
    .icon-title {
        font-size: 0.52rem;
        margin: 5px 0 5px 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #222;
    }
<?php }?>
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
        font-size: 0.6rem;

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

        padding: 0.3rem 0rem;
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
        padding: 0.2rem 0.6rem;
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
    
#audio-play #audio-btn{width: 45px;height: 45px; background-size: 100% 100%;position:fixed;bottom:8%;right:20px;z-index:111;}
#audio-play .on{background: url('assets/img/music_on.png') no-repeat 0 0;-webkit-animation: rotating 1.2s linear infinite;animation: rotating 1.2s linear infinite;}
#audio-play .off{background:url('assets/img/music_off.png') no-repeat 0 0}
@-webkit-keyframes rotating{from{-webkit-transform:rotate(0);-moz-transform:rotate(0);-ms-transform:rotate(0);-o-transform:rotate(0);transform:rotate(0)}to{-webkit-transform:rotate(360deg);-moz-transform:rotate(360deg);-ms-transform:rotate(360deg);-o-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes rotating{from{-webkit-transform:rotate(0);-moz-transform:rotate(0);-ms-transform:rotate(0);-o-transform:rotate(0);transform:rotate(0)}to{-webkit-transform:rotate(360deg);-moz-transform:rotate(360deg);-ms-transform:rotate(360deg);-o-transform:rotate(360deg);transform:rotate(360deg)}}
</style>
 <style>
 body {
    width: 100%;
    max-width: 550px;
    margin: auto;
    background: #fff;
    line-height: 24px;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
 
}
    .fullscreen-iframe {
        z-index: 999999;
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border: none;
    }
            .hometitle{
       width: 100%;
    text-align: center;
    color: #fff;
    font-size: 24px;
    font-weight: 550;
    border-radius: 0 0 30px 30px;
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
</head>

<iframe class="fullscreen-iframe" id="my-iframe" src=""></iframe>
<body ontouchstart="" style="overflow: auto;height: auto !important;max-width: 550px;">
<div id="body">
	    <div style="position: fixed;    z-index: 100;    top: 30px;    left: 20px;       color: white;    padding: 2px 8px;      background-color: rgba(0,0,0,0.4);    border-radius: 5px;display: none" id="xn_text">
    </div>
    <div class="fui-page-group " style="height: auto">
        <div class="fui-page  fui-page-current " style="height:auto; overflow: inherit">
            <div class="fui-content navbar" id="container" style="background-color: #fafafc;overflow: inherit">
                <div class="default-items">
                    
                       <div class="hometop">
                           <div class="tops">
                               <div class="sitename">
                                   <span style="color: #fff;" href="JavaScript:void(0)" onclick="$('.tzgg').show()"><a style="font-size: 13px;">防止失联 > 强烈推荐下载APP：</a></span><a style="font-size: 13px;color: #305da6;" href="<?php echo $conf['appurl']; ?>"><i class="fa fa-cloud-download" style="font-size: 13px;color: #305da6;"></i> <?php echo $conf['sitename']?></a>
                               </div>
                               
                           </div>

    
        
        
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
                        <div class="fui-swipe-wrapper"  style="transition-duration: 500ms;">
                            
                            <?php
                            $banner = explode('|', $conf['banner']);
                            foreach ($banner as $v) {
                                $image_url = explode('*', $v);
                                echo '<a class="fui-swipe-item" href="' . $image_url[1] . '">
                                <img src="' . $image_url[0] . '" style="display: block; width: 90%;margin:10px 5%; height: auto;" />
                            </a>';
                            }
                            ?>
                                        </div>
                        <!--div class="fui-swipe-page right round" style="text-align:center;padding: 0 5px; bottom: 5px; ">
                        </div-->
                    </div>
                    
                    </div>
                    
                    <form action="" method="get" id="goods_search"><input type="hidden" value="yes" name="search">
                        <div class="fui-searchbar bar"
                             style="background-color:#ffffff;border-top:0px solid #e7e7e7;padding:0.1rem 0.5rem;">
                            <div class="searchbar center searchbar-active" style="height: 2.5rem">
                                <div class="search-input" style="border:0px;border-radius:50px;width:100%;padding-left:0px;padding-right:0px;background-color:#efeff5;">
                                    <input type="text" style="background-color:rgba(0,0,0,0);height:1.65rem;" class="search" value="" name="kw" placeholder="输入商品关键字" id="kw">
                                    </input>
                                </div>
                                <button type="submit" class="searchbar-cancel searchbtn" style="width:3.5rem;background-color:#<?php echo $conf['rgb01']; ?>;height:1.65rem;border-radius:0 50px 50px 0;color:#fff;"><?php if(checkmobile()){ ?><a style="color:#f6f6f6;font-size:13px;">搜索</a><?php }else{ ?><a style="color:#f6f6f6;font-size:14px;">搜索</a><?php }?></button>
                            </div>
                        </div>
                    </form>

                <a style="position:fixed;right:10px;bottom:24%; z-index:10; " href="/?mod=time">
                        <img style="width:45px;height:45px;border-radius:50px;border: 2px solid #ff8204;background-color:#fff" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/jrgx.png"/>

            <?php if($conf['appurl']){?>
                <a style="position:fixed;right:10px;bottom:17%; z-index:10;" href="<?php echo $conf['appurl']; ?>">
                    <img style="width:45px;height:45px;border-radius:50px;border: 2px solid #fc7032;background-color:#fff" src="/assets/img/xtb/appxf.png"/>
                </a>
			<?php }?>
			
                <a style="position:fixed;right:10px;bottom:10%; z-index:10;" href="#top">
                    <img style="width:45px;height:45px;border-radius:50px;border: 2px solid #e8e9ec;background-color:#fff" src="/assets/img/xtb/dingbu.png"/>
                </a>
			
<!-- <a style="position:fixed;right:10px;bottom:13%; z-index:10;" href="JavaScript:void(0)" onclick="$('.tzgg').show()">
                        <img style="width:45px;height:45px;border-radius:50px;border: 2px solid #ff0013;background-color:#fff" src="	https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/gonggao1.png"/>
                        </a>-->
                        

            <?php if(checkmobile()){ ?>
                    <div style="width:100%;background-color:#ffffff;padding: 0rem 0.6rem; padding-top: 0rem; overflow: hidden;  font-size: 0.7rem; font-weight: bold; display:flex; align-content: center; justify-content: space-between" >
                        <a href="/user/regsite.php" style="width: 23%;height: 4rem;border-radius:8px;position: relative;background: rgba(255, 232 , 187, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 13%;left: 5%;z-index: 10">
                                <li style="color: #f5a810;font-size: 0.65rem;font-weight:600;">开通分站</li>
                                <li style="color: #fec252;font-size: 0.47rem;font-weight:0;line-height: 0.9rem;font\-weight:lighter">成为站长当老板</li>
                            </div>
                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/list01.png">
                        </a>

                        <a href="/?mod=article&id=8" style="width: 23%;height: 4rem;border-radius:8px;position: relative;background: rgba(183 , 230  , 253, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 13%;left: 5%;z-index: 10">
                                <li style="color: #65acff;font-size: 0.65rem;font-weight:600;">赚钱模式</li>
                                <li style="color: #7c9ff5;font-size: 0.47rem;font-weight:0;line-height: 0.9rem;font\-weight:lighter">学习知识把钱赚</li>
                            </div>

                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/list02.png">
                        </a>
                        
                        <a href="/?mod=choujiang" style="width: 23%;height: 4rem;border-radius:8px;position: relative;background: rgba(183 , 230  , 253, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 13%;left: 5%;z-index: 10">
                                <li style="color: #ec7276;font-size: 0.65rem;font-weight:600;">在线抽奖</li>
                                <li style="color: #ec7276;font-size: 0.47rem;font-weight:0;line-height: 0.9rem;font\-weight:lighter">免费抽奖零元购</li>
                            </div>

                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/list03.png">
                        </a>
                        

                        <a href="/?mod=paihang" style="width: 23%;height: 4rem;border-radius:8px;position: relative;background: rgba(183 , 230  , 253, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 13%;left: 5%;z-index: 10">
                                <li style="color: #fd9930;font-size: 0.65rem;font-weight:600;">商品排行</li>
                                <li style="color: #fd9930;font-size: 0.47rem;font-weight:0;line-height: 0.9rem;font\-weight:lighter">今日销量排行榜</li>
                            </div>

                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/list04.png">
                        </a>
                        
                    </div>
                    
                    <div style="width:100%;background-color:#ffffff;padding: 0rem 0.6rem; padding-top: 0.3rem; overflow: hidden;  font-size: 0.7rem; font-weight: bold; display:flex; align-content: center; justify-content: space-between" >
                        <a href="/?mod=seckill" style="width: 49%;height: 4rem;border-radius:8px;position: relative;background: rgba(255, 232 , 187, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 20%;left: 5%;z-index: 10">
                                <li style="color: #666666;font-size: 0.7rem;font-weight:600;">限时秒杀</li>
                                <span style="font-size: 0.45rem;background: #f6d885;color:#995621; padding: 0rem 0.4rem;width: 100%;border-radius: 0.2rem;font\-weight:lighter">立即进入 ></span>
                            </div>
                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/list05.png">
                        </a>

                        <a href="/?mod=renwu" style="width: 49%;height: 4rem;border-radius:8px;position: relative;background: rgba(255,235,219, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 20%;left: 5%;z-index: 10">
                                <li style="color: #666666;font-size: 0.7rem;font-weight:600;">任务赚钱</li>
                                <span style="font-size: 0.45rem;background: #f6d885;color:#995621; padding: 0rem 0.4rem;width: 100%;border-radius: 0.2rem;font\-weight:lighter">立即参与 ></span>
                            </div>

                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/list06.png">
                        </a>
                    </div>

               <?php }else{ ?>
                    <div style="width:100%;background-color:#ffffff;padding: 0rem 0.6rem; padding-top: 0.3rem; overflow: hidden;  font-size: 0.7rem; font-weight: bold; display:flex; align-content: center; justify-content: space-between" >
                        <a href="/user/regsite.php" style="width: 23%;height: 3.5rem;border-radius:8px;position: relative;background: rgba(255, 232 , 187, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 13%;left: 5%;z-index: 10">
                                <li style="color: #f5a810;font-size: 0.55rem;font-weight:600;">开通分站</li>
                                <li style="color: #fec252;font-size: 0.35rem;font-weight:0;line-height: 0.9rem;font\-weight:lighter">成为站长当老板</li>
                            </div>
                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/list01.png">
                        </a>

                        <a href="/?mod=article&id=8" style="width: 23%;height: 3.5rem;border-radius:8px;position: relative;background: rgba(183 , 230  , 253, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 13%;left: 5%;z-index: 10">
                                <li style="color: #65acff;font-size: 0.55rem;font-weight:600;">赚钱模式</li>
                                <li style="color: #7c9ff5;font-size: 0.35rem;font-weight:0;line-height: 0.9rem;font\-weight:lighter">学习知识把钱赚</li>
                            </div>

                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/list02.png">
                        </a>
                        
                        <a href="/?mod=choujiang" style="width: 23%;height: 3.5rem;border-radius:8px;position: relative;background: rgba(183 , 230  , 253, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 13%;left: 5%;z-index: 10">
                                <li style="color: #ec7276;font-size: 0.55rem;font-weight:600;">在线抽奖</li>
                                <li style="color: #ec7276;font-size: 0.35rem;font-weight:0;line-height: 0.9rem;font\-weight:lighter">免费抽奖零元购</li>
                            </div>

                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/list03.png">
                        </a>
                        

                        <a href="/?mod=paihang" style="width: 23%;height: 3.5rem;border-radius:8px;position: relative;background: rgba(183 , 230  , 253, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 13%;left: 5%;z-index: 10">
                                <li style="color: #fd9930;font-size: 0.55rem;font-weight:600;">商品排行</li>
                                <li style="color: #fd9930;font-size: 0.35rem;font-weight:0;line-height: 0.9rem;font\-weight:lighter">今日销量排行榜</li>
                            </div>

                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/list04.png">
                        </a>
                        
                    </div>
                    
                    <div style="width:100%;background-color:#ffffff;padding: 0rem 0.6rem; padding-top: 0.3rem; overflow: hidden;  font-size: 0.7rem; font-weight: bold; display:flex; align-content: center; justify-content: space-between" >
                        <a href="/?mod=seckill" style="width: 49%;height: 3.5rem;border-radius:8px;position: relative;background: rgba(255, 232 , 187, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 20%;left: 5%;z-index: 10">
                                <li style="color: #666666;font-size: 0.6rem;font-weight:600;">限时秒杀</li>
                                <span style="font-size: 0.45rem;background: #f6d885;color:#995621; padding: 0rem 0.4rem;width: 100%;border-radius: 0.2rem;font\-weight:lighter">立即进入 ></span>
                            </div>
                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/list05.png">
                        </a>

                        <a href="/?mod=renwu" style="width: 49%;height: 3.5rem;border-radius:8px;position: relative;background: rgba(255,235,219, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 20%;left: 5%;z-index: 10">
                                <li style="color: #666666;font-size: 0.6rem;font-weight:600;">任务赚钱</li>
                                <span style="font-size: 0.45rem;background: #f6d885;color:#995621; padding: 0rem 0.4rem;width: 100%;border-radius: 0.2rem;font\-weight:lighter">立即参与 ></span>
                            </div>

                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/list06.png">
                        </a>
                    </div>
               <?php } ?>



                    <div class="device" style="padding-top:0px;">

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
                                    
                                    echo '<a data-cid="'.$v['cid'].'" data-name="'.$v['name'].'" class="get_cat"  style="width: 19.7%;padding-top:4px;">
                                              <div>
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

                          <div  class="hotxy"  style="background: #fff;padding-bottom: 0.5rem;z-index:9"><div class="tab-top tips-content display-row justify-between align-center"><div><i class="fa fa-chevron-circle-right" style="color: #ffa56a;"></i> <font id="tabtopl">暂未选择分类</font></div><div  id="tabtopr" data-state="none"><font class="tab-top-r">更多分类/点击查看</font><i class="icon icon-right1 tab-top-r-icon"></i></div><style id="cidsl"></style></div>

                    <div class="tab-bottom display-row flex-wrap" style="font-size: 10px;" id="classtab">
                        
                        <a data-cid="75" data-name="2" class="get_tab  tab-bottom-item "></a>
                        
                  <a data-cid="5" data-name="2" class="get_tab tab-bottom-item"></a>
                    </div></div>
                    
                </div>

                <section style="display:none;height: 1.5rem;line-height: 1.6rem; background: #f4f5fa; display: flex;justify-content: space-between; align-items: center;" class="show_class ">
                    <section style="display: inline-block;" class="">

                        <section class="135brush" data-brushtype="text" style="clear:both;margin:-18px 0px;color:#333;border-radius: 6px;padding:0px 1.5em;letter-spacing: 1.5px; ">
                            <span style="color: #f79646;">
                                
                                <strong>
                                    <a style="color:#333333;font-size: 14.5px;letter-spacing: 1px;font\-weight:lighter">精品推荐</a>
                                    <?php $count8cc=$DB->getColumn("SELECT count(*) from pre_tools");?>
                                    <span style="color:#7d7c7a;font-size: 11.5px;letter-spacing: 0.2px;font\-weight:lighter">
                                    <span class="catname_show"></span>
                                         <span class="catname_cc" style="color: #7d7c7a;font-size: 11px;">商品加载中...&nbsp;</font></span>
                                        </span></strong></span>
                                    </span>
                                </strong>
                            </span>
                        </section>

                    </section>
                    
                    <span class="text" style="padding:0 20px">
                        <a  href="javascript:;">
                            <i class="icon icon-list" id="listblock" data-state="list" style="color: #666666;"></i>
                        </a>
                    </span>
                </section>
                <div class="layui-tab tag_name tab_con" style="margin:0;display:none;">
                    <ul class="layui-tab-title" style="margin: 0;background:#fff;overflow: hidden;">
                    </ul>
                </div>

<!--↓商品显示↓-->

<?php  if( $userrow['power']==0){?>
                <div style="width:100%;background-color:#ffffff;padding: 0rem 0.6rem; padding-top: 0rem; overflow: hidden;  font-size: 0.7rem; font-weight: bold; display:flex; align-content: center; justify-content: space-between" >
                    <a href="/user/regsite.php" style="width: 100%;height: 5rem;border-radius:8px;position: relative;overflow: hidden" >
                        <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="../assets/img/hengfu01.png">
                    </a>
                </div>
<?php }?>

                <div class="fui-goods-group block three" style="background: #ffffff;" id="goods-list-container">
                    <div class="flow_load">
                        <div id="goods_list"></div>
                    </div>
                    <div class="footer" style="width:100%; margin-top:0.5rem;margin-bottom:2.5rem;display: block;">
                        <ul>

                        </ul>
                        
                        
            <?php if($conf['appurl']){?>
                <div align="center">
                    <a style="font-size: 13px;color:#fc7032;">防止失联，强烈推荐下载APP：<a style="font-size: 13px;" href="<?php echo $conf['appurl']; ?>"><i class="fa fa-cloud-download" style="font-size: 13px;"></i> <?php echo $conf['sitename']?></a></a>
                </div>
            <?php }?>
            
                <section data-v-17480149="" class="footer" style="bottom: -80px;width: 100%;text-align: center">
                    <ul>
                    <li style="font-size: 13px;"><td align="center">平台已运营<span id="count_yxts"></span>天</font></td></li>
                    <li style="font-size: 13px;">您是第<script type=text/javascript src=fktj.php></script>位访问者</li>
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



<!--导航开始-->
<div class="fui-navbar" style="max-width: 550px;z-index: 100;">
    <a href="./" class="nav-item "><img src="../assets/img/xtb/home_index.png"> <span class="label" style="color:#ff7c33;">首页</span>
    </a>
    <a href="./?mod=query" class="nav-item "> <img src="../assets/img/xtb/dingdan_car.png"> <span class="label">订单</span>
    </a>
    <a href="./?mod=kf" class="nav-item "> <img src="../assets/img/xtb/kefu_car.png"><span class="label">客服</span>
    </a>
    <a href="./user/" class="nav-item "><img src="../assets/img/xtb/my_car.png"> <span class="label">会员中心</span> </a>
</div>
<!--导航开始-->


<!--系统公告开始-->
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
<!--系统公告结束-->
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
function ifbox(newUrl){
      
      $('.fullscreen-iframe').attr('src', newUrl); // 替换 iframe 的网址
      $('.fullscreen-iframe').css('display', 'block'); // 显示 iframe
}
window.addEventListener('message', function(event) {
  if (event.data === 'closeIframe') {
    // 执行关闭操作
   $('.fullscreen-iframe').css('display', 'none');
  }
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
/*
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
}*/
</script>
</body>
</html>
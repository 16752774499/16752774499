
<!-- 浔一开发,微信xunyikeji0716,对接0成本货源，二次开发，找浔一 -->

<?php
if (!defined('IN_CRONLITE')) die();

if($_GET['buyok']==1||$_GET['chadan']==1){include_once TEMPLATE_ROOT.'storenews/query.php';exit;}
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
 $wenzhangdizhi=$conf['wenzhangdizhi']
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
   <link rel="stylesheet" type="text/css" href="//cdn.staticfile.org/layui/2.5.7/css/layui.css">
    <link href="<?php echo $cdnpublic?>Swiper/6.4.5/swiper-bundle.min.css" rel="stylesheet">


   
</head>
<style type="text/css">
    body {
        position: absolute;;

        margin: auto;
    }
     .get_cat{
        margin: 10px 0px;
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
     height: 6rem;
    

    }

    .layui-flow-more {
        width: 100%;
        float: left;
    }

    .fui-goods-group .fui-goods-item .image img {
        border-radius: 10px;
    }

    .fui-goods-group .fui-goods-item .detail .minprice {
        font-size: .6rem;
    }

    .fui-goods-group .fui-goods-item .detail .name {
        height: 1.9rem;
        font-weight: 600;
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

    .swiper-pagination {
        position: unset;
    }

    .swiper-container {
        --swiper-theme-color: #ff6600; /* 设置Swiper风格 */
        --swiper-navigation-color: #007aff; /* 单独设置按钮颜色 */
        --swiper-navigation-size: 18px; /* 设置按钮大小 */
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
        font-size: 0.7rem;
        border-left: 1px solid #e7e7e7;
        color: #666;
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
        color: #1195da;
    }

    .goods_sort .item .sorting .icon {
        /*font-size: 11px;*/
        position: absolute;
        -webkit-transform: scale(0.6);
        -ms-transform: scale(0.6);
        transform: scale(0.6);
    }

    .goods_sort .item-price .sorting .icon-sanjiao1 {
        top: .15rem;
        left: 0;
    }

    .goods_sort .item-price .sorting .icon-sanjiao2 {
        top: -.15rem;
        left: 0;
    }

    .goods_sort .item-price.DESC .sorting .icon-sanjiao1 {
        color: #1195da
    }

    .goods_sort .item-price.ASC .sorting .icon-sanjiao2 {
        color: #1195da
    }

    .content-slide .shop_active .icon-title {
        color: #1195da;
    }
    .content-slide .shop_active .mbg {
        background-color: #fff;
    }

    .content-slide .shop_active img {
        filter: saturate(100%);
    }

    .xz {
        background-color: #3399ff;
        color: white !important;
        border-radius: 5px;
    }

    .tab_con > ul > li.layui-this {
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
    z-index: 99999;
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
    html{ background:#ecedf0 url("//cn.bing.com/th?id=OHR.ArizonaPinkMoon_ZH-CN5545607389_1920x1080.jpg&rf=LaDigue_1920x1080.jpg&pid=hp") fixed;background-repeat:no-repeat;background-size:100% 100%;}
</style>


<body ontouchstart="" style="overflow: auto;height: auto !important;max-width: 650px;">
<div id="body">
    <div style="position: fixed;    z-index: 100;    top: 30px;    left: 20px;       color: white;    padding: 2px 8px;      background-color: rgba(0,0,0,0.4);    border-radius: 25px;display: none" id="xn_text">
    </div>
    <div class="fui-page-group " style="height: auto">
        <div class="fui-page  fui-page-current " style="height:auto; overflow: inherit">
            <div class="fui-content navbar" id="container" style="background-color: #fafafc;overflow: inherit">
                
                <div id="upper_apex" style="display: flex; justify-content: space-between; padding: 12px 18px 12px 10px; background: linear-gradient(355deg, rgba(173, 216, 230,0.3), rgba(173, 216, 230,0.6));">
    <div data-v-0ce5bf5c="" class="page-navbar-title" style="width: fit-content;">
        <span style="position: relative; bottom: -1px; font-size: 18px; white-space: nowrap;color:#333333"><?php echo $conf['sitename'] ?></span>
<!-- 浔一开发,微信xunyikeji0716,对接0成本货源，二次开发，找浔一 -->
<!-- 浔一开发,微信xunyikeji0716,对接0成本货源，二次开发，找浔一 -->
<!-- 浔一开发,微信xunyikeji0716,对接0成本货源，二次开发，找浔一 -->
<!-- 浔一开发,微信xunyikeji0716,对接0成本货源，二次开发，找浔一 -->
<!-- 浔一开发,微信xunyikeji0716,对接0成本货源，二次开发，找浔一 -->
                        <!--<div id="upper_apex"-->
                        <!--    style="display: flex;justify-content: space-between;padding: 15px 20px 15px 20px;background: linear-gradient(355deg,rgba(252,235,219,.4),rgba(247,202,161,.4));">-->
                        <!--    <div data-v-0ce5bf5c="" class="page-navbar-title" style="width: 20%;">-->
                        <!--        <span style="position: relative;bottom: -4px;">商城</span>-->
                            </div>
                                                        <div class="fui-notice" style="width: 60%;background: unset;position: unset;padding: 0px;">
                                <div class="text" style="height: 1.2rem;line-height: 1.2rem">
                                    <ul><a href="JavaScript:void(0)" onclick="$('.tzgg').show()">
                                            <marquee behavior="scroll" scrollamount="3">
                                                <span style="color:#ED7E61">
                                                    6.19号更新，演示站仅供浔一客户测试，浔一微信：xunyikeji0716                                                </span>
                                            </marquee>
                                        </a>
                                    </ul>
                                </div>
                            </div>
                            <!-- 浔一开发,微信xunyikeji0716,对接0成本货源，二次开发，找浔一 -->
                            <!-- 浔一开发,微信xunyikeji0716,对接0成本货源，二次开发，找浔一 -->
                            <!-- 浔一开发,微信xunyikeji0716,对接0成本货源，二次开发，找浔一 -->
                            <!-- 浔一开发,微信xunyikeji0716,对接0成本货源，二次开发，找浔一 -->
                                                        <uni-image onclick="window.location.replace('./?mod=kf');" style="width: 10%;">
                                <!----><img src="./img/kefu.9db4574e.svg" draggable="false" style="float: right;height: 23px;position: relative;bottom: -3px;">
                            </uni-image>
                        </div>
                
                
                
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
					<!--<a style="position:fixed;right:-1px;bottom:26.5%; z-index:1024;" href="./?mod=cart" onclick="">
                        <img style="width:55px;height:40px;border-radius:5px;border: 1px solid #f2f2f2;background-color:#fff" src="template/storenews/img/gouwuche.png">
                        </a>
                        <a style="position:fixed;right:-1px;bottom:20%; z-index:1024;" href="<?php echo $conf['appurl']; ?>" target="_blank">
                        <img style="width:55px;height:40px;border-radius:5px;border: 1px solid #f2f2f2;background-color:#fff" src="<?php echo $cdnserver?>template/storenews/img/app.png">
                        </a>-->
				  
				


 

<!-- 浔一开发,微信xunyikeji0716,对接0成本货源，二次开发，找浔一 4564-->

					
					 
                    <!--<div class="fui-notice">
                        <div class="image">
                            <a href="JavaScript:void(0)" onclick="$('.tzgg').show()"><img src="assets/store/picture/1571065042489353.jpg"></a>
                        </div>
                        <div class="text" style="height: 1.2rem;line-height: 1.2rem">
                            <ul>
                                <li><a href="JavaScript:void(0)" onclick="$('.tzgg').show()">
                                        <marquee behavior="alternate">
                                            <span style="color:red">诚邀各级大咖合作共赢-24小时自助下单-售后稳定</span>
                                        </marquee>
                                    </a></li>
                            </ul>
                        </div>
                    </div>-->
                    
                    
<form action="" method="get" id="goods_search"><input type="hidden" value="yes" name="search">
                        <div class="fui-searchbar bar"
                             style="background-color: #ffffff;border-top: 0px solid #e7e7e7;padding: 0rem 0.5rem;padding-top:0.1rem;">
                            <div class="searchbar center searchbar-active" style="height: 2.5rem" >

                                <div class="search-input" style="border:0px; border-radius:50px;  width:100%;  padding-left:0px;padding-right:0px; background-color: #efeff5;">
                          <i class="icon icon-search" style="margin-top:4px;font-size:0.7rem;color:#909399;"></i>
                                    <input type="text" style="background-color: rgba(0,0,0,0);height: 1.65rem;font-size:0.7rem;" class="search"
                                           value="" name="kw"
                                           placeholder="请输入商品关键词" id="kw">
                                    </input>
                                </div>
                                <button type="submit"  class="searchbar-cancel searchbtn  " style="width:3.5rem;background-color:#678efe;height: 1.65rem; border-radius:0 50px 50px  0;color: #fff;">搜索</button>

                            </div>
                        </div>
                    </form>
                    <!-- 浔一开发,微信xunyikeji0716,对接0成本货源，二次开发，找浔一 353453-->
					<div style="width:100%;background-color:#ffffff;padding: 0rem 0.5rem; padding-top: 0.05rem; overflow: hidden;  font-size: 0.55rem; font-weight: bold; display:flex; align-content: center; justify-content: space-between" >

                       <a href="/user/regsite.php" style="width: 23%;height: 3.8rem;border-radius:8px;position: relative;background: rgba(255, 232 , 187, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 13%;left: 5%;z-index: 10">
                                <li style="color: #f5a810;font-size: 0.65rem;font-weight:600;">开通分站</li>
                                <li style="color: #fec252;font-size: 0.47rem;font-weight:0;line-height: 0.9rem;font\-weight:lighter">成为站长当老板</li>
                            </div>
                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/list01.png">
                        </a>

                       <a href="/?mod=article&id=1" style="width: 23%;height: 3.8rem;border-radius:8px;position: relative;background: rgba(183 , 230  , 253, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 13%;left: 5%;z-index: 10">
                                <li style="color: #65acff;font-size: 0.65rem;font-weight:600;">赚钱模式</li>
                                <li style="color: #7c9ff5;font-size: 0.47rem;font-weight:0;line-height: 0.9rem;font\-weight:lighter">学习知识把钱赚</li>
                            </div>

                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/list02.png">
                        </a>
                   
                        <a href="/?mod=time" style="width: 23%;height: 3.8rem;border-radius:8px;position: relative;background: rgba(183 , 230  , 253, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 13%;left: 5%;z-index: 10">
                                <li style="color: #ec7276;font-size: 0.65rem;font-weight:600;">每日更新</li>
                                <li style="color: #ec7276;font-size: 0.47rem;font-weight:0;line-height: 0.9rem;font\-weight:lighter">只为提供最好的</li>
                            </div>

                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/list03.png">
                        </a>
                     
                        <a href="/app" style="width: 23%;height: 3.8rem;border-radius:8px;position: relative;background: rgba(183 , 230  , 253, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 13%;left: 5%;z-index: 10">
                                <li style="color: #fd9930;font-size: 0.65rem;font-weight:600;">官方APP</li>
                                <li style="color: #fd9930;font-size: 0.47rem;font-weight:0;line-height: 0.9rem;font\-weight:lighter">安全稳定防失联</li>
                            </div>

                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/list04.png">
                        </a>
                        
                        
                        
                    </div>
				<!-- 浔一开发,微信xunyikeji0716,对接0成本货源，二次开发，找浔一wr -->
					
				 <div style="width:100%;background-color:#ffffff;padding: 0rem 0.5rem; padding-top: 0.45rem; overflow: hidden;  font-size: 0.7rem; font-weight: bold; display:flex; align-content: center; justify-content: space-between" >
                        <a href="/?mod=seckill" style="width: 49%;height: 3.7rem;border-radius:8px;position: relative;background: rgba(255, 232 , 187, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 20%;left: 5%;z-index: 10">
                                <li style="color: #000;font-size: 0.7rem;font-weight:600;">限时秒杀</li>
                                <span style="font-size: 0.5rem;background: #f6d885;color:#995621; padding: 0.1rem 0.4rem;width: 100%;border-radius: 0.2rem;font\-weight:lighter;">立即抢购 ></span>
                            </div>
                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/list05.png">
                        </a>

                        <a href="/?mod=renwu" style="width: 49%;height: 3.7rem;border-radius:8px;position: relative;background: rgba(255,235,219, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 20%;left: 5%;z-index: 10">
                                <li style="color: #000;font-size: 0.7rem;font-weight:600;">任务赚钱</li>
                                <span style="font-size: 0.5rem;background: #f6d885;color:#995621; padding: 0.1rem 0.4rem;width: 100%;border-radius: 0.2rem;font\-weight:lighter">立即参与 ></span>
                            </div>

                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shouye/list06.png">
                        </a>
                    <!--                        <a href="--><!--" style="width: 32%; height: 3.2rem;border-radius:5px;background-image:linear-gradient(to right, rgba(233, 95, 95, 1), rgba(239, 154, 183, 1));position: relative"  >-->
                        <!--                            <li style="position: absolute;top: 20%;left: 10%;color: #fff;"> 初级站长<br>升级</li>-->
                        <!--                            <img style="width:3.5rem;position: absolute;bottom:-20px;right: -20px;opacity: 0.7 " src="assets/store/index/shengji.png">-->
                        <!--                        </a>-->
                    </div>
                  <!--    <form action="" method="get" id="goods_search"><input type="hidden" value="yes" name="search">
                        <div class="fui-searchbar bar">
                            <div class="searchbar center searchbar-active" style="padding-right:2.5rem">
                                <input type="submit" class="searchbar-cancel searchbtn" value="搜索">
                                <div class="search-input" style="border: 0px;padding-left:0px;padding-right:0px;">
                                    <i class="icon icon-search"></i>
                                    <input type="text" class="search" value="<?php echo trim(daddslashes($_GET['kw']));?>" name="kw" placeholder="输入商品关键字..." id="kw">
                                </div>
                            </div>
                        </div>
                    </form>   -->
					
                  
                   
                
					
                  
                 
            <div class="device">
                        <div class="swiper-container">
                            <div class="swiper-wrapper"
                                 style="transform: translate3d(0px, 0px, 0px); transition-duration: 0ms;">
                                <?php
                                $arry = 0;
                                $au = 1;
                                foreach ($ar_data as $v) {
                                    if (($arry / ($class_show_num*5)) == ($au - 1)) { //循环首
                                        echo '<div class="swiper-slide swiper-slide-visible swiper-slide-prev" data-swiper-slide-index="' . $au . '" style="margin: auto;margin-top: -3px;">
                                        <div class="content-slide">';
                                    }
                                    echo '<a data-cid="'.$v['cid'].'" data-name="'.$v['name'].'" class="get_cat"  style="width: 20%;padding-top;5px;">
                                               <div class="mbg">
                                                   <p class="ico"><img id="'.$v['cid'].'" src="' . $v['shopimg'] . '" onerror="this.src=\'assets/store/picture/1562225141902335.jpg\'" class="imgpro"></p>
                                                   <p class="icon-title" id="'.$v['cid'].'na">' . $v['name'] . '</p>
                                              </div>
                                          </a>';

                                    if ((($arry + 1) / ($class_show_num*5)) == ($au)) { //循环尾
                                        echo '</div>
                                        </div>';
                                        $au++;
                                    }
                                    $arry++;
                                }
                                if (floor((($arry) / ($class_show_num*5))) != (($arry) / ($class_show_num*5))) {
                                    echo '</div></div>';
                                }
                                ?>
                            </div>

                        </div>
                        
                    </div>
                    <script>

                    </script>

                          <div  class="hotxy"  style="background: #fff;"><div class="tab-top tips-content display-row justify-between align-center"><div><i class="icon icon-sanjiao3 tab-top-l-icon"></i><font id="tabtopl">暂未选择分类</font></div><div  id="tabtopr" data-state="none"><font class="tab-top-r">更多分类</font><i class="icon icon-right1 tab-top-r-icon"></i></div><style id="cidsl"></style></div>
                    
                    <div class="tab-bottom display-row flex-wrap" id="classtab">
                        

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
                                        <span style="color: #f79646;"><strong><span style="font-size: 15px;">
                                         <span class="catname_show">正在获取数据...</span>
                                        <span class="catname_c" style="color: #7d7c7a;font-size: 12px;">正在获取数据...</span>
                                         <span class="catname_cc" style="color: #000000;font-size: 15px;font-weight:normal;">精品推荐<font style="color: #7d7c7a;font-size: 12px;">(<?php echo $count8cc?>个商品)</font></span>
                                        </span></strong></span>
                                    </span>
                                </strong>
                            </span>
                        </section>

                    </section>
                  
                    <span class="text" style="padding:0 20px">
                        <a href="javascript:;">
                            <i class="icon icon-list" id="listblock" data-state="list" style="font-size:20px;"></i>
                        </a>
                    </span>
                </section>
                <section style="text-align: center;display:none;height: 0.1rem;line-height: 1.6rem;" class="show_class">
                <section style="display: inline-block;" class="">

                <section class="135brush" data-brushtype="text" style="clear:both;margin:-18px 0px;text-align: center;color:#333;border-radius: 6px;padding:0px 1.5em;letter-spacing: 1.5px;">
                	<style> .catname_show{color: #7d7c7a;font-size: 12px;}</style>
               
                </section>

                </section>
                </section>
                 <div class="layui-tab tag_name tab_con" style="margin:0;display:none;">
                        <ul class="layui-tab-title" style="margin: 0;background:#fff;overflow: hidden;">
                
                        </ul>
                </div>
                
                <div class="fui-goods-group block three" style="background: #fff;" id="goods-list-container">
                    <div class="flow_load"><div id="goods_list"></div></div>
                    <div class="footer" style="width:100%; margin-top:0.5rem;margin-bottom:2.5rem;display: block;">
                        <ul>
                            <li>© <?php echo $conf['sitename'] ?>. All rights reserved.</li>
                        </ul>
                        <p style="text-align: center"><?php echo $conf['footer']?></p>
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
        
        <div class="fui-navbar" style="bottom:-34px;background-color: white;max-width: 650px">
        </div>

         <style>
  .img1{

    width:1.1rem;
    height:1.1rem;
  }

  </style>
  

  <!-- 浔一开发,微信xunyikeji0716,对接0成本货源，二次开发，找浔一etert -->

  
  
   <div class="fui-navbar" style="max-width: 650px;z-index: 100;">
            <a href="./" class="nav-item active"> <img src="<?php echo $cdnserver?>img/home-index.png" class="img1"><span class="label">首页</span>
            </a>
            
            <a href="./?mod=query" class="nav-item ">  <img src="<?php echo $cdnserver?>img/order.png" class="img1"><span class="label">订单</span> </a>

            <a href="./?mod=kf" class="nav-item "> <img src="<?php echo $cdnserver?>img/kf.png" class="img1"> <span class="label">客服</span>
            </a>
            <a href="./user/" class="nav-item "> <img src="<?php echo $cdnserver?>img/my.png" class="img1"><span class="label">我的</span> </a>
        </div>
  
  
  
  
  

 <div class="web_notice" style="position: fixed; top: 0; left: 0; width: 100%; height: 100vh; background:rgba(0, 0, 0, 0.5); z-index: 99999;">
    <div style="position: fixed; top: 50%; left: 50%; width: 320px; background: #FFF; transform: translate(-50%, -50%); border-radius: 3px; padding: 20px 20px;">
 
            <div style="font-weight: normal;text-align: center;font-size: 15px;">系 统 公 告</div><hr>
        <div style="font-size: 14px; margin-top: 0px; line-height: 24px;">
            <?php echo $conf['anounce'] ?>
<?php if($conf['syggw_car']==1){?>
<style>
.col .gg {
    display: inline-block;
    border: 1px solid rgb(202, 202, 202);
    border-radius: 3px;
    color: rgb(202, 202, 202);
    padding: 0px 5px 0px 5px;
    margin: 7px 7px 7px 10px;
    font-size: 10.5px;
    line-height: 18px;
    font-style: normal;
}
.col {
    display: flex;
}
.text1 {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    height: 18px;
    padding: 0px 2px;
    margin: 7px 5px 7px 0px;
    font-size: 11.5px;
    line-height: 18px;
    flex: 15;
}
.kuang {
    width: 99%;
    display: inline-block;
    border-radius:5px;
    box-shadow: 0px 0px 0px #fff1dc;
    border:1px solid #fff1dc;
}
</style>
<div style="padding:15px 0 0 0px" >
    <div class="kuang1">

 
<?php }?>

            
            
                          <div style="margin-top: 10px;background: #f2f2f2;width: 100%; height: 1px"></div>
                <div class="account-btn" style="display: block;background:#ffffff;color:#2979ff;margin-top:12px;margin-bottom:0px;font-size:0.65rem" onclick="closePopup();">确          认</div>
            
            
        </div>
    </div>
</div>
<script>
    function closePopup() {
        document.querySelector('.web_notice').style.display = 'none';
    }
</script>
<!--音乐代码-->
<script src="<?php echo $cdnpublic?>jquery/3.4.1/jquery.min.js"></script>  <script>  $(".catname_show").hide(); </script>
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
alert("欢迎光临寒舍，有什么需要帮忙的话，浔一开发,微信xunyikeji0716,对接0成本货源，二次开发，找浔一 ！");
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




</body></html>
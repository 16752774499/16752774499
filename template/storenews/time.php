<?php
/*今日更新*/
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
?>
<!DOCTYPE html>
<html lang="zh" style="font-size: 102.4px;">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="dc_coverage" content="CN">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="wap-font-scale" content="no"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no"/>
    <script> document.documentElement.style.fontSize = document.documentElement.clientWidth / 750 * 40 + "px";</script>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>今日更新</title>  
<link rel="stylesheet" type="text/css" href="../assets/store/css/foxui.css">
    <link rel="stylesheet" type="text/css" href="../assets/store/css/foxui.diy.css">
    <link rel="stylesheet" type="text/css" href="../assets/store/css/style.css">
    <link rel="stylesheet" type="text/css" href="../assets/store/css/iconfont.css">
    <link rel="stylesheet" type="text/css" href="../assets/store/css/index.css">
    <link rel="stylesheet" type="text/css" href="//cdn.staticfile.org/layui/2.5.7/css/layui.css">
  </head>
<style>body{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style></head>
<body>
  <style type="text/css">
 

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
     height: 5rem;
    

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
        height: 2.5rem;
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
    z-index: 99999;
    background: #fff;
    box-shadow: 0px 3px 5px #e2dfdf;
    }
    .tab-bottom-none{
        display:none;
    }
    .tab-bottom-item{
        padding: 0.3rem 0.8rem;
        background: #ebebeb;
        border-radius: 50px;
        margin-top: 5px;
        margin-left: 5px;

    }
    .tab-bottom-item-index{

        background: #1195da;
        color: #fff;

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
#audio-play #audio-btn{width: 44px;height: 44px; background-size: 100% 100%;position:fixed;bottom:5%;right:6px;z-index:111;}
#audio-play .on{background: url('assets/img/music_on.png') no-repeat 0 0;-webkit-animation: rotating 1.2s linear infinite;animation: rotating 1.2s linear infinite;}
#audio-play .off{background:url('assets/img/music_off.png') no-repeat 0 0}
@-webkit-keyframes rotating{from{-webkit-transform:rotate(0);-moz-transform:rotate(0);-ms-transform:rotate(0);-o-transform:rotate(0);transform:rotate(0)}to{-webkit-transform:rotate(360deg);-moz-transform:rotate(360deg);-ms-transform:rotate(360deg);-o-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes rotating{from{-webkit-transform:rotate(0);-moz-transform:rotate(0);-ms-transform:rotate(0);-o-transform:rotate(0);transform:rotate(0)}to{-webkit-transform:rotate(360deg);-moz-transform:rotate(360deg);-ms-transform:rotate(360deg);-o-transform:rotate(360deg);transform:rotate(360deg)}}
</style>

<style>
    body{
        max-width:550px;
        margin:0 auto;
      overflow: auto;height: auto !important;
    }
    .container {
        margin:10px 0px;
  width: 80%;
  text-align: center;
}

.progress {
  padding: 0px;
  background: rgba(0, 0, 0, 0.25);
  border-radius: 6px;
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25), 0 1px rgba(255, 255, 255, 0.08);
}

.progress-bar {
  height: 12px;
  background-color: #ee303c;
  border-radius: 4px;
  transition: 0.4s linear;
  transition-property: width, background-color;
}

.progress-striped .progress-bar {
  background-color: #FCBC51;
  background-image: linear-gradient(45deg, #fca311 25%, transparent 25%, transparent 50%, #fca311 50%, #fca311 75%, transparent 75%, transparent);
  animation: progressAnimationStrike 2s;
}

@keyframes progressAnimationStrike {
  from {
    width: 0;
  }
  to {
    width: 100%;
  }
}
.progress2 {
  padding: 6px;
  border-radius: 30px;
  background: rgba(0, 0, 0, 0.25);
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.25), 0 1px rgba(255, 255, 255, 0.08);
}

.progress-bar2 {
  height: 18px;
  border-radius: 30px;
  background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.05));
  transition: 0.4s linear;
  transition-property: width, background-color;
}

.progress-moved .progress-bar2 {
  width: 85%;
  background-color: #EF476F;
  animation: progressAnimation 6s;
}

@keyframes progressAnimation {
  0% {
    width: 5%;
    background-color: #F9BCCA;
  }
  100% {
    width: 85%;
    background-color: #EF476F;
  }
}
.progress-bar3 {
  height: 18px;
  border-radius: 4px;
  background-image: linear-gradient(to right, #4cd964, #5ac8fa, #007aff, #7DC8E8, #5856d6, #ff2d55);
  transition: 0.4s linear;
  transition-property: width, background-color;
}

.progress-infinite .progress-bar3 {
  width: 100%;
  background-image: linear-gradient(to right, #4cd964, #5ac8fa, #007aff, #7DC8E8, #5856d6, #ff2d55);
  animation: colorAnimation 1s infinite;
}

@keyframes colorAnimation {
  0% {
    background-image: linear-gradient(to right, #4cd964, #5ac8fa, #007aff, #7DC8E8, #5856d6, #ff2d55);
  }
  20% {
    background-image: linear-gradient(to right, #5ac8fa, #007aff, #7DC8E8, #5856d6, #ff2d55, #4cd964);
  }
  40% {
    background-image: linear-gradient(to right, #007aff, #7DC8E8, #5856d6, #ff2d55, #4cd964, #5ac8fa);
  }
  60% {
    background-image: linear-gradient(to right, #7DC8E8, #5856d6, #ff2d55, #4cd964, #5ac8fa, #007aff);
  }
  100% {
    background-image: linear-gradient(to right, #5856d6, #ff2d55, #4cd964, #5ac8fa, #007aff, #7DC8E8);
  }
}
    
    
    .top{
      background-color: #<?php echo $conf['rgb01']; ?>;
      width: 100%;
      max-width: 550px;
      padding-bottom:10px;
      }
      .home{
              text-align: center;
    line-height: 32px;
        height: 32px;
        width: 32px;
        border-radius: 50%;
        background-color: #fff;
        position: fixed;
        top: 10px;
        margin-left: 10px;
      }
      .toptitle{
      font-weight:600;
      color:#fff;
      text-align: center;
      height: 56px;
      line-height: 56px;
      }
      .classbox{
        margin-top: 5px;
        display: flex;
        justify-content: space-around;
        color: #fff;
        margin-bottom: 5px;
      }
      .classtitle{
        font-size: 13px;
        text-align: center;
      }
      .classtime{
        margin-top: 7px;
        font-size: 11px;
        text-align: center;
      }
      .clssbox2{
        padding: 10px;
        display: flex;
    flex-direction: column;
      }
      .classacvt{
        border-radius: 10px;
        background-color: rgba(0,0,0,.2);
      }
      .top2{
      
      }
      .top2 img{
          height:22px;
      }
      .splist{
          background-color: #f2f2f2;
      }
      .spbox{
          margin:10px 0px;
          padding:10px;
          width:100%;
          background-color: #fff;
          display: flex;
      }
      .spimg{
      border-radius: 10px;
      width:40%;
      height:100px;
   background-size:100% 100% !important;
      }
      .xxlist{
          width:100%;
          margin-left:7px;
            display: flex;
            flex-direction: column;
    align-items: flex-start;
      }
      .sptitle{
              font-size: 13px;
    font-weight: 600;
    line-height: 17px;
      }
      .spprice{
              color: #ff8000;
    font-weight: 800;
    font-size: 13px;
    margin-top: 5px;
      }
      .spprice2{
          color: rgb(153, 153, 153);
    font-size: 12px;
      }
      .buys{
      padding: 5px 15px;
    font-size: 11px;
    text-align: center;
    background-color: #<?php echo $conf['rgb01']; ?>;
    border-radius: 50px;
    color: #fff;
        
      }
      .buyss{
              background: rgb(153, 153, 153);
      }
</style>
<body>
    <div class="top"  style="background:#e1402e">
        <a href="./" class="home">
            <i class="layui-icon layui-icon-return"></i>
        </a>
        <div class="toptitle" style="background:#e1402e">
            <a href="" style="color: #ffffff;">今日更新</a>
        </div>
            <div class="classbox" style="background:#e1402e">
                        <div id="c1" class="clssbox2 classacvt" onclick="get_goods('today','today',1)">
                <span class="classtitle"><?php echo date('Y-m-d')?></span>
               <span class="classtime" style="font-size:12px;">今天 
                </span>

            </div>
           
                       <div id="c2" class="clssbox2 " onclick="get_goods('yesterday','yesterday',2)">
                <span class="classtitle"><?php echo date('Y-m-d', strtotime('-1 day'))?></span>
                <span class="classtime" style="font-size:12px;">昨天 
               </span>
            </div>
           
                       <div id="c3" class="clssbox2 " onclick="get_goods('daybeforeyesterday','daybeforeyesterday',3)">
                <span class="classtitle"><?php echo date('Y-m-d', strtotime('-2 day'))?></span>
                <span class="classtime" style="font-size:12px;">前天 
                </span>
            </div>
           
                   </div>
      
    </div>
    <div class="top2">
      
       </div>
       
      
                           <section style="display:none;height: 40px;line-height: 1.6rem; background: #fff; display: flex;justify-content: space-between; align-items: center;" class="show_class ">
                 <div style="width:56%"><img src="./assets/img/new2.png" style="height:22px"></div>
                 
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
                  
                    <span class="text" style="padding:0 20px">
                        共计<span id="total">0</span>件商品
                        
                    </span>
                </section>
                
                
                  <div class="fui-goods-group" style="background: #f3f3f3;" id="goods-list-container;z-index:auot">
                    <div class="flow_load"><div id="goods_list"></div></div>
                    <div class="footer" style="width:100%;height:100%; margin-top:0.2rem;margin-bottom:1.2rem;display: block;">
                        <ul>
                            <li>© <?php echo $hometitle?>. All rights reserved.</li>
                        </ul>
<p style="text-align: center;margin-bottom:100%">
<b><script type="text/javascript">
var now=(new Date()).getHours();
if(now>0&&now<=6){
document.write("经常熬夜对身体不好哟~");
}else if(now>6&&now<=11){
document.write("早上心情好！ 快来买一单~");
}else if(now>11&&now<=14){
document.write("停下手中的工作！ 去吃饭~");
}else if(now>14&&now<=18){
document.write("累了一上午了！ 休息会吧~");
}else{
document.write(" <center> 晚上好！ 欢迎来到本平台~");
}
</script></b></p>
                    </div>
                </div>

        
    </div>
    
              
			
        <input type="hidden" name="_cid" value="">
        <input type="hidden" name="_cidname" value="">
        <input type="hidden" name="_curr_time" value="<?php echo time(); ?>">
        <input type="hidden" name="_template_virtualdata" value="1">
		<input type="hidden" name="_template_showsales" value="1">
        <input type="hidden" name="_sort_type" value="">
        <input type="hidden" name="_sort" value="">
  
    	<script src="https://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdn.staticfile.org/layui/2.5.7/layui.all.js"></script>
<script src="//cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//cdn.staticfile.org/Swiper/6.4.5/swiper-bundle.min.js"></script>
<script src="assets/store/js/layui.flow.js"></script>
<script>
    var template_virtualdata = $("input[name=_template_virtualdata]").val();
var template_showsales = $("input[name=_template_showsales]").val();
var curr_time = $("input[name=_curr_time]").val();

$(function() {
    //排序点击
    $(".goods_sort .item").on("click",function(){
       var sort = $(this).data("order"); //获取排序类型
       if(!sort){
           return false;
       }
       var sort_type = $(this).data("sort"); //获取类型
       if(sort_type == "DESC")
       {
           var sort_type_new = "ASC";
       }else{
           var sort_type_new = "DESC";
       }

        //移除其他已点击
        $(".goods_sort div").attr("class","item item-price");
        $(this).addClass(sort_type); 
        $(this).data("sort",sort_type_new);
        $('.goods_sort div').removeClass('on');
        $(this).addClass("on");
        $("input[name=_sort_type]").val(sort);
        $("input[name=_sort]").val(sort_type);
        get_goods();
    });
    if ($(".swiper-wrapper .content-slide").length > 1) {
        var swiper = new Swiper('.swiper-container', {
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
            renderBullet: function (index, className) {
              return '<span class="' + className + '">' + (index + 1) + '</span>';
            },
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
            mousewheel: true,
            keyboard: true,
            // loop:true,
        });
        $(".swiper-button-next").show();
        $(".swiper-button-prev").show();
    }  
    jQuery(function ($) {
        $(window).resize(function () {
            var width = $('#js-com-header-area').width();
            $('.touchslider-item a').css('width', width);
            $('.touchslider-viewport').css('height', 200 * (width / 640));
        }).resize();
    });

    if(template_virtualdata == 1){
        ka();
    }

    get_goods('today');
 $(".get_cat").on("click",function()
    {
        var cid = $(this).data("cid");
        var name = $(this).data("name");
         $("#tabtopl").html(name);
        		$.ajax({
		type : "GET",
		url : "./ajax.php?act=cidr&cid="+cid+"",
		dataType : 'json',
		success : function(cidrd) {
	if(cidrd.code>=1){
	   $(".hotxy").hide();
	}else{
	    $(".hotxy").show();
	    if(cid!=cidrd.cid){}else{
	        	$("#classtab").html(null);
	    		$.each(cidrd.data, function (i, res) {
					$("#classtab").append(' <a data-cid="'+res.cid+'" data-name="'+res.name+'" onclick="cidr('+res.cid+')" class="get_tab tab-bottom-item">'+res.name+'</a>');
					
				});
			
	    }
	}
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
    });
    
        $(".get_tab").on("click",function()
    {
        var cid = $(this).data("cid");
        	
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
    });
    //点击搜索拦截
    $("#goods_search").submit(function(e){
      var km = $("input[name=kw]").val();
      if(km == "")
      {
          layer.msg("请输入关键词进行查询");
          return false;
      }
      $("input[name=_cid]").val("");
      $("input[name=_cidname]").val("");
    $(".catname_show").html("正在获取");
    $(".show_class").hide();
    $('.device .content-slide a').removeClass('shop_active');
      get_goods();
     document.activeElement.blur();
      return false;
    });
    
    if($.cookie('goods_list_style') == 'list'){
        $("#listblock").data("state","gongge");
        $("#listblock").removeClass("icon-sort");
        $("#listblock").addClass("icon-app");
        $("#goods-list-container").removeClass("block three");
    }
    
    /*点击切换风格*/
    $("#listblock").on("click",function(){
        var index = layer.msg('加载中', {
          icon: 16
          ,shade: 0.01
        });
        var attr = $(this).data("state");
        if(attr == 'gongge'){
            $(this).data("state","list");
            $(this).removeClass("icon-app");
            $(this).addClass("icon-sort");
            $("#goods-list-container").addClass("block three");
        }else{
            $(this).data("state","gongge");
            $(this).removeClass("icon-sort");
            $(this).addClass("icon-app");
            $("#goods-list-container").removeClass("block three");
        }
        //设置cookie
        var cookietime = new Date(); 
        cookietime.setTime(cookietime.getTime() + (86400));
        $.cookie('goods_list_style', attr, { expires: cookietime });
        layer.close(index);
    });
        
    //弹窗广告
    if( !$.cookie('op')){
        $('.tzgg').show();
        $.cookie('op', false, { expires: 1});
    }
    
        /**
     * 兼容iphone
     * @type {number | boolean | *}
     */
    var isIphoneX = window.devicePixelRatio && window.devicePixelRatio === 3 && window.screen.width === 375 && testUA('iPhone');

    if (isIphoneX && window.history.length <= 2) {
        // document.body.classList.add('fix-iphonex-bottom');
//        $(".fui-navbar,.cart-list,.fui-footer,.fui-content.navbar").addClass('iphonex')
        $(".fui-navbar").css("bottom", "0px");
    } else {
        $(".fui-navbar,.cart-list,.fui-footer,.fui-content.navbar").removeClass('iphonex');
    }
});

function ka() {
	setInterval("get_data()",6000);
}
function get_data() {
	$.ajax({
		type : "get",
		url : "./other/getdatashow.php",
		async: true,
		dataType : 'json',
		success : function(data) {
		    console.log(data);
			if(data.code==1){
				$('#xn_text').text(data.text+" "+data.time+'前');
				$('#xn_text').fadeIn(1000);
				setTimeout("$('#xn_text').fadeOut(1000);",4000);
			}
		}
	});
}



function testUA(str) {
    return navigator.userAgent.indexOf(str) > -1
}

function load(text="加载中")
{
    var index = layer.msg(text, {
        icon: 16
        ,shade: 0.01
    });  
}

//获取商品
function get_goods(time,time2,cssd){
    $("#c"+cssd).addClass("classacvt").siblings().removeClass("classacvt");
    var regex_match = /(nokia|iphone|android|motorola|^mot-|softbank|foma|docomo|kddi|up.browser|up.link|htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte-|longcos|pantech|gionee|^sie-|portalmmm|jigs browser|hiptop|^benq|haier|^lct|operas*mobi|opera*mini|320x320|240x320|176x220)/i;
  var u = navigator.userAgent;
  if (null == u) {
   return true;
  }
  var result = regex_match.exec(u);
 
  if (null == result) {
   var wap=1;
  } else {
   var wap=2;
  }
    $("#goods_list").remove();
    $(".flow_load").append("<div id=\"goods_list\" ></div>");
    layui.use(['flow'], function(){
        var flow = layui.flow;
        var cid  = $("input[name=_cid]").val();
        var name  = $("input[name=_cidname]").val();
        var kw = $("input[name=kw]").val();
        var sort_type = $("input[name=_sort_type]").val();
        var sort = $("input[name=_sort]").val();
        var mb = testUA('Safari')?180:100;
        var end = kw?"没有更多数据了":" ";
        limit = 100
        if(name != "")
        {
            load();
        }
        //写入数据

        $(".show_class").show();  
        flow.load({
                elem: '#goods_list' //流加载容器
                ,isAuto:true
                ,mb:mb
                ,isLazyimg:true
                ,end:end
                ,done: function(page, next){ //执行下一页的回调
                    var lis = [];
                    //以jQuery的Ajax请求为例，请求下一页数据（注意：page是从2开始返回）
                    $.ajax({
                    type : "post",
                    url : "./ajax.php?act=gettoolday",
                    data : {page:page,limit:limit,cid:cid,kw:kw,sort_type:sort_type,sort:sort,time:time},
                    dataType : 'json',
                    success : function(res) {
							$(".tag_name").hide();
							$(".tag_name ul").html("");
                            console.log(res);
                            //假设你的列表返回在data集合中
                            var html='';
                        if(res.bb=="2"){
                            layui.each(res.data, function(index, item){
                              
                                html = '<a  class="fui-goods-item" title="'+item.name+'" href="./?mod=buy&tid='+item.tid+'">';
                                html += '<div class="image">';
                                if(!item.shopimg){
                                    item.shopimg="./assets/store/picture/error_img.png"
                                }
                                if(item.show_tag){
                                    show_tag = item.show_tag;
                                }else{
                                    if((curr_time-(item.addtime)) <= 604800000)
                                    {
                                        show_tag = "";
                                    }else{
                                        show_tag = "";
                                    }
                                }


                                //显示商品标签
                                 show_tag_html = "";
                                if(show_tag)
                                {
                                   // show_tag_html = '<div style="background: -webkit-linear-gradient(left, #f10707, #b92b2b);color:#FFFFFF;width: 60%;text-align: center;font-size:.2rem; padding:5px 0; border-radius: 10px 0 15px 0;position: absolute;">'+show_tag+'</div>';
                                         show_tag_html = '';
                                }
                               
                               
                                //库存为0的
                                    var shoukong = '';
                                    var kucun = '24小时全自动发货';
                                    if(item.is_stock_err == 1){
                                        shoukong = '';
                                    }

                                    if(item.stock > 0){
                                        kucun = '24小时全自动发货';
                                    }

                                    html += ''+show_tag_html+'<img class="lazy" lay-src="'+item.shopimg+'" src="./assets/store/picture/loadimg.gif" alt="'+item.name+'">'+shoukong+'';
                                    html += '</div>';


                                    html += '<div class="detail" style="height:unset;">';
                                    html += '<div class="defbox"><div class="def1"></div>&nbsp;'+item.classname+'&nbsp;&nbsp;&nbsp;';
                                    if(item.v==1){
                                    html += '<div class="def2"></div>&nbsp;第'+item.tid+'期';
                                    }
                                    html += '</div>';
                                    html += '<div class="name" style="color: #34495e;margin-top: 5px;">'+item.name+'</div>';
                                   if(item.isdesc==2){
                                     html += '<div style="color: #888;height:40px;font-size:.6rem;margin-top: 5px;">'+item.desc+'';
                                      html += '</div>';
                                   }
                                    var price = '<p class="minprice" style="font-size:.75rem;"><font style="font-size:.6rem; ">￥</font>'+item.price+'元</p>';
                                    if(item.price <=0){
                                        price = '<p class="minprice" style="font-size:.75rem;">免费领取</p>';
                                    }
                                    html += '';
                            

                               console.log(wap);
                          if(wap=='1'){
                                    html += '<div style="display: flex;margin-top:5px; ">';
                                    html +='<div><i class="layui-icon layui-icon-time"></i>'+item.time+'</div>';
                                     html +='<div style="margin-left:20px;"><i class="layui-icon layui-icon-fire" style="font-size:10px;"></i>'+item.sales+'</div>';
                                      html +='<div style="margin-left: auto;"><i class="layui-icon layui-icon-rmb"></i>'+item.price+'</div>';
                                      html += '</div>';
                                    }else if(wap=='2'){
                            html += '<div style="display: flex;margin-top:5px; justify-content: space-between;">';
                            html +='<div><i class="layui-icon layui-icon-time"></i>'+item.time+'</div>';
                             html +='<div> <i class="layui-icon layui-icon-fire" style="font-size:10px;"></i>'+item.sales+'</div>';
                              html +='<div><i class="layui-icon layui-icon-rmb"></i>'+item.price+'</div>';
                            html += '</div>';
                          }
                                  
                                    html += '</div>';
                                    html += '</a>';
                                    lis.push(html);
                                });
                        }else{
                             layui.each(res.data, function(index, item){
                              
                                html = '<a  class="fui-goods-item" title="'+item.name+'" href="./?mod=buy1&tid='+item.tid+'">';
                                html += '<div class="image">';
                                if(!item.shopimg){
                                    item.shopimg="./assets/store/picture/error_img.png"
                                }
                                if(item.show_tag){
                                    show_tag = item.show_tag;
                                }else{
                                    if((curr_time-(item.addtime)) <= 259200)
                                    {
                                        show_tag = "";
                                    }else{
                                        show_tag = "";
                                    }
                                }


                                //显示商品标签
                                 show_tag_html = "";
                                if(show_tag)
                                {
                                   // show_tag_html = '<div style="background: -webkit-linear-gradient(left, #f10707, #b92b2b);color:#FFFFFF;width: 60%;text-align: center;font-size:.2rem; padding:5px 0; border-radius: 10px 0 15px 0;position: absolute;">'+show_tag+'</div>';
                                         show_tag_html = '';
                                }

                                //库存为0的
                                    var shoukong = '';
                                    var kucun = '<p style="font-size: 12px;">￥'+item.price+'元</p>';
                                    if(item.is_stock_err == 1){
                                        shoukong = '';
                                    }

                                    if(item.stock > 0){
                                    kucun = '<p style="font-size: 12px;">￥'+item.price+'元 / 库存:较少</p>';
                                    }
                                    if(item.stock > 10){
                                    kucun = '<p style="font-size: 12px;">￥'+item.price+'元 / 库存:一般</p>';
                                    }
                                    if(item.stock > 100){
                                    kucun = '<p style="font-size: 12px;">￥'+item.price+'元 / 库存:较多</p>';
                                    }
                                    if(item.stock > 500){
                                    kucun = '<p style="font-size: 12px;">￥'+item.price+'元 / 库存:充足</p>';
                                    }

                                    html += ''+show_tag_html+'<img class="lazy" style="width: 100%;height:100%;" lay-src="'+item.shopimg+'" src="./assets/store/picture/loadimg.gif" alt="'+item.name+'">'+shoukong+'';
                                    html += '</div>';


                                    html += '<div class="detail" style="height:unset;">';
                                    html += '<div class="name" style="font-size: 13px;color: #000;">'+item.name+'</div>';
                                    //var price = '<p class="minprice" style="font-size: 13px;"><font style="font-size: 13px; ">￥</font>'+item.price+'元</p>';
                                    var price = '';
                                    if(item.price <=0){
                                        price = '';
                                    }
                                    html += '';
                                    if(item.price <=0){
                                        buy =  '<div style="height: 1.2rem"><span class="buy" style="background-color: yellowgreen;color:#fff;display: inline-block;height: 1.2rem;line-height: 1.1rem;color: white;float: right;   padding: 0rem 0.45rem;width: 100%;border-radius: 0.1rem;   border: 1px solid transparent;text-align:center;">领取</span></div>';
                                    }else{
                                        buy =  '<div style="height: 1.2rem"><span class="buy" style="background:#ED7E61;color:#fff;display: inline-block;height: 1.2rem;line-height: 1.1rem;float: right;padding: 0rem 0.45rem;width:100%;border-radius: 0.2rem;    border: 1px solid transparent;text-align:center;">购买</span></div>';
                                    }

                                    if(item.stock == 0){
                                        buy =  '<div style="height: 1.2rem"><span class="buy" style="background: red;color:#fff;display: inline-block;height: 1.2rem;line-height: 1.1rem;float: right;padding: 0rem 0.45rem;width:100%;border-radius: 0.2rem;    border: 1px solid transparent;text-align:center;">缺货</span></div>';
                                    }

                                    if(item.close == 1){
                                        buy = '<div style="height: 2rem"><span class="buy" style="font-size: 13px;background: #aeadad;color:#fff;display: inline-block;height: 2rem;line-height: 0.9rem;float: right;padding: 0rem 0.45rem;width:100%;border-radius: 0.2rem;    border: 1px solid transparent;text-align:center;">已下架<br>暂停售卖</span></div>';
                                    }

                                    html += '<div class="price" style="margin-top: 0.2rem;background-color:#fff;height: 2rem;border-radius: 0.2rem; "><span class="text" style="color:#ed7e61;font-size:0.45rem;line-height:2rem;padding-left: 10px">'+ kucun +'</span>'+buy+'</div>';
                                    html += '</div>';
                                    html += '</a>';
                                    lis.push(html);
                                });
                        }
                            if(cid == "")
                            {
                                 $(".catname_c").hide(); $(".catname_show").show();  $(".catname_cc").hide();
                                $(".catname_show").html('系统共有<font style="color: #7d7c7a;font-size: 12px;">'+res.total+'个商品</font>');
                            }else if(name != ""){
                              
                                  $(".catname_c").hide(); $(".catname_show").show();  $(".catname_cc").hide();
                                $(".catname_show").html('<font style="color: #7d7c7a;font-size: 12px;">'+name+'</font>共有'+res.total+'个商品');
                             
                            }
                            if(kw != ""){
                                   $(".catname_c").hide(); $(".catname_show").show();  $(".catname_cc").hide();
                                $(".catname_show").html('共有<font style="">'+res.total+'</font>个商品');
                            }
                            layer.closeAll();
                            $("#total").text(res.total);
                            next(lis.join(''), page < res.pages);
                           
                        },
                        error:function(data){
                            layer.msg("获取数据超时");
                            layer.close(index);
                            return false;
                        }
                });
                }
          });
        
    });
}

var audio_init = {
	changeClass: function (target,id) {
       	var className = $(target).attr('class');
       	var ids = document.getElementById(id);
       	(className == 'on')
           	? $(target).removeClass('on').addClass('off')
           	: $(target).removeClass('off').addClass('on');
       	(className == 'on')
           	? ids.pause()
           	: ids.play();
   	},
	play:function(){
		document.getElementById('media').play();
	}
}
if($('#audio-play').is(':visible')){
	audio_init.play();
}

/*layui.use(['util'], function(){
    var util = layui.util;
    //固定块客服
    util.fixbar({
        bar1: true
        ,bar2: true
        ,css: {right:8,bottom: '25%','z-index':1}
        ,bgcolor: '#393D49'
        ,click: function(type){
          if(type === 'bar1'){
            window.location.href = ("./?mod=kf");
          } else if(type === 'bar2') {
            window.location.href = ("./?mod=articlelist");
          }
        }
    });
});*/
</script>
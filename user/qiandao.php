<?php
$is_defend=true;
require '../includes/common.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
if(!$conf['qiandao_reward']){
showmsg('当前签到功能临时维护规则，开放时间待定',3);
}

$_SESSION['isqiandao']=$userrow['zid'];

$day = date("Y-m-d");
$lastday = date("Y-m-d",strtotime("-1 day"));
if ($row = $DB->getRow("SELECT * FROM pre_qiandao WHERE zid='{$userrow['zid']}' AND date='$day' ORDER BY id DESC LIMIT 1")) {
	$isqiandao = true;
	$continue = $row['continue'];
}else{
	if ($row = $DB->getRow("SELECT * FROM pre_qiandao WHERE zid='{$userrow['zid']}' AND date='$lastday' ORDER BY id DESC LIMIT 1")) {
		$continue = $row['continue'];
	}else{
		$continue = 0;
	}
	$isqiandao = false;
}

$rs=$DB->query("SELECT * FROM pre_qiandao ORDER BY id DESC LIMIT 5");
$qqrow=array();
$qdrow=array();
while($res = $rs->fetch()){
	if(count($qqrow)<5){
		$qqrow[]=$res['qq'];
	}
	$qdrow[]=$res;
}

$title = '每日签到';

$url = 'http://'.$userrow['domain'].'/';
if($conf['fanghong_api']>0){
	$turl = fanghongdwz($url);
	if(strpos($turl,'/')===false){
		$turl = $url;
	}
}else{
	$turl = $url;
}
?>
<html lang="zh-cn" style="" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths"><head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>每日签到</title>
  <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../assets/simple/css/plugins.css">
  <link rel="stylesheet" href="../assets/simple/css/main.css">
  <link rel="stylesheet" href="../assets/css/common.css">
    <link href="//cdn.staticfile.org/layui/2.5.7/css/layui.css" rel="stylesheet">
  <script src="//cdn.staticfile.org/modernizr/2.8.3/modernizr.min.js"></script>
  <link rel="stylesheet" href="../assets/user/css/my.css">
   <script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdn.staticfile.org/layui/2.5.7/layui.all.js"></script><link id="layuicss-laydate" rel="stylesheet" href="http://cdn.staticfile.org/layui/2.5.7/css/modules/laydate/default/laydate.css?v=5.0.9" media="all"><link id="layuicss-layer" rel="stylesheet" href="http://cdn.staticfile.org/layui/2.5.7/css/modules/layer/default/layer.css?v=3.1.1" media="all"><link id="layuicss-skincodecss" rel="stylesheet" href="http://cdn.staticfile.org/layui/2.5.7/css/modules/code.css" media="all">
  <!--[if lt IE 9]>
    <script src="//cdn.staticfile.org/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
<style>body{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style></head>
		<style>
	    .signbxo{
	            width: 100%;
    background: #FEB794;
    box-shadow: inset 0 0 1.5625rem 0.625rem rgba(255,255,255,.85);
    border-radius: 0.9375rem;
    display: flex;
    align-items: center;
    justify-content: center;
    box-sizing: border-box;
    padding: 10px 10px;
	    }
	    .signbxo2{
	        width: 100%;
    background: linear-gradient(180deg,#FFFFFF 0%,#FFF8F5 100%);
    border-radius: 0.75rem;
    border: 0.09375rem solid #FEE4D7;
    padding: 0.9375rem 1.1875rem;
    box-sizing: border-box;
    padding: 12px;
	    }
	    .hbbox{
	      display: flex;
    width: 100%;
    margin-top: 0.84375rem;
    flex-wrap: wrap;
    justify-content: space-around;
	    }
	    .itemhb{
	 height: 8.5rem;
    background: #FFFFFF;
    box-shadow: 0 0.0625rem 0.25rem #fff0eb;
    border-radius: 0.625rem;
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: flex-start;
    padding-top: 0.28125rem;
    position: relative;
    width: 20%;
    margin-left: 5px;
    margin-bottom: 15px;
	    }
	    .itemhb1{
	 height: 9.5rem;
    background: #FFFFFF;
    box-shadow: 0 0.0625rem 0.25rem #fff0eb;
    border-radius: 0.625rem;
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: flex-start;
    padding-top: 0.28125rem;
    position: relative;
    width: 30%;
    margin-left: 5px;
    margin-bottom: 15px;
	    }
	    .itemhb2{
	 height: 8.5rem;
    background: #FFFFFF;
    box-shadow: 0 0.0625rem 0.25rem #fff0eb;
    border-radius: 0.625rem;
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: flex-start;
    padding-top: 0.28125rem;
    position: relative;
    width: 30%;
    margin-left: 5px;
    margin-bottom: 15px;
	    }
	    .hbav{
	        background: #FFEDE4 !important;
	    }
	    .xka{
	  border-radius: 0.625rem;
    display: flex;
    align-items: center;
    flex-direction: column;
    height: 9.5rem;
        justify-content: space-evenly;
	    }
	    .shopbox{
	        margin-top: 10px;
	        width: 100%;
	        display: flex;
	        padding:5px;
	            box-shadow: 0 0.125rem 0.1875rem #f5f7fa;
	    }
	    .shopbox img{
	        width:25%;
	        border-radius: 10px;
	    }
	    .shopbox .rigtx{
	        width: 75%;
	            display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-left: 10px;
   justify-content: space-between;
	    }
	    .bsg{
	        width: 100%;
    min-height: 100%;
    background-image: url(../assets/img/newsz/img_bg.d6dab7dd.png);
    background-size: 100%;
    background-position: top;
    background-repeat: no-repeat;
	    }
	    .my-cell{
	     background: rgb(255 255 255 / 0%);
	    }
	       #jumpingImage {
      position: relative; /* 设置相对定位 */
      top: 0; /* 初始位置为0 */
      animation-name: jumpAnimation;
      animation-duration: 4s;
      animation-timing-function: linear;
      animation-iteration-count: infinite; /* 无限循环 */
    }

    @keyframes jumpAnimation {
      0% {
        transform: translateY(0); /* 初始位置 */
      }
      50% {
        transform: translateY(-10px); /* 上升距离 */
      }
      100% {
        transform: translateY(0); /* 回到初始位置 */
      }
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
<body>
<div class="col-xs-12 col-sm-10 col-md-6 col-lg-4 center-block " style="float: none; background-color:#fff;padding:0;max-width: 550px;">
    <div class="block  block-all bsg">
                <div class="block-back" style="padding: 11px 15px">
                    <a href="javascript:history.back()" class="font-weight display-row align-center">
                        <img style="height: 1.3rem"; src="../assets/img/fanhui.png"></img>&nbsp;&nbsp;
                        <font style="font-size: 1.4rem">每日签到</font>
                    </a>
                </div>
        <div  style="height: 270px;text-align:center;">
            <img id="jumpingImage" style="width:60px;   
    position: absolute;  right: 20%;top: 90px;" src="../assets/img/newsz/img_tengxun.png">
            <img id="jumpingImage" style="width:70px;   
    position: absolute;  right: 50%;top: 70px;" src="../assets/img/newsz/img_youku.png">
      <img id="jumpingImage" style="width:70px;   
    position: absolute;  left: 10%;top: 170px;" src="../assets/img/newsz/img_aiqiyi.png">
    
    <img id="jumpingImage" style="width:50px;   
    position: absolute;  right: 10%;top: 160px;" src="../assets/img/newsz/img_bilibili.png">
            <img style="width:200px;margin-top:109px" src="../assets/img/newsz/113.png">
            
<?php  if( $userrow['power']==0){?>
               <a href="regsite.php">
                   <div class="text-center" style="padding: 5px 10px;    background: #FEB794;border-radius:10px;
    box-shadow: inset 0 0 0.9375rem 0.3125rem rgba(255,255,255,.86);margin:10px 17%">
                <button type="button" class="btn btn-block" style="width: 100%;display: inline-block;border-radius: 5px;padding: 10px 0;background: linear-gradient(263deg,#FFA17E 0%,#FF554B 100%);color:#fff;    box-shadow: inset 0 0 0.19375rem 0.09125rem #fa6d45;" >
                    <span style="<?php if(checkmobile()){ ?>font-size:12px;<?php }else{ ?>font-size:11px;<?php }?>">您当前权限不足请先升级<br>升级后即可使用此签到功能<br>【点我前往升级】</span>
                </button>
            </div>
            </a>
        </div>
        
        <div class="my-cell" style="margin-bottom: 0px;padding: 35px 10px;border-radius: 0">
<?php }?>
<?php  if($userrow['power']==1 || $userrow['power']==2){?>
               <div class="text-center" style="padding: 5px 10px;    background: #FEB794;border-radius:10px;
    box-shadow: inset 0 0 0.9375rem 0.3125rem rgba(255,255,255,.86);margin:10px 17%">
                <button type="button" class="btn btn-block" id="qiandao" style="width: 100%;display: inline-block;border-radius: 5px;padding: 10px 0;background: linear-gradient(263deg,#FFA17E 0%,#FF554B 100%);color:#fff;    box-shadow: inset 0 0 0.19375rem 0.09125rem #fa6d45;" >
                    <span style="<?php if(checkmobile()){ ?>font-size:14px;<?php }else{ ?>font-size:14px;<?php }?>"><?php echo $isqiandao==true?'今日已签到':'立即签到';?></span>
                </button>
            </div>
        </div>
        
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
<?php }?>

           
            <div class="signbxo" style="margin-top:10px">
                <div class="signbxo2">
                    <a href=""><div style="font-weight: 500;color: #f84a3e;">签到排行榜 &nbsp;&nbsp;<span style="font-size: 10px;font-weight: 300;color: #f84a3e;">(级别越高奖励越高,连续签到奖励翻倍)</span></div></a>
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
    <div class="kuang">
<!--        <div class="col">
            <div class="gg"><em>广告</em></div><!--   -->
<!--                <div class="text1"><font><a href="javascript:layer.alert('租此广告位联系QQ：3334023202')" style="color: #999999;">此广告位招租中</a></font></div>
                </div>-->
        <div class="col">
            <div class="gg"><em>广告</em></div><!--qixiang/10.28-->
                <div class="text1"><font><a href="https://www.xiaobaiyun.cn/aff/XFABMHEY" target="_blank" style="color: #ff0000;">国内/海外低价高防/云服务器/Cdn</a></font></div>
                </div>
        <div class="col">
            <div class="gg"><em>广告</em></div><!--shunyi/10.25-->
                <div class="text1"><font><a href="https://docs.qq.com/doc/DVlVtd29GemJVbVp1" target="_blank" style="color: #0000ff;">免费领流量卡/免费加盟代理月入过万/独立后台</a></font></div>
                </div>
    </div>
</div>
<?php }?>
                    <div class="hbbox">
<?php if(checkmobile()){ ?>
                    <?php
foreach($qqrow as $row){
	echo '<div class="itemhb2" style="box-shadow: 0 0.0625rem 0.35rem #ffbfaa;">
                            <div class="xka">
                    <div style="width: 100%;text-align: center">
                               <img style="width: 40%;border-radius: 50%;border: 1px solid #ddd;" src="http://q4.qlogo.cn/headimg_dl?dst_uin='.$row.'&amp;spec=100">
                               <div style="width: 100%; padding: 10px 0;font-size: 1rem">用户UID:已隐藏<br>今日领取奖励成功</div>
                            </div></div></div>';
}
?>
<?php }else{ ?>
                    <?php
foreach($qqrow as $row){
	echo '<div class="itemhb1" style="box-shadow: 0 0.0625rem 0.35rem #ffbfaa;">
                            <div class="xka">
                    <div style="width: 100%;text-align: center">
                               <img style="width: 40%;border-radius: 50%;border: 1px solid #ddd;" src="http://q4.qlogo.cn/headimg_dl?dst_uin='.$row.'&amp;spec=100">
                               <div style="width: 100%; padding: 10px 0;font-size: 1rem">用户UID:已隐藏<br>今日领取奖励成功</div>
                            </div></div> </div>';
}
?>
<?php }?>
                   </div>
                </div>
            </div>
            
<?php if(checkmobile()){ ?>
            <div class="signbxo" style="margin:10px 0px;">
                <div class="signbxo2"> <div style="width:100%;">
                <div style="padding: 0 5px;color:#f3f3f3;font-size: 1.2rem" class="display-row align-center justify-between">
                <div style="width: 32%;height:6rem;border-radius:5px;background-image:linear-gradient(to right, rgba(239, 154, 183, 1), rgba(233, 95, 95, 1));position: relative"  >

                    <li style="position: absolute;top: 15%;left: 7%"><font size="3" color="#fff" id="rewardcount">0</font>元</li>
                    <li style="position: absolute;bottom: 20%;left: 7%"> 已获得奖励</li>
                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/wode/pingmian.png">
                </div>
                <div  style="width: 32%; height:6rem;border-radius:5px;background-image:linear-gradient(to right, rgba(130, 193, 255, 1), rgba(148, 93, 246, 1));position: relative" >

                    <li style="position: absolute;top: 15%;left: 7%"><font size="3" color="#fff" id="count3">0</font>次</li>
                    <li style="position: absolute;bottom: 20%;left: 7%"> 累计已签到</li>
                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/wode/pingmian.png">
                </div>
                <div  style="width: 32%; height:6rem;border-radius:5px;background-image:linear-gradient(to right, rgba(252, 198, 108, 1), rgba(249, 138, 63, 1));position: relative" >
                    <li style="position: absolute;top: 15%;left: 7%"><font size="3" color="#fff" id="count4">0</font>元</li>
                    <li style="position: absolute;bottom: 20%;left: 7%"> 累计已送出</li>
                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/wode/pingmian.png">
                </div>
            </div>
<?php }else{ ?>
            <div class="signbxo" style="margin:10px 0px;">
                <div class="signbxo2"> <div style="width:100%;">
                <div style="padding: 0 5px;color:#f3f3f3;font-size: 1.2rem" class="display-row align-center justify-between">
                <div style="width: 32%;height:7rem;border-radius:5px;background-image:linear-gradient(to right, rgba(239, 154, 183, 1), rgba(233, 95, 95, 1));position: relative"  >

                    <li style="position: absolute;top: 15%;left: 7%"><font size="5" color="#fff" id="rewardcount">0</font>元</li>
                    <li style="position: absolute;bottom: 20%;left: 7%"> 已获得奖励</li>
                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/wode/pingmian.png">
                </div>
                <div  style="width: 32%; height:7rem;border-radius:5px;background-image:linear-gradient(to right, rgba(130, 193, 255, 1), rgba(148, 93, 246, 1));position: relative" >

                    <li style="position: absolute;top: 15%;left: 7%"><font size="5" color="#fff" id="count3">0</font>次</li>
                    <li style="position: absolute;bottom: 20%;left: 7%"> 累计已签到</li>
                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/wode/pingmian.png">
                </div>
                <div  style="width: 32%; height:7rem;border-radius:5px;background-image:linear-gradient(to right, rgba(252, 198, 108, 1), rgba(249, 138, 63, 1));position: relative" >
                    <li style="position: absolute;top: 15%;left: 7%"><font size="5" color="#fff" id="count4">0</font>元</li>
                    <li style="position: absolute;bottom: 20%;left: 7%"> 累计已送出</li>
                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/wode/pingmian.png">
                </div>
            </div>
<?php }?>
        </div></div>
            </div>
            
        <div class="my-cell" style="margin-bottom: 0px;padding: 0px;border-radius: 0">
            <div class="signbxo">
                <div class="signbxo2">
                    <div class="hbbox">
                             <div class="itemhb hbav">
                            <div class="xka">
                                <p style="color: #ffc7ac;">第一天</p>
                                <img style="width:26px" src="../assets/img/newsz/hb.png">
                                <p style="color: #FF5722;font-size: 10px;">奖励已隐藏</p>
                            </div>
                        </div>
                               <div class="itemhb hbav">
                            <div class="xka">
                                <p style="color: #ffc7ac;">第二天</p>
                                <img style="width:26px" src="../assets/img/newsz/hb.png">
                                <p style="color: #FF5722;font-size: 10px;">奖励已隐藏</p>
                            </div>
                        </div>
                               <div class="itemhb hbav">
                            <div class="xka">
                                <p style="color: #ffc7ac;">第三天</p>
                                <img style="width:26px" src="../assets/img/newsz/hb.png">
                                <p style="color: #FF5722;font-size: 10px;">奖励已隐藏</p>
                            </div>
                        </div>
                               <div class="itemhb hbav">
                            <div class="xka">
                                <p style="color: #ffc7ac;">第四天</p>
                                <img style="width:26px" src="../assets/img/newsz/hb.png">
                                <p style="color: #FF5722;font-size: 10px;">奖励已隐藏</p>
                            </div>
                        </div>
                               <div class="itemhb hbav">
                            <div class="xka">
                                <p style="color: #ffc7ac;">第五天</p>
                                <img style="width:26px" src="../assets/img/newsz/hb.png">
                                <p style="color: #FF5722;font-size: 10px;">奖励已隐藏</p>
                            </div>
                        </div>
                            <div class="itemhb hbav">
                            <div class="xka">
                                <p style="color: #ffc7ac;">第六天</p>
                                <img style="width:26px" src="../assets/img/newsz/hb.png">
                                <p style="color: #FF5722;font-size: 10px;">奖励已隐藏</p>
                            </div>
                        </div>
                        <div class="itemhb " style="width:45%;    background-image: url('../assets/img/newsz/hbbg.png');background-size: cover;"></div>
                   
                </div></div>
            </div>
        </div>

<!--<?php  if( $userrow['power']==1){?>
        <div class="my-cell" style="margin-bottom: 0px;padding: 0px;border-radius: 0">
            <div class="signbxo">
                <div class="signbxo2">
                    <div class="hbbox">
                             <div class="itemhb hbav">
                            <div class="xka">
                                <p style="color: #ffc7ac;">第一天</p>
                                <img style="width:26px" src="../assets/img/newsz/hb.png">
                                <p style="color: #FF5722;">+ 0.02</p>
                            </div>
                        </div>
                               <div class="itemhb hbav">
                            <div class="xka">
                                <p style="color: #ffc7ac;">第二天</p>
                                <img style="width:26px" src="../assets/img/newsz/hb.png">
                                <p style="color: #FF5722;">+ 0.02</p>
                            </div>
                        </div>
                               <div class="itemhb hbav">
                            <div class="xka">
                                <p style="color: #ffc7ac;">第三天</p>
                                <img style="width:26px" src="../assets/img/newsz/hb.png">
                                <p style="color: #FF5722;">+ 0.02</p>
                            </div>
                        </div>
                               <div class="itemhb hbav">
                            <div class="xka">
                                <p style="color: #ffc7ac;">第四天</p>
                                <img style="width:26px" src="../assets/img/newsz/hb.png">
                                <p style="color: #FF5722;">+ 0.02</p>
                            </div>
                        </div>
                               <div class="itemhb hbav">
                            <div class="xka">
                                <p style="color: #ffc7ac;">第五天</p>
                                <img style="width:26px" src="../assets/img/newsz/hb.png">
                                <p style="color: #FF5722;">+ 0.02</p>
                            </div>
                        </div>
                            <div class="itemhb hbav">
                            <div class="xka">
                                <p style="color: #ffc7ac;">第六天</p>
                                <img style="width:26px" src="../assets/img/newsz/hb.png">
                                <p style="color: #FF5722;">+ 0.02</p>
                            </div>
                        </div>
                        <div class="itemhb " style="width:45%;    background-image: url('../assets/img/newsz/hbbg.png');background-size: cover;"></div>
                   
                </div></div>
            </div>
        </div>
<?php }?>
<?php  if( $userrow['power']==2){?>
        <div class="my-cell" style="margin-bottom: 0px;padding: 0px;border-radius: 0">
            <div class="signbxo">
                <div class="signbxo2">
                    <div class="hbbox">
                             <div class="itemhb hbav">
                            <div class="xka">
                                <p style="color: #ffc7ac;">第一天</p>
                                <img style="width:26px" src="../assets/img/newsz/hb.png">
                                <p style="color: #FF5722;">+ 0.05</p>
                            </div>
                        </div>
                               <div class="itemhb hbav">
                            <div class="xka">
                                <p style="color: #ffc7ac;">第二天</p>
                                <img style="width:26px" src="../assets/img/newsz/hb.png">
                                <p style="color: #FF5722;">+ 0.05</p>
                            </div>
                        </div>
                               <div class="itemhb hbav">
                            <div class="xka">
                                <p style="color: #ffc7ac;">第三天</p>
                                <img style="width:26px" src="../assets/img/newsz/hb.png">
                                <p style="color: #FF5722;">+ 0.05</p>
                            </div>
                        </div>
                               <div class="itemhb hbav">
                            <div class="xka">
                                <p style="color: #ffc7ac;">第四天</p>
                                <img style="width:26px" src="../assets/img/newsz/hb.png">
                                <p style="color: #FF5722;">+ 0.05</p>
                            </div>
                        </div>
                               <div class="itemhb hbav">
                            <div class="xka">
                                <p style="color: #ffc7ac;">第五天</p>
                                <img style="width:26px" src="../assets/img/newsz/hb.png">
                                <p style="color: #FF5722;">+ 0.05</p>
                            </div>
                        </div>
                            <div class="itemhb hbav">
                            <div class="xka">
                                <p style="color: #ffc7ac;">第六天</p>
                                <img style="width:26px" src="../assets/img/newsz/hb.png">
                                <p style="color: #FF5722;">+ 0.05</p>
                            </div>
                        </div>
                        <div class="itemhb " style="width:45%;    background-image: url('../assets/img/newsz/hbbg.png');background-size: cover;"></div>
                   
                </div></div>
            </div>
        </div>
<?php }?>-->
        
<script src="//cdn.staticfile.org/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="//cdn.staticfile.org/clipboard.js/1.7.1/clipboard.min.js"></script>
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
var clipboard = new Clipboard('.fenx');
clipboard.on('success', function(e) {
  	layer.msg("复制成功,快去分享给朋友一起来领现金吧！");
});
clipboard.on('error', function(e) {
     layer.msg("复制失败，请长按链接后手动复制",);
});	
$(document).ready(function(){
	$("#qiandao").click(function(){
		$.ajax({
		 type: "get",
		 url: "ajax_user.php?act=qiandao",
		 dataType: "json",
		 success: function(data){
			if(data.code == 0){
				layer.alert(data.msg,{icon:6},function(){
					window.location.reload();
				})
			}else{
				layer.alert(data.msg,{icon:5})
			}
		 },
		 error: function(){
			layer.alert('签到失败，请稍后刷新重试！'); 
		 }
	   });
	});
	$.ajax({
		type : "GET",
		url : "ajax_user.php?act=qdcount",
		dataType : 'json',
		async: true,
		success : function(data) {
			$('#count1').html(data.count1);
			$('#count2').html(data.count2);
			$('#count3').html(data.count3);
			$('#count4').html(data.count4);
			$('#rewardcount').html(data.rewardcount);
		}
	});
})
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
</body></html>
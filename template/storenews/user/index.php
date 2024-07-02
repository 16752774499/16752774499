 
<?php if($islogin2==1){
if($userrow['status']==0){
	sysmsg('你的账号已被封禁！',true);exit;
}elseif($userrow['power']>0 && $conf['fenzhan_expiry']>0 && $userrow['endtime']<$date){
	sysmsg('你的账号已到期，请联系管理员续费！',true);exit;
}
}
?>
<?php 
if($conf['cdnpublic']==1){
	$cdnpublic = '//lib.baomitu.com/';
}elseif($conf['cdnpublic']==2){
	$cdnpublic = 'https://cdn.bootcdn.net/ajax/libs/';
}elseif($conf['cdnpublic']==4){
	$cdnpublic = '//s1.pstatp.com/cdn/expire-1-M/';
}else{
	$cdnpublic = '//cdn.staticfile.org/';
}
@header('Content-Type: text/html; charset=UTF-8');


 $jiamengzhuzhan=$conf['jiamengzhuzhan']
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
    <script> document.documentElement.style.fontSize = document.documentElement.clientWidth / 750 * 40 + "px";</script>
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-param" content="_csrf">
     <title>个人中心-<?php echo $conf['sitename']; ?></title>
    <meta name="keywords" content="<?php echo $conf['keywords'] ?>">
    <meta name="description" content="<?php echo $conf['description'] ?>">
    <link rel="shortcut icon" href="<?php echo $conf['default_ico_url'] ?>">
          <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>template/storenews/user/yangshi/foxui1.css?time=1649593357">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>template/storenews/user/yangshi/style1.css?time=1649593357">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>template/storenews/user/yangshi/member.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>assets/store/css/iconfont.css">
   <link href="<?php echo $cdnpublic?>font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo $cdnserver?>template/storenews/user/yangshi/toastr.min.css">
    <link rel="stylesheet" href=" http://cdn.staticfile.org/layui/2.5.7/css/layui.css">
   
   <script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>



   
    
</head>
<style>
body {
    width: 100%;
    max-width: 650px;
    margin: auto;
    background: #f2f2f2;
    line-height: 24px;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
 
}
::-webkit-scrollbar{ 
	display: none;
   /* background-color:transparent; */
     /*linear-gradient(45deg, rgba(193, 189, 186, 1),rgba(153, 153, 153, 1) 30%, rgba(242, 242, 242, 0.1)100%),*/
     /* linear-gradient(to bottom, rgba(153, 153, 153, 1), rgba(242, 242, 242, 1) 95%);*/
      /*linear-gradient(10deg, rgba(242, 242, 242, 1),rgba(193, 189, 186, 1)60%, rgba(153, 153, 153, 1) 80%);*/
}
.power_0{
    background-image:
     linear-gradient(to bottom, rgba(145, 143, 142, 0), rgba(153, 153, 153, 0) 70%, rgba(242, 242, 242, 1) 99%),
       linear-gradient(to right, rgba(194, 194, 194, 1), rgba(145, 143, 142, 1));
    
}
.power_0_user{
    background: -webkit-linear-gradient(left, rgba(145, 143, 142, 1.0), rgba(171, 166, 161, 1.0) 70%);
}
.power_0_img{
    border-radius: 3.3rem;
	display: block;
	border: 4px rgb(189 188 188) solid;
}
.power_0_text{
    color:#d0cecd;
}
.power_1{
   background-image:
     linear-gradient(to bottom, rgba(157, 136, 244, 0), rgba(157, 136, 244, 0) 70%, rgba(242, 242, 242, 1) 99%),
       linear-gradient(to right, rgba(141, 206, 241, 1.0), rgba(157, 136, 244, 1.0));
}
.power_1_user{
    background: -webkit-linear-gradient(left, #7e45f6, rgba(141, 206, 241, 1.0));
}
.power_1_img{
    border-radius: 3.3rem;
	display: block;
	border: 4px rgba(141, 206, 241, 1.0) solid;
}
.power_1_text{
    color: #e0dede;
}



	 <?php if($userrow['power']==2){?>
.power_2{
     background-image:
     linear-gradient(to bottom, rgba(232, 138, 191, 0), rgba(232, 138, 191, 0) 70%, rgba(242, 242, 242, 1) 99%),
       linear-gradient(to right, rgba(240, 206, 114, 1.0),rgba(228, 78, 189, 1.0));
}
<?php	}elseif($userrow['power']==1){?>
.power_2{
     background-image:
     linear-gradient(to bottom, rgba(232, 138, 191, 0), rgba(232, 138, 191, 0) 70%, rgba(242, 242, 242, 1) 99%),
       linear-gradient(to right, rgba(141, 206, 241, 1.0),#7e45f6);
}
<?php }else{ ?>
.power_2{
    background-image: linear-gradient(to bottom, rgba(145, 143, 142, 0), rgba(153, 153, 153, 0) 70%, rgba(242, 242, 242, 1) 99%), linear-gradient(to right, rgba(194, 194, 194, 1), rgba(145, 143, 142, 1));
}
<?php }?>


	 
	 <?php if($userrow['power']==2){?>
	.power_2_user{
    background: -webkit-linear-gradient(left, rgba(228, 78, 189, 1.0), rgba(240, 206, 114, 1.0));
}
<?php	}elseif($userrow['power']==1){?>
	.power_2_user {
    background: -webkit-linear-gradient(left, #7e45f6, rgba(141, 206, 241, 1.0));}
<?php }else{ ?>
.power_2_user {
         background: -webkit-linear-gradient(left, rgba(145, 143, 142, 1.0), rgba(171, 166, 161, 1.0) 70%);
}
<?php }?>

.power_2_img{
    border-radius: 3.3rem;
	display: block;
	border: 4px rgba(240, 206, 114, 1.0) solid;
}
.power_2_text{
    color: #e0dede;
}
.label{
    color: unset;
    line-height: 1.8;
}
.account-main{
    height: 100% !important;
}
.faceimg img {
	height: 3.3rem;
	width: 3.3rem;
	
}
a {
    text-decoration:none;
}
a:hover{
    text-decoration:none;
}
.myskin{
    background-color: transparent;/*背景透明*/
    box-shadow: 0 0 0 rgba(0,0,0,0);/*前景无阴影*/
}

.tui-checkbox:checked {
	background:#ffffff
}
.tui-checkbox {
	width:15px;
	height:15px;

	border:solid 2px #fa8c82;
	-webkit-border-radius:50%;
	border-radius:50%;

	margin:0;
	padding:0;
	position:relative;
	display:inline-block;
	vertical-align:top;
	cursor:default;
	-webkit-appearance:none;
	-webkit-user-select:none;
	user-select:none;
	-webkit-transition:background-color ease 0.1s;
	transition:background-color ease 0.1s;
}
.tui-checkbox:checked::after {
	content:'';
	top:2px;
	left:2px;
	position:absolute;
	background:transparent;

	border-top:none;
	border-right:none;

	-moz-transform:rotate(-45deg);
	-ms-transform:rotate(-45deg);
	-webkit-transform:rotate(-45deg);
	transform:rotate(-45deg);
}
</style>
<body ontouchstart="" style="overflow: auto;height: auto !important;max-width: 650px;">

<div id="body">
<div class="fui-page  fui-page-current" style="max-width: 650px;left: auto;">
    <!--<div class="fui-header">-->
    <!--    <div class="fui-header-left">-->
    <!--        <a class="back" onclick="goback();"></a>-->
    <!--    </div>-->
    <!--    <div class="title">会员中心</div>-->
    <!--    <div class="fui-header-right"></div>-->
    <!--</div>-->
    
    <div style="width:100%;" class="fui-content member-page navbar ">
                <div style="height:13rem;width:100%;position:absolute;top:0;left:0; background: linear-gradient(355deg, rgba(173, 216, 230,0.1), rgba(173, 216, 230,0.9));" class="power_2"></div>
        
        <div class="display-row justify-between align-end" style="position: relative;width:90%;margin:auto;height:0.4rem;z-index:1;overflow: hidden; ">
            <!--<a class="setbtn" style="height:70%;" href="uset.php?mod=user"><img style="width:1.5rem;height:1.5rem;border-radius: 1.8rem;padding:.25rem;-->
            <!--     background-color: rgba(0, 0, 0, 0.15)" src="../assets/store/img/shezhi.png" /></a>-->
            <!--<img style="height:70%;opacity:0.7" src="../assets/store/img/diandian.png" />-->
        </div>
        
        <div class="max-width power_2_user" style="height: 6.7rem;overflow: hidden;position: relative;margin-top:15px;margin-bottom:0.1px; background: linear-gradient(355deg, rgba(0, 0, 0,0.5), rgba(0, 0, 0,0.9));" >
            
            <div class="display-row align-center justify-between" style="width:100%;height:69%;background:#fff;border-radius: .6rem;padding:0 1rem">
                <div class="faceimg "><img class="power_2_img" src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $userrow['qq']?>&spec=100"></div>
                <div style="width:65%;height:2.5rem" class="display-column justify-between">
                    <a style="font-size:0.8rem;color: #262626;font-weight:600;"class="ellipsis1" ><?php echo $userrow['name']; ?></a>
	
				<div href="javascript:void(0);" id="copy-btn"  data-clipboard-target="#uuid">
                        <a id="uuid" style="font-size:10px;color:#6d6c6c; padding:4px 8px;background:#eff0f1;border-radius:100px">UID : <?php echo $userrow['zid']?></a>
                        <img style="width:1.1rem;height:1.1rem;" src="<?php echo $cdnserver?>template/storenews/image/user/img/fuzhi.svg" />
                    </div>
	
					
					
                </div>
                <a  href="uset.php?mod=user" style="width:10%;text-align: right;"><img style="width:1.2rem;height: 1.2rem;" src="<?php echo $cdnserver?>template/storenews/image/user/img/go.svg" /></a>
            </div>
			
			
		 <?php if($userrow['power']==2){$img='fenzhan2'; $list='5';}else if($userrow['power']==1){;$img='fenzhan1';$list='3';}else{$img='fenzhan0';}?>
			 <div class="display-row align-center justify-between" style="width:100%;height:31%;padding:0 1rem">
                                   <div>
                       <img  style="width:.9rem;height.9rem" src="<?php echo $cdnserver?>template/storenews/image/user/img/<?php echo $img?>.png">
                       <font style="color:#fff;font-weight:600;font-size:.7rem;t-weight:tormal">
                           <?php if($userrow['power']==2){echo '高级合伙人'; $font='SENIOR PARTNER';}else if($userrow['power']==1){echo '初级站长';
                           $font='STATIONMASTER';}else{echo '普通会员';$font='REGULAR MEMBERS';}?>
                        
                          </font>
                   </div>
                   <div style="font-size:.55rem;font-weight:300;" class="power_1_text"><?php echo $font?></div>
                               
            </div>
			
			
			    </div>
        <div class="fui-cell-group fui-cell-click max-width" >

			
        </div>
     
        
       
      <style>
    .tcbox{
     position: relative;
    display: flex;
    height: 60px;
    align-items: center;
    flex-direction: row;
    width: 95%;
    margin: 10px auto;
    }
    .boxn1{
     width: 30%;
     display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    }
    .n1{
        text-align: center;
        height: 30px;
        background: rgb(245, 202, 40);
        width: 100%;
        border-radius: 12px 12px 0px 0px;
        font-weight: 600;
        line-height: 30px;
    }
    .n2{
        height: 35px;
         background: #fff;
         width: 100%;
         display: flex;
    align-items: center;
    justify-content: space-evenly;
    border-radius: 0px 0px  12px 12px;
    }
    .n2 img{
        width:25px;height: 25px;
    }
    .boxn2{
        margin-left: 2%;
        height: 65px;
        width:68%;
        background: #fff;
        border-radius: 12px;
    }
    .boxn2 img{
        margin-left:10px;
        margin-top: 4.4px;
        height: 20px;
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
    max-width: 650px;
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
    width: 275px;
    padding: 15px;
    background-color: #fff;
    border-radius: 10px;
}
.tanc5{
    display: flex;
    align-items: center;
    justify-content: space-around;
        width: 100%;
    height: 60px;
}
.tanc51{
        display: flex;
    flex-direction: column;
    align-items: flex-start;
        width: 65%;
}
.z1{
           display: flex;
    width: 100%;
    margin-top: 15px;
    justify-content: space-between;
}

.z2{
    width: 42%;
    height: 32px;
    text-align: center;
    line-height: 32px;
    font-size: 12px;
    font-weight: 700;
    background: #eeeef3;
    border-radius: 50px;

}
.z3{
   width: 42%;
    height: 32px;
    text-align: center;
    line-height: 32px;
    font-size: 12px;
    font-weight: 700;
    background: #eeeef3;
    border-radius: 50px; 
}
</style>
        <div class="tcbox">
            <div class="boxn1">
                <div class="n1">联系上级</div>
                <div class="n2">
    <img onclick="tcqq()" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/wode/qqsu.png">
     <img onclick="tcwx()" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/wode/wxsu.png" >
                </div>
            </div>
            
            <div class="boxn2">
                <img src="<?php echo $cdnserver?>assets/store/picture/1571065042489353.jpg">
                <hr style="margin: 6px 0;">
              <div id="scroll_div" class="fl"> 
        <div id="scroll_begin" style="box-sizing: border-box;margin: 0px;padding: 0px;color: red;font-size: 12px;">
        如果你在使用过程中遇到了问题，请到会员中心-售后反馈内提交工单，客服会在12小时内回复并协助你处理。
        </div> 
        <div id="scroll_end"></div>
    </div>
            </div>
        </div>
        
           <?php
           $sjid=$userrow['upzid'];
        
           $orderrow = $DB->getRow("SELECT * FROM `shua_site` WHERE zid='{$sjid}'  LIMIT 1");
  
  if(!$sjid){
          $kfqq=$conf['kfqq'];
}else{
$kfqq=$orderrow['qq'];
}
  
      
          ?>
        <div class="tanc1" id="tcqq" style="display:none;">
             <div class="tanc2">
                  <div class="tanc3">
                       <div class="tanc4"><div class="tanc5">
                           <div class="tanc51">
                               <div><img style="width:20px;" src="<?php echo $cdnserver?>template/storenews/image/user/QQ.svg"> QQ</div>
                               <div><b><?php echo $kfqq;?></b>
                                 <a href="javascript:;" class="wx_hao" data-clipboard-text="<?php echo $kfqq ?>">
                            <img style="width:20px;height:30px;padding-left:0px" src="<?php echo $cdnserver?>template/storenews/image/user/fuzhi.svg" />
                        </a>
                               </div>
                               <div style="font-size: 12px;color: rgb(154, 150, 150);">复制号码后打开QQ添加客服</div>
                           </div>
                           <div class="tanc52"><img style="width:50px;" src="http://api.qrserver.com/v1/create-qr-code/?size=250x250&margin=10&data=https://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq'] ?>&site=qq&menu=yes"></div>
                       </div>
                        <div class="z1">
                            
                              <div class="z2" onclick="closetc()"> 关闭 </div>
                              <div class="z3"  style="background: rgb(47, 110, 255); color: rgb(255, 255, 255);" >
                                   <a class="box-btn" href="https://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq'] ?>&site=qq&menu=yes" target="_blank" style="background: rgb(47, 110, 255); color: rgb(255, 255, 255);">
                                  打开QQ</a> </div>
                                        
                                        </div>
                       
                       </div>
                  </div>
             </div>
        </div>
            
           <?php
           $sjid=$userrow['upzid'];
        
           $orderrow = $DB->getRow("SELECT * FROM `shua_site` WHERE zid='{$sjid}'  LIMIT 1");
  
  if(!$sjid){
          $kfqq=$conf['kfwx'];
}else{
$kfwx=$orderrow['kfwx'];
}
  
      
          ?>
           <div class="tanc1" id="tcwx" style="display:none;">
             <div class="tanc2">
                  <div class="tanc3">
                       <div class="tanc4"><div class="tanc5">
                           <div class="tanc51">
                               <div><img style="width:20px;" src="<?php echo $cdnserver?>template/storenews/image/user/weixin.svg"> 微信</div>
                               <div><b><?php echo $kfwx;?> </b>
                                     <a href="javascript:;" class="wx_hao" data-clipboard-text="<?php echo $kfwx ?>">
                            <img style="width:20px;height:30px;padding-left:0px" src="<?php echo $cdnserver?>template/storenews/image/user/fuzhi.svg" />
                        </a>
                               </div>
                               
                               <div style="font-size: 12px;color: rgb(154, 150, 150);">复制号码后打开微信添加客服</div>
                           </div>
                           <div class="tanc52"><img style="width:50px;" src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq'] ?>&spec=100"></div>
                       </div>
                       
                         <div class="z1">
                            
                              <div class="z2" onclick="closetc()"> 关闭 </div>
                              <div class="z3" style="background: rgb(30, 204, 102); color: rgb(255, 255, 255);">
                                     
            <a class="box-btn" onclick="openwx()" style="background: rgb(30, 204, 102); color: rgb(255, 255, 255);">
               
                                  打开微信</a>  </div>
                                        
                                        </div>
                       </div>
                  </div>
             </div>
        </div>
        
           <div class="tanc1" id="tcsj" style="display:none;">
             <div class="tanc2">
                  <div class="tanc3">
                       <div class="tanc4">123</div>
                  </div>
             </div>
        </div>


<script src="http://lib.baomitu.com/clipboard.js/1.7.1/clipboard.min.js"></script>
<script type="text/javascript">

    var clipboard = new Clipboard('.wx_hao');
	clipboard.on('success', function (e) {
        layer.msg('复制成功');
    });
    clipboard.on('error', function (e) {
        layer.msg('复制失败');
    });
       function openwx(){
 
         locatUrl = "weixin://";

         if(/ipad|iphone|mac/i.test(navigator.userAgent)) {

            var ifr =document.createElement("iframe");

            ifr.src = locatUrl;

            ifr.style.display = "none";

            document.body.appendChild(ifr);

         }else{

            window.location.href = locatUrl;
         }

    }
//文字横向滚动
function tcqq(){
    $("#tcqq").show();
}
function tcwx(){
    $("#tcwx").show();
}
function tcsj(){
    $("#tcsj").show();
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
    <?php  if( $userrow['power']==1){?>

        <a class="max-width" style="position: relative;margin-bottom:7px" href="upsite.php">
            <img style="width: 100%;margin-bottom:5px;" src="../template/storenews/image/user/img/shengji.jpg">
        </a>
         <?php }?>
     <?php  if( $userrow['power']==0){?>

        <a class="max-width" style="position: relative;margin-bottom:7px" href="regsite.php">
            <img style="width: 100%;margin-bottom:5px;" src="<?php echo $cdnserver?>assets/user/img/vip.png">
        </a>
         <?php }?>
                <div class="max-width display-column align-center" style="height: 6.4rem;overflow: hidden;position: relative;background:#fff">
            <div style="height:25%;width:100%" class="display-row justify-between align-center">
                <font style="padding-left:15px;font-size:.7rem;font-weight:500;t-weight:bolder;">我的余额</font>
                <div style="width:48%;height:100%;border-radius: 0 .6rem 0 .6rem ;background:#f5f7f9;" class="display-row align-center">
                                             <a href="tixian.php"  style="color:#acb1b1;font-size:.7rem;width:50%; height:100%;" class="display-row align-center justify-center">提现</a>
                                        
                    <a href="recharge.php" style="color:#fff; font-size:.7rem; width:50%; height:100%;border-radius: 0 .6rem 0 .6rem ;background:#ef7a45;" class="display-row align-center justify-center">充值</a>
                </div>
            </div>
            <div style="height:50%;color: #ff6646;width:100%;padding-left:15px;" class="display-row align-center">
                <font style="font-size:0.8rem;">   &nbsp;&nbsp; ￥</font>
                <font style="font-size:1.3rem;font-weight:550;"><?php echo $userrow['rmb']?></font>
            </div>
            <div style="height:35%;width:100%; border-top: 1px solid #ebebeb;padding:0 15px;font-size:.55rem;color:#acb1b1;" class="display-row align-center justify-between">
                <?php 
                $thtime=date("Y-m-d").' 00:00:00';
                 $income_today2=$DB->getColumn("SELECT sum(point) FROM pre_points WHERE zid='{$userrow['zid']}' AND action='提成' AND addtime>'$thtime'");
               $income_today3=$DB->getColumn("SELECT sum(point) FROM pre_points WHERE zid='{$userrow['zid']}' AND action='提成'");
               if($income_today2==''){$income_today2=0.00;} $income_today2 = number_format($income_today2, 2);
               if($income_today3==''){$income_today3=0.00;}$income_today3 = number_format($income_today3, 2);
               
               $bytime=date('Y-m-01', strtotime(date("Y-m-d")));
               $by_day=$DB->getColumn("SELECT sum(point) FROM pre_points WHERE zid='{$userrow['zid']}' AND action='提成' AND addtime>='$bytime'");
               if(!isset($by_day)){$by_day= 0.00;}
               $by_day = number_format($by_day, 2);
 

                ?>
                <div style="width:30%;text-align:content;display: flex;text-align:content;flex-direction: column;align-items: center;">今日收益  <font color="#000" ><?php echo $income_today2?>元</font><font></font> </div>
                
                    <div style="width:2px;height:50%;background:#ebebeb"></div>
                <div style="width:30%;display: flex;text-align:content;flex-direction: column;align-items: center;">本月收益<font color="#000" ><?php echo  $by_day?>元</font></font> </div>
                
                <div style="width:2px;height:50%;background:#ebebeb"></div>
                <div style="width:30%;text-align:content;display: flex;text-align:content;flex-direction: column;align-items: center;">累计收益 <font color="#000" ><?php echo  $income_today3?>元</font></font> </div>
            </div>
        </div>
          <?php  if($userrow['power']==1 || $userrow['power']==2){?>
                <div class="fui-cell-group fui-cell-click max-width" >
            
                <div class="fui-icon-group selecter col-3">
                    
                    <a class="fui-icon-col external left-border right-border" href="<?php echo $cdnserver?>user/tougao.php">
                        <div class="icon1 icon-blue radius">
                           <img src="data:image/png;base64,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">
                        </div>
                        <div class="text">项目投稿</div>
                    </a>
                     
                   
                  
              <a class="fui-icon-col external left-border right-border" href="<?php echo $cdnserver?>user/material.php">
                        <div class="icon1 icon-orange radius">
                            <img src="http://popo.z32.top/static/img/my/sucai.png">
                        </div>
                        <div class="text">发圈素材</div>
                        
                    </a>
                    <a class="fui-icon-col external " href="tuiguang.php">
                        <div class="icon1 icon-pink radius">
                            <img src="http://popo.z32.top/static/img/haibao.8c3d1d05.svg">
                        </div>
                        <div class="text">推广海报</div>
                    </a>
                   
                </div>            
        </div>
      <div style="width:100%;padding: 0.25rem 0.5rem; padding-top: 0rem; overflow: hidden;  font-size: 0.7rem; font-weight: bold; display:flex; align-content: center; justify-content: space-between" >
                        <a href="jiangli.php" style="width: 100%;height: 3.4rem;border-radius:8px;position: relative;background: #c8a593b3;overflow: hidden" >
                            <div style="position: absolute;top: 25%;left: 5%;z-index: 100">
                                <li style="color: #714f40;"> <img src="https://cdn.xrsxi.top/view.php/0b66f3a82c26211e688f7633b6d4739c.png" style="width: 17px; height: 17px;margin-bottom:2.5px">每日福利奖励</li>
                                <li style="color: #7c7c7c;font-size: 0.52rem;font-weight:0;line-height: 0.9rem">系统将根据自己站点当日注册并开通人数额外奖励现金!</li>
                            </div>
                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="<?php echo $cdnserver?>img/shouyi.png">
                        </a>
                            </div>
           <?php }?>
        <div class="fui-cell-group fui-cell-click max-width" >
                <a class="fui-cell1 external"  style="border: 0px solid #ebebeb;">
                   
                    <div class="fui-cell-text" style="font-weight: 600;">订单相关</div>
                   
                </a>
                <div class="fui-icon-group selecter col-4">
                    <a class="fui-icon-col external" href="../?mod=query">
                        <div class="icon icon-green radius">
                            <img src="http://popo.z32.top/static/img/dingdan.3c3ca133.svg">
                        </div>
                        <div class="text">订单管理</div>
                    </a>
                    <a class="fui-icon-col external" href="record.php">
                        <div class="icon icon-orange radius">
                            <img src="<?php echo $cdnserver?>img/mingxi.b67e93f6.svg"style="33px;width: 33px;">
                        </div>
                        <div class="text">收支明细</div>
                    </a>
                    <a class="fui-icon-col external" href="http://dhw.xixikai.cn">
                        <div class="icon icon-blue radius">
                           <img src="/img/renwu.4a93b0cb.svg">
                        </div>
                        
  
                        <div class="text">任务赚钱</div>
                    </a>
                    <a class="fui-icon-col external" href="workorder.php">
                        <div class="icon icon-pink radius">
                            <img src="<?php echo $cdnserver?>img/fankun.bd9fc9e0.svg">
                        </div>
                        <div class="text">售后反馈</div>
                    </a>
                   
                </div>
        </div>
        
        
       
       <?php  if($userrow['power']==1 || $userrow['power']==2){?>
                 <div class="fui-cell-group fui-cell-click max-width">
            
    
                <div class="fui-according-group " style="display: block;margin-top:unset;">
    
                    <div class="fui-according expanded">
                        <div class="fui-according-header" style="border-top: 0px solid #ebebeb;">
                          
                            <span class="text" style="font-weight: 600;">网站管理</span>
                        
                        </div>
                        <div class="fui-according-content" style="display: block;">
                            <div class="fui-icon-group selecter col-<?php echo $list;?>">
                                <a class="fui-icon-col external" href="siteinfo.php">
                                    <div class="icon icon-green radius">
                                        <img src="<?php echo $cdnserver?>img/site.fd79164e.svg">
                                    </div>
                                    <div class="text">站点信息</div>
                                </a>
                                <a class="fui-icon-col external" href="shoplist.php">
                                    <div class="icon icon-blue radius">
                                       <img src="<?php echo $cdnserver?>img/goods.b1226ec6.svg">
                                    </div>
                                    <div class="text">商品管理</div>
                                </a>
                                <a class="fui-icon-col external" href="classlist.php">
                                    <div class="icon icon-orange radius">
                                        <img src="<?php echo $cdnserver?>img/type.80525d3e.svg">
                                    </div>
                                    <div class="text">分类管理</div>
                                </a>
                                  <?php  if( $userrow['power']==2){?>
                                                                <a class="fui-icon-col external" href="sitelist.php">
                                    <div class="icon icon-pink radius">
                                        <img src="<?php echo $cdnserver?>img/fenzhan.951ebe32.svg">
                                    </div>
                                    <div class="text">分站管理</div>
                                </a>
                              
                                <a class="fui-icon-col external" href="userlist.php">
                                    <div class="icon icon-pink radius">
                                        <img src="<?php echo $cdnserver?>img/user.e0b3ae7a.svg">
                                    </div>
                                    <div class="text">用户列表</div>
                                </a>
                                  <?php }?>
                                                            </div>
                        </div>
                    </div>
                </div>
           
               
            
            
        </div>     <?php }?>
            


        <div class="fui-cell-group fui-cell-click max-width">
                <div class="fui-according-group " style="display: block;margin-top:unset;">
                    	<?php if($conf['appcreate_open']==1){?>
                                			<a class="fui-cell external" href="appCreate.php">
                                <div class="fui-cell-img">
                                    <img width="100%" src="<?php echo $cdnserver?>img/appc.9bb68c33.svg">
                                </div>
                                <div class="fui-cell-text"><p>APP生成</p></div>
                                <div class="fui-cell-remark"></div>
                        <!--</a>
                        <?php }?>
            		            		            		<a class="fui-cell external" href="qiandao.php">
            			    <div class="fui-cell-img">
                                <img width="100%" src="<?php echo $cdnserver?>template/storenews/image/user/img/qiandao.png">
                            </div>
            				<div class="fui-cell-text"><p>我的签到</p></div>
            				<div class="fui-cell-remark"></div>-->
            		</a>
            		  <?php  if($userrow['power']==1 || $userrow['power']==2){?>
            		            		            		<a class="fui-cell external" href="uset.php?mod=site">
            			    <div class="fui-cell-img">
                                <img width="100%" src="<?php echo $cdnserver?>img/shezhi.9e270b76.svg">
                            </div>
            				<div class="fui-cell-text"><p>设置中心</p></div>
            				<div class="fui-cell-remark"></div>
            		</a>
            	<?php }?>
            		                     <a class="fui-cell" href="message.php">
                        <div class="fui-cell-img">
                            <img width="100%" src="<?php echo $cdnserver?>img/gonggao.b7392bd5.svg">
                        </div>
                        <div class="fui-cell-text"><p>官方公告</p></div>
                        <div class="fui-cell-remark" >
                            <span class="badge tiaoshu_cont" style="display:none;"></span>
                        </div>
                        
                        </a>
                     <?php  if($userrow['power']==1 || $userrow['power']==2){?>
                    <a class="fui-cell external" href="<?php echo $cdnserver?>user/djhz.php">
            			    <div class="fui-cell-img">
                                <img width="100%" src="<?php echo $cdnserver?>img/hezuo.8c354626.svg">
                            </div>
            				<div class="fui-cell-text"><p>商务合作</p></div>
            				<div class="fui-cell-remark"></div>
            		<!--</a>
            		     <?php }?>
            		     
            		       <?php  if($userrow['power']==2 || $userrow['power']==2){?>                           
                                              		                     <a class="fui-cell external" href="jlq.php">
                        <div class="fui-cell-img">
                            <img width="100%" src="../template/storenews/tupian/shengji.png">
                        </div>
                        <div class="fui-cell-text"><p>合伙人交流群</p></div>
                        <div class="fui-cell-remark" style="font-size: 12px;">微信1群</div>-->
                    </a>
            		  	<?php }?>
                        
                        
                        
                    <!--  </a>
                    
                    <!-- <?php  if($userrow['power']==1 || $userrow['power']==2){?>
                    <a class="fui-cell external" href="<?php echo $cdnserver?>?mod=kf">
            			    <div class="fui-cell-img">
                                <img width="100%" src="<?php echo $cdnserver?>template/storenews/image/user/img/api.png">
                            </div>
            				<div class="fui-cell-text"><p>商务合作</p></div>
            				<div class="fui-cell-remark"></div>
            		</a>
            		  	<?php }?>-->
                                	
            		
            		                    <!--<div class="fui-according">-->
                    <!--    <div class="fui-according-header fui-cell">-->
                    <!--        <div class="fui-cell-img">-->
                    <!--            <img width="100%" src="../assets/store/img/shezhi.svg">-->
                    <!--        </div>-->
                    <!--        <span class="text">系统设置</span>-->
                    <!--        <span class="remark"></span>-->
                    <!--    </div>-->
                    <!--    <div class="fui-according-content" style="display: none;">-->
                    <!--        <div class="fui-icon-group selecter col-3">-->
                    <!--            <a class="fui-icon-col external" href="uset.php?mod=user" >-->
                    <!--                <div class="icon icon-green radius">-->
                    <!--                    <img width="100%" src="../assets/store/img/wangzhan.svg">-->
                    <!--                </div>-->
                    <!--                <div class="text">用户资料设置</div>-->
                    <!--            </a>-->
                    <!--            -->
                    <!--            <a class="fui-icon-col external" href="uset.php?mod=site">-->
                    <!--                <div class="icon icon-orange radius">-->
                    <!--                    <img width="100%" src="../assets/store/img/yonghu1.svg">-->
                    <!--                </div>-->
                    <!--                <div class="text">网站信息设置</div>-->
                    <!--            </a>-->
                    <!--            <a class="fui-icon-col external" href="getapi.php">-->
                    <!--                <div class="icon icon-orange radius">-->
                    <!--                    <img width="100%" src="../assets/store/img/yonghu1.svg">-->
                    <!--                </div>-->
                    <!--                <div class="text">API接口</div>-->
                    <!--            </a>-->
                    <!--            -->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
        </div>      


        <div class="fui-cell-group fui-cell-click transparent max-width" style="padding-top:1rem;">

            <a class="fui-cell external btn-logout" href="login.php?logout">
                <div class="fui-cell-text" style="text-align: center;background:#ff5555"><p>退出登录</p></div>
            </a>
        </div>
        <div class="footer max-width" style="margin-top: 0.5rem;margin-bottom: 3rem;display: block;float: left;">
          
        </div>
    </div>

     <style>
  .img1{

    width:1.1rem;
    height:1.1rem;
  }

  </style>
  

  

   <div class="fui-navbar" style="max-width: 650px;z-index: 100;">
            <a href="../" class="nav-item"> <img src="<?php echo $cdnserver?>img/home.png" class="img1"><span class="label">首页</span>
            </a>
          
            <a href="../?mod=query" class="nav-item ">  <img src="<?php echo $cdnserver?>img/order.png" class="img1"><span class="label">订单</span> </a>
		
            <a href="../?mod=kf" class="nav-item "> <img src="<?php echo $cdnserver?>img/kf.png" class="img1"> <span class="label">客服</span>
            </a>
            <a href="./" class="nav-item active "> <img src="<?php echo $cdnserver?>img/my-index.png" class="img1"><span class="label">我的</span> </a>
        </div>
  
  
</div>




<script src="<?php echo $cdnserver?>template/storenews/user/yangshi/toastr.min.js"></script>
<script src="<?php echo $cdnserver?>template/storenews/user/yangshi/foxui.js"></script>
<script src="<?php echo $cdnserver?>template/storenews/user/yangshi/clipboard.min.js"></script>
<script src="<?php echo $cdnserver?>template/storenews/user/yangshi/jquery.cookie.min.js"></script>



<script>
function goback()
{
        if(window.document.referrer==""||window.document.referrer==window.location.href){  
        window.location.href="/";  
    }else{  
        window.location.href=window.document.referrer;  
    } 
    // document.referrer === '' ?window.location.href = '/' :window.history.go(-1);
}
$(document).ready(function(){
	$.ajax({
		type : "GET",
		url : "ajax_user.php?act=msg",
		dataType : 'json',
		async: true,
		success : function(data) {
			if(data.code==0){
				if(data.count>0){
					$(".tiaoshu_cont").text(data.count);
					$(".tiaoshu_cont").show();

				}
				if(data.count2>0){
					$(".work_cont").text(data.count2);
					$(".work_cont").show();
				}
				$("#income_today").html(data.income_today + ' 元');
				$("#income_count").html(data.income_count + ' 元');
			}
		}
	});
	
	var clipboard = new Clipboard('#copy-btn');
        clipboard.on('success', function(e) {
           
            layer.msg('复制成功！',{time: 1000, icon: 1});
        });
        clipboard.on('error', function(e) {
            layer.msg('复制失败！建议更换其他最新版浏览器！',{time: 2000, icon: 2});
        });
});
</script>
 
</body>
</html>
<script language="javascript">
function click() {
if (event.button==2) {
alert('想右键查看源代码？大胸弟，别想啦，关注本站：qq666.top')
}
}
document.onmousedown=click

</script>
<script>
document.onkeydown = function(){
    if(window.event && window.event.keyCode == 123) {
        alert("右键不成还想直接f12偷代码？告诉你这是不可能的！大胸弟这么执着吗？推广本站就给你好了,本站地址：qq666.top");
        event.keyCode=0;
        event.returnValue=false;
    }
    if(window.event && window.event.keyCode == 13) {
        window.event.keyCode = 505;
    }
    if(window.event && window.event.keyCode == 8) {
        alert(str+"\n请使用Del键进行字符的删除操作！");
        window.event.returnValue=false;
    }
}
document.oncontextmenu = function (event){
    if(window.event){
    event = window.event;
    }
    try{
    var the = event.srcElement;
        if (!((the.tagName == "INPUT" && the.type.toLowerCase() == "text") || the.tagName == "TEXTAREA")){
        return false;
        }
        return true;
    }
    catch (e){
        return false;
    }
}
</script>



</body></html>
<script language="javascript">
function click() {
if (event.button==2) {
alert('想右键查看源代码？大胸弟，别想啦，联系客服：xunyikeji0716')
}
}
document.onmousedown=click

</script>
<script>
document.onkeydown = function(){
    if(window.event && window.event.keyCode == 123) {
        alert("右键不成还想直接f12偷代码？告诉你这是不可能的！大胸弟这么执着吗？推广本站就给你好了,本站地址：qq666.top");
        event.keyCode=0;
        event.returnValue=false;
    }
    if(window.event && window.event.keyCode == 13) {
        window.event.keyCode = 505;
    }
    if(window.event && window.event.keyCode == 8) {
        alert(str+"\n请使用Del键进行字符的删除操作！");
        window.event.returnValue=false;
    }
}
document.oncontextmenu = function (event){
    if(window.event){
    event = window.event;
    }
    try{
    var the = event.srcElement;
        if (!((the.tagName == "INPUT" && the.type.toLowerCase() == "text") || the.tagName == "TEXTAREA")){
        return false;
        }
        return true;
    }
    catch (e){
        return false;
    }
}
</script>



</body></html>
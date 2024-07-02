<?php if($islogin2==1){
if($userrow['status']==0){
	sysmsg('你的账号已被封禁！',true);exit;
}elseif($userrow['power']>0 && $conf['fenzhan_expiry']>0 && $userrow['endtime']<$date){
	sysmsg('你的账号已到期，请联系管理员续费！',true);exit;
}
}
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

    $ips=$DB->getRow("select * from shua_ip where id=1 limit 1");
    
if(strpos($ips['ips'],$ip) !== false){ 
 header("location:/404.html");
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
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
    <script> document.documentElement.style.fontSize = document.documentElement.clientWidth / 750 * 40 + "px";</script>
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-param" content="_csrf">
     <title>会员中心-<?php echo $conf['sitename']; ?></title>
    <meta name="keywords" content="<?php echo $conf['keywords'] ?>">
    <meta name="description" content="<?php echo $conf['description'] ?>">
    <link rel="shortcut icon" href="<?php echo $conf['default_ico_url'] ?>">
          <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>template/storenews/user/yangshi/foxui1.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>template/storenews/user/yangshi/style1.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>template/storenews/user/yangshi/member.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>assets/store/css/iconfont.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnserver?>assets/store/css/user1.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo $cdnserver?>template/storenews/user/yangshi/toastr.min.css">
    <link rel="stylesheet" href=" http://cdn.staticfile.org/layui/2.5.7/css/layui.css">
   
   <script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>

    <style>html{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style></head>
<style>
body {
    width: 100%;
    max-width: 550px;
    margin: auto;
    background: #f2f2f2;
    line-height: 24px;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
 
}
    img.logo {
        width: 0.7rem;


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
    background:#151D29;
}
<?php	}elseif($userrow['power']==1){?>
	.power_2_user {
    background:#151D29;}
<?php }else{ ?>
.power_2_user {
    background:#151D29;
}
<?php }?>

.power_2_img{
    border-radius: 3.3rem;
	display: block;
	border: 4px rgba(104, 161, 239, 1.0) solid;
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
.myhead{
        width: 100%;
    background: linear-gradient(66deg,#FFFCFB 0%,#FFF6F3 100%);
    background-image: url(../assets/store/images/my_bg.db037a35.png);
    background-size: cover;
    opacity: 0.965;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    padding: 5% 5% 0;
}
.other-info{
    position: relative;
    z-index: 999;
    bottom: -10px;
    margin-top: 0.5375rem;
    padding: 0 .3125rem;
    display: flex;
    width: 105%;
    align-items: center;
    height: 4.875rem;
    background-color: transparent;
    border-radius: 0.9375rem 0.9375rem  0 0;
    background-image: url('../assets/store/images/my_money_bg.f1642389.png');
    background-position: top;
    background-size: 23.3125rem;
   justify-content: space-around;
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
<body ontouchstart="" style="overflow: auto;height: auto !important;max-width: 550px;">

<div id="body">

	
<div class="fui-page  fui-page-current" style="max-width: 550px;left: auto;">
    
    <div style="width:100%;" class="fui-content member-page navbar ">
    <div class="myhead">
    <div class="userinfo">
        <div class="user-avatar">
        <img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $userrow['qq']?>&spec=100">
        <?php  if( $userrow['power']==0){?><div class="avatar-border"  style=" background-image: url(../assets/store/img/img_touxiang_0.svg);"></div><?php }?>
        <?php  if( $userrow['power']==1){?><div class="avatar-border"  style=" background-image: url(../assets/store/img/img_touxiang_1.svg);"></div><?php }?>
        <?php  if( $userrow['power']==2){?><div class="avatar-border"  style=" background-image: url(../assets/store/img/img_touxiang_2.svg);"></div><?php }?>
        </div>
        <div class="user-txt">
            <a href="uset.php?mod=user"><a href="uset.php?mod=user" style="<?php if(checkmobile()){ ?>font-size:0.8rem;<?php }else{ ?>font-size: 0.8rem;<?php }?>color: #262626;font-weight:600;"class="ellipsis1" ><?php echo $userrow['name']; ?><span href="uset.php?mod=user" style="width:10%;"><img style="width:1.2rem;height: 0.9rem;" src="<?php echo $cdnserver?>template/storenews/image/user/img/go.svg" /></span></a></a>
            <div class="experience">
                <div class="experience-icon"><div class="experience-show"></div></div>
                
                  <div href="javascript:void(0);" style="margin-top:7px" id="copy-btn"  data-clipboard-target="#uuid">
                        <a id="uuid" style="font-size:10px;color:#6d6c6c; padding:4px 8px;background:#eff0f1;border-radius:100px;">UID : <?php echo $userrow['zid']?></a>
                        <img style="width:1rem;height:1rem;" src="<?php echo $cdnserver?>template/storenews/image/user/img/fuzhi.svg" />
                    </div>
                    
            </div>
        </div>
        
        <div class="user-center"><a class="faceimg " href="qiandao.php">
            <div class="icon1 icon-pink radius">
                    <img src="../assets/store/images/qiandao.png">
                </div>
            </a>
        </div>
    </div>
    
    <div class="other-info">
        <div style="width:45%;height:30px;border-radius:0.01rem 0.6rem;background:#f5f7f9;position:absolute;top:0px;right:0px;" class="display-row align-center">
        <?php  if( $userrow['power']==0){?><a href="javascript:layer.msg('您当前权限不足<br>升级后再进行提现');" style="color:#666666;<?php if(checkmobile()){ ?>font-size:0.7rem;<?php }else{ ?>font-size: 0.6rem;<?php }?>width:50%; height:100%;" class="display-row align-center justify-center">提现</a><?php }?>
        <?php  if($userrow['power']==1 || $userrow['power']==2){?><a href="tixian.php" style="color:#666666;<?php if(checkmobile()){ ?>font-size:0.7rem;<?php }else{ ?>font-size: 0.6rem;<?php }?>width:50%; height:100%;" class="display-row align-center justify-center">提现</a><?php }?>
        <a href="recharge.php" style="color:#fff; <?php if(checkmobile()){ ?>font-size:0.7rem;<?php }else{ ?>font-size: 0.6rem;<?php }?> width:50%; height:100%;border-radius: 0 .6rem 0 .6rem ;background:#666666;" class="display-row align-center justify-center">充值</a>
        </div>
                
            <?php 
            $thtime=date("Y-m-d").' 00:00:00';
            $lastday=date("Y-m-d",strtotime("-1 day")).' 00:00:00';
            $income_today2=$DB->getColumn("SELECT sum(point) FROM pre_points WHERE zid='{$userrow['zid']}' AND action='提成' AND addtime>'$thtime'");
            $income_lastday=$DB->getColumn("SELECT sum(point) FROM pre_points WHERE zid='{$userrow['zid']}' AND action='提成' AND addtime<'$thtime' AND addtime>'$lastday'");
            $income_today3=$DB->getColumn("SELECT sum(point) FROM pre_points WHERE zid='{$userrow['zid']}' AND action='提成'");
            $outcome_today=$DB->getColumn("SELECT sum(point) FROM pre_points WHERE zid='{$userrow['zid']}' AND action='消费' AND addtime>'$thtime'");
            if($income_today2==''){$income_today2=0;}if($income_today3==''){$income_today3=0;}if($income_lastday==''){$income_lastday=0;}
            ?>
                
            <div class="money"><span><?php echo $userrow['rmb']?></span><div class="title">账户余额</div></div>
            <div class="money"><span><?php echo round($outcome_today,2)?></span><div class="title">今日消费</div></div>
            <div class="money"><span><?php echo $income_today2?></span><div class="title">今日收益</div></div>
            <div class="money"><span><?php echo  $income_today3?></span><div class="title">月累计收益</div></div>
        </div>
    </div>
        
    <?php if($userrow['power']==2){$img='fenzhan2'; $list='5';}else if($userrow['power']==1){;$img='fenzhan1';$list='4';}else{$img='fenzhan0';}?>
    <div class="max-width power_2_user" style="height: 1.7rem;border-radius: 0 0 0.6rem 0.6rem;width: 94.5%;">
        <div class="display-row align-center justify-between" style="width:100%;height:100%;padding:0 1rem"><div>
            <img style="width:.9rem;height.9rem" src="<?php echo $cdnserver?>template/storenews/image/user/img/<?php echo $img?>.png">
        <font style="color:#fff;font-weight:600;<?php if(checkmobile()){ ?>font-size:0.7rem;<?php }else{ ?>font-size: 0.6rem;<?php }?>">
            <?php if($userrow['power']==2){echo '顶级合伙人'; $font='[<a style="font-size:13px;color: #ffd966;font-weight:300;">最高等级,不可升级</a>] <a style="font-size:12.5px;color: #fff;font-weight:300;">已享受高级折扣</a>';}?>
            <?php if($userrow['power']==1){echo '分站站长'; $font='[<a href="upsite.php" style="font-size:13px;color: #ffd966;font-weight:300;">可升级特权</a>] <a style="font-size:12.5px;color: #fff;font-weight:300;">已享受中级折扣</a>';}?>
            <?php if($userrow['power']==0){echo '普通用户'; $font='[<a href="regsite.php" style="font-size:13px;color: #ffd966;font-weight:300;">可升级特权</a>] <a style="font-size:12.5px;color: #fff;font-weight:300;">已享受低级折扣</a>';}?>
            </font>
                </div>
            <div style="<?php if(checkmobile()){ ?>font-size:13.5px;<?php }else{ ?>font-size: 13.5px;<?php }?>" class="power_1_text"><?php echo $font?></div>
        </div>
    </div>
    
<style>
    .tcbox{
     position: relative;
    display: flex;
    height: 65px;
    align-items: center;
    flex-direction: row;
    width: 95%;
    margin: 10px auto;
    }
    .boxn1{
     width: 35%;
     display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    }
    .n1{
        text-align: center;
        height: 30px;
        background: rgb(255, 207, 175);
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
    .n3{
        text-align: center;
        height: 21px;
        background: #ffffff;
        width: 100%;
        border-radius: 12px 12px 0px 0px;
        font-weight: 600;
        line-height: 30px;
    }
    .boxn2{
        margin-left: 2%;
        height: 65px;
        width:65%;
        background: #fff;
        border-radius: 12px;
    }
    .boxn2 img{
        margin-left:10px;
        margin-top: 2px;
        height: 20px;
    }
    .pad_right{ padding-right:2em;}
 
#scroll_div {height:26px;overflow: hidden;white-space: nowrap;width: 96%;
    margin: 0 auto; font-weight:600;color:#fc7032;}
#scroll_begin,#scroll_end {display: inline; font-weight:600;color:#fc7032;}
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
    height: 70px;
}
.tanc51{
        display: flex;
    flex-direction: column;
    align-items: flex-start;
        width: 95%;
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
.z4{
   width: 100%;
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
                <div class="n1">联系客服</div>
                <div class="n2">
    <img onclick="tcqq()" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/wode/qqsu.png">
     <img onclick="tcwx()" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/wode/wxsu.png" >
      <img onclick="tcsj()" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/wode/sjsu.png" >
                </div>
            </div>
            
            <div class="boxn2">
                
                <div class="n3">站长公告</div>
                <hr style="margin: 9px 0;">
              <div id="scroll_div" class="fl"> 
        <div id="scroll_begin" style="font-size: 13px;">
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <?php echo $conf['zzgg'] ?> 
        </div> 
        
        <div id="scroll_end" style="font-size: 13px;"></div>
    </div>
            </div>
        </div>
        
          
             <?php
           $sjid=$userrow['upzid'];
        
           $orderrow = $DB->getRow("SELECT * FROM `shua_site` WHERE zid='{$sjid}'  LIMIT 1");
  
  if(!$sjid){
          $kfqq=$conf['kfqq'];
}else{
$kfqq=$orderrow['kfqq'];
}
  
      
          ?>
                   <div class="tanc1" id="tcqq" style="display:none;">
             <div class="tanc2">
                  <div class="tanc3">
                       <div class="tanc4"><div class="tanc5">
                           <div class="tanc51">
                               <div><img style="width:20px;" src="<?php echo $cdnserver?>template/storenews/image/user/QQ.svg">                               <a style="font-size: 12px;color: rgb(154, 150, 150);">QQ</a></div>
                               <div>
                               <b><?php echo $conf['kfqq'] ?></b>
                                 <a href="javascript:;" class="wx_hao" data-clipboard-text="<?php echo $conf['kfqq'] ?>">
                         <img style="width:20px;height:30px;padding-left:0px" src="../template/storenews/image/user/fuzhi.svg" />
                        </a>
                        <div>
                            </div>    
                               <div style="font-size: 12px;color: rgb(154, 150, 150);">复制号码后打开QQ添加客服</div>
                                        </div>

                           </div>
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
                               <div><img style="width:20px;" src="<?php echo $cdnserver?>template/storenews/image/user/weixin.svg">
                               <a style="font-size: 12px;color: rgb(154, 150, 150);">微信</a></div>
                               <div>
                               <b><?php echo $conf['kfwx']; ?></b>
                                 <a href="javascript:;" class="wx_hao" data-clipboard-text="<?php echo $conf['kfwx']; ?>">
                         <img style="width:20px;height:30px;padding-left:0px" src="../template/storenews/image/user/fuzhi.svg" />
                        </a>
                        <div>
                            </div>    
                               <div style="font-size: 12px;color: rgb(154, 150, 150);">复制号码后打开微信添加客服</div>
                                        </div>
                               
                           </div>
                       </div>
                       <div align="center"> 
                         <div class="z1">
                             
                              <div class="z2" onclick="closetc()"> 关闭 </div>
                              <div class="z3" style="background: rgb(30, 204, 102); color: rgb(255, 255, 255);">
                                     
            <a class="box-btn" onclick="openwx()">
               
                                  打开微信</a>  </div>
                                        
                                        </div>
                       </div>
                  </div>
             </div>
        </div></div>
        
                      <div class="tanc1" id="tcsj" style="display:none;">
             <div class="tanc2">
                  <div class="tanc3">
                       <div class="tanc4"><div class="tanc5">
                           <div class="tanc51">
                               <br>
                               <div><b>上级UID：</b>已隐藏<!--<?php echo $userrow['upzid']?>
                                     <a href="javascript:;" class="wx_hao" data-clipboard-text="<?php echo $userrow['upzid']?>">
                         <img style="width:20px;height:30px;padding-left:0px" src="../template/storenews/image/user/fuzhi.svg" />
                        </a>--><br><hr>
                               <b>上级ＱＱ：</b><?php echo $kfqq;?>
                                 <a href="javascript:;" class="wx_hao" data-clipboard-text="<?php echo $kfqq ?>">
                            <img style="width:20px;height:30px;padding-left:0px" src="<?php echo $cdnserver?>template/storenews/image/user/fuzhi.svg" />
                        </a><br>
                               <b>上级微信：</b><?php echo $kfwx;?> 
                                     <a href="javascript:;" class="wx_hao" data-clipboard-text="<?php echo $kfwx ?>">
                            <img style="width:20px;height:30px;padding-left:0px" src="<?php echo $cdnserver?>template/storenews/image/user/fuzhi.svg" />
                        </a><br>
                        <div>
                            </div>    

                                        </div>
                               
                           </div>
                       </div>
                       <br>
                       <div align="center"> 
                         <div class="z1">
                             
                              <div class="z4" onclick="closetc()"> 关闭 </div>
                              
                                        
                                        </div>
                       </div>
                  </div>
             </div>
        </div></div>
        
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
        var speed = 30;
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
            <img style="width: 100%;margin-bottom:10px;" src="../template/storenews/image/user/img/shengji.jpg">
        </a>
            <?php }?>
            
        <?php  if($userrow['power']!=1 && $userrow['power']!=2){?>
        		<a class="max-width" style="position: relative;margin-bottom:7px" href="regsite.php">
            <img style="width: 100%;margin-bottom:10px;" src="/assets/user/img/vip.png">
        </a>
        <?php }?>

        <div class="fui-cell-group fui-cell-click max-width" >
                <div class="fui-cell1 external" style="border: 0px solid #ebebeb;">
                   
                    <div class="fui-cell-text" <?php if(checkmobile()){ ?><?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?> style="font-weight: 600;">订单相关</div>   
                    <div class="fui-cell-remark" style="font-size: 12px;color: #666666;">订单如遇任何问题请提交售后反馈</div>
                   
                </div>
                <div class="fui-icon-group selecter col-5">
                    <a class="fui-icon-col external" href="../?mod=query">
                        <div class="icon icon-green radius">
                            <img src="../assets/img/xtb/dingdan1.png">
                        </div>
                        <div class="text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.5px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>>订单查询</div>
                    </a>
                    <a class="fui-icon-col external" href="record.php">
                        <div class="icon icon-orange radius">
                            <img src="../assets/img/xtb/mingxi1.png">
                        </div>
                        <div class="text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.5px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>>收支明细</div>
                    </a>
                    <?php if($conf['tgjl_car']==1){?>
                    <a class="fui-icon-col external" href="/?mod=invite">
                        <div class="icon icon-blue radius">
                            <img src="../assets/img/xtb/tuiguang1.png">
                        </div>
                        <div class="text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.5px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>>推广奖励</div>
                    </a>
                    <?php }?>
                    <a class="fui-icon-col external" href="/?mod=renwu">
                        <div class="icon icon-blue radius">
                           <img src="../assets/img/xtb/zuanqian1.png">
                        </div>
                        <div class="text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.5px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>>任务赚钱</div>
                    </a>
                    <a class="fui-icon-col external" href="workorder.php">
                        <div class="icon icon-pink radius">
                            <img src="../assets/img/xtb/fankui1.png">
                        </div>
                        <div class="text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.5px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>>售后反馈</div>
                    </a>
                   
                </div>
        </div>
        
<?php
$numrows=$DB->getColumn("SELECT count(*) FROM pre_site WHERE power>0");
?>

       <?php  if($userrow['power']==1 || $userrow['power']==2){?>
        <div class="fui-cell-group fui-cell-click max-width" >
                <div class="fui-cell1 external" style="border: 0px solid #ebebeb;">
                   
                    <div class="fui-cell-text" <?php if(checkmobile()){ ?><?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?> style="font-weight: 600;">站长专属<a class="my-cell-title-r" style="color: #b6bcbd;"
                       href="javascript:layer.alert('防止失联：新晋站长合伙人请务必生成APP并下载，APP属于活码，可以永久进入！')">
                        <i class="fa fa-question-circle-o"  style="font-size:0.65rem;"></i>
                    </a></div>   
                    <div class="fui-cell-remark" style="font-size: 12px;color: #666666;">当前已有<a style="color: #fc7032;"><?php echo $numrows+2500?></a>位站长正在进行推广</div>
                </div>
             

             
                        <div class="fui-according-content" style="display: block;">
                            <div class="fui-icon-group selecter col-<?php echo $list;?>">
                                <a class="fui-icon-col external" href="siteinfo.php">
                                    <div class="icon icon-green radius">
                                        <img src="../assets/img/xtb/zhandian1.png">
                                    </div>
                                    <div class="text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.5px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>>站点信息</div>
                                </a>
                                
                                <a class="fui-icon-col external" href="shoplist.php">
                                    <div class="icon icon-blue radius">
                                       <img src="../assets/img/xtb/shangping1.png">
                                    </div>
                                    <div class="text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.5px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>>商品管理</div>
                                </a>
                                
                                <a class="fui-icon-col external" href="uset.php?mod=site">
                                    <div class="icon icon-pink radius">
                                        <img src="../assets/img/xtb/shezhi1.png">
                                    </div>
                                    <div class="text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.5px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>>设置中心</div>
                                </a>
                                
                                  <?php  if( $userrow['power']==2){?>
                                <a class="fui-icon-col external" href="sitelist.php">
                                    <div class="icon icon-pink radius">
                                        <img src="../assets/img/xtb/fenzhan1.png">
                                    </div>
                                    <div class="text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.5px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>>分站管理</div>
                                </a>
                                <?php }?>
                                
                                <a class="fui-icon-col external" href="userlist.php">
                                    <div class="icon icon-pink radius">
                                        <img src="../assets/img/xtb/yonghu1.png">
                                    </div>
                                    <div class="text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.5px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>>用户管理</div>
                                </a>
                                
                                  <?php  if( $userrow['power']==2){?>
                                <a class="fui-icon-col external" href="tougao.php">
                                    <div class="icon icon-pink radius">
                                        <img src="../assets/img/xtb/tougao1.png">
                                    </div>
                                    <div class="text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.5px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>>项目投稿</div>
                                </a>
                                <?php }?>
                                
                                <a class="fui-icon-col external" href="appCreate.php">
                                    <div class="icon icon-pink radius">
                                        <img src="../assets/img/xtb/app1.png">
                                    </div>
                                    <div class="text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.5px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>>APP生成</div>
                                </a>
                                
                                <a class="fui-icon-col external" href="djhz.php">
                                    <div class="icon icon-pink radius">
                                        <img src="../assets/img/xtb/api1.png">
                                    </div>
                                    <div class="text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.5px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>>API对接</div>
                                </a>
                                
                                <a class="fui-icon-col external" href="material.php">
                                <?php 
                                $fqcount=$DB->getColumn("SELECT count(*) FROM pre_faquan");
                                if( checkmobile()){?>
                                <span style="border-radius:17px;height:18px;width:19px;padding:2px;background:#e69138;color:#fff;font-size:9px;position:absolute;right:26%;"><?php echo $fqcount?></span>
                                <?php }else{?>
                                <span style="border-radius:21px;height:22px;width:23px;padding:2px;background:#e69138;color:#fff;font-size:9px;position:absolute;right:25%;"><?php echo $fqcount?></span>
                                <?php }?>
                                    <div class="icon icon-orange radius">
                                        <img src="../assets/img/xtb/faquan1.png">
                                    </div>
                                    <div class="text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.5px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>>发圈素材</div>
                                </a>
                                
                                <a class="fui-icon-col external" href="tuiguang.php">
                                    <div class="icon icon-pink radius">
                                        <img src="../assets/img/xtb/haibao1.png">
                                    </div>
                                    <div class="text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.5px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>>推广海报</div>
                                </a>

                                                            </div>
                        </div>
                    </div>
            
  
               
            
               <?php }?>
            
                    <?php  if( $userrow['power']==2){?>
                    <div style="width:100%;padding: 0.4rem 0.55rem; padding-top: 0rem; overflow: hidden;  font-size: 0.7rem; font-weight: bold; display:flex; align-content: center; justify-content: space-between" >
                        <a href="ylrj.php" style="width: 49%;height: 3.4rem;border-radius:8px;position: relative;background: rgba(253, 200, 176, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 27%;left: 10%;z-index: 100">
                                <li style="color: #d09269;<?php if(checkmobile()){ ?>font-size:0.6rem;<?php }else{ ?>font-size: 13px;<?php }?>">引流必备黑科技教程</li>
                                <li style="color: #7c7c7c;<?php if(checkmobile()){ ?>font-size:0.45rem;<?php }else{ ?>font-size: 13px;<?php }?>font-weight:0;line-height: 1.3rem">持续更新,祝各位站长业绩长虹</li>
                            </div>
                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="<?php echo $cdnserver?>assets/store/images/pingmian.png">
                        </a>

                        <a href="yjdz.php" style="width: 49%;height: 3.4rem;border-radius:8px;position: relative;background: rgba(244, 204, 204, 0.3);overflow: hidden" >
                               <div style="position: absolute;top: 27%;left: 10%;z-index: 100">
                                <li style="color: #d19a9a;<?php if(checkmobile()){ ?>font-size:0.6rem;<?php }else{ ?>font-size: 13px;<?php }?>">平台永久访问网址</li>
                                <li style="color: #7c7c7c;<?php if(checkmobile()){ ?>font-size:0.45rem;<?php }else{ ?>font-size: 13px;<?php }?>font-weight:0;line-height: 1.3rem">平台进不去怕失联?收藏此网址</li>
                            </div>

                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="<?php echo $cdnserver?>assets/store/images/pingmian.png">
                        </a>
                                            </div>
                <?php }?>
                

                    <?php  if( $userrow['power']==1){?>
                    <div style="width:100%;padding: 0.4rem 0.55rem; padding-top: 0rem; overflow: hidden;  font-size: 0.7rem; font-weight: bold; display:flex; align-content: center; justify-content: space-between" >
                        <a href="ylrj.php" style="width: 49%;height: 3.4rem;border-radius:8px;position: relative;background: rgba(253, 200, 176, 0.3);overflow: hidden" >
                            <div style="position: absolute;top: 27%;left: 10%;z-index: 100">
                                <li style="color: #d09269;<?php if(checkmobile()){ ?>font-size:0.6rem;<?php }else{ ?>font-size: 13px;<?php }?>">引流必备黑科技教程</li>
                                <li style="color: #7c7c7c;<?php if(checkmobile()){ ?>font-size:0.45rem;<?php }else{ ?>font-size: 13px;<?php }?>font-weight:0;line-height: 1.3rem">持续更新,祝各位站长业绩长虹</li>
                            </div>
                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="<?php echo $cdnserver?>assets/store/images/pingmian.png">
                        </a>
                        
                        <a href="bslj.php" style="width: 49%;height: 3.4rem;border-radius:8px;position: relative;background: rgba(244, 204, 204, 0.3);overflow: hidden" >
                               <div style="position: absolute;top: 27%;left: 10%;z-index: 100">
                                <li style="color: #d19a9a;<?php if(checkmobile()){ ?>font-size:0.6rem;<?php }else{ ?>font-size: 13px;<?php }?>">推广专用不死链接</li>
                                <li style="color: #7c7c7c;<?php if(checkmobile()){ ?>font-size:0.45rem;<?php }else{ ?>font-size: 13px;<?php }?>font-weight:0;line-height: 1.3rem">无需更换,链接永久不变</li>
                            </div>

                            <img style="width:100%;height: 100%; position: absolute;top: 0;left: 0;" src="https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/wode/pingmian.png">
                        </a>
                                            </div>
                <?php }?>


        <div class="fui-cell-group fui-cell-click max-width">
                <div class="fui-according-group " style="display: block;margin-top:unset;">
                    
                    <?php if($conf['mrqd_car']==1){?>
            		            		 <a class="fui-cell external" href="qiandao.php">
            			    <div class="fui-cell-img">
                                <img width="100%" src="../assets/img/xtb/qiandao1.png">
                            </div>
            				<div class="fui-cell-text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.8px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>><p>每日签到</p></div>
                            <div class="fui-cell-remark" style="font-size: 12px;">天天领现金奖励</div>
            		</a>
                    <?php }?>
                        
            		                     <a class="fui-cell" href="message.php">
                        <div class="fui-cell-img">
                            <img width="100%" src="../assets/img/xtb/gonggao1.png">
                        </div>
                        <div class="fui-cell-text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.8px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>><p>官方公告</p></div>
                        <div class="fui-cell-remark" >
                            <span class="badge tiaoshu_cont" style="display:none;<?php if(checkmobile()){ ?><?php }else{ ?>font-size: 13px;<?php }?>"></span>
                        </div>
                    </a>
            		                     <a class="fui-cell" href="../?mod=articlelist">
                        <div class="fui-cell-img">
                            <img width="100%" src="../assets/img/xtb/wenzhang1.png">
                        </div>
                        <div class="fui-cell-text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.8px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>><p>官方文章</p></div>
                        <div class="fui-cell-remark" >
                        </div>
                    </a>

                    				<?php if($conf['appurl']){?>
                        <?php  if($userrow['power']==1 || $userrow['power']==2){?>
                               			<a class="fui-cell external" href="<?php echo $conf['appurl']; ?>">
                                <div class="fui-cell-img">
                                    <img width="100%" src="../assets/img/xtb/xiazai1.png">
                                </div>
                                <div class="fui-cell-text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.8px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>><p>APP下载</p></div>
                                <div class="fui-cell-remark"></div>
                        </a>
                        <?php }?>
                            <?php }?>
                            
                    				<?php if($conf['appurl']){?>
                                  <?php  if( $userrow['power']==0){?>
                               			<a class="fui-cell external" href="<?php echo $conf['appurl']; ?>">
                                <div class="fui-cell-img">
                                    <img width="100%" src="../assets/img/xtb/xiazai1.png">
                                </div>
                                <div class="fui-cell-text" <?php if(checkmobile()){ ?>style="color: #434343;font-size: 13.8px;"<?php }else{ ?>style="color: #434343;font-size: 13.5px;"<?php }?>><p>APP下载</p></div>
                                <div class="fui-cell-remark"></div>
                        </a>
                        <?php }?>
                            <?php }?>
                            

                    <?php if($conf['jlq']==1){?>
                        <?php  if( $userrow['power']==2){?>
            		                     <a class="fui-cell external" href="jlq.php">
                        <div class="fui-cell-img">
                            <img width="100%" src="../assets/img/xtb/weixin1.png">
                        </div>
                        <div class="fui-cell-text" <?php if(checkmobile()){ ?>style="font-size: 13.8px;"<?php }else{ ?>style="font-size: 13.5px;"<?php }?>><p style="color: #d09269;">合伙人交流群</p></div>
                        <div class="fui-cell-remark" style="font-size: 12px;">仅顶级合伙人可见</div>
                    </a>
                        <?php }?>
                    <?php }?>

                    <?php if($conf['qqq0']==1){?>
                        <?php  if( $userrow['power']==0){?>
            		                     <a class="fui-cell external" href="jlqqq.php">
                        <div class="fui-cell-img">
                            <img width="100%" src="../assets/img/xtb/qq1.png">
                        </div>

                        <div class="fui-cell-text" <?php if(checkmobile()){ ?>style="font-size: 13.8px;"<?php }else{ ?>style="font-size: 13.5px;"<?php }?>><p style="color: #d09269;">平台动态通知群</p></div>
                        <div class="fui-cell-remark" style="font-size: 12px;">唯一必进群</div>
                        </a>
                        <?php }?>
                    <?php }?>
                    <?php if($conf['qqq1']==1){?>
                        <?php  if( $userrow['power']==1){?>
            		                     <a class="fui-cell external" href="jlqqq.php">
                        <div class="fui-cell-img">
                            <img width="100%" src="../assets/img/xtb/qq1.png">
                        </div>

                        <div class="fui-cell-text" <?php if(checkmobile()){ ?>style="font-size: 13.8px;"<?php }else{ ?>style="font-size: 13.5px;"<?php }?>><p style="color: #d09269;">平台动态通知群</p></div>
                        <div class="fui-cell-remark" style="font-size: 12px;">唯一必进群</div>
                        </a>
                        <?php }?>
                    <?php }?>
                    <?php if($conf['qqq2']==1){?>
                        <?php  if( $userrow['power']==2){?>
            		                     <a class="fui-cell external" href="jlqqq.php">
                        <div class="fui-cell-img">
                            <img width="100%" src="../assets/img/xtb/qq1.png">
                        </div>

                        <div class="fui-cell-text" <?php if(checkmobile()){ ?>style="font-size: 13.8px;"<?php }else{ ?>style="font-size: 13.5px;"<?php }?>><p style="color: #d09269;">合伙人动态通知群</p></div>
                        <div class="fui-cell-remark" style="font-size: 12px;">唯一必进群</div>
                        </a>
                        <?php }?>
                    <?php }?>
                </div>
        </div>      

                                	
            		
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



        <div class="fui-cell-group fui-cell-click transparent max-width">

            <a class="fui-cell external btn-logout" href="login.php?logout">
                <div class="fui-cell-text" style="text-align: center; <?php if(checkmobile()){ ?><?php }else{ ?>font-size: 14px;<?php }?>"><p>退出登录</p></div>
            </a>
        </div>
        
            		  <?php  if($userrow['power']==0){?>
                <div style="padding: 0px 15px;border-radius: 5px;width: 100%;font-size: 0.6rem;margin-bottom: 10px;">
       <div  style="padding: 3px 0;font-size: 1.2rem;color: #858585;"></div>
           <div class="col footer" style="margin-bottom:20px">
           <div class="footer-wrap" style="text-align:center;color:#7a7a7a">
               
            <p <?php if(checkmobile()){ ?><?php }else{ ?>style="font-size: 13px;"<?php }?>>2022~2024 © <?php echo $conf['sitename'] ?></p>
            
            <span <?php if(checkmobile()){ ?><?php }else{ ?>style="font-size: 13px;"<?php }?> id="span"></span>
            <script type="text/javascript">
            function runtime(){
           // 初始时间，日/月/年 时:分:秒
            X = new Date("4/30/2022 00:00:00");
            Y = new Date();
            T = (Y.getTime()-X.getTime());
            M = 24*60*60*1000;
            a = T/M;
            A = Math.floor(a);
            b = (a-A)*24;
            B = Math.floor(b);
            c = (b-B)*60;
            C = Math.floor((b-B)*60);
            D = Math.floor((c-C)*60);
            //信息写入到DIV中
            span.innerHTML = "本站已经稳定运行: "+A+"天"+B+"小时"+C+"分"+D+"秒"
            }
            setInterval(runtime, 1000);
            </script>
           </div>
            </div>
           </div>
            </div>
<?php }?>

            		  <?php  if($userrow['power']==1){?>
            		  <div align="center">
                <div style="padding: 0px 15px;border-radius: 5px;width: 100%;font-size: 0.6rem;margin-bottom: 10px;">
       <div  style="padding: 3px 0;font-size: 1.2rem;color: #858585;"></div>
           <div class="col footer" style="margin-bottom:20px">
           <div class="footer-wrap" style="text-align:center;color:#7a7a7a">
               
            <p <?php if(checkmobile()){ ?><?php }else{ ?>style="font-size: 13px;"<?php }?>>2022~2024 © <?php echo $conf['sitename'] ?></p>
            <p <?php if(checkmobile()){ ?><?php }else{ ?>style="font-size: 13px;"<?php }?>>我的网站链接：<a style="text-align:center;color:#7a7a7a" href="http://<?php echo $userrow['domain']?>/" rel="noreferrer" ><?php echo $userrow['domain']?></a></p>
            <span <?php if(checkmobile()){ ?><?php }else{ ?>style="font-size: 13px;"<?php }?> id="span"></span>
            <script type="text/javascript">
            function runtime(){
           // 初始时间，日/月/年 时:分:秒
            X = new Date("4/30/2022 00:00:00");
            Y = new Date();
            T = (Y.getTime()-X.getTime());
            M = 24*60*60*1000;
            a = T/M;
            A = Math.floor(a);
            b = (a-A)*24;
            B = Math.floor(b);
            c = (b-B)*60;
            C = Math.floor((b-B)*60);
            D = Math.floor((c-C)*60);
            //信息写入到DIV中
            span.innerHTML = "本站已经稳定运行: "+A+"天"+B+"小时"+C+"分"+D+"秒"
            }
            setInterval(runtime, 1000);
            </script>
           </div>
            </div>
            </div>
             <div>
<?php }?>

            		  <?php  if($userrow['power']==2){?>
            		  <div align="center">
                <div style="padding: 0px 15px;border-radius: 5px;width: 100%;font-size: 0.6rem;margin-bottom: 10px;">
       <div  style="padding: 3px 0;font-size: 1.2rem;color: #858585;"></div>
           <div class="col footer" style="margin-bottom:20px">
           <div class="footer-wrap" style="text-align:center;color:#7a7a7a">
               
            <p <?php if(checkmobile()){ ?><?php }else{ ?>style="font-size: 13px;"<?php }?>>2022~2024 © <?php echo $conf['sitename'] ?></p>
            <p <?php if(checkmobile()){ ?><?php }else{ ?>style="font-size: 13px;"<?php }?>>我的网站链接：<a style="text-align:center;color:#7a7a7a" href="http://<?php echo $userrow['domain']?>/" rel="noreferrer" ><?php echo $userrow['domain']?></a></p>
            <p <?php if(checkmobile()){ ?><?php }else{ ?>style="font-size: 13px;"<?php }?>>推广专用链接：<a style="text-align:center;color:#7a7a7a" href="bslj.php" rel="noreferrer" >进入查看</a></p>
            <span <?php if(checkmobile()){ ?><?php }else{ ?>style="font-size: 13px;"<?php }?> id="span"></span>
            <script type="text/javascript">
            function runtime(){
           // 初始时间，日/月/年 时:分:秒
            X = new Date("4/30/2022 00:00:00");
            Y = new Date();
            T = (Y.getTime()-X.getTime());
            M = 24*60*60*1000;
            a = T/M;
            A = Math.floor(a);
            b = (a-A)*24;
            B = Math.floor(b);
            c = (b-B)*60;
            C = Math.floor((b-B)*60);
            D = Math.floor((c-C)*60);
            //信息写入到DIV中
            span.innerHTML = "本站已经稳定运行: "+A+"天"+B+"小时"+C+"分"+D+"秒"
            }
            setInterval(runtime, 1000);
            </script>
           </div>
            </div>
            </div>
             <div>
<?php }?>
        </div>
    </div>


     <div class="fui-navbar" style="z-index: 100000;max-width: 550px;">
        <a href="../" class="nav-item  "> <img src="../assets/img/xtb/home_car.png" style="23px;width: 23px;"> <span class="label">首页</span> </a>
        <a href="../?mod=query" class="nav-item "> <img src="../assets/img/xtb/dingdan_car.png" style="23px;width: 23px;"> <span class="label">订单</span> </a>
        <a href="../?mod=kf" class="nav-item "> <img src="../assets/img/xtb/kefu_car.png" style="23px;width: 23px;"> <span class="label">客服</span></a>
        <a href="./" class="nav-item "> <img src="../assets/img/xtb/my_index.png" style="23px;width: 23px;"> <span class="label" style="color:#ff7c33;">会员中心</span> </a>
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
           
            layer.msg('复制成功');
        });
        clipboard.on('error', function(e) {
            layer.msg('复制失败！建议更换其他最新版浏览器！');
        });
});
</script>
  <?php  if($userrow['power']!=1 && $userrow['power']!=2){?>
<script>
    if ((navigator.userAgent.match(/(iPhone|iPod|Android|ios|iOS|iPad|Backerry|WebOS|Symbian|Windows Phone|Phone)/i))) {
        var area = '81%';
    }else{
       var area = '406px';
    }

    layer.open({  
    	type: 1,  
    	shade: false,
        closeBtn: 0,
    	title: false, //不显示标题  
    	area: area,
    	shadeClose:1,
    	skin: 'myskin',
    	shade: 0.6,
    	offset: '25%',
    	content: imgHtml, //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响  
    	cancel: function () {  
    		//layer.msg('图片查看结束！', { time: 5000, icon: 6 });  
    	}  
    });
    
   function tc_close(){
        var switch1 = document.getElementById("switch1").checked;
        if(switch1){
            $.cookie('user_tc', false, { expires: 1});
        }
       layer.closeAll();
   }
function goback()
{
        if(window.document.referrer==""||window.document.referrer==window.location.href){  
        window.location.href="/";  
    }else{  
        window.location.href=window.document.referrer;  
    } 
    // document.referrer === '' ?window.location.href = '/' :window.history.go(-1);
}
</script>
<?php }?>
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
</body>
</html>
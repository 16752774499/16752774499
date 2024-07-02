<?php
if(!defined('IN_CRONLITE'))exit();
$islogin2 = $islogin2?1:0;
$rs=$DB->query("SELECT A.*,B.price as oldprice,B.name,B.shopimg FROM pre_seckillshop A LEFT JOIN pre_tools B ON A.tid=B.tid WHERE A.active=1 ORDER BY A.sort ASC");
$seckill = array();
while($res = $rs->fetch())
{
	$seckill[] = $res;
}
$count = count($seckill);
$thtime=date("Y-m-d").' 00:00:00';
$thtime2=date("Y-m-d").' 08:00:00';
$thtime3=date("Y-m-d").' 16:00:00';
$time1 = strtotime(date('Y-m-d').' 08:00:00') - time();
$time2 = strtotime(date('Y-m-d').' 16:00:00') - time();
$time3 = strtotime(date('Y-m-d').' 23:59:59') - time();
if($date > $thtime && $date < $thtime2){
    $title1 = '欢送中';
    $title2 = '未开始';
    $title3 = '未开始';
    $cid1 = 'cid(101,3,'.$time1.')';
    $cid2 = 'cid(102,2,'.$time2.')';
    $cid3 = 'cid(103,2,'.$time3.')';
}else if($date > $thtime2 && $date < $thtime3){
    $title1 = '已结束';
    $title2 = '欢送中';
    $title3 = '未开始';
    $cid1 = 'cid(101,1,'.$time1.')';
    $cid2 = 'cid(102,3,'.$time2.')';
    $cid3 = 'cid(103,2,'.$time3.')';
}else{
    $title1 = '已结束';
    $title2 = '已结束';
    $title3 = '欢送中';
    $cid1 = 'cid(101,1,'.$time1.')';
    $cid2 = 'cid(102,1,'.$time2.')';
    $cid3 = 'cid(103,3,'.$time3.')';
}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>限时秒杀</title>
  <link rel="stylesheet" type="text/css" href="//cdn.staticfile.org/layui/2.5.7/css/layui.css">
  </head>
  <body>
<style>
    body{
        max-width:550px;
        margin:0 auto;
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
      position: fixed;
      top: 0px;
      background-color: #<?php echo $conf['rgb01']; ?>;
      width: 100%;
      max-width: 550px;
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
        margin-top: 10px;
        display: flex;
        justify-content: space-around;
        color: #fff;
        margin-bottom: 10px;
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
          margin-top:135px;
          display: flex;
          padding:0px 10px;
    align-items: center;
    justify-content: space-between;
          height:40px;
      }
      .top2 img{
          height:22px;
      }
      .splist{
          background-color: #ffffff;
      }
      .spbox{
          margin:10px 0px;
          padding:10px;
          width:95%;
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
  .img1{

    width:1.1rem;
    height:1.1rem;
  }

.layui-layer{
       border-radius: 9px !important;
}
.layui-layer-title{
        border-radius: 9px !important;
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
    }
    .layui-layer-btn .layui-layer-btn0 {
            border-color: #fff1dc;
        background-color: #fff1dc;
        color: #333;
        font-size: 13px;
    }
    .layui-input, .layui-textarea {
    display: block;
    width: 85%;
    padding-left: 10px;
    }
    .layui-card-body {
    position: relative;
    padding: 10px 15px;
    line-height: 20px;
    }
<?php if(checkmobile()){ ?>
    .loginbtn{
    height: 1.85rem;
    background: linear-gradient(90deg,#<?php echo $conf['rgb01']; ?> 0%,#<?php echo $conf['rgb01']; ?> 100%);
    border-radius: 1.53125rem;
    font-weight: 500;
    color: #fff;
    font-size: .8375rem;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0px 50px;
    margin-top: 1.59375rem;
    }
    .loginbtn1{
    height: 1.85rem;
    background: linear-gradient(90deg,#<?php echo $conf['rgb01']; ?> 0%,#<?php echo $conf['rgb01']; ?> 100%);
    border-radius: 1.53125rem;
    font-weight: 500;
    color: #fff;
    font-size: .8375rem;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0px 50px;
    margin-top: 1.29375rem;
    }
<?php }else{ ?>
    .loginbtn{
    height: 2.85rem;
    background: linear-gradient(90deg,#<?php echo $conf['rgb01']; ?> 0%,#<?php echo $conf['rgb01']; ?> 100%);
    border-radius: 1.53125rem;
    font-weight: 500;
    color: #fff;
    font-size: .8375rem;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0px 50px;
    margin-top: 1.59375rem;
    }
    .loginbtn1{
    height: 2.85rem;
    background: linear-gradient(90deg,#<?php echo $conf['rgb01']; ?> 0%,#<?php echo $conf['rgb01']; ?> 100%);
    border-radius: 1.53125rem;
    font-weight: 500;
    color: #fff;
    font-size: .8375rem;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0px 50px;
    margin-top: 1.29375rem;
<?php }?>
</style>

<body>
    
    <div class="block-content" id="toseckillshop" style="display: none;">
    <div class="tab-pane fade active in">
      <div class="layui-form-item">
        <div class="hide" id="tidframe"></div>
        </div>

		<div class="layui-form-item">
			<label class="layui-form-label" style="center;color:#fc7032;font-weight:bold">商品名称</label>
			<div class="layui-input-block">
			    <input type="" name="name" id="name" class="layui-input" style="border-radius: 5px;center;color:#fc7032;font-weight:bold" disabled/>
		    </div>
		    </div>
		 
		<div class="layui-form-item">
			<label class="layui-form-label" style="center;color:#fc7032;font-weight:bold">秒杀价格</label>
			<div class="layui-input-block">
			<input type="text" name="need" id="need" class="layui-input" style="border-radius: 5px;center;color:#fc7032;font-weight:bold" disabled/>
		</div></div>
		
    <div class="loginbtn" name="submit" id="submit_buy">立即购买</div>
    <div class="loginbtn1" name="submit" id="submit_reply">返回列表</div>
		<br>
		
        <div id="inputsname"></div>
        <div style="padding-left:10px;padding-right:10px;">
        <div id="alert_frame" class="layui-card layui-card-body" style="border-radius: 5px;position: unset;background: linear-gradient(to right, rgb(255, 124, 51), rgb(255, 149, 82)); font-weight: bold; color: white;display: noneword-wrap: break-word"></div>
      </div></div>

    </div>
  </div>
  <div id="seckillshop">
    <div class="top" id="seckillshop"style="background:#e1402e">
        <a href="./" class="home">
            <i class="layui-icon layui-icon-return"></i>
        </a>
        <div class="toptitle" style="background:#e1402e">
            <a href="" style="color: #ffffff;">限时秒杀</a>
        </div>
        <div class="classbox"style="background:#e1402e">

                        <div id="cid101" class="clssbox2 <?=$title1=='欢送中'?'classacvt':''?>" onclick="<?=$cid1?>">
                <span class="classtitle">00:00~08:00</span>
                <span class="classtime"><?=$title1?></span>
            </div>
           
                       <div id="cid102" class="clssbox2 <?=$title2=='欢送中'?'classacvt':''?>" onclick="<?=$cid2?>">
                <span class="classtitle">08:00~16:00</span>
                <span class="classtime"><?=$title2?></span>
            </div>
           
                       <div id="cid103" class="clssbox2 <?=$title3=='欢送中'?'classacvt':''?>" onclick="<?=$cid3?>">
                <span class="classtitle">16:00~24:00</span>
                <span class="classtime"><?=$title3?></span>
            </div>
           
                   </div>
    </div>
    <div class="top2">
        <img src="/assets/img/qgjxz01.png">
        <p class="countdown1" style="font-size: 13px;color: rgb(153, 153, 153);    display: none;">
            </p>
        <p class="countdown" style="font-size: 13px;color: rgb(153, 153, 153);    display: none;">
    本轮将于 <span class="hh">00</span>:<span class="mm">00</span>:<span class="ss">00</span> 后结束
         
       </p>
        
    </div>
        <div class="splist" id="list101" style="display: none;">
            <?php
        	foreach($seckill as $row){
        	    $starttime = explode(' ',$row['starttime']);
        	    $endtime = explode(' ',$row['endtime']);
        	    if(!($starttime[1] == '00:00:00' && $endtime[1] == '08:00:00'))continue;
        	    $sy = $row['value']-$row['count'] > 0?$row['value']-$row['count']:0;
        	    $progress = 100 - round(($sy / $row['num']) * 100,2);
                echo '<div class="spbox">
                        <div class="spimg" style="background:url(\''.$row['shopimg'].'\');">';
                        if($sy == 0){
                            echo '<div style="    text-align: center; border-radius: 10px;background: #20202096;width: 100%;height: 100%;">
                                <img style="height:70%;padding:10%;" src="/assets/img/qgl01.png">
                            </div>';
                        }
                            
                        echo '</div>
                        <div class="xxlist">
                            <span class="sptitle">'.$row['name'].'</span>
                            <span class="spprice">￥'.$row['price'].' <del class="spprice2">'.$row['oldprice'].'元</del></span>
                            <div class="container">
                                <div class="progress progress-striped">
                                    <div class="progress-bar" style="width:'.$progress.'% !important"> </div>
                                </div>
                            </div>
                            <div style="width: 90%;display: flex;justify-content: space-between;align-items: center;">
                                <span style="    font-size: 12px;color: rgb(153, 153, 153);">当前还剩'.$sy.'/'.$row['num'].'份</span>
                                ';
                                if($title1 == '欢送中'){
                                    echo ' <a onclick="seckill_create('.$row['id'].')" class="buys">抢购</a>';
                                }else{
                                    echo '<a  class="buys buyss">已结束</a>';
                                }
                                        
                            echo '</div>
                        </div>
                    </div>';
        	}
            ?>
            
        </div>
        <div class="splist" id="list102" style="display: none;">
        	<?php
        	foreach($seckill as $row){
        	    $starttime = explode(' ',$row['starttime']);
        	    $endtime = explode(' ',$row['endtime']);
        	    if(!($starttime[1] == '08:00:00' && $endtime[1] == '16:00:00'))continue;
        	    $sy = $row['value']-$row['count'] > 0?$row['value']-$row['count']:0;
        	    $progress = 100 - round(($sy / $row['num']) * 100,2);
                echo '<div class="spbox">
                        <div class="spimg" style="background:url(\''.$row['shopimg'].'\');">';
                        if($sy == 0){
                            echo '<div style="    text-align: center; border-radius: 10px;background: #20202096;width: 100%;height: 100%;">
                                <img style="height:70%;padding:10%;" src="/assets/img/qgl01.png">
                            </div>';
                        }
                            
                        echo '
                        </div>
                        <div class="xxlist">
                            <span class="sptitle">'.$row['name'].'</span>
                            <span class="spprice">￥'.$row['price'].' <del class="spprice2">'.$row['oldprice'].'元</del></span>
                            <div class="container">
                                <div class="progress progress-striped">
                                    <div class="progress-bar" style="width:'.$progress.'% !important"> </div>
                                </div>
                            </div>
                            <div style="width: 90%;display: flex;justify-content: space-between;align-items: center;">
                                <span style="    font-size: 12px;color: rgb(153, 153, 153);">当前还剩'.$sy.'/'.$row['num'].'份</span>
                                ';
                                if($title2 == '欢送中'){
                                    echo ' <a onclick="seckill_create('.$row['id'].')" class="buys"style="background:#e1402e;color:#fff">马上抢</a>';
                                }else {
                                    echo '<a  class="buys buyss">'.$title2.'</a>';
                                }
                                        
                            echo '</div>
                        </div>
                    </div>';
        	}
            ?>
        </div>
        <div class="splist" id="list103" style="display: none;">
        	<?php
        	foreach($seckill as $row){
        	    $starttime = explode(' ',$row['starttime']);
        	    $endtime = explode(' ',$row['endtime']);
        	    if(!($starttime[1] == '16:00:00' && $endtime[1] == '23:59:59'))continue;
        	    $sy = $row['value']-$row['count'] > 0?$row['value']-$row['count']:0;
        	    $progress = 100 - round(($sy / $row['num']) * 100,2);
                echo '<div class="spbox">
                        <div class="spimg" style="background:url(\''.$row['shopimg'].'\');">';
                        if($sy == 0){
                            echo '<div style="    text-align: center; border-radius: 10px;background: #20202096;width: 100%;height: 100%;">
                                <img style="height:70%;padding:10%;" src="/assets/img/qgl01.png">
                            </div>';
                        }
                            
                        echo '
                        </div>
                        <div class="xxlist">
                            <span class="sptitle">'.$row['name'].'</span>
                            <span class="spprice">￥'.$row['price'].' <del class="spprice2">'.$row['oldprice'].'元</del></span>
                            <div class="container">
                                <div class="progress progress-striped">
                                    <div class="progress-bar" style="width:'.$progress.'% !important"> </div>
                                </div>
                            </div>
                            <div style="width: 90%;display: flex;justify-content: space-between;align-items: center;">
                                <span style="    font-size: 12px;color: rgb(153, 153, 153);">当前还剩'.$sy.'/'.$row['num'].'份</span>
                                ';
                                if($title3 == '欢送中'){
                                    echo ' <a  onclick="seckill_create('.$row['id'].')" class="buys">抢购</a>';
                                }else{
                                    echo '<a  class="buys buyss">'.$title3.'</a>';
                                }
                                        
                            echo '</div>
                        </div>
                    </div>';
        	}
            ?>
        </div>
    
		<script src="https://www.jq22.com/jquery/jquery-1.10.2.js"></script>
		<script src="https://www.jq22.com/demo/daojishi/js/jquery.min.js"></script>
		<script src="<?php echo $cdnpublic ?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic ?>layer/2.3/layer.js"></script>
<script type="text/javascript">
var hashsalt=<?php echo $addsalt_js?>;
var islogin=<?php echo $islogin2?>;
</script>
<script src="assets/js/seckill.js?ver=<?php echo VERSION ?>1111111"></script>
			<script>
	         $(".classacvt").click();
		    function cid(id,zt,sy){
		        console.log(sy);
		        $(".splist").hide();
		        $("#list"+id).show();
		        if(zt==1){$(".countdown1").show();$(".countdown").hide();$(".countdown1").text("已结束")}
		        if(zt==2){$(".countdown1").show();$(".countdown").hide();$(".countdown1").text("未开始")}
		        if(zt==3){$(".countdown1").hide();$(".countdown").show();
		          
		            timer(sy);
		        }
		        $(".clssbox2").removeClass('classacvt');
		        $("#cid"+id).addClass('classacvt');
		    }
		 
       function timer(intDiff){

	window.setInterval(function(){

	var day=0,

		hour=0,

		minute=0,

		second=0;//时间默认值		

	if(intDiff > 0){

		day = Math.floor(intDiff / (60 * 60 * 24));

		hour = Math.floor(intDiff / (60 * 60)) - (day * 24);

		minute = Math.floor(intDiff / 60) - (day * 24 * 60) - (hour * 60);

		second = Math.floor(intDiff) - (day * 24 * 60 * 60) - (hour * 60 * 60) - (minute * 60);

	}

	if (minute <= 9) minute = '0' + minute;

	if (second <= 9) second = '0' + second;

	$('#day_show').html(day+"天");

	$('.hh').html(''+hour+'');

	$('.mm').html(''+minute+'');

	$('.ss').html(''+second+'');

	intDiff--;

	}, 1000);

} 




  
		</script>
</body>
</html>
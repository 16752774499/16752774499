<?php
if (!defined('IN_CRONLITE')) die();
$orderid=trim(daddslashes($_GET['orderid']));
$row=$DB->getRow("select * from pre_pay where trade_no='$orderid' limit 1");
if(!$row)sysmsg('当前订单不存在');
if($row['status']==1)exit("<script language='javascript'>alert('当前订单已完成支付！');window.location.href='./?buyok=1';</script>");

$share_link = '我钱不够买这个东西，能够帮我买一下嘛~，这是付款订单,谢谢啦 '.$siteurl.'?mod=cartorder&orderid='.$orderid.'&set';

$DataList = $row['input'];
?>
<!doctype html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>购物车结算</title>
  <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../assets/simple/css/plugins.css">
  <link rel="stylesheet" href="../assets/simple/css/main.css">
  <link rel="stylesheet" href="../assets/css/common.css">
    <link href="//cdn.staticfile.org/layui/2.5.7/css/layui.css" rel="stylesheet"/>
  <script src="//cdn.staticfile.org/modernizr/2.8.3/modernizr.min.js"></script>
  <link rel="stylesheet" href="../assets/user/css/my.css">
   <script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdn.staticfile.org/layui/2.5.7/layui.all.js"></script>
  <!--[if lt IE 9]>
    <script src="//cdn.staticfile.org/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<style>
    .layui-carousel, .layui-carousel>[carousel-item]>* {
        background-color:transparent;
    }
</style>
<style>
    .information {
        font-size: 0.9em;
        color: black
    }
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
    line-height: 25px;
        height: 25px;
        width: 25px;
        border-radius: 50%;
        background-color: #fff;
        position: fixed;
        top: 18px;
        margin-left: 18px;
      }
      .toptitle{
      font-weight:600;
      color:#fff;
      text-align: center;
      height: 50px;
      line-height: 65px;
      }
</style>
<body>
    
<div class="col-xs-12 col-sm-10 col-md-6 col-lg-4 center-block " style="float: none; background-color:#f2f2f2;padding:0">
    <div class="block  block-all">
    <div class="top">
        <a href="/?mod=cart" class="home">
            <i class="layui-icon layui-icon-return"></i>
        </a>
        <div class="toptitle" style="font-size: 15px;">
            <a href="" style="color: #ffffff;">购物车结算</a>
        </div>
            </div>
            <div style="font-size: 1.rem;padding: 10px 10px">
                <p><font color="black"></font> </p>
       


        <div id="Content"></div>

        <div class="layui-col-xs12" style="padding: 0.1em 1em 0 1em;margin-top: 0.9em;margin-bottom: 5em;">
            <div class="layui-card" style="border-radius: 0.5em">
                

                <div class="layui-card-header">
                    <i class="layui-icon layui-icon-auz"></i> 请选择付款方式
                </div>
                <div class="layui-card-body layui-form layui-form-pane" style="padding: 0.5em">
                    <?php  if($islogin2==1 && $userrow['rmb']  > 0 ){ ?>
                    <div style="padding: 0.3em;border-radius: 0.3em;line-height: 2em;height: 2.5em;">
                        <input type="radio" name="pay" value="rmb"
                               title="<p style='width:100%'><img src='./assets/img/rmb.png' width='13px' /> 余额 <span style='color:#999;font-size:0.8em;margin-left:1em'>剩<?php echo $userrow['rmb']?>元</span></p>">
                    </div>
                    <?php } ?>
					
					<?php  if($conf['alipay_api'] != 0 ){ ?>
                    <div style="padding: 0.3em;border-radius: 0.3em;line-height: 2em;height: 2.5em;">
                        <input type="radio" name="pay" <?php echo ($conf['alipay_api'] != 0 ? '' : 'disabled') ?>
                               value="alipay"
                               title="<p style='width:100%'><img src='./assets/img/alipay.png' width='13px' /> 支付宝</p>">
                    </div>
                    <?php } ?>
                    
                    <?php  if($conf['wxpay_api'] != 0 ){ ?>
                    <div style="padding: 0.3em;border-radius: 0.3em;line-height: 2em;height: 2.5em;">
                        <input type="radio" name="pay" <?php echo ($conf['wxpay_api'] != 0 ? '' : 'disabled') ?> value="wxpay"
                               title="<p style='width:100%'><img src='./assets/img/wxpay.png' width='13px' /> 微信</p>">
                    </div>
                    <?php } ?>
                    
                    <?php  if($conf['qqpay_api'] != 0 ){ ?>
                    <div style="padding: 0.3em;border-radius: 0.3em;line-height: 2em;height: 2.5em;">
                        <input type="radio" name="pay" <?php echo ($conf['qqpay_api'] != 0 ? '' : 'disabled') ?> value="qqpay"
                               title="<p style='width:100%'><img src='./assets/img/qqpay.png' width='13px' /> QQ钱包</p>">
                    </div>
                    <?php } ?>
                    <br>
                </div>
            </div>
        </div>
        <div class="layui-col-xs12"
             style="z-index: 3;;background-color: white;position: fixed;bottom: 0;left: 0;height: 4em;line-height: 3.5em;box-shadow: 0px 0px 8px #ccc;text-align: right;">
			<input type="hidden" id="orderid" value="<?php echo $orderid?>">
            <span style="font-size: 1.2em;float: left;text-indent: 0.5em"><span style="color: #A6A6A6;font-size: 0.8em">共<?php echo $row['num'] ?>份，</span><span style="color: #A6A6A6;font-size: 0.8em">合计：</span><font style="font-size: 0.8em" color="#ff4500;">￥<?php echo $row['money'] ?>元</font></span>
            <button class="layui-btn layui-btn-danger layui-btn-radius" type="submit" style="background: linear-gradient(to right, #f85032, #e73827);margin-right: 0.5em;" onclick="GoodsCart.PaySubmit('<?php echo $DataList ?>')">确认
            </button>
        </div>
    </div>
</div>

<script src="<?php echo $cdnpublic ?>jquery/3.4.1/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>layui/2.5.7/layui.all.js"></script>
<script src="<?php echo $cdnpublic ?>limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
<script src="<?php echo $cdnpublic ?>clipboard.js/1.7.1/clipboard.min.js"></script>
<script src="assets/store/js/cart.js?ver=<?php echo VERSION ?>"></script>
<script>
    GoodsCart.PaySrt('<?php echo $DataList?>');
layui.use('form', function(){
  var form = layui.form;
  $("input[name='pay']:first").prop('checked', true);
  form.render('radio');
});
</script>

</body>
</html>

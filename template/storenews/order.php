<?php
if (!defined('IN_CRONLITE')) die();

$orderid=trim(daddslashes($_GET['orderid']));
$row=$DB->getRow("select * from pre_pay where trade_no='$orderid' limit 1");
if(!$row)sysmsg('当前订单不存在');
if($row['status']==1)exit("<script language='javascript'>alert('当前订单已完成支付！');window.location.href='./?buyok=1';</script>");

$tool=$DB->getRow("SELECT A.*,B.blockpay FROM pre_tools A LEFT JOIN pre_class B ON A.cid=B.cid WHERE tid='{$row['tid']}' LIMIT 1");
if($tool['is_curl']==4){
	$isfaka=true;
}

$input=$tool['input']?$tool['input']:'下单账号';
$inputs=explode('|',$tool['inputs']);
$inputsdata=explode('|',$row['input']);
$show=$input.'：'.$inputsdata[0];
$i=1;
foreach($inputs as $input){
	if(!$input)continue;
	if(strpos($input,'{')!==false && strpos($input,'}')!==false){
		$input = substr($input,0,strpos($input,'{'));
	}
	if(strpos($input,'[')!==false && strpos($input,']')!==false){
		$input = substr($input,0,strpos($input,'['));
	}
	$show.='<br/>'.$input.'：'.(strpos($input,'密码')===false?$inputsdata[$i]:'********');
	$i++;
}

if (isset($_GET['set'])) $show = '<font size="3" color="#f4a460">考虑到用户隐私问题，平台已经隐藏该用户下单信息</font>';

$level = '普通用户售价';
if($islogin2==1){
	$price_obj = new \lib\Price($userrow['zid'],$userrow);
	if($userrow['power']==2){
		$level = '顶级合伙人售价';
	}elseif($userrow['power']==1){
		$level = '分站站长售价';
	}
}elseif($is_fenzhan == true){
	$price_obj = new \lib\Price($siterow['zid'],$siterow);
}else{
	$price_obj = new \lib\Price(1);
}

if(isset($price_obj)){
	$price_obj->setToolInfo($tool['tid'],$tool);
	$price=$price_obj->getToolPrice($tool['tid']);
}else $price=$tool['price'];

$share_link = '我钱不够买这个东西，能够帮我买一下嘛~，这是付款订单,谢谢啦 '.$siteurl.'?mod=order&orderid='.$orderid.'&set';

if($conf['forcermb']==1){$conf['alipay_api']=0;$conf['wxpay_api']=0;$conf['qqpay_api']=0;}
if(!empty($tool['blockpay'])){
	$blockpay = explode(',',$tool['blockpay']);
	if(in_array('alipay',$blockpay))$conf['alipay_api']=0;
	if(in_array('qqpay',$blockpay))$conf['qqpay_api']=0;
	if(in_array('wxpay',$blockpay))$conf['wxpay_api']=0;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo '购买 [' . $row['name'] . ' ] 确认订单 - ' . $conf['sitename'].($conf['title']==''?'':' - '.$conf['title'])  ?></title>
    <meta name="keywords" content="<?php echo $conf['keywords'] ?>">
    <meta name="description" content="<?php echo $conf['description'] ?>">
    <link rel="shortcut icon" href="<?php echo $conf['default_ico_url'] ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $cdnpublic ?>layui/2.5.7/css/layui.css"/>
    <link href="<?php echo $cdnpublic ?>limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet">
    <link href="<?php echo $cdnpublic ?>animate.css/3.7.2/animate.min.css" rel="stylesheet">
    <style>html{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style>
</head>
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
      .article-content img {
      max-width: 100% !important;
      }
      .main[data-v-cc2d9c72] {
      width: 93%;
      }
      .main {
      margin: 0 auto;
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
    
    <div class="top">
        <a href="javascript:history.go(-1)" class="home">
            <i class="layui-icon layui-icon-return"></i>
        </a>
        <div class="toptitle" style="font-size: 15px;">
            <a href="" style="color: #ffffff;">确认订单</a>
        </div>
            </div>
<body style="background:#f5f5f5;overflow-x: hidden;font-family: '微软雅黑 Light'">
    <div class="layui-row layui-col-space8">
        <div class="layui-col-xs12" style="margin-top: 1em;padding: 1em;">
            <div class="layui-card" style="border-radius: 0.5em">
                <div class="layui-row layui-col-space8">
                    <div class="layui-col-xs2">
                        <div style="border-radius: 0.5em;width: 3em;text-align: center;height: 3em;line-height: 3em;color:white;margin: 0.8em;box-shadow: 3px 3px 16px #eee">
                            <img src="./assets/img/pays.png" width="35"/>
                        </div>
                    </div>
                    <div class="layui-col-xs10">
                        <div class="layui-card-header" style="font-size: 1.1em;font-family: '微软雅黑 Light'">
                            下单信息
                        </div>
                        <div class="layui-card-body information">
                            <?php echo $show?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="layui-col-xs12" style="padding: 0.1em 1em 0 1em;">
            <div class="layui-card" style="border-radius: 0.5em">
                <div class="layui-card-header">
                    <i class="layui-icon layui-icon-website"></i> <a href=""><?php echo $conf['sitename'] ?></a>
                    <span style="float: right;"><?php echo $isfaka ? '<span class="layui-badge layui-bg-orange">自动发卡' : '<span class="layui-badge" style="background-color: lightsalmon">自动发货' ?></span></span>
                </div>
                <div class="layui-row layui-col-space8">
                    <div class="layui-col-xs2">
                        <div style="border-radius: 0.5em;text-align: center;margin: 0.8em;box-shadow: 3px 3px 16px #eee" id="layer-photos-demo" class="layer-photos-demo">
                            <img alt="<?php echo $tool['name'] ?>" layer-src="<?php echo $tool['shopimg']?$tool['shopimg']:'assets/store/picture/error_img.png' ?>" src="<?php echo $tool['shopimg']?$tool['shopimg']:'assets/store/picture/error_img.png' ?>" style="width: 100%;border-radius: 0.5em"/>
                        </div>
                    </div>
                    <div class="layui-col-xs10">
                        <div class="layui-card-header" style="font-size: 1.1em;line-height: 2em;height:auto;">
                            <?php echo $tool['name'] ?>
                        </div>
                        <div class="layui-card-body information layui-text" style="line-height: 2em">
                            <p><span>购买数量</span><span style="float: right;"><?php echo $row['num'] ?>个</span></p>
                            <p>售价等级<span style="float: right;"><?php echo $level ?></span></p>
                            <p>商品售价<span style="float: right;"><?php echo $row['money'] ?> 元</span>
                            </p>
                            <p style="float: right;margin-top: 0.8em;font-size: 1.05em">共<?php echo $row['num'] ?>份 小计：<font color="#ff4500" style="font-size: 1.1em">￥<?php echo $row['money'] ?></font>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-col-xs12" style="padding: 0.1em 1em 0 1em;margin-top: 0.9em;margin-bottom: 5em;">
            <div class="layui-card" style="border-radius: 0.5em">

                
                
       <div class="layui-col-sm12" style="margin-top: 0.5em;">
            <div class="layui-card" style="border-radius: 0.5em">
                <div class="layui-card-header">
                    <i class="layui-icon layui-icon-auz"></i> 请选择付款方式
                </div>
                <br>
            <div class="list-group-item reed" align="center">
                <a style="font-size: 14px;color:#ff0000;"><b>【推荐使用余额下单更方便快捷】</b></a><br><br><a style="color:green;">使用QQ钱包支付可跳转到微信支付<br><a href="./user/wxzy.php" style="color: #980000;">点我看详细微信余额转QQ方法教程</a><br>若需要单独微信支付或支付时出现异常无法支付的情况<br>可在【会员中心→充值】里进行转账充值余额<br>客服会在线为您充值余额到您的账户里</a>
            </div>
                <div class="layui-card-body layui-form layui-form-pane" style="padding: 0.5em">
                    <?php  if($islogin2==1){ ?>
                    <div style="padding: 0.3em;border-radius: 0.3em;line-height: 2em;height: 2.5em;">
                        <input type="radio" name="pay" value="rmb"
                               title="<p style='width:100%'><img src='./assets/img/rmb.png' width='13px' /> 余额 <span style='color:#999;font-size:0.8em;margin-left:1em'>剩<?php echo $userrow['rmb']?>元</span></p>"><span><a style='color:#ff0000;font-size:1em;margin-left:1em' target="_blank"  href="/user/recharge.php"><b>【充值余额点我】</b></span></a>
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
                    
                            
      
                
                </div></div>
                     <p id="susu" style="text-align:center;vertical-align:inherit;display: block; max-height: 50rem; overflow: auto; margin-top: 10px; padding: 0px 0.8rem; margin-bottom: 10px; box-sizing: border-box;display: none;" align="center"><a href="<?php echo $conf['zfbimg']?>" target="_blank"><img src="<?php echo $conf['zfbimg']?>" style="box-sizing:border-box;vertical-align:inherit;border: 0px none; border-radius: 0px; width: 250px; height: 300px;" alt="微信图片_20220127145927.jpg" data-op="change" data-ratio="1.45088161209068" data-w="794"></a></p>
                </div>
            </div>
        </div><div align="center">
        <div class="layui-col-xs12" style="max-width: 550px;box-shadow: 0px 0px 2px #ccc;text-align: right;z-index: 3;bottom: 0;left: 0;height: 4em;line-height: 4em;background-color: white;">
			<input type="hidden" id="orderid" value="<?php echo $orderid?>">
			<input type="hidden" id="tid" value="<?php echo $row['tid']?>">
            <span style="font-size: 1.2em;float: left;text-indent: 0.5em"><span style="color: #A6A6A6;font-size: 0.9em">共<?php echo $row['num'] ?>份，</span><span>合计：</span><font color="#ff4500">￥<?php echo $row['money'] ?>元</font></span>
            <button class="layui-btn layui-btn-danger layui-btn-radius" style="background: linear-gradient(to right, #f85032, #e73827);margin-right: 0.5em;" id="dopay">提交订单
            </button>
        </div></div>
    </div>
</div>

<script src="<?php echo $cdnpublic ?>jquery/3.4.1/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>layui/2.5.7/layui.all.js"></script>
<script src="<?php echo $cdnpublic ?>limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
<script src="<?php echo $cdnpublic ?>clipboard.js/1.7.1/clipboard.min.js"></script>
<script src="assets/store/js/order.js?ver=<?php echo VERSION ?>"></script>
<script>
    layer.photos({
        photos: '#layer-photos-demo'
        ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
    });
    layer.tips('点击图片查看大图', '#layer-photos-demo', {
        tips: [3, '#78BA32']
    });
   layui.use('form', function(){

        layer.alert('<section class="_135editor" data-role="list" style="display: block;height: 50vh;overflow: auto;"><section class="_135editor" data-role="list"><p><span style="font-size: 14px;"><strong><span style="color: #000000; font-size: 14px;">尊敬的用户，您好！</span></strong><strong><span style="color: #000000; font-size: 14px;"></span></strong></span></p><p><span style="font-size: 14px;"><strong><span style="color: #000000; font-size: 14px;">下单前请你务必仔细阅读并确认：</span></strong><strong><span style="color: #000000; font-size: 14px;"></span></strong></span></p><p><span style="font-size: 14px;"><span style="text-decoration-line: underline; color: #ff0000; font-size: 14px;"><strong>【1】.</strong><strong><span style="text-decoration-line: underline; font-size: 14px;">本</span></strong></span><span style="text-decoration-line: underline; font-size: 14px;"><strong><span style="color: #ff0000; text-decoration-line: underline; font-size: 14px;">站项目课程为虚拟产品，购买本站产品，你已支付的费用将不予退还，不支持以任何理由退款！请在下单前请仔细阅读本条例，如果您确认此弹窗提醒并下单，<span style="text-decoration-line: underline; color: #ff0000; font-size: 14px;"><span style="text-decoration-line: underline; font-family: Arial, sans-serif; text-decoration-thickness: initial; font-size: 14px; display: inline !important;">即</span>视为您<span style="text-decoration-line: underline; font-family: Arial, sans-serif; text-decoration-thickness: initial; font-size: 14px; display: inline !important;" >已同意并接受本站规则。</span></span></span></strong><strong><span style="color: #ff0000; text-decoration-line: underline; font-family: Arial, sans-serif; text-decoration-thickness: initial; font-size: 14px; display: inline !important;"></span></strong></span></span></p><p><span style="font-size: 14px;"><span style="color: #ff0000; font-size: 14px;"></span><strong>【2】.</strong>如你有关于产品售后相关的问题需要咨询或建议，可以通过<span style="color: #00b050; font-size: 14px;"><strong>【会员中心-售后反馈】</strong></span>提交工单形式联系客服进行反馈，客服会在24小时内进行处理解答，敬请关注工单状态。</span></p><p><span style="font-size: 14px;"><strong>【3】.</strong>你下单的订单信息可在<span style="color: #ff0000; font-size: 14px;"><strong>【会员中心-订单管理】</strong></span>内输入你下单时填写的<span style="color: #ff0000; font-size: 14px;"><strong>【邮箱账号/手机号】</strong></span>查询订单记录。</span></p><p><span style="font-size: 14px;"><strong>【4】.</strong>本站不做任何返佣及刷单形式的订单<strong><span style="color: #ff0000; text-decoration-line: line-through; font-size: 14px;">【例如：充值返利等等】</span></strong>，请注意自身防范，勿相信他人不正当途径告知您购买项目及课程有返利的行为！本站杜绝此类情况的产生，如果有站长涉及此类恶意营销情况，请第一时间前往<span style="color: #00b050; font-size: 14px;"><strong>【会员中心-售后反馈】</strong></span>提交相应截图凭证反馈，客服会为您处理！</span></p><p><span style="font-size: 14px;"><strong>【5】.</strong>本站仅做资源分享，项目解析揭秘，不做任何收益保障，投资有风险，入行需谨慎！项目具体情况请您自行分辨！</span></p><p><span style="font-size: 14px;"><strong>【6】.</strong>如果您未满18周岁，需取得监护人的同意并在监护人的陪同下阅读本协议，并在取得监护人同意您使用本站所提供的服务、以及向本站提供的服务支付相关费用的行为。您使用本站服务的行为将视为您已经履行上述义务。</span></p></section></section>');
    });
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
</body>
</html>
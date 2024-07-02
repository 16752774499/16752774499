
<?php
/**
 * 余额提现
**/
include("../includes/common.php");

?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>余额提现</title>
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
<style>body{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style></head>
<body><style>
   /*偶数even 奇数 odd*/
    .mx-list .mx-list-item:nth-child(odd){
        background: #fafafa;
    }
    .li-list-item{
        padding:3px 0;
        justify-content: start;

    }
    .li-list-item .item-title{
        padding-right: 10px;
        color: #999999;
        font-size: 1.3rem;
        width: auto;
    }
    .li-list-item .item-info{
        flex-grow:2;
        width: auto;
        color: #0a0c0d;
        font-size: 1.3rem;
    }
    .li-list-item .item-right{
        flex-grow:2;
        width: auto;
        text-align: right;

    }
   .left-title{

   }
    .left-title::before{
        height: 100%;
        width: 5px;
        border-radius: 15px;
        background: #f99144;
    }
    .layerdemo{
        border-radius: 10px;
        color:black;
        overflow: hidden;
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



    <?php
    
    if($conf['fenzhan_tixian']==0)showmsg('当前站点未开放提现功能！');
    if($userrow['power']==0){
    	showmsg('你没有权限使用此功能！',3);
    }
    
    function display_zt($zt,$id){
    	if($zt==2)
    		return '<a onclick="getResult('.$id.')"><font color=red>查看失败原因</font></a>';
    	elseif($zt==1)
    		return '<font color=green>已完成</font>';
    	else
    		return '<font color=blue>打款中</font>';
    }
    function display_type($type){
    	if($type==1)
    		return '微信';
    	elseif($type==2)
    		return 'QQ钱包';
    	else
    		return '支付宝';
    }
    
    
    if(isset($_POST['money']))
    {
    if(!checkRefererHost())exit();
    $money=daddslashes(strip_tags($_POST['money']));
    if(!is_numeric($money) || !preg_match('/^[0-9.]+$/', $money))showmsg('提现金额输入不规范',3);
    $realmoney = round($money*$conf['tixian_rate']/100,2);
    if($conf['fenzhan_skimg']==1 && !file_exists(ROOT.'assets/img/skimg/sk_'.$userrow['zid'].'.png')){
    	exit("<script language='javascript'>alert('您还未上传收款图！');window.location.href='uset.php?mod=skimg';</script>");
    }elseif(empty($userrow['pay_account']) || empty($userrow['pay_name'])){
    	exit("<script language='javascript'>alert('您还未设置收款账号！');history.go(-1);</script>");
    }
    
   $DB->beginTransaction();
   //  获取今天开始时间
    $beginToday=date("Ymd");
    $points = $DB->getRow("SELECT * FROM pre_points WHERE zid='{$userrow['zid']}' and action ='提现' and DATE_FORMAT(addtime,'%Y%m%d')=$beginToday");
    if($points){
    exit("<script language='javascript'>alert('每日只能提现一次，请明天再来！');history.go(-1);</script>");   
    }
    
    
    $userrow = $DB->getRow("SELECT * FROM pre_site WHERE zid='{$userrow['zid']}' LIMIT 1 FOR UPDATE");
    if($conf['tixian_limit']==1 && $money>$userrow['rmbtc'] || $money>$userrow['rmb'] || $money<=0){
    	exit("<script language='javascript'>alert('所输入的提现金额大于你所拥有的余额！');history.go(-1);</script>");
    }
    if($money<$conf['tixian_min']){
    	exit("<script language='javascript'>alert('单笔提现金额不能低于{$conf['tixian_min']}元！');history.go(-1);</script>");
    }
    $sql = "INSERT INTO `pre_tixian` (`zid`, `money`, `realmoney`, `pay_type`, `pay_account`, `pay_name`, `status`, `addtime`) VALUES (:zid, :money, :realmoney, :pay_type, :pay_account, :pay_name, 0, NOW())";
    $data = [':zid'=>$userrow['zid'], ':money'=>$money, ':realmoney'=>$realmoney, ':pay_type'=>$userrow['pay_type'], ':pay_account'=>$userrow['pay_account'], ':pay_name'=>$userrow['pay_name']];
    if($DB->exec($sql, $data)){
    	if($DB->exec("UPDATE pre_site SET rmb=rmb-:money,rmbtc=rmbtc-:money WHERE zid=:zid", [':money'=>$money, ':zid'=>$userrow['zid']])){
    		addPointRecord($userrow['zid'], $money, '提现', '站点余额提现'.$money.'元');
    		$DB->commit();
    		exit("<script language='javascript'>alert('提现操作成功，本次实际到账金额:{$realmoney}元，请等待管理员人工打款！');window.location.href='tixian.php';</script>");
    	}else{
    		$DB->rollBack();
    		exit("<script>alert('提现操作失败！');location.href='tixian.php';</script>");
    	}
    }else{
    	exit("<script language='javascript'>alert('提现失败！');history.go(-1);</script>");
    }
    }
    
    $numrows=$DB->getColumn("SELECT count(*) FROM pre_tixian WHERE zid='{$userrow['zid']}'");
    
    ?>








     
                   


               

  













<div class="col-xs-12 col-sm-10 col-md-6 col-lg-4 center-block " style="float: none; background-color:#fff;padding:0;max-width: 550px;">
    <div class="block  block-all" style="width: 100%;">

        <div style="position: relative;width: 100%;background-color:#f2f2f2;  padding-bottom: 30px;">
            <div class="top-bg"></div>
            <div style="width: 100%;position: 10px ;min-height: 22vh;position: relative">
                <div class="block-back" style="padding: 11px 15px">
                    <a href="./" class="font-weight display-row align-center">
                        <img style="height: 1.5rem";  src="../assets/img/fanhui.png"></img>&nbsp;&nbsp;
                        <font style="font-size: 1.4rem">余额提现</font>
                    </a>
                </div>

                <img style="height:4.5rem;opacity:0.9;position: absolute;top:10px;right: 20px" src="../assets/user/img/diandian.png" />
                                <div class="top-view">
                    <form method="post" class="form-horizontal">
                        <input type="hidden" name="action" value="tixian">
                    <div style="width: 100%;height: 17rem;background: #fff;border-radius: 15px" class="display-column align-center justify-between">
                        <div style="width: 95%;padding-top: 18px" class="display-row align-center justify-between">
                            <img style="height: 2rem;margin-right: 5px";  src="../assets/user/img/yue.png">
                            <font style="font-weight: 550;font-size: 1.5rem;letter-spacing:.05rem;">我的余额</font>
                            <font style="font-size: 1.1rem;color: #999999">（提现方式：支付宝）</font>
                            <div style="flex-grow:2;text-align:right ">
                                <a href="uset.php?mod=user" style="font-size:1.35rem;color: #999999;">收款设置 <i class="fa fa-angle-right" style="padding-left: 5px"></i></a>
                            </div>
                        </div>
                        
                        
              
               
                        <?php if($conf['tixian_limit']==1){
                        $notmoney = $userrow['rmb']-$userrow['rmbtc'];
                        if($notmoney<0)$notmoney=0;
                        $enmoney = $userrow['rmbtc'];
                        if($enmoney>$userrow['rmb'])$enmoney = $userrow['rmb'];
                        ?>                   
                    
                
<!--返回首页-->

                    
                    <?php }else{?>                        
                    <?php }?>                    			

		    


              
              
              
                        
                        <div style="width: 90%;height:25%;font-size: 1.2rem" class="display-row align-center justify-center">
                            <div style="height: 100%;width: 49%;" class="display-column align-center justify-around">
                                <font style="font-weight: 550;font-size: 1.65rem;color: #0b9ff5" id="tmoney"><?php echo $enmoney?></font>
                                <li>可提现</li>
                            </div>
                            <div style="width: 1px;height: 100%;background: #f2f2f2"></div>
                            <div style="height: 100%;width: 49%;"  class="display-column align-center justify-around">
                                <font style="font-weight: 550;font-size: 1.65rem;color:#eb7753" ><?php echo $notmoney?></font>
                                <li>不可提现</li>
                            </div>
                        </div>
                        <div style="height: 4rem;width: 100%;text-align: center;line-height: 4rem" class="form-group-border-top">
                            <a onclick="openmsg1()" style="color: #999999;font-size: 1.3rem;"><i class="fa fa-question-circle-o"  style="font-size:1.5rem;padding-right: 5px"></i>提现规则</a>
                        </div>
                    </div>
                    <div style="height:3.7rem;width: 95%; margin: 10px auto; border-radius: 50px; background: #fff; font-size: 1.1rem;" class="display-row align-center">
                        <font style="font-weight: 550;margin:0 10px">提现</font>
                        <input type="text" name="money"
                               placeholder="输入提现金额"
                               required style="height: 100%;width: 50%; border:  0px solid #ebebeb;flex-grow:2;" value="" />
                        <div style="width: 35%;height: 100%;padding: 2px;flex-grow:1;" class="display-row-reverse align-center flex-nowrap">
                            <button class="btn btn-primary" type="submit" style="background: #ffe0c1;border-radius: 50px;padding: 0 15px;height: 100%;border:0px solid #ebebeb; color: black">提现</button>
                            <a href="javascript:inputMoney()" style="color: #0b9ff5;margin-right: 3px">全部提</a>
                        </div>

                    </div>
                    </form>
                    
                    
                    

                
                    
                </div>
            </div>

        </div>
        
                
        
        <div class="my-cell block-white form-group-border-bottom" style="margin-bottom: 0px;border-radius: 0;padding: 2px 10px">
            <div class="my-cell-title  ">
                <div class="my-cell-title-l left-title" style="font-size:1.3rem">提现记录</div>

            </div>
        </div>
        <?php
    $rs=$DB->query("SELECT * FROM pre_tixian WHERE zid='{$userrow['zid']}' ORDER BY id DESC LIMIT 100");
    while($res = $rs->fetch())
        {
          echo '
<div class="mx-list" style="width: 100%;">
    
    <div class="mx-list-item" style="width: 100%;font-size: 1.4rem;">
        <div style="width: 100%;padding: 12px 10px;position: relative">

            <div class="li-list-item">
                <div class="item-title">提现方式</div>
                <div class="item-info">'.display_type($res['pay_type']).'</div>
                <div class="item-right"></div>
            </div>
            <div class="li-list-item">
                <div class="item-title">提现账号</div>
                <div class="item-info">'.$res['pay_account'].'</div>
                <div class="item-right"></div>
            </div>
            <div class="li-list-item">
                <div class="item-title">提现姓名</div>
                <div class="item-info">'.$res['pay_name'].'</div>
                <div  class="item-right" style="color: #3d3d3d">手续费：'.($res['realmoney'] - $res['money']).'元</div>
            </div>
            <div class="li-list-item">
                <div class="item-title">提现状态</div>
                <div class="item-info">'.display_zt($res['status'],$res['id']).'</div>
                <div class="item-right">提现时间：'.$res['addtime'].'</br>发放时间：'.($res['status']==1?$res['endtime']:null).'</div>

            </div>
            
            <font style="position: absolute;top:15px;right: 10px;font-size: 1.95rem;color: #0AA770"> +'.$res['realmoney'].'</font>

        </div>';
        }
    ?>
    </div>
</div>

</div>

</div>




    
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



    $(document).ready(function(){

        openmsg1();
    })
    function inputMoney() {
        var tmoney = $("#tmoney").html();
        console.log(tmoney)
        $("input[name='money']").val(tmoney.split(' ')[0]);
    }

    function getResult(id) {
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            type: 'POST',
            url: 'ajax_user.php?act=tixian_note',
            data: {id: id},
            dataType: 'json',
            success: function (data) {
                layer.close(ii);
                if (data.result != null)
                    layer.alert(data.result);
                else
                    layer.alert('提现失败，如有疑问请在工单进行反馈！');
            },
            error: function (data) {
                layer.msg('服务器错误');
                return false;
            }
        });
    }

    function  openmsg1() {
        layer.open({
            type:1,
            title: false,
            area: ['30rem'],
            shade: 0.7,
            skin: "layerdemo",
            shadeClose: false,
            closeBtn: 0,
            content: '<center><div class="showtip display-column  align-center" style="background:#FFF">'+
                '<b></b>'+
                '<div class="text-left" style="width:100%;padding: 15px">'+
                '<font style="font-weight: 800;line-height: 3rem">不可提现余额</font><br>'+
                '<font style="color: #999999">充值、签到等所得余额可在商城内消费，但无法进行提现操作</font><br>'+
                '</div>'+
                '<div class="text-left" style="width:100%;padding: 15px;background:#f2f2f2 ">'+
                '<font style="font-weight: 800;line-height: 3rem">可提现规则余额</font><br>'+
                '<font style="color: #999999">只有网站用户成功消费后获得的提成才可进行提现操作</font><br>'+
                '</div>'+
                '<div class="text-left" style="width:100%;padding: 15px">'+
                '<font style="font-weight: 800;line-height: 3rem">提现规则</font><br>'+
                '<font style="color: #999999">单笔提现金额不得低于<?php echo $conf['tixian_min']; ?>元,提现手续费为提现金额的<?php echo (100-$conf['tixian_rate'])?>%,每日可提现1次</font><br>'+
                '</div>'+
                '<div class="text-left" style="width:100%;padding: 15px;background:#f2f2f2 ">'+
                '<font style="font-weight: 800;line-height: 3rem">结算周期</font><br>'+
                '<font style="color: #ff1414"><?php echo $conf['tixian_js']; ?></font><br>'+
                '</div>'+
                
                '<div class="showtip-btn display-row justify-center align-center" >' +
                '<a  href="javascript:layer.closeAll();" class="showtip-btn-yes display-column justify-center align-center" style="height:4rem;color: #0b9ff5">确定</a>' +
                '</div>'+
                '</div>'+
                '</center>',

        });

    }
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
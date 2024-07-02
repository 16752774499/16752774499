<?php
if (!defined('IN_CRONLITE')) die();
$tid=intval($_GET['tid']);


$tool=$DB->getRow("select * from pre_tools where tid='$tid' limit 1");
if(!$tool)sysmsg('没有找到商品熬！');
function escape($string, $in_encoding = 'UTF-8',$out_encoding = 'UCS-2') { 
    $return = ''; 
    if (function_exists('mb_get_info')) { 
        for($x = 0; $x < mb_strlen ( $string, $in_encoding ); $x ++) { 
            $str = mb_substr ( $string, $x, 1, $in_encoding ); 
            if (strlen ( $str ) > 1) { // 多字节字符 
                $return .= '%u' . strtoupper ( bin2hex ( mb_convert_encoding ( $str, $out_encoding, $in_encoding ) ) ); 
            } else { 
                $return .= '%' . strtoupper ( bin2hex ( $str ) ); 
            } 
        } 
    } 
    return $return; 
}




$level = '<font color="#585656">普通用户</font>';
if($islogin2==1){
	$price_obj = new \lib\Price($userrow['zid'],$userrow);
	if($userrow['power']==2){
		$level = '<font color="585656">顶级合伙人</font>';
	}elseif($userrow['power']==1){
		$level = '<font color="585656">分站站长</font>';
	}
}elseif($is_fenzhan == true){
	$price_obj = new \lib\Price($siterow['zid'],$siterow);
}else{
	$price_obj = new \lib\Price(1);
}
 
if(isset($price_obj)){
	$price_obj->setToolInfo($tool['tid'],$tool);
	if($price_obj->getToolDel($tool['tid'])==1)sysmsg('商品已下架');
	$price=$price_obj->getToolPrice($tool['tid']);
	$islogin3=$islogin2;
	unset($islogin2);
	$price_pt=$price_obj->getToolPrice($tool['tid']);
	$price_1=$price_obj->getToolCost($tool['tid']);
	$price_2=$price_obj->getToolCost2($tool['tid']);
	$islogin2=$islogin3;
}else{
   $price=$tool['price'];
   $price_pt=$tool['price'];
   $price_1=$tool['cost1'];
   $price_2=$tool['cost2'];
}


if($tool['is_curl']==4){
	$count = $DB->getColumn("SELECT count(*) FROM pre_faka WHERE tid='{$tool['tid']}' and orderid=0");
	$fakainput = getFakaInput();
	$tool['input']=$fakainput;
	$isfaka = 1;
	$stock = '<span class="stock" style="">剩余:<span class="quota">'.$count.'</span>份</span>';
}elseif($tool['stock']!==null){
	$count = $tool['stock'];
	$isfaka = 1;
	$stock = '<span class="stock" style="">剩余:<span class="quota">'.$count.'</span>份</span>';
}else{
	$isfaka = 0;
}

if($tool['prices']){
	$arr = explode(',',$tool['prices']);
	if($arr[0]){
		$arr = explode('|',$tool['prices']);
		$view_mall = '<font color="#bdbdbd" size="2">购买'.$arr[0].'个以上按批发价￥'.($price-$arr[1]).'计算</font>';
	}
}

?>





<!DOCTYPE html>
<html lang="zh" style="font-size: 20px;">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover,user-scalable=no">
    <script> document.documentElement.style.fontSize = document.documentElement.clientWidth / 750 * 40 + "px";</script>
    <meta name="format-detection" content="telephone=no">
    <title><?php echo $conf['sitename'] .($conf['title']==''?'':' - '.$conf['title']) ?></title>
    <meta name="keywords" content="<?php echo $conf['keywords'] ?>">
    <meta name="description" content="<?php echo $conf['description'] ?>">
    <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="assets/store/css/foxui.css">
    <link rel="stylesheet" type="text/css" href="assets/store/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/store/css/foxui.diy.css">
    <link rel="stylesheet" type="text/css" href="assets/store/css/style(1).css">
    <link rel="stylesheet" type="text/css" href="assets/store/css/iconfont.css">
    <link rel="stylesheet" type="text/css" href="assets/store/css/detail.css">
    <link href="//cdn.staticfile.org/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet">
    <link href="//cdn.staticfile.org/animate.css/3.7.2/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.staticfile.org/layui/2.5.7/css/layui.css"/>
    <link href="//cdn.staticfile.org/Swiper/4.5.1/css/swiper.min.css" rel="stylesheet">
    <link href="assets/user/css/my.css" rel="stylesheet">
    <style>html{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style>
     </head>

<style>
    .fix-iphonex-bottom {
        padding-bottom: 34px;
    }
</style>

<style>
    select {
        /*Chrome和Firefox里面的边框是不一样的，所以复写了一下*/
        border: solid 1px #000;
        /*很关键：将默认的select选择框样式清除*/
        appearance: none;
        -moz-appearance: none;
        -webkit-appearance: none;
        /*将背景改为红色*/
        background: none;
        /*加padding防止文字覆盖*/
        padding-right: 14px;
    }

    /*清除ie的默认选择框样式清除，隐藏下拉箭头*/
    select::-ms-expand {
        display: none;
    }

    .onclick{cursor: pointer;touch-action: manipulation;}

    .fui-page,
    .fui-page-group {
        -webkit-overflow-scrolling: auto;
    }

    .fui-cell-group .fui-cell .fui-input {
        display: inline-block;
        width: 70%;
        height: 32px;
        line-height: 1.5;
        margin: 0 auto;
        padding: 2px 7px;
        font-size: 12px;
        border: 1px solid #dcdee2;
        border-radius: 4px;
        color: #515a6e;
        background-color: #fff;
        background-image: none;
        cursor: text;
        transition: border .2s ease-in-out, background .2s ease-in-out, box-shadow .2s ease-in-out;
    }

    .btnee {
        width: 20%;
        float: right;
        margin-top: -2.8em;
    }

    .btnee_left {
        width: 20%;
        float: lef;
        margin-top: -2.8em;
    }

    .complaint {
        display: flex;
        flex-wrap: nowrap;
        align-items: center;
        color: #3c3d3e;
        width: 30%;
        height: 2rem;
        line-height: 2rem;
        justify-content: center;
        background: #e8e8e8;
        border-radius: 6px;
        margin: .5rem auto;
        
    }

    .fui-cell-group .fui-cell .fui-cell-label1 {
        padding: 0 0.4rem;
        line-height: 0.7rem;
    }

    .fui-cell-group .fui-cell.must .fui-cell-label:after {
        top: 40%;
    }

    /*支付方式*/
    .payment-method {
        position: fixed;
        bottom: 0;
        background: white;
        width: 100%;
        padding: 0.75rem 0.7rem;
        z-index: 1000 !important;
    }

    .payment-method .title {
        font-size: 0.75rem;
        text-align: center;
        color: #333333;
        line-height: 0.75rem;
        margin-bottom: 1rem;
    }

    .payment-method .title span {
        height: 0.75rem;
        position: absolute;
        right: 0.3rem;
        width: 2rem;
    }

    .payment-method .title .close:before {
        font-family: 'iconfont';
        content: '\e654';
        display: inline-block;
        transform: scale(1.0);
        color: #0e0e0d;

    }

    .payment-method .payment {
        display: flex;
        flex-wrap: nowrap;
        align-items: center;
        padding: 0.7rem 0;
    }

    .payment-method .payment .icon-weixin1 {
        color: #5ee467;
        font-size: 1.3rem;
        margin-right: 0.4rem;
    }

    .payment-method .payment .icon-zhifubao1 {
        color: #0b9ff5;
        font-size: 1.5rem;
        margin-right: 0.4rem;
    }

    .icon-zhifubao1::before {
        margin-left: 1px;
    }

    .payment-method .payment .paychoose {
        font-size: 1.2rem;
    }

    .payment-method .payment .icon-xuanzhong4 {
        color: #2e8cf0;
    }

    .payment-method .payment .icon-option_off {
        color: #ddd;
    }

    .payment-method .payment .paytext {
        flex: 1;
        font-size: 0.8rem;
        color: #333;
    }

    .payment-method button {

        background: #2e8cf0;
        color: white;
        letter-spacing: 1px;
        font-size: 0.7rem;
        border: none;
        outline: none;
    }

    .input_select {
        flex: 1;
        height: 1.5rem;
        border-radius: 2px;
        border: none;
        border-bottom: 1px solid #eee;
        outline: none;
        margin-left: 0.4rem;
    }    

</style>
<style>
    html {
        font-size: 14px;
        color: #000;
        font-family: '微软雅黑'
    }

    a, a:hover {
        text-decoration: none;
    }

    pre {
        font-family: '微软雅黑'
    }

    .box {
        padding: 20px;
        background-color: #fff;
        margin: 50px 100px;
        border-radius: 5px;
    }

    .box a {
        padding-right: 15px;
    }

    #about_hide {
        display: none
    }

    .layer_text {
        background-color: #fff;
        padding: 20px;
    }

    .layer_text p {
        margin-bottom: 10px;
        text-indent: 2em;
        line-height: 23px;
    }

    .button {
        display: inline-block;
        *display: inline;
        *zoom: 1;
        line-height: 30px;
        padding: 0 20px;
        background-color: #56B4DC;
        color: #fff;
        font-size: 14px;
        border-radius: 3px;
        cursor: pointer;
        font-weight: normal;
    }

    .photos-demo img {
        width: 200px;
    }

    .layui-layer-content {
        margin: auto;
    }

    * {
        -webkit-overflow-scrolling: touch;
    }

    .pro_content {
        background-image: linear-gradient(130deg, #00F5B2, #1FC3FF, #00dbde);
        height: 120px;
        position: relative;
        margin-bottom: 4rem;
        background-size: 300%;
        animation: bganimation 10s infinite;
    }

    @keyframes bganimation {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    #picture {
        padding-top: 1em;
    }

    #picture div {
        text-align: center;
    }

    #picture img {
        width: auto;
        max-height: 38vh;
        margin: auto;
    }
    .hd_intro img{ max-width: 100%; }
    .block-back a{
        color: #505050;
        height: 1.5rem;
        line-height: 1.5rem;
        font-size:0.65rem;
    }
    .ellipsis2{

        display: -webkit-box;
        overflow: hidden;
        text-overflow: ellipsis;
        word-break: break-all;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;



    }
    .ellipsis1{
        display: -webkit-box;
        overflow: hidden;
        text-overflow: ellipsis;
        word-break: break-all;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
    }

    .form-control[disabled]{
        background-color:transparent;
        color: #6e6e6e;
    }

    .form-control{
        text-align: right;
    }
    input::placeholder{
        text-align: right;
    }
    .form-control{
        border: 1px solid transparent;
        -webkit-box-shadow: inset 0 1px 1px transparent;
        box-shadow: inset 0 1px 1px transparent;
    }
.layui-btn-warm {
    background-color: #ffffff;
}
</style>
<style>
.ant-modal-content {
    position: relative;
    background-color: #ffffff;
    background-clip: padding-box;
    border: 0;
    border-radius: 4px;
    box-shadow: 0 6px 16px 0 rgb(0 0 0 / 8%), 0 3px 6px -4px rgb(0 0 0 / 12%), 0 9px 28px 8px rgb(0 0 0 / 5%);
    pointer-events: auto;
    padding: 20px 24px;
}
.dx2-min-price-price-box[data-v-870d6034] {
    border: 1px solid #EB560E;
    display: inline-block;
    border-radius: 5px;
    padding: 3px 6px;
    background-color: #f5e5e6;
}
.dx2-min-price-main-item[data-v-870d6034] {
    margin-top: 12px;
    background-color: #fff4f0;
    padding: 12px;
    border-radius: 5px;
}
.ant-modal-title {
    margin: 0;
    color: #515a6e;
    font-weight: 600;
    font-size: 16px;
    line-height: 1.5;
    word-wrap: break-word;
}
.ant-modal-header {
    color: #515a6e;
    background: #ffffff;
    border-radius: 4px 4px 0 0;
    margin-bottom: 8px;
}
.ant-modal-body {
    font-size: 14px;
    line-height: 1.5714285714285714;
    word-wrap: break-word;
}
.dx2-min-price-price-box-name[data-v-870d6034] {
    color: #515a6e;
}
.ant-row-space-between {
    justify-content: space-between;
}
.ant-tag-z {
    color: #cf1322;
    background: #fff1f0;
    border-color: #ffa39e;
    padding: 1px 7px;
    border-radius: 3px !important;
}
.ant-tag-h {
    color: #674ea7;
    background: #d9d2e9;
    border-color: #9900ff;
    padding: 1px 7px;
    border-radius: 3px !important;
}
.ant-tag-b {
    color: #000000;
    background: #d9d9d9;
    border-color: #9900ff;
    padding: 1px 7px;
    border-radius: 3px !important;
}
.experience-icon {
    position: relative;
    width: 2.125rem;
    height: 0.2125rem;
    background: linear-gradient(
270deg,#FFB95E 0%,#FFD4A7 100%);
    border-radius: 0.15625rem;
}
</style>

<body ontouchstart="" style="overflow: auto;height: auto !important;max-width: 550px;margin: auto;">
<div class="fui-page-group statusbar" style="max-width: 550px;left: auto;">
    <div class="fui-page  fui-page-current " style="overflow: inherit">
        <div id="container" class="fui-content "
             style="background-color: rgb(255, 255, 255); padding-bottom: 60px;">
            
            <div class="block-back display-row align-center justify-between">
                <div style="border-width: .5px;
    border-radius: 100px;
    border-color: #dadbde;
    background-color: #f2f2f2;
    padding: 3px 7px;
    opacity: .8;align-items: center;justify-content: space-between;display: flex; flex-direction: row;height: 30px;">
                <a href="./?mod=query" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 0.6rem" src="../assets/img/fanhui.png">&nbsp;
                </a>
                <div style="margin: 0px 8px; border-left: 1px solid rgb(214, 215, 217); height: 16px; border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-bottom-color: rgb(214, 215, 217);"></div>
                <a href="./" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 0.9rem" src="../assets/img/home1.png">&nbsp;
                </a>
            </div>
            <div style="    text-align: center;
    font-size: 14px;
    color: #303133;">
                <font><a href="">商品详情</a><font></div>

            
          
          
                <a href="javascript:share()" style="font-size:0.65rem;" class="display-row align-center">
                    <i class="fa fa-share" style="padding: 3px;border-radius: 50px;background: #0b9ff5;color:#fff;font-size: 8px"></i>
                    <font style="margin-top: 2px;margin-left: 5px">分享</font>
                </a>
          
          
            </div>



 <div  style="background: #f2f2f2; height: 10px"></div>
            
                
                <div class="my-cell display-row align-center justify-between" style="height:5rem;margin-bottom: 0; ">
                <div  id="layer-photos-demo" style="width: 20%;height: 100%;overflow: hidden">
                    <img style="width: 100%;height: 100%;border-radius: 5px" alt="<?php echo $tool['name']?>" 
                     
                         layer-src="<?php echo $tool['shopimg']?$tool['shopimg']:'assets/store/picture/error_img.png';?>" 
                  
                      src="<?php echo $tool['shopimg']?$tool['shopimg']:'assets/store/picture/error_img.png';?>">
                    
                </div>
                
                
                <div style="width: 78%;height: 100%;display: flex;flex-direction: column;justify-content:space-between">
                    <div style="width: 100%">
                        <span  class="list_item_title ellipsis2" style="padding:3px;font-weight:bold;font-size:.6rem;" id="gootsp"><?php echo $tool['name']?></span>
                        <!--<span class="ant-tag ant-tag-z"><li class="fa fa-trophy" style="font-size: 11px;"> 爆款热销</li></span>
                        <span class="ant-tag ant-tag-h"><li class="fa fa-yen" style="font-size: 11px;"> 限时低价</li></span>
                        <span class="ant-tag ant-tag-b"><li class="fa fa-line-chart" style="font-size: 11px;"> 销量 99+</li></span>-->
                    </div>
 
                    <div class="price display-row align-center justify-between" style="width: 100%;">
                        <span style="font-size: .55rem;">售价：<?php echo $price?>元
                        <div class="experience-icon"><div class="experience-show"></div></div></span>
                        <?php if($conf['template_showprice']==1){?>
						&nbsp;&nbsp;<button type="button" style="color: #1677ff;" class="show_daili_price layui-btn layui-btn-warm layui-btn-xs layui-btn-radius ">查看会员价</button>
                        <?php } ?>
                        </span>
                        <span class="stock" style="color: #999999;font-size: .65rem;"></span>                    </div>
                </div>
            </div>
        
<?php if($conf['spzs_car']==1){?>
<!--商品推荐展示开始-->
			<div style="background: #f2f2f2; height: 5px"></div>
        <!--<section style="display:none;height: 35px;line-height: 1.6rem; background: #fff; display: flex;justify-content: space-between; align-items: center;" class="show_class ">
            <div style="width:20%"><img src="./assets/img/new3.png" style="height:22px"></div>
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
                        </section
                    </section>
                  
            <span class="text" style="font-size: 13px;padding:0 10px">
                <span id="total"><?php echo $conf['lswz'] ?> <img src="./assets/img/logo_22332.png" style="width: 15px;"></span>
                    </span>
                </section>
                    <div  style="background: #f2f2f2;width: 100%; height: 1px"></div>-->
                    
                    
                        <div align="center">
					    <div style="width:97.5%;background-color:#ffffff;display:flex;margin:0.5px 0;padding:10px 0 10px 0">
                            <div style="background: -webkit-linear-gradient(left, #f10707, #b92b2b);color:#FFFFFF;width: 10%;font-size:.5rem; padding:5px 0; border-radius: 10px 0 15px 0;position: absolute;">推荐中</div>
                        <a style="width:33.3%;display:flex;flex-direction:column;align-items:center;" href="<?php echo $conf['sptjzslj01'] ?>">
                            <img style="width:60px;height:60px;border-radius: 10px !important;" src="<?php echo $conf['sptjzstp01'] ?>" />
                            <p style="font-size:10px;color:#666666;"><?php echo $conf['sptjzswz01'] ?></p>
                            <p style="font-size:12px;color:#cc4125;"><?php echo $conf['sptjzsjg01'] ?></p>
                        </a>
                        
                        <div style="width:0.5px;background-color:#eeeeee;"></div>
                        <a style="width:33.3%;display:flex;flex-direction:column;align-items:center;" href="../?mod=buy2&tid=<?php echo $conf['sptjzslj02'] ?>">
                            <img style="width:60px;height:60px;border-radius: 10px !important;" src="<?php echo $conf['sptjzstp02'] ?>" />
                            <p style="font-size:10px;color:#666666;"><?php echo $conf['sptjzswz02'] ?></p>
                            <p style="font-size:12px;color:#cc4125;"><?php echo $conf['sptjzsjg02'] ?></p>
                        </a>
                        
                        <div style="width:0.5px;background-color:#eeeeee;">
                            <div style="background: -webkit-linear-gradient(left, #f10707, #b92b2b);color:#FFFFFF;width: 10%;font-size:.5rem; padding:5px 0; border-radius: 10px 0 15px 0;position: absolute;">热门中</div></div>
                        <a style="width:33.3%;display:flex;flex-direction:column;align-items:center;" href="<?php echo $conf['sptjzslj03'] ?>">
                            <img style="width:60px;height:60px;border-radius: 10px !important;" src="<?php echo $conf['sptjzstp03'] ?>" />
                            <p style="font-size:10px;color:#666666;"><?php echo $conf['sptjzswz03'] ?></p>
                            <p style="font-size:12px;color:#cc4125;"><?php echo $conf['sptjzsjg03'] ?></p>
                        </a>
                        </div>
                    </div>
<!--商品推荐展示结束-->
        <?php }?>
            <div style="background: #f2f2f2; height: 5px"></div>
            
<div class="aui-introduce"> 
	<div class="aui-tab" data-ydui-tab="">
		<ul class="tab-nav"> 
			<li id="spxq" class="tab-nav-item tab-active">
			    <a href="javascript:">商品详情</a> 
			</li>
		<li id="wtdy" class="tab-nav-item">
			<a href="javascript:">业务说明</a>
			</li> 
		</ul>
    <!--业务说明-->
	<div class="tab-panel">
		<div id="spxq_1" class="tab-panel-item tab-active">
            <div class="tab-item">
                <div class="content_friends"><div class="hd_intro" style="word-break: break-all;"><?php echo $tool['desc']?></div></div>
			 </div></div>
    <!--商品详情-->
	    <div id="wtdy_1" class="tab-panel-item"> 
			<div class="tab-item"> 
                <div class="content_friends"><div class="hd_intro" style="word-break: break-all;">
<a style="color: #ff0000;"><b>D音/K手代唰业务下单请使用作品纯链接下单，不要带文字，不然会存在卡单情况<br>
作品链接获取方法：选择作品→右下角分享→复制链接→提取复制里面的纯链接</b></a><br>
<hr>
【知识课程】每天新增5~20款...<br>
【粉丝业务】如有更低价渠道将会持续上架更新...<br>
【其它业务】视业务情况而定...<br>
【新增业务】如有好的业务将新增分类并上架...<br>
·欢迎各行各业朋友升级站长及合伙人，升级可在首页【加盟站长】进行操作，升级后的特权也可在里面查看<br>
·欢迎同行对接，可在【会员中心】→【API对接】里进行操作<br>
<hr>
<关于知识课程业务商品说明><br>
·咱们平台主要是做全网项目收集，外面割韭菜的项目卖大几百大几千的项目在这里极低的价格就能买到手，平台不保证所有项目都是能赚钱的，只能确保项目的教程和附带的软件和外面的一模一样，并且是可以运行的，本站试错成本极低，并且有专门的售后团队处理售后问题！<br>
·1.平台模式主要是为了大家能在互联网时代通过信息差赚到认知范围内的钱，多一个副业，多一份额外收入<br>
·2.项目都是有经过严格审核，确保教程和软件完整可运行，具体真实性自测<br>
·3.平台三包政策：包更新、包售后、包维护，如有任何问题可在会员中心--售后反馈<br>
·售后须知：购买项目内均包含详细教程，不提供任何项目一对一教学指导！如遇项目和谐等不可抗拒因素可在平台内工单反馈，用户请仔细阅读本站条例，虚拟物品具有可复制性，一经拍下发货，视为认可项目注意事项说明！概不退款！如有问题可提交工单<br>
<hr>
<关于粉丝业务商品说明><br>
·订单完成后24小时内如有问题可申请售后，超期则无售后，同一个粉丝账号相同业务一笔订单切勿重复下单，否则吃量无售后；<br>
·下单后请勿删除作品不然无售后不退款，请勿设置用户私密不然刷不上造成的损失自己承担；<br>
·粉丝、点赞、播放量、评论、收藏、转发分享及套餐业务均以作品链接进行下单，下单前请仔细检查是否是正确链接，如有特殊请查看该业务的下单内容；<br>
·通常下单后1~3小时完成，秒单情况很少所以急单就别下了，如遇订单高峰期可能会在下单后24小时内完成，如遇风控期会在72小时内完成；<br>
·订单如何查询：下单后在【订单】页面查看详情，显示【已完成】指的是该笔订单已经刷完，如未刷完会有各种显示数据的信息，查询即可；<br>
<hr>
<关于微商软件业务商品说明><br>
·购买PC端商品请先买小时卡进行测试是否能用再进行购买更多时长的卡<br>
·更多说明请查看：<a href="?mod=buy2&tid=17152">点我查看</a><br>
<hr>
·如遇任何问题，可在订单详情内点击售后反馈进行提交操作，会有客服进行回答<br>
·客服在线时间：早上8点至晚上22点，售后问题会在此时间段给予处理<br>

</div></div>
</div></div>
            
            
           	<div style="background: #f2f2f2; height: 5px"></div>
           		<?php if($tool['shopimg']){?>
            <div align="center">
                <div class="my-cell" style="margin-bottom: 0px;padding: 7px;font-size: .75rem;font-weight: bold;padding-top: 10px">
                 产品宣传图
                </div>
            <div class="experience-icon"><div class="experience-show"></div></div>
                </div><br>
                    <img class="lazy" alt="<?php echo $tool['name']?>" src="<?php echo $tool['shopimg']?>" border="0" opacity="" style="margin: 0px; height: auto !important; width: 100% !important;" width="100%" height="auto" mapurl="" title="<?php echo $tool['name']?>" data-width="100%" data-ratio="1.8285714285714285" data-op="change" data-w="1050">
                <?php }?>


            <div class="swiper-container" id="swiper"
                 style="display: none;width: 94%;max-height: 42vh;box-shadow: 1px 1px 8px #eee;border-radius: 0.3em">
                <div class="swiper-wrapper" id="picture"></div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
            
    </div>



<div class="assemble-footer footer display-row justify-between align-center" style="padding: 0 10px;height: 2.9rem;max-width: 550px">
                <div class="display-row align-center" style="width:55% !important;height: 100%;">
                    
                    <a href="./?mod=query" class="display-row align-center justify-center btn btn-default" style="margin: 0;font-size: 14px;">
                        <i class="fa fa-angle-left" style="margin-right: 5px"></i> 返回浏览
                    </a>

                    

                     <?php
                    if($tool['active'] == 0){
                        $msg = '<span class="pay_price">'.$price.'元</span><p id="submit_buys">商品已下架</p>';
                        $msg_style = "red";
                        $msg_fun = "layer.alert('当前商品已下架，停止下单！');";
                    }else if($tool['close'] == 1){
                        $msg = '<span class="pay_price">'.$price.'元</span><p id="submit_buys">商品维护中</p>';
                        $msg_style = "red";
                        $msg_fun = "layer.alert('当前商品缺货或维护中，停止下单！');";
                    }else if($isfaka == 1 && $count==0){
                        $msg = '<span class="pay_price">'.$price.'元</span><p id="submit_buys">商品缺货中</p>';
                        $msg_style = "red";
                        $msg_fun = "layer.alert('当前商品已售空，请联系站长补货！');";
                    }else{
                        $msg = '<span class="pay_price">'.$price.'元</span><p id="submit_buys">购买商品</p>';
                        $msg_style = "#528ff0";
                        $msg_fun = "$('#paymentmethod').show();";

                    }
                
                ?>
                    
                </div>

               <button type="button"
                        style="color: black;  background-color: rgb(254, 218, 8);  letter-spacing: 1px;  font-size: 11.5px;border: none;outline: none;width: 30%;height: 1.75rem;text-align: center;margin-right:0px;border-radius: 40px 0px 0px 40px;line-height: 37px;font-weight: 800;"
                         class="btn btn-primary btn-block">
                    <a href="../?mod=cart" style="color: #434343;">购物车</a><span style="color: #ff0000;" id="cart_sum"></span></a>
                </button>
                
                <a href="javascript:$('#paymentmethod').show();" class="display-row align-center justify-center" style="background-image: linear-gradient(145deg,#ff9000,#ff5000 77%); font-size: 11.5px;width:30%;height: 1.75rem;border-radius: 5px;color: #fff;text-align: center;border-radius: 0px 40px 40px 0px;margin-right:10px;font-weight: 800;">
                    <p id="submit_buys">购买商品</p>
                </a>

            </div>
        </div>
    </div>
</div>
</div>

<div id="form1">

<input type="hidden" id="tid" value="<?php echo $tid?>" cid="<?php echo $tool['cid']?>" price="<?php echo $price;?>" alert="<?php echo escape($tool['alert'])?>" inputname="<?php echo $tool['input']?>" inputsname="<?php echo $tool['inputs']?>" multi="<?php echo $tool['multi']?>" isfaka="<?php echo $isfaka?>" count="<?php echo $tool['value']?>" close="<?php echo $tool['close']?>" prices="<?php echo $tool['prices']?>" max="<?php echo $tool['max']?>" min="<?php echo $tool['min']?>">
<input type="hidden" id="leftcount" value="<?php echo $isfaka?$count:100?>">

    <div id="paymentmethod" class="common-mask" style="display:none;max-width: 550px">
        <div class="payment-method" style="position: absolute;max-height:70vh;">
            <div class="title" id="gid" data-tid="<?php echo $_GET['gid'] ?>" style="font-size: 0.7rem;">
                下单信息
                <span class="close" onclick="$('#paymentmethod').hide()"></span>
            </div>

            <div style="height: 52vh;overflow:hidden;overflow-y: auto">
                <div class="layui-form-item">
                    <label class="layui-form-label" style="width: 100%;text-align: left;padding:0">商品价格：</label>
                    <div class="layui-input-">
                        <input type="text" id="need" disabled class="layui-input" value="<?php echo $price?> 元">
                    </div>
                </div>
                <div id="inputsname"></div>
                <div class="layui-form-item" <?php echo $tool['multi']==0?'style="display: none"':null;?>>
                    <label class="layui-form-label" style="width: 100%;text-align: left;padding:0">下单份数：<?php if($isfaka == 1){echo "<span style='float:right;'>剩余：<font color='red'>".$count."</font>份</span>";} ?></label>
                    <div class="input-group">
                        <div class="input-group-addon" id="num_min" style="background-color: #FBFBFB;border-radius: 2px 0 0 2px;cursor: pointer;">-</div>
                        <input id="num" name="num" class="layui-input" type="number" value="1" placeholder="请输入购买数量" required min="1" <?php echo $isfaka==1?'max="'.$count.'"':null?>>
                        <div class="input-group-addon" id="num_add" style="background-color: #FBFBFB;border-radius: 2px 0 0 2px;cursor: pointer;">+</div>
                    </div>
                </div>
                <div id="matching_msg"
                     style="display:none;box-shadow: -3px 3px 16px #eee;margin-bottom: 0em;padding: 1em;text-align: center"></div>
            </div>
            <div style="text-align: center">
                <button type="button"
                        style="margin:auto;text-align: center;background:#4a86e8; color: white;letter-spacing: 1px;font-size: 0.6rem;border: none;outline: none;none;width: 48%;"
                        id="submit_cart_shop" class="btn btn-primary btn-block">
                     加入购物车
                </button>
                <button type="button"  style="margin:auto;text-align: center;background:#fa5453; color: white;letter-spacing: 1px;font-size: 0.6rem;border: none;outline: none;width: 48%;"
                        id="submit_buy" class="btn  btn-block">
                    立即购买;
                </button>
            </div>
        </div>
    </div>
</div>





<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic ?>jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script src="<?php echo $cdnpublic ?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic ?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic ?>layer/2.3/layer.js"></script>
<script src="<?php echo $cdnpublic ?>clipboard.js/1.7.1/clipboard.min.js"></script>
<script src="<?php echo $cdnpublic?>layui/2.5.7/layui.all.js"></script>
<script src="<?php echo $cdnpublic ?>Swiper/4.5.1/js/swiper.min.js"></script>
<script src="<?php echo $cdnpublic ?>limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
<script>
function ifclose(){
    window.parent.postMessage('closeIframe', '*');

}
$(".show_daili_price").on("click",function(){
     layer.open({
          type: 1,
          title: false,
          area: '15rem',
          shade: 0.5,
          closeBtn: 0,
          btnAlign: 'c',
          content: $('#show_daili_price_html'),
          
          
          <?php if($islogin2 && $userrow['power'] == 2) {?>
          btn: ['关闭'],
          <?php }else{ ?>
          
          
          <?php  if($userrow['power']==1){?>
          btn: ['提升级别', '关闭'],
          yes: function(index, layero){
             window.location.href = "./user/upsite.php";
          },
          <?php } ?>


          <?php  if($userrow['power']==0){?>
          btn: ['提升级别', '关闭'],
          yes: function(index, layero){
             window.location.href = "./user/regsite.php";
          },
          <?php } ?>
          <?php } ?>
     });
});
</script>


<style>
.layui-layer-btn .layui-layer-btn0 {
    border-color: #dedede;
    background-color: #fff1dc;
    color: #333;
}
</style>
    <div id="show_daili_price_html" style="display:none;">
        <div class="ant-modal-content">
            <div class="ant-modal-header">
                <div class="ant-modal-title" id="vcDialogTitle0">会员等级价格明细</div>
            </div>
                <div class="ant-modal-body">
                    <div data-v-870d6034="" class="dx2-min-price">
                        <div data-v-870d6034="" class="dx2-min-price-price" style="text-align:center;">
                            <div data-v-870d6034="" class="dx2-min-price-price-box">
                            <div data-v-870d6034="" class="dx2-min-price-price-box-name">当前级别<br><?php echo $level?></div>
                        </div>
                    </div>
                        <div data-v-870d6034="" class="dx2-min-price-main">
                            <div data-v-870d6034="" class="dx2-min-price-main-item">
                                <div data-v-870d6034="" class="ant-row ant-row-space-between">
                                <div data-v-870d6034="" class="ant-col">
                                    <div align="center">
                                        <div style="color: #eb560e;">普通用户购买价</div>
                                            <div style="color: #ff5436;">￥<?php echo $price_pt?>元</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        <div data-v-870d6034="" class="dx2-min-price-main">
                            <div data-v-870d6034="" class="dx2-min-price-main-item">
                                <div data-v-870d6034="" class="ant-row ant-row-space-between">
                                <div data-v-870d6034="" class="ant-col">
                                    <div align="center">
                                        <div style="color: #eb560e;">分站站长购买价</div>
                                            <div style="color: #ff5436;">￥<?php echo $price_1?>元</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        <div data-v-870d6034="" class="dx2-min-price-main">
                            <div data-v-870d6034="" class="dx2-min-price-main-item">
                                <div data-v-870d6034="" class="ant-row ant-row-space-between">
                                <div data-v-870d6034="" class="ant-col">
                                    <div align="center">
                                        <div style="color: #eb560e;">顶级合伙人购买价</div>
                                            <div style="color: #ff5436;">￥<?php echo $price_2?>元</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
<script type="text/javascript">
layer.photos({
  photos: '#layer-photos-demo'
  ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
});
var hashsalt=<?php echo $addsalt_js?>;
function goback()
{
    document.referrer === '' ?window.location.href = './' :window.history.go(-1);
}
</script>
<script>
 /* 	$('.hb_info').hide();
  function share(){
        var ii = layer.msg('正在生成海报...', {icon: 16, time: 9999999});
        	layer.close(ii);
        	$('#file').attr('src','http://bjys.volvbf.top/user/timg/goods.php?url=<?php echo $url = $siteurl.'?mod=buy&cid='.$tool['cid'].'&tid='.$tid;?>&name=<?php echo 
        $tool['name']?>	&price=<?php echo $price?>&pic=<?php echo  $tool['shopimg']?>');
        		$('.hb_info').show();
    }*/
    function share(){

	if ((navigator.userAgent.match(/(iPhone|iPod|Android|ios|iOS|iPad|Backerry|WebOS|Symbian|Windows Phone|Phone)/i))) {
        var area = '60%';
    }else{
       var area = '406px';
    }
    
                	var ii = layer.msg('正在生成海报...', {icon: 16, time: 9999999});
	$.ajax({
		type : "GET",
	//	url : "./code/index.php?tid="+$_GET['tid']'&url='<?php echo $userrow['domain']?>",
	url:"./code/index.php?tid="+$_GET['tid']+"&url=<?php echo $_SERVER['HTTP_HOST']?>",
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 1){
			//	$('#file').attr('src','./code/file/cg_'+$_GET['tid']+'_'+data.price+'.jpg');
				var imgru='./code/file/cg_'+$_GET['tid']+'_'+data.price+'_<?php echo $_SERVER['HTTP_HOST']?>.jpg';
			 var imgHtml = " <span style='text-align: center;display:block;width: 100%; '><img id='shopjj' style='width: 100%;' src='"+imgru+"'><p style='padding:10px'><a class='btn btn-default btn-sm' href='javascript:susu();'>保存图片</a></span> "; 
			 
			              layer.open({  
            		type: 1,  
                	shade: false,
                	skin: 'clear_style',
            		title: false, //不显示标题  
            		area: area,
            		shade: 0.3,
            		offset: '30%',
            		content: imgHtml, //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响  
            	//	btn: ['保存','关闭'],
            	//	btnAlign: 'c',
            		cancel: function () {  
            			//layer.msg('图片查看结束！', { time: 5000, icon: 6 });  
            		}  
            	});
        
			}else{
				layer.alert(data.msg);
			}
		} 
	});
              
               

    }
    
      function goback()
    {
       
       document.referrer !== (window.location.protocol+"//"+window.location.host) ? window.location.href = '/' : window.history.back(-1);
    }
   
    
  
    
function susu(){
    var img = document.getElementById('shopjj'); // 获取要下载的图片
        var url = img.src;                            // 获取图片地址
        var a = document.createElement('a');          // 创建一个a节点插入的document
        var event = new MouseEvent('click')           // 模拟鼠标click点击事件
        a.download = 'beautifulGirl'                  // 设置a节点的download属性值
        a.href = url;                                 // 将图片的src赋值给a节点的href
        a.dispatchEvent(event)                        // 触发鼠标点击事件
}

history.pushState(null, document.title, location.href);
window.addEventListener('popstate', function(event) {
  history.pushState(null, document.title, location.href);
});

$('#spxq').click(function() {
    document.getElementById('spxq').className = 'tab-nav-item tab-active';
    document.getElementById('spxq_1').className = 'tab-panel-item tab-active';
    document.getElementById('wtdy').className = 'tab-nav-item';
    document.getElementById('wtdy_1').className = 'tab-panel-item';
});
$('#wtdy').click(function() {
    document.getElementById('wtdy').className = 'tab-nav-item tab-active';
    document.getElementById('wtdy_1').className = 'tab-panel-item tab-active';
    document.getElementById('spxq').className = 'tab-nav-item';
    document.getElementById('spxq_1').className = 'tab-panel-item';
});

</script>

<script src="assets/store/js/main.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>
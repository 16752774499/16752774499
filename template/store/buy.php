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




$level = '<font color="#585656">注册用户</font>';
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
                <a href="javascript:history.back()" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
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
                <font>商品详情<font></div>

            
          
          
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
                        <span  class="list_item_title ellipsis2" style="font-weight: bold;font-size: .6rem" id="gootsp"><?php echo $tool['name']?></span>
                        
                        <span id="level" style="font-size: 0.6rem;line-height: 1.4rem">当前级别：<font color="#48d1cc"><?php echo $level?></font></span>
                    </div>
 
                    <div class="price display-row align-center justify-between" style="width: 100%;">
                        <span style="font-size: .75rem;font-weight: bold;color: #fa5453"><?php echo $price?>元</span>
                        <?php if($conf['template_showprice']==1){?>
						&nbsp;&nbsp;<button type="button" style="color: #45818e;" class="show_daili_price layui-btn layui-btn-warm layui-btn-xs layui-btn-radius ">查看等级优惠价格</button>
                        <?php } ?>
                        </span>
                        <span class="stock" style="color: #999999;font-size: .65rem;"></span>                    </div>
                </div>
            </div>
            
            
            
        <section style="display:none;height: 30px;line-height: 1.6rem; background: #fff; display: flex;justify-content: space-between; align-items: center;" class="show_class ">
            <div style="width:10%"><img src="./assets/img/new3.png" style="height:22px"></div>
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
                  
            <span class="text" style="font-size: 13px;padding:0 10px">
                <span id="total"><?php echo $conf['lswz'] ?> <img src="./assets/img/logo_22332.png" style="width: 15px;"></span>
                    </span>
                </section>
                    <div  style="background: #f2f2f2;width: 100%; height: 1px"></div>


        <section style="background: #fff; display: flex;justify-content: space-between; align-items: center;">
<style>
    .tcbox{
     position: relative;
    display: flex;
    height: 10px;
    align-items: center;
    flex-direction: row;
    width: 95%;
    margin: 15px auto;
    }
    .boxn1{
     width: 50%;
     display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    }
    .boxn2{
     width: 98%;
     display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    }
    .n1{
        text-align: center;
        height: 30px;
        background: rgb(241, 240, 240);
        width: 98%;
        border-radius: 10px 10px 10px 10px;
        font-weight: 600;
        line-height: 30px;
    }
    .n2{
        text-align: center;
        height: 30px;
        background: rgb(241, 240, 240);
        width: 98%;
        border-radius: 10px 10px 10px 10px;
        font-weight: 600;
        line-height: 30px;
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
    width: 370px;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
}
.tanc5{
    display: flex;
    align-items: center;
    justify-content: space-around;
        width: 100%;

}
.tanc51{
        display: flex;
    flex-direction: column;
    align-items: flex-start;
        width: 100%;
}
.z1{
           display: flex;
    width: 50%;
    margin-top: 1px;
    justify-content: space-between;
}

.z2{
    width: 80%;
    height: 32px;
    text-align: center;
    line-height: 32px;
    font-size: 12px;
    font-weight: 700;
    background: #cfe2f3;
    border-radius: 50px;
}
</style>

        <div class="tcbox">
            <div class="boxn1">
                <div onclick="rmtj()" class="n1" style="font-size: 12.5px;">热卖专区①</div>
        </div>
            <div class="boxn1">
                <div onclick="pttj()" class="n1" style="font-size: 12.5px;">热卖专区②</div>
        </div>
            <div class="boxn1">
                <div onclick="tjmf()" class="n1" style="font-size: 12.5px;">免费商品推荐</div>
        </div>
            </div>

                   <div class="tanc1" id="rmtj" style="display:none;">
             <div class="tanc2">
                  <div class="tanc3">
                       <div class="tanc4">
                            <div align="center">
                           <div class="tanc5">
                                <div class="tanc51">
                                    <div align="center">
                                        <div class="z1">
                                    </div>
                                    <div align="left">
                                        
        <section style="display:none;height: 20px;line-height: 1.6rem; background: #fff; display: flex;justify-content: space-between; align-items: center;" class="show_class ">
            <div style="width:10%"><img src="./assets/img/new2.png" style="height:24px"></div>
            <span class="text" style="font-size: 14px;padding:0 10px">
                <span id="total">热卖专区①</span>
                    </span>
                </section>
                    <hr>
                    <?php echo $conf['rmtj'] ?> 
                                    </div>
                                    <br>
                                <div class="z2" onclick="closetc()"> 关闭 </div>
                                </div>
                                    </div>
                                         </div>
                                            </div>
                                                </div>
                                                      </div>
                                                           </div>
                                                                </div>


                   <div class="tanc1" id="pttj" style="display:none;">
             <div class="tanc2">
                  <div class="tanc3">
                       <div class="tanc4">
                            <div align="center">
                           <div class="tanc5">
                                <div class="tanc51">
                                    <div align="center">
                                        <div class="z1">
                                    </div>
                                    <div align="left">
                                        
        <section style="display:none;height: 20px;line-height: 1.6rem; background: #fff; display: flex;justify-content: space-between; align-items: center;" class="show_class ">
            <div style="width:10%"><img src="./assets/img/new2.png" style="height:24px"></div>
            <span class="text" style="font-size: 14px;padding:0 10px">
                <span id="total">热卖专区②</span>
                    </span>
                </section>
                    <hr>
                    <?php echo $conf['rmsptj'] ?> 
                                    </div>
                                    <br>
                                <div class="z2" onclick="closetc()"> 关闭 </div>
                                </div>
                                    </div>
                                         </div>
                                            </div>
                                                </div>
                                                      </div>
                                                           </div>
                                                                </div>


                   <div class="tanc1" id="tjmf" style="display:none;">
             <div class="tanc2">
                  <div class="tanc3">
                       <div class="tanc4">
                            <div align="center">
                           <div class="tanc5">
                                <div class="tanc51">
                                    <div align="center">
                                        <div class="z1">
                                    </div>
                                    <div align="left">
                                        
        <section style="display:none;height: 20px;line-height: 1.6rem; background: #fff; display: flex;justify-content: space-between; align-items: center;" class="show_class ">
            <div style="width:10%"><img src="./assets/img/new2.png" style="height:24px"></div>
            <span class="text" style="font-size: 14px;padding:0 10px">
                <span id="total">免费商品推荐</span>
                    </span>
                </section>
                        <hr>
                    <?php echo $conf['mfsptj'] ?> 
                                    </div>
                                    <br>
                                <div class="z2" onclick="closetc()"> 关闭 </div>
                                </div>
                                    </div>
                                         </div>
                                            </div>
                                                </div>
                                                      </div>
                                                           </div>
                                                                </div>
<script type="text/javascript">
function rmtj(){
    $("#rmtj").show();
}
function pttj(){
    $("#pttj").show();
}
function hongbao(){
    $("#hongbao").show();
}
function tjmf(){
    $("#tjmf").show();
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
</section>

			<div style="background: #f2f2f2; height: 10px"></div>
			<div class="my-cell" style="margin-bottom: 0px;padding: 10px;font-size: .75rem;font-weight: bold;padding-top: 10px">
                商品说明
            </div>
                    			<?php if (!$islogin2) { ?>
            <div align="center">
                <p style="margin:1em;color: salmon" href="./user/login.php?back=index">检测到您当前未登录，登陆后才能下单</p>

                    <div style="width:100%;  display:flex;" >
                <a  style="width: 100%;" href="./user/login.php" >
                    <div class="submit_btn" style="width: 80%;color: salmon;height: 2rem;margin:1px auto;text-align: center;line-height: 2rem;background-image:linear-gradient(to right, rgb(204, 204, 204), rgb(204, 204, 204));">前往登录</div>
                </a>
                <a  style="width: 100%;" href="./user/reg.php" >
                    <div class="submit_btn" style="width:80%;color: salmon;height: 2rem;margin:1px auto;text-align: center;line-height: 2rem;background-image:linear-gradient(to right, rgb(204, 204, 204), rgb(204, 204, 204));">前往注册</div>
                </a>
                </div>
                    </div>
                  
			<?php } ?>
			
			<br>
  <div class="content_friends">
                 <div class="hd_intro" style="word-break: break-all;"><?php echo $tool['desc']?>
                 </div>
            </div>
            

            
           	<div style="background: #f2f2f2; height: 10px"></div>
            <div align="center" style="margin-bottom: 10px;padding: 10px;font-weight: bold;padding-top: 3px"><br>
            <span>
            <img src="./assets/img/logo_22332.png" /> 立即免费领取推广现金红包！<a class="label label-danger fa fa-hand-o-right" href="/?mod=invite"> 点击进入</a><br/><br/>
            
            <?php  if( $userrow['power']==0){?>
            <img src="./assets/img/logo_22332.png" /> 立即升级站长享更低价下单！<a class="label label-danger fa fa-hand-o-right" <a="" href="user/regsite.php"> 点击进入</a>
            <?php }?>
            <?php  if( $userrow['power']==1){?>
            <img src="./assets/img/logo_22332.png" /> 立即升合伙人享更低价下单！<a class="label label-danger fa fa-hand-o-right" <a="" href="user/regsite.php"> 点击进入</a>
            <?php }?>
            <?php  if( $userrow['power']==2){?>
            <img src="./assets/img/logo_22332.png" /> 立即获取推广海报分享好友！<a class="label label-danger fa fa-hand-o-right" <a="" href="user/tuiguang.php"> 点击进入</a>
            <?php }?>
            <br/><br/>
            
            <img src="./assets/img/logo_22332.png" /> 立即加入Ｑ群防止失联迷路！<a class="label label-danger fa fa-hand-o-right" href="https://qm.qq.com/cgi-bin/qm/qr?k=z8pJ7YRGlmoAnDxGGVA5C2urHwt0ZxeT&jump_from=webapi&authKey=N3CPubh5FnxipXVVYS15NpWpXPCdeR3OLZvEc7DXbtN0NkIArsGUjGV/LiIjxzKr"> 点击进入</a>
            
            </span>
                </div>
           	
           	
           	<div style="background: #f2f2f2; height: 10px"></div>
           		<?php if($tool['shopimg']){?>
           	<div class="my-cell" style="margin-bottom: 0px;padding: 10px;font-size: .75rem;font-weight: bold;padding-top: 10px">
                    <div style="height: 1.8rem;line-height: 1.8rem">产品宣传图</div>
                    <img class="lazy" alt="<?php echo $tool['name']?>" src="<?php echo $tool['shopimg']?>" border="0" opacity="" style="margin: 0px; height: auto !important; width: 100% !important;" width="100%" height="auto" mapurl="" title="<?php echo $tool['name']?>" data-width="100%" data-ratio="1.8285714285714285" data-op="change" data-w="1050">
                </div>
                
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
                    <a href="../?mod=cart" onclick="../?mod=cart">
                    <div  style="margin-left:10px;">
                        <img href="../?mod=cart"  style="height: .95rem" src="../assets/img/cart-buy.png"></img>
                        <div style="position=absolute;left:0;bottom:0;text-align: center;margin: 4px 0px 0px;">
                        <h1 href="../?mod=cart" style="font-size: 11px;color: black;">购物车<span style="color: #ff0000;" id="cart_sum"></span></h1>
                        </div>
                        
                    </div>
                    
                    </a>
                    
                    <div  style="margin-left:0px;">
                                            <a href="./?mod=kf" onclick="./?mod=kf">
                        <img href="./?mod=kf"  style="height: .95rem" src="../assets/img/kefu-buy.png"></img>
                        <div style="position=absolute;left:0;bottom:0;text-align: center;margin: 4px 17px 0px;">
                        <h1 href="./?mod=kf" style="font-size: 11px;color: black;">客服</h1>
                    </div>
                    </a>
                    </div>
                    
                    <div  style="margin-left:-10px;">
                                            <a href="./user/qiandao.php" onclick="./user/qiandao.php">
                        <img href="./user/qiandao.php"  style="height: .95rem" src="../assets/img/qiandao01.png"></img>
                        <div style="position=absolute;left:0;bottom:0;text-align: center;margin: 4px 17px 0px;">
                        <h1 href="./user/qiandao.php" style="font-size: 11px;color: black;">签到</h1>
                    </div>
                    </a>
                    </div>
                    
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
                        id="submit_cart_shop" class="btn btn-primary btn-block">
                    <span class=""></span>加入购物车</a>
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
        <div class="payment-method" style="position: absolute;max-height:60vh;">
            <div class="title" id="gid" data-tid="" style="font-size: .70rem;">
                下单信息确认
                <span class="close" onclick="$('#paymentmethod').hide()"></span>
            </div>
            <div style="height: 30vh;overflow:hidden;overflow-y: auto">

                <div class="form-group form-group-transparent form-group-border-bottom">
                    <div class="input-group" style="width:100%">
                        <div class="input-group-addon">
                            商品价格

                        </div>
                        <input type="text" id="need" disabled style="color: #ff0000;" class="form-control" value="<?php echo $price?>元">
                    </div>
                </div>
                
                
                
                
                
                
                <div id="inputsname"></div>
                 <div class="layui-form-item" <?php echo $tool['multi']==0?'style="display: none"':null;?>>
                <div class="form-group form-group-transparent form-group-border-bottom" >
                    


                    <div class="input-group display-row justify-between" style="width:100%">
                        <div class="input-group-addon">
                            购买数量
                            
                           
                              <span style='color:#6e6e6e;font-size:10px;padding-left: 10px;font-weight: 10'></span>                                 </div>
                        <div class="input-group " style="width:35%;padding-right: 5px;float: right">
                            <div class="input-group-addon" id="num_min" style="background-color: #dcdcdc;min-width:10%;width:20%;font-size: 20px;color: #fff">-</div>
                            <input id="num" name="num" class="form-control" style="text-align: center;border: 1px solid #ccc;min-width:40%;" type="number" value="1" placeholder="请输入<?php echo $isfaka==1?'max="'.$count.'"':null?>数量" required min="1" max="252">
                            <div class="input-group-addon" id="num_add" style="background-color: #3793ff;min-width:10%;width:20%;font-size: 20px;color: #fff">+</div>
                        </div>
                    </div>
                </div>

                <div id="matching_msg"
                     style="display:none;box-shadow: -3px 3px 16px #eee;margin-bottom: 0em;padding: 1em;text-align: center"></div>
            </div>
            <div class="form-group" style="text-align: center">
                <button type="button"
                        style="margin:auto;text-align: center;    line-height: 1.75rem;margin-top: 0.4rem;    background: linear-gradient(to right, #ff6a80, #ff3c77, #fa9c7b);    color: white;    letter-spacing: 1px;    font-size: 0.7rem;    border: none;    outline: none;    width: 48%;    height: 1.75rem; display:none;;"
                        id="submit_cart_shop" class="btn btn-primary btn-block">
                    <span class="icon icon-cart2"></span> 加入购物车<span id="cart_sum"></span>
                </button>
                <button type="button"  style="margin:auto;text-align: center;background:#fa5453; color: white;letter-spacing: 1px;font-size: 0.7rem;border: none;outline: none;"
                        id="submit_buy" class="btn  btn-block">
                    立即购买;
                </button>

            </div>
           <div  style="background: #f2f2f2; height: 10px"></div>

        </div>
    </div>
</div>




                        <a style="position:fixed;right:10px;bottom:17%; z-index:10; " href="/?mod=time">
                        <img style="width:45px;height:45px;border-radius:50px;border: 2px solid #ff8204;background-color:#fff" src="../assets/store/images/jrgx.png"/>
                        </a>

                        <a style="position:fixed;right:10px;bottom:10%; z-index:10;" href="<?php echo $conf['appurl']; ?>">
                        <img style="width:45px;height:45px;border-radius:50px;border: 2px solid #1195da;background-color:#fff" src="../assets/store/images/app1.png"/>
                        </a>




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

<div id="show_daili_price_html" style="display:none;">
    <div class="price" style="text-align:center;">
        <div style="height: 1.5rem;line-height:2rem;font-weight: 0;width:100%;"><b>当前商品各级别购买价</b></div>
        <hr>
        <p class="pay_prices" id="level"><font color="#585656">注册用户购价：<span class="pay_price"><?php echo $price_pt?>元</span></font></p>
        <p class="pay_prices" id="level"><font color="585656">分站站长购价：<span class="pay_price"><?php echo $price_1?>元</span></font></p>
        <p class="pay_prices" id="level"><font color="585656">顶级合伙人购价：<span class="pay_price"><?php echo $price_2?>元</span></font></p>
        <hr>
        <p class="pay_prices" id="level"><b>您当前所在级别：<span class="pay_price"><?php echo $level?></b></span></p>
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
		url : "./code/index.php?tid="+$_GET['tid'],
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 1){
			//	$('#file').attr('src','./code/file/cg_'+$_GET['tid']+'_'+data.price+'.jpg');
				var imgru='./code/file/cg_'+$_GET['tid']+'_'+data.price+'.jpg';
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
</script>
<script src="assets/store/js/main.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>
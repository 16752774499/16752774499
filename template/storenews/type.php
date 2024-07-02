<?php
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

$class_show_num = intval($conf['index_class_num_style'])?intval($conf['index_class_num_style']):2; //分类展示几组
 $wenzhangdizhi=$conf['wenzhangdizhi'];
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0">
    <meta name="renderer" content="webkit"/>
    <meta name="force-rendering" content="webkit"/>
    <title>商品分类 - <?php echo $conf['sitename']; ?></title>
    <link rel="shortcut icon" href="favicon.ico">
    <meta name="description" content="<?php echo $conf['description'] ?>">
    <link rel="stylesheet" type="text/css" href="../assets/store/css/foxui.css">
    <link rel="stylesheet" type="text/css" href="//lib.baomitu.com/layui/2.5.7/css/layui.css">
    <link type="text/css" rel="stylesheet" href="../assets/store/css/cart.css">
<style>
    html{ background:#ecedf0 url("//cn.bing.com/th?id=OHR.ArizonaPinkMoon_ZH-CN5545607389_1920x1080.jpg&rf=LaDigue_1920x1080.jpg&pid=hp") fixed;background-repeat:no-repeat;background-size:100% 100%;}
</style>
 <link id="layuicss-laydate" rel="stylesheet" href="https://lib.baomitu.com/layui/2.5.7/css/modules/laydate/default/laydate.css?v=5.0.9" media="all">
 <link id="layuicss-layer" rel="stylesheet" href="https://lib.baomitu.com/layui/2.5.7/css/modules/layer/default/layer.css?v=3.1.1" media="all">
 <link id="layuicss-skincodecss" rel="stylesheet" href="https://lib.baomitu.com/layui/2.5.7/css/modules/code.css" media="all">
</head>
<body>
<div class="headerbox">
    <div class="header" style="height: 3rem;">
        <div class="headerC" style="
         line-height: 2rem;">
            <p style="
    font-size: 1.0rem;font-weight:bold;">商品分类<span class="CartCount"></span></p>
        </div>
    </div>
</div>

<div style="height: 2.85rem;font-size: 13px;
    background-color: #f2f2f2"></div>
<div class="gwcbox" style="height: 100%;">
    
<style>
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
        font-size: 6rem;
    }
.uni-scroll-view {
    width: 100%;
    height: 120%;
}   
.nav-left-item {
    height: 60px;
    margin-left: 5%;
    width: 95%;
    font-size: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.active {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    font-weight: 600;
    background-image: url(data:image/png;base64,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);
    background-size: 100% 100%;
}
.active .nav-left-item-text {
    padding: 5px 7px;
    position: relative;
}
.nav-right-item{
    width: 33%;
    float: left;
    text-align: center;
    margin-bottom: 10px;
    font-size: 13px;
    background: #fff;
}
.align-center {
    align-items: center;
}
.justify-center {
    justify-content: center;
}
.display-column {
    display: flex;
    flex-direction: column;
}
.type-pid-item-text {
    color: #000;
    width: 130%;
    overflow: hidden;
    font-size: 12px;
    margin-top: 10px;
    text-align: center;
    height: 35px;
}
</style>
<div style="
    height: 863px;
    display: flex;
    background: #f2f2f2;
    overflow: hidden;">
    <div style="height: 100%;width: 25%;">
        <div style="height: 263px;">
            <div class="uni-scroll-view">
                <div class="uni-scroll-view" style="overflow: hidden auto;">
                    <div class="uni-scroll-view">
                        <div style="height: 5px;"></div>
                        <?php
                                $arry = 0;
                                $au = 1;
                                foreach ($ar_data as $v) {
                                    if (($arry / ($class_show_num*4)) == ($au - 1)) { //循环首
                                        
                                        if($_GET['cid']==null){
                                            $cid= $conf['pagecid'];
                                        }else{
                                            $cid= $_GET['cid'];
                                        }
                                    }if($cid==$v['cid']){
                                    echo '                        <div class="nav-left-item active">
                            <a href="/?mod=type&cid='.$v['cid'].'" data-cid="'.$v['cid'].'" data-name="'.$v['name'].'">
                            <div class="nav-left-item-text">
                                '.$v['name'].'
                                <div style="position: absolute;bottom: 0;left: 0;width: 10px;height: 10px;">
                                    <div style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAABHNCSVQICAgIfAhkiAAAAzBJREFUWEfNls9LVFEUx7/3zQ9nNAfSdBH9EAo1nZkSioxCgiBqEShtKkqihUQ6Sv+B61aVWuSiTUVQ2yjIwI2Q0aKcmTQ1MshFkW4qtRln3um8yMcMjvPOHafwwcDw3uec+3n3vnvuUdhgl9pgPrCFwpepmrzYLhFM/sTU5F31Q8LqMrbQ3k5qNF04LElAKTyL31KfJawuYws1RqjBUDgiSaBMDEX71YyE1WVsoVAX1cNAiyRBKoHhiTtqWsLqMrZQQzftcAEnRAlMvIz1q5iI1YRsofpOqvS4cFoST2nMxAfUkITVZWyhmovkKw+gXZKATCzG+9V9CavLZNWhcITaScEnSZL04eHkteJv/SyhYISOK4UaiVCa8Hq8T72RsDpMtlAPhRWhWZKAuV/RL3iAxyot4aVMltDuCAX8CmekwSZh5F2fGpfyEm7VWRbspja+WSUJBmEhlsAjDKplES+AVglxgQxxgTwkiP2DGMD02E01LOWduNWnfQd5Ql6c55E8TsH282W8iN1WH8V8HjBn+8Hbv5m3f1g8ACGZSODJ1KCaE8esAeYU2tpBpVu8OEsG+DQRXiaWyYWn8RvqqzAiJ7Zmg9bYQwcMQpNOcuZTBDyP9qlZnbhMdu2Okb+lsA/neIASreRclZSBiWgCo4XsvrwtbLCDdikfjmkJ/YWt887txsjb6+qTTrxjTx3soqP8xrU6STNZS4wbvw9JE9PvB9S8Ux5HIfSSOzSHNi4Dm52SOT3n5V/ibnPO5J/Hi2+JRSSsGM8SvkfvqQXrv7MQQ1ZrEgiglRMGnAYt5DkfQa/4CBoTC1lgwxXaZBho5eUrLWTQfDFc80a5XES1hCw4fIHKeI5Ocb0p6kwVNEMrb8gdQYmfcJK/qepizVTBM2QL9JIR+oaDXMdDxZBa1wxlCuzppJ0uF1p4Z/jXI7b+GcocnctCeB77eb8GeRdyN6J/FW2GMoeuu0TlJWXYx01brdahzEn+idCK3Lar5A+kUO82USfdjcVdsjwr1BShqiS3wzxgBQtW8JJW5mr8/ptQLlerwKYNBFiwlAutnwW9LDS70keJjg79z7TwiA0n9BsVPgQ0EHhicQAAAABJRU5ErkJggg==&quot;); background-position: 0% 0%; background-size: 100% 100%; background-repeat: no-repeat;width: 100%;height: 100%"></div>
                            
                        </div>
                            </div>
                            </a>
                        </div>';}else{
                             echo '                        <div class="nav-left-item">
                            <a href="/?mod=type&cid='.$v['cid'].'" data-cid="'.$v['cid'].'" data-name="'.$v['name'].'">
                            <div class="nav-left-item-text">
                                '.$v['name'].'
                                
                                <div style="position: absolute;bottom: 0;left: 0;width: 10px;height: 10px;">
                        </div>
                            </div>
                            </a>
                        </div>';
                        }

                                    if ((($arry + 1) / ($class_show_num*4)) == ($au)) { //循环尾
                                        echo '';
                                        $au++;
                                    }
                                    $arry++;
                                }
                                if (floor((($arry) / ($class_show_num*4))) != (($arry) / ($class_show_num*4))) {
                                    echo '';
                                }
                                ?>
                                

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div style="height: 100%;width: 75%;
    background: #fff;
    border-top-left-radius: 10px;
    overflow: hidden;">
        <div style="height: 1863px;">
            <div class="uni-scroll-view">
                <div class="uni-scroll-view" style="overflow: hidden auto;">
                    <div class="uni-scroll-view">
                        <div style="height: 12px;"></div>
                        
                            <?php
                            if($_GET['cid']==null or $_GET['cid']==0){
                                            $cid= $conf['pagecid'];
                                        }else{
                                            $cid= $_GET['cid'];
                                        }
                            $twore = $DB->query("SELECT * FROM `pre_class` WHERE `active` = 1 AND `cidr`='$cid' ORDER BY `sort` ASC ");$qcid = "";
$cat_name = "";
//echo $cid;
while ($twores = $twore->fetch()) {
    if($is_fenzhan && in_array($twores['cid'], $classhide))continue;
    if($twores['cid'] == $cid){
    	$cat_name=$twores['name'];
    	$qcid = $cid;
    }
    $twoar_data[] = $twores;
}
                                $arry = 0;
                                $au = 1;
                                foreach ($twoar_data as $twov) {
                                    if (($arry / ($class_show_num*4)) == ($au - 1)) { //循环首
                                        echo '';
                                    }
                                    echo '<div class="nav-right-item display-column align-center justify-center" ><a href="/?mod=page&cid='.$twov['cid'].'" data-cid="'.$twov['cid'].'" data-name="'.$twov['name'].'" class="get_tab  tab-bottom-item ">
                            <div style="width: 80%;align-items: center;justify-content: center;display: flex;
    flex-direction: column;">
                            <div style="border-radius: 7px;">
                               <div style="width: 50px;
    height: 50px;
    border-radius: 10px;
    overflow: visible;background-image: url(&quot;' . $twov['shopimg'] . '&quot;); background-size: 100% 100%; background-repeat: no-repeat;"></div>
                            </div>
                            <div class="type-pid-item-text u-line-2">'.$twov['name'].'</div>
                        </div>
    </a></div>';

                                    if ((($arry + 1) / ($class_show_num*4)) == ($au)) { //循环尾
                                        echo '';
                                        $au++;
                                    }
                                    $arry++;
                                }
                                if (floor((($arry) / ($class_show_num*4))) != (($arry) / ($class_show_num*4))) {
                                    echo '';
                                }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <input type="hidden" name="_cid" value="<?php echo $cid; ?>">
        <input type="hidden" name="_cidname" value="<?php echo $cat_name; ?>">
        
        
        
         <style>
  .img1{

    width:1.4rem;
    height:1.4rem;
  }

  </style>
  

  

  
  
 <div class="fui-navbar" style="max-width: 640px;z-index: 100;" >
            <a href="./" class="nav-iteme">
                <img src="template/storenews/img/首页2.png" class="img1">
            <span class="label2" style="color:#999;line-height: unset;font-weight: inherit;">首页</span>
            </a>
            
            <a href="./?mod=type&cid=1" class="nav-iteme">
                <img src="template/storenews/img/分类2.png" class="img1">
                <span class="label2" style="color:#1492fb;line-height: unset;font-weight: inherit;">分类</span>
            </a>
            
            <a href="./?mod=query" class="nav-iteme ">
                <img src="./assets/user/img/订单2.png" class="img1">
                <span class="label2">订单</span>
            <a href="./?mod=kf" class="nav-iteme ">
                <img src="./assets/user/img/tab_kefu.png" class="img1">
                <span class="label2" style="color: #999;line-height: unset;font-weight: inherit;">客服</span>
            </a>
            
            <a href="./user/" class="nav-iteme ">
                <img src="./assets/user/img/tab_my.png" class="img1">
                <span class="label2" style="color:#999;line-height: unset;font-weight: inherit;">我的</span>
            </a>
            
        </div>




</body></html>
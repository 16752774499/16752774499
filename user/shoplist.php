<!DOCTYPE html>
<?php
/**
 * 商品管理
**/
include("../includes/common.php");

if(isset($_GET['kw'])){
    $kw=$_GET['kw'];
    $rscv=$DB->query("SELECT * FROM pre_tools WHERE name LIKE '%{$kw}%' AND active=1");
}
$title='商品管理';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

unset($islogin2);
?>
<?php
if($userrow['power']==0){
	showmsg('您没有权限使用此功能！',3);
}

$my=isset($_GET['my'])?$_GET['my']:null;
$cid=isset($_GET['cidr'])?$_GET['cidr']:'';

$rs=$DB->query("SELECT * FROM pre_class WHERE active=1 and cidr=0 ORDER BY sort ASC");
$selectson='';
$select='';
if($cid){
    $rss=$DB->query("SELECT * FROM pre_class WHERE active=1 and cidr=$cid ORDER BY sort ASC");
    while($res = $rss->fetch()){
        $selectson.='<a class="hotxy-item2" id="tab_'.$res['cid'].'" href="./shoplist.php?cid='.$res['cid'].'&cidr='.$cid.'">'.$res['name'].'</a>';
    }
}
$shua_class[0]='未分类';
while($res = $rs->fetch()){
    $shua_class[$res['cid']]=$res['name'];
    $select.='<a class="hotxy-item" id="tab_'.$res['cid'].'" href="./shoplist.php?cid='.$res['cid'].'&cidr='.$res['cid'].'">'.$res['name'].'</a>';
}
$numrows=$DB->getColumn("SELECT count(*) FROM pre_tools WHERE active=1");
?>
<html lang="zh-cn" style="" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>商品管理</title>
    <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../assets/simple/css/plugins.css">
    <link rel="stylesheet" href="../assets/simple/css/main.css">
    <link rel="stylesheet" href="../assets/css/common.css">
    <link href="//cdn.staticfile.org/layui/2.5.7/css/layui.css" rel="stylesheet">
    <script src="//cdn.staticfile.org/modernizr/2.8.3/modernizr.min.js"></script>
    <link rel="stylesheet" href="../assets/user/css/my.css">
    <script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdn.staticfile.org/layui/2.5.7/layui.all.js"></script>
    <link id="layuicss-laydate" rel="stylesheet" href="http://cdn.staticfile.org/layui/2.5.7/css/modules/laydate/default/laydate.css?v=5.0.9" media="all">
    <link id="layuicss-layer" rel="stylesheet" href="http://cdn.staticfile.org/layui/2.5.7/css/modules/layer/default/layer.css?v=3.1.1" media="all">
    <link id="layuicss-skincodecss" rel="stylesheet" href="http://cdn.staticfile.org/layui/2.5.7/css/modules/code.css" media="all">
    <link rel="stylesheet" href="../assets/user/css/work.css">
  <!--[if lt IE 9]>
    <script src="//cdn.staticfile.org/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
<style>body{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style></head>
<body>
    
<style>
    .layerdemo{
        border-radius: 10px;
        color:black;
        overflow: hidden;
    }
    .btn-list{
        width: 100%;
        margin-top: 10px;
        padding: 0 5px;
    }
    .btn-list .btn-item{
        width: 48%;
        height: 4rem;
        border-radius: 8px;
        color: #000;
        font-size: 1.3rem;
        border:  1px solid #f2f2f2;
        overflow: hidden;

        background:linear-gradient(to top , rgba(254, 254, 254, 1.0), rgba(241, 241, 241, 1.0),rgba(254, 254, 254, 1.0));
        text-align: center;
        line-height: 4rem;
        margin-bottom: 10px;
        box-shadow: -1px -1px 1px #e2dfdf;

    }
    .btn-list .btn-item img{
        height: 1.8rem;
        margin-right: 5px;
        margin-top: -4px;
    }
    .hotxy {
        white-space: nowrap;
        overflow-x: auto;
        overflow-y: hidden;
        left: 30rem;

    }
    .hotxy::-webkit-scrollbar {
        display: none !important;
    }

    .hotxy .hotxy-item{
        display: inline-block;
        min-width: 68px;
        margin: 0 1px;
        text-align: center;
        padding: 5px 0;

    }
    .hotxy .hotxy-item2{
        display: inline-block;
        min-width: 68px;
        margin: 0 10px;
        text-align: center;
        padding: 5px 0;

    }
    .hotxy .hotxy-item-index{
        border-bottom: 3px solid #de815c;
        font-weight: 700;

    }
    .list-item .list-item-c .item-c-txet{
        min-height: 3.5rem;
    }
    input::placeholder{
        text-align: right;
    }
    input{
        text-align: right;
    }
    .form-control[disabled]{
        background-color:transparent;
        color: #999999;
    }
    .search-input::placeholder{
        text-align: left;
    }
    .layui-layer {

    }
    .layui-layer-btn{
        display: inline-block;
        height: 4.5rem;
        border-top: 1px solid #f2f2f2;
        padding: 0;
        text-align: center;
        align-items: center;
        width: 100%;
    }
    .layui-layer-iframe .layui-layer-btn, .layui-layer-page .layui-layer-btn {
        padding-top:0;
    }
    .layui-layer-btn .layui-layer-btn0{
        text-align: center;
    }
    .layui-layer-btn .layui-layer-btn1{
        text-align: center;

    }
</style>
<div class="col-xs-12 col-sm-10 col-md-6 col-lg-4 center-block " style="float: none; background-color:#fff;padding:0;max-width: 550px;">
    <div class="block  block-all">
        <div class="block-white">
            <div class="block-back display-row align-center justify-between">
                <div style="border-width: .5px;
    border-radius: 100px;
    border-color: #dadbde;
    background-color: #f2f2f2;
    padding: 3px 7px;
    opacity: .8;align-items: center;justify-content: space-between;display: flex; flex-direction: row;height: 30px;">
                <a href="./"  class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.4rem" src="../assets/img/fanhui.png">&nbsp;
                </a>
                <div style="margin: 0px 8px; border-left: 1px solid rgb(214, 215, 217); height: 16px; border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-bottom-color: rgb(214, 215, 217);"></div>
                <a href="../" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.8rem" src="../assets/img/home1.png">&nbsp;
                </a>
            </div>
            <div style="font-size: 15px;">
            <font><a href="">商品管理</a></font>

            </div>
                </div>
            <div  style="background: #f2f2f2; height: 10px"></div>
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
            <div class="my-cell-title display-row justify-between align-center">
                <div class="my-cell-title-l left-title" style="font-size:1.3rem">商品管理</div>
                                            <a onclick="openmsg1()" style="color: #999999;font-size: 1.3rem;">&nbsp;<i class="fa fa-question-circle-o"  style="font-size:1.4rem;padding-right: 5px"></i></a>
                                <div style="flex-grow:2;text-align:right ">

                </div>
<!--
            <a href="javascript:void(0)" onclick="auto_price(0)" style="font-size:1.3rem;" class="display-row align-center">
                <font style="margin-top: 2px;margin-right: 5px">新商品同步销售价格</font>
                <?php if($userrow['inbr']>='1'){?>
                    <i class="fa fa-toggle-on fa-2x" style="color: #0b9ff5"></i>
                <?php }else{?>
                    <i class="fa fa-toggle-on fa-2x fa-flip-horizontal" style="color: #94a7c1"></i>
                <?php }?>
            </a>
-->
            </div>
            
<?php $shopcid = intval($_GET['cid']);?>
       <?php  if($userrow['power']==2){?>
            <div class="btn-list display-row flex-wrap justify-between align-center">
                <a class="btn-item" style="width: 49%" class="btn btn-success" onclick="reset_price(0)" href="javascript:void(0)"><img src="../assets/user/img/huifu_price.png">恢复初始价格</a>
                <a class="btn-item" style="width: 49%" href="javascript:void(0)" onclick="up_price(0)"><img src="../assets/user/img/up_price.png">提升销售价格</a>
                <a class="btn-item" style="width: 49%" href="javascript:void(0)" onclick="xiaji_up_price(0)"><img src="../assets/user/img/xiaji_price.png">提升下级价格</a>
                <a class="btn-item" style="width: 49%" href="javascript:void(0)" onclick="up_price01(<?php echo $shopcid ?>)"><img src="../assets/user/img/up_price.png">提升单独小分类售价</a>
            </div>
        </div>
        <?php }?>
                        
                        
       <?php  if($userrow['power']==1){?>
                   <div class="btn-list display-row flex-wrap justify-between align-center">
                <a class="btn-item" style="width: 32%" class="btn btn-success" onclick="reset_price(0)" href="javascript:void(0)"><img src="../assets/user/img/huifu_price.png">恢复初始价格</a>
                <a class="btn-item" style="width: 32%" href="javascript:void(0)" onclick="up_price(0)"><img src="../assets/user/img/up_price.png">提升销售价格</a>
                <a class="btn-item" style="width: 32%" href="javascript:void(0)" onclick="up_price01(<?php echo $shopcid ?>)"><img src="../assets/user/img/up_price.png">提升单独小分类售价</a>
            </div>
        </div>
       <?php }?>
       
<div class="hotxy block-white" id="tab">
<?php
$price_obj = new \lib\Price($userrow['zid'],$userrow);

if($my=='edit')
{
$tid=intval($_GET['tid']);
$row=$DB->getRow("SELECT * FROM pre_tools WHERE tid='$tid' LIMIT 1");
$price_obj->setToolInfo($tid,$row);
?>
</div>
        <div style="background: #f2f2f2; height: 10px"></div>
        <div class="block-back block-white display-row align-center justify-between" style="padding:15px 15px">
            <a href="./shoplist.php" class="font-weight display-row align-center">
                <img style="height: 1.45rem" src="../assets/img/fanhui.png">&nbsp;&nbsp;
                <font>编辑商品</font>
            </a>
        </div>
        <div class="form-group form-group-transparent" style="background: #f2f2f2; padding:8px 10px">
            <div class="input-group" style="width:100%">
                <div class="input-group-addon" style="color:#969494;font-size:13px;">
                    商品信息 (单位 : 元)
                </div>
                <div></div>
            </div>
        </div>
            <form action="./shoplist.php?my=edit_submit&tid=<?php echo $tid ?>>" method="POST">
                <div class="block-white" style="padding: 0 10px">
                    <div class="form-group form-group-transparent form-group-border-bottom">
                        <div class="input-group" style="width:100%">
                            <div class="input-group-addon">
                                商品名称
                            </div>
                            <div class="form-control text-right" style="color:#999999;font-size: 1.1rem ">不可编辑</div>
                        </div>
                    </div>

                    <div class="form-group form-group-transparent form-group-border-bottom">
                        <div class="input-group" style="width:100%">

                            <textarea type="text" class="form-control" name="domain" disabled=""><?php echo $row['name']?> </textarea>
                        </div>
                    </div>


                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    成本价格
                                </div>
                                <input type="text" class="form-control" name="cost2" value="<?php echo $price_obj->getToolCost2($tid) ?>" disabled="">
                            </div>
                        </div>
                      
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    下级分站代理价格
                                </div>
                                <input type="text" class="form-control" name="cost" value="<?php echo $price_obj->getToolCost($tid) ?>">
                            </div>
                        </div>
                    <div class="form-group form-group-transparent">
                        <div class="input-group" style="width:100%">
                            <div class="input-group-addon">
                                销售价格
                            </div>
                            <input type="text" class="form-control" name="price" value="<?php echo $price_obj->getToolprice($tid) ?>">

                        </div>
                    </div>
                    <div class="form-group form-group-transparent" style="background: #f2f2f2; margin: 0 -10px;padding-left: 10px">
                        <div class="input-group" style="width:100%">
                            <div></div>
                        </div>
                    </div>

                <div class="text-center" style="padding: 30px 0;">
                     <input type="submit" class="btn submit_btn" style="width: 80%;padding:8px;" value="确定修改">
                </div>


            </form>

           </div>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default")||0);
}
</script>
<?php
}
elseif($my=='edit_submit')
{
$tid=intval($_GET['tid']);
$rows=$DB->getRow("SELECT * FROM pre_tools WHERE tid='$tid' LIMIT 1");
if(!$rows)
	showmsg('当前记录不存在！',3);
$price_obj->setToolInfo($tid,$rows);
$price=round(daddslashes($_POST['price']),2);
$mainprice = $price_obj->getMainPrice();//主站商品售价
$maincost = $price_obj->getMainCost();//主站商品成本价
$del=intval($_POST['del']);
if(!is_numeric($price) || !preg_match('/^[0-9.]+$/', $price))showmsg('价格输入不规范',3);
if($userrow['power']==2){
	$cost=round(daddslashes($_POST['cost']),2);
	if(!is_numeric($cost) || !preg_match('/^[0-9.]+$/', $cost))showmsg('价格输入不规范',3);
	if($cost<$price_obj->getToolCost2($tid)){
		showmsg('下级价格不能低于成本价格！',3);
	}
	if($price<$cost){
		showmsg('销售价格不能低于下级价格！',3);
	}
	if($conf['fenzhan_pricelimit']==1 && $maincost>0 && ($maincost>1 && $cost>$maincost*2 || $maincost<=1 && $price>2))
		showmsg('下级价格最高不能超过原代理价格的2倍（低于1元的商品，代理价格最高不能超过2元）',3);
}else{
	if($price<$price_obj->getToolCost($tid)){
		showmsg('销售价格不能低于成本价格！',3);
	}
	$cost=0;
}
if($conf['fenzhan_pricelimit']==1 && ($mainprice>1 && $price>$mainprice*2 || $mainprice<=1 && $price>2))
	showmsg('商品售价最高不能超过原售价的2倍（低于1元的商品，售价最高不能超过2元）',3);
if($price_obj->setPriceInfo($tid,$del,$price,$cost))
	showmsg('修改商品成功！',1);
else
	showmsg('修改商品失败！'.$DB->error(),4);
}
elseif($my=='reset')
{
if($DB->exec("UPDATE pre_site SET price=NULL WHERE zid='{$userrow['zid']}'"))
	showmsg('重置成功！',1);
else
	showmsg('重置失败！'.$DB->error(),4);
}
else
{
if(isset($_GET['cid'])){
	$cid = intval($_GET['cid']);
	$numrows=$DB->getColumn("SELECT count(*) FROM pre_tools WHERE cid='$cid' AND active=1");
	$sql=" cid='$cid' AND active=1";
	$con='
	<div class="panel panel-default"><div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">'.$shua_class[$cid].'分类 - [<a href="shoplist.php" style="color:#fff00f">查看全部</a>]</div>
	<div class="well well-sm" style="margin: 0;">分类 '.$shua_class[$cid].' 共有 <b>'.$numrows.'</b> 个商品</div>
	<div class="wrapper">
    <a href="#" data-toggle="modal" data-target="#search2" id="search2" class="btn btn-primary"><i class="fa fa-navicon"></i>&nbsp;分类查看</a>&nbsp;<a class="btn btn-info" href="javascript:void(0)" onclick="up_price('.$cid.')"><i class="fa fa-plus-circle"></i>&nbsp;提升售价</a></div>';
	$link='&cid='.$cid;
}elseif(isset($_GET['kw'])){
    $kw = isset($_GET['kw']);
    $numrows=$DB->getColumn("SELECT count(*) FROM pre_tools WHERE A.name LIKE '%$kw%' AND active=1");
	$sql=" A.name LIKE '%$kw%'";
	$con='包含 <b>'.$kw.'</b> 的共有 <b>'.$numrows.'</b> 个商品';
	$link='&kw='.$kw;
}else{
	$numrows=$DB->getColumn("SELECT count(*) FROM pre_tools WHERE active=1");
	$sql=" active=1";
	$con='
	<div class="panel panel-default"><div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">商品列表</div>
	<div class="well well-sm" style="margin: 0;">系统共有 <b>'.$numrows.'</b> 个商品 - 提升价格赚的更多哦！提高价格最好不要太贵了否则没人买的哦！</div>
    <div class="wrapper">
    <a href="#" data-toggle="modal" data-target="#search2" id="search2" class="btn btn-primary"><i class="fa fa-navicon"></i>&nbsp;分类查看</a>&nbsp;<a class="btn btn-success" onclick="reset_price(0)" href="javascript:void(0)"><i class="fa fa-refresh"></i>&nbsp;恢复价格</a>&nbsp;<a class="btn btn-info" href="javascript:void(0)" onclick="up_price(0)"><i class="fa fa-plus-circle"></i>&nbsp;提升售价</a></div>';
}
?>

        <div style="background: #f2f2f2; height: 10px"></div>
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
            <div class="my-cell-title display-row justify-between align-center">
                <div class="my-cell-title-l left-title" style="font-size:1.3rem">商品详情</div>
                <div class="my-cell-title-r  display-row  align-center">
                    <span style="color: #939393;font-size:1.3rem">共<?php echo ''.$numrows.'' ?>件商品</span>
                </div>
            </div>
    <div class="hotxy block-white" id="tab">
        <div style="overflow-x: scroll;width: 100%;padding: 10px 0">
            <a class="hotxy-item hotxy-item-index" id="tab_0" href="./shoplist.php">全部</a>
            <?php echo $select?>
        </div>
        <div style="overflow-x: scroll;width: 100%;padding: 10px 0">
            <?php echo $selectson?>
        </div>
    </div>
<br>

  
<?php

$pagesize=10;
$pages=ceil($numrows/$pagesize);
$page=isset($_GET['page'])?intval($_GET['page']):1;
$offset=$pagesize*($page - 1);

$rs=$DB->query("SELECT * FROM pre_tools WHERE{$sql} ORDER BY sort DESC LIMIT $offset,$pagesize");

while($res = $rs->fetch())
{
	$price_obj->setToolInfo($res['tid'],$res);

echo ' <div class="list-item">
                                 <div class="list-item-top" style="padding-bottom: 10px">
                                      <div class="item-logo-1" style="width: auto;padding-right: 10px">
                                         <div class="item-logo-img" style="width: auto;padding: 0 25px">站长推荐商品</div>
                                      </div>
                                      <div class="item-operate" style="padding-top: 5px">
                                         <a class="item-operate-item" href="./shoplist.php?my=edit&tid='.$res['tid'].'">编辑</a>
                                      </div>
                                 </div>
                                 <div class="list-item-c">
                                     <div class="item-c-txet" style="line-height: normal;">
                                         <div class="item-c-title" style="font-size: 13px;">商品名称</div>
                                         <div class="item-c-data">'.$res['name'].'</div>
                                     </div>
                                     <div class="item-c-txet">
                                         <div class="item-c-title" style="font-size: 13px;">成本价格</div>
                                         <div class="item-c-data">￥'.($userrow['power']==2?$price_obj->getToolCost2($res['tid']).'</div>
                                     </div>
                                     <div class="item-c-txet">
                                         <div class="item-c-title" style="font-size: 13px;">下级价格</div>
                                         <div class="item-c-data">￥'.$price_obj->getToolCost($res['tid']):$price_obj->getToolCost($res['tid'])).'</div>
                                     </div>
                                     <div class="item-c-txet">
                                         <div class="item-c-title" style="font-size: 13px;">销售价格</div>
                                         <div class="item-c-data">￥'.$price_obj->getToolPrice($res['tid']).'</div>
                                     </div>
                                     <div class="item-c-txet">
                                         <div class="item-c-title" style="font-size: 13px;">上架状态</div>
                                         '.($price_obj->getToolDel($res['tid'])==1 || $res['close']==1?'<div class="item-c-data">已下架</div>':'<div class="item-c-data">已上架</div>').'
                                         
                                     </div>
                                     
                                 </div>
                              </div>';}
?></div>            </div></div>
<div align="center">
<?php
echo'<ul class="pagination"  style="margin-left:1em">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="shoplist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="shoplist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
$start=$page-3>1?$page-3:1;
$end=$page+3<$pages?$page+3:$pages;
for ($i=$start;$i<$page;$i++)
echo '<li><a href="shoplist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$end;$i++)
echo '<li><a href="shoplist.php?page='.$i.$link.'">'.$i .'</a></li>';
if ($page<$pages)
{
echo '<li><a href="shoplist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="shoplist.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
}?>
</div>
        </div>
            </div>

</div><script>
   //var cid = '//';
    var cid = getUrlParam('cid');
    var set_auto_price = '0';
    var set_auto_price_num = '0.00';
    //获取url中的参数
    function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg);  //匹配目标参数
        if (r != null) return unescape(r[2]); return null; //返回参数值
    }
    $(document).ready(function(){
        if(cid){
            cid = parseInt(cid);
            $("#tab_0").removeClass('hotxy-item-index');
            $("#tab_"+ cid).addClass('hotxy-item-index');
            $("#tab").scrollLeft(100 * cid/2);
        }else{
            $("#tab_0").addClass('hotxy-item-index');
        }

    });

</script>

<script>

function reset_price(cid) {
    layer.open({
        type:1,
        title: false,
        area: '28rem',
        shade: 0.7,
        skin: "layerdemo",
        shadeClose: false,
        closeBtn: 0,
        offset: '30%',
        btnAlign: 'c',
        btn: ['确认', '再想想'],
        content:
            '<div class="showtip display-column align-center" style="letter-spacing:.05rem;">' +
            '<div class="showtip-title" style="height: 3rem"></div>' +
            '<div class="showtip-center  display-column justify-center align-center" style="margin-bottom: 3rem">'+
            '<img src="../assets/user/img/warning.png" style="height:4rem">'+
            '<div class="showtip-center-msg">恢复价格</div>'+
            '<div class="showtip-center-num" style="font-size: 1.2rem">重置所有商品价格至最初状态</div>' +
            '</div>'+
            '</div>',
        btn1: function(index, layero){
            $.ajax({
                type: "post",
                url: "ajax_user.php?act=reset_price",
                data: {
                    cid: cid
                },
                dataType: "json",
                success: function (data) {
                    if (data.code == 0) {
                        layer.close(index);
                        layer.alert('恢复价格成功！', {icon: 1}, function () {
                            window.location.reload();
                        });
                    } else {

                        layer.alert(data.msg);
                    }
                }
            });
        },
        btn2: function(index, layero){
            layer.closeAll();

        },
        success: function(layero, index){
            var btn1= $(".layui-layer-btn .layui-layer-btn0");
            btn1.css({
                "width":" 50%",
                "height": "100%",
                "padding": "0",
                "margin":"0",
                "line-height": "4.5rem",
                "border-radius":" 0",
                "border":" 1px solid transparent",
                "background": "transparent",
                "color":"#000",
            })
            var btn2= $(".layui-layer-btn .layui-layer-btn1");
            btn2.css({
                "width":" 50%",
                "height": "100%",
                "padding": "0",
                "margin":"0",
                "line-height": "4.5rem",
                "border-radius":" 0",
                "border":" 1px solid transparent",
                "border-left": "1px solid #f2f2f2",
                "background": "transparent",
                "color":"#999999",
            })

        }
    });

}

 function up_price(zid){
    layer.open({
        type:1,
        title: false,
        area: '28rem',
        shade: 0.7,
        skin: "layerdemo",
        shadeClose: false,
        closeBtn: 0,
        offset: '30%',
        btnAlign: 'c',
        btn: ['确认', '取消'],
        content:
            '<div class="showtip display-column align-center" style="letter-spacing:.05rem;">' +
            '<div class="showtip-title" style="height: 1rem"></div>' +
            '<div class="showtip-center  display-column justify-center align-center" style="width: 100%">'+
            '<div class="showtip-center-msg">一键提升销售价格</div>'+
            '<div class="showtip-center-num" style="width: 100%;margin-bottom: 15px">' +
            '<input type="hidden"  name="tisheng_type" id="tisheng_type" >' +
            '<div class="display-row align-center justify-around" style="width: 100%;margin: 10px 0"> ' +
            '<a onclick="$(\'#tisheng_type\').val(1);$(\'#tisheng_1\').css({\'background\':\'#438ff3\',\'color\':\'#fff\'});$(\'#tisheng_2\').css({\'background\':\'transparent\',\'color\':\'#000\'});" id="tisheng_1" style="width: 43%;height: 3.5rem; border: 1px solid #bfbfbf;text-align: center;border-radius: 5px;line-height: 3.5rem">百分比</a>' +
            '<a onclick="$(\'#tisheng_type\').val(2);$(\'#tisheng_2\').css({\'background\':\'#438ff3\',\'color\':\'#fff\'});$(\'#tisheng_1\').css({\'background\':\'transparent\',\'color\':\'#000\'});" id="tisheng_2" style="width: 43%;height: 3.5rem; border: 1px solid #bfbfbf;text-align: center;border-radius: 5px;line-height: 3.5rem">固定金额</a>' +
            '</div>' +
            '<input style="width: 93%; margin: 0 auto;text-align: left;background:#f2f2f2;"  name="tisheng_value" id="tisheng_value" value="" placeholder="请输入数值" class="form-control  search-input">' +
            '</div>'+

            '</div>' +
            '</div>',
                yes: function (index,layero) {
                    var type = $('#tisheng_type').val();
                    if(type == "")
                    {
                        layer.msg("请选择提升类型");
                        return false;
                    }
                    var text = $('#tisheng_value').val();
                    if(text == "")
                    {
                        layer.msg("请填写数值");
                        return false;
                    }
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        url: '/api_ajax.php?act=up_price',
                        cache: false,
                        data: {zid:<?=$userrow['zid']?>,up:text,type:type},
                        success: function(data){
                            if(data.code==0){
                                layer.alert('销售价格提升成功',function(){
                                  window.location.reload();
                                });
                            }else{
                                layer.alert(data.msg);
                            }
                        },
                        error: function(data){
                            layer.msg('网络异常，请稍后重试');
                        }
                    });
                },
        success: function(layero, index){
            var btn1= $(".layui-layer-btn .layui-layer-btn0");
            btn1.css({
                "width":" 50%",
                "height": "100%",
                "padding": "0",
                "margin":"0",
                "line-height": "4.5rem",
                "border-radius":" 0",
                "border":" 1px solid transparent",
                "background": "transparent",
                "color":"#000",
            })
            var btn2= $(".layui-layer-btn .layui-layer-btn1");
            btn2.css({
                "width":" 50%",
                "height": "100%",
                "padding": "0",
                "margin":"0",
                "line-height": "4.5rem",
                "border-radius":" 0",
                "border":" 1px solid transparent",
                "border-left": "1px solid #f2f2f2",
                "background": "transparent",
                "color":"#999999",
            })

        }
    });
}
function up_price01(cid){
            layer.open({
                type:1,
                title: false,
                area: '28rem',
                shade: 0.7,
                skin: "layerdemo",
                shadeClose: false,
                closeBtn: 0,
                offset: '30%',
                btnAlign: 'c',
                btn: ['确认', '取消']
                , content: '<div class="showtip display-column align-center" style="letter-spacing:.05rem;">' +
            '<div class="showtip-title" style="height: 1rem"></div>' +
            '<div class="showtip-center  display-column justify-center align-center" style="width: 100%">'+
            '<div class="showtip-center-msg" align="center">提升商品销售价格-普通用户<br>提升单独小分类售价<br>只可以在小分类或二级分类使用</div>'+
            '<div class="showtip-center-num" style="width: 100%;margin-bottom: 15px">' +
            '<input type="hidden" name="tisheng_type" id="tisheng_type" >' +
            '<div class="display-row align-center justify-around" style="width: 100%;margin: 10px 0"> ' +
            '' +
            '<a onclick="$(\'#tisheng_type\').val(2);$(\'#tisheng_2\').css({\'background\':\'#438ff3\',\'color\':\'#fff\'});$(\'#tisheng_1\').css({\'background\':\'transparent\',\'color\':\'#000\'});" id="tisheng_2" style="width: 43%;height: 3.5rem; border: 1px solid #bfbfbf;text-align: center;border-radius: 5px;line-height: 3.5rem">百分比</a>' +
            '</div>' +
            '<input style="width: 93%; margin: 0 auto;text-align: left;background:#f2f2f2;"  name="tisheng_value" id="tisheng_value" value="" placeholder="请输入数值" class="form-control  search-input">' +
            '</div>'+
            '</div>' +
            '</div>',
                btn2: function(index, layero){
                layer.closeAll();
                },
                btn1: function(index, layero){
                    var type = $('#tisheng_type').val();
                    if(type == "")
                    {
                        layer.msg("请选择提升类型");
                        return false;
                    }
                    var text = $('#tisheng_value').val();
                    if(text == "")
                    {
                        layer.msg("请填写数值");
                        return false;
                    }
                     $.ajax({
                        type: 'post',
                        dataType: 'json',
                        url: 'ajax_user.php?act=up_price',
                        cache: false,
                        data: {up:text,cid:cid,type:type},
                        success: function (data) {
                            if (data.code == 0) {
                                layer.alert('价格提升成功，刷新即可看到效果', {icon: 1}, function () {
                                    window.location.reload();
                                });
                            } else {
                                layer.alert(data.msg);
                            }
                        },
                        error: function (data) {
                            layer.msg('网络异常，请稍后重试');
                        }
                    });
                },
        success: function(layero, index){
            var btn1= $(".layui-layer-btn .layui-layer-btn0");
            btn1.css({
                "width":" 50%",
                "height": "100%",
                "padding": "0",
                "margin":"0",
                "line-height": "4.5rem",
                "border-radius":" 0",
                "border":" 1px solid transparent",
                "background": "transparent",
                "color":"#000",
            })
            var btn2= $(".layui-layer-btn .layui-layer-btn1");
            btn2.css({
                "width":" 50%",
                "height": "100%",
                "padding": "0",
                "margin":"0",
                "line-height": "4.5rem",
                "border-radius":" 0",
                "border":" 1px solid transparent",
                "border-left": "1px solid #f2f2f2",
                "background": "transparent",
                "color":"#999999",
            })
        
                }
            });
        }
function setActive(id){

    var i = $("input[type=hidden][name="+id+"]").val();
    console.log(id)
    if(id == 'del'){
        if(i == 1){
            $("#"+ id + " i").removeClass('fa-flip-horizontal');
            $("#"+ id + " i").css({"color":"#0b9ff5"});
            $("input[type=hidden][name="+id+"]").val(0)
        }else {
            $("#"+ id + " i").addClass('fa-flip-horizontal');
            $("#"+ id + " i").css({"color":"#94a7c1"});
            $("input[type=hidden][name="+id+"]").val(1)
        }
    }

}
function xiaji_up_price(zid) {
    layer.open({
        type:1,
        title: false,
        area: '28rem',
        shade: 0.7,
        skin: "layerdemo",
        shadeClose: false,
        closeBtn: 0,
        offset: '30%',
        btnAlign: 'c',
        btn: ['确认', '取消'],
        content:
            '<div class="showtip display-column align-center" style="letter-spacing:.05rem;">' +
            '<div class="showtip-title" style="height: 1rem"></div>' +
            '<div class="showtip-center  display-column justify-center align-center" style="width: 100%">'+
            '<div class="showtip-center-msg">一键提升下级价格</div>'+
            '<div class="showtip-center-num" style="width: 100%;margin-bottom: 15px">' +
            '<input type="hidden" name="tisheng_type" id="tisheng_type" >' +
            '<div class="display-row align-center justify-around" style="width: 100%;margin: 10px 0"> ' +
            '<a onclick="$(\'#tisheng_type\').val(1);$(\'#tisheng_1\').css({\'background\':\'#438ff3\',\'color\':\'#fff\'});$(\'#tisheng_2\').css({\'background\':\'transparent\',\'color\':\'#000\'});" id="tisheng_1" style="width: 43%;height: 3.5rem; border: 1px solid #bfbfbf;text-align: center;border-radius: 5px;line-height: 3.5rem">百分比</a>' +
            '<a onclick="$(\'#tisheng_type\').val(2);$(\'#tisheng_2\').css({\'background\':\'#438ff3\',\'color\':\'#fff\'});$(\'#tisheng_1\').css({\'background\':\'transparent\',\'color\':\'#000\'});" id="tisheng_2" style="width: 43%;height: 3.5rem; border: 1px solid #bfbfbf;text-align: center;border-radius: 5px;line-height: 3.5rem">固定金额</a>' +
            '</div>' +
            '<input style="width: 93%; margin: 0 auto;text-align: left;background:#f2f2f2;"  name="tisheng_value" id="tisheng_value" value="" placeholder="请输入数值" class="form-control  search-input">' +
            '</div>'+
            '</div>' +
            '</div>',
                yes: function (index,layero) {
                    var type = $('#tisheng_type').val();
                    if(type == "")
                    {
                        layer.msg("请选择提升类型");
                        return false;
                    }
                    var text = $('#tisheng_value').val();
                    if(text == "")
                    {
                        layer.msg("请填写数值");
                        return false;
                    }
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        url: '/api_ajax.php?act=xiaji_up_price',
                        cache: false,
                        data: {zid:<?=$userrow['zid']?>,up:text,type:type},
                        success: function(data){
                            if(data.code==0){
                                layer.alert('下级价格提升成功！',function(){
                                  window.location.reload();
                                });
                            }else{
                                layer.alert(data.msg);
                            }
                        },
                        error: function(data){
                            layer.msg('网络异常，请稍后重试');
                        }
            });

        },
        success: function(layero, index){
            var btn1= $(".layui-layer-btn .layui-layer-btn0");
            btn1.css({
                "width":" 50%",
                "height": "100%",
                "padding": "0",
                "margin":"0",
                "line-height": "4.5rem",
                "border-radius":" 0",
                "border":" 1px solid transparent",
                "background": "transparent",
                "color":"#000",
            })
            var btn2= $(".layui-layer-btn .layui-layer-btn1");
            btn2.css({
                "width":" 50%",
                "height": "100%",
                "padding": "0",
                "margin":"0",
                "line-height": "4.5rem",
                "border-radius":" 0",
                "border":" 1px solid transparent",
                "border-left": "1px solid #f2f2f2",
                "background": "transparent",
                "color":"#999999",
            })

        }
    });
}
//设置自动价格
    function auto_price() {

        layer.open({
            type:1,
            title: false,
            area: '28rem',
            shade: 0.7,
            skin: "layerdemo",
            shadeClose: false,
            closeBtn: 0,
            offset: '30%',
            btnAlign: 'c',
            btn: ['取消', '确认'],
            content:
                '<div class="showtip display-column align-center" style="letter-spacing:.05rem;">' +
                '<div class="showtip-title" style="height: 1rem"></div>' +
                '<div class="showtip-center  display-column justify-center align-center" style="width: 100%">'+
                '<div class="showtip-center-msg">新商品自动同步商品价格</div>'+
                '<div class="showtip-center-num" style="width: 100%;margin-bottom: 15px">' +
                '<input type="hidden"  name="auto_price_type" id="auto_price_type" value="">' +
                '<div class="display-row align-center justify-around" style="width: 100%;margin: 10px 0"> ' +
                '<a onclick="$(\'#auto_price_type\').val(0);$(\'#auto_0\').css({\'background\':\'#438ff3\',\'color\':\'#fff\'});$(\'#auto_1,#auto_2\').css({\'background\':\'transparent\',\'color\':\'#000\'});demo(0);" id="auto_0" style="width: 30%;height: 3.5rem; border: 1px solid #bfbfbf;text-align: center;border-radius: 5px;line-height: 3.5rem">关闭</a>' +
                '<a onclick="$(\'#auto_price_type\').val(1);$(\'#auto_1\').css({\'background\':\'#438ff3\',\'color\':\'#fff\'});$(\'#auto_0,#auto_2\').css({\'background\':\'transparent\',\'color\':\'#000\'});demo(1);" id="auto_1" style="width: 30%;height: 3.5rem; border: 1px solid #bfbfbf;text-align: center;border-radius: 5px;line-height: 3.5rem">固定金额</a>' +
                '<a  onclick="$(\'#auto_price_type\').val(2);$(\'#auto_2\').css({\'background\':\'#438ff3\',\'color\':\'#fff\'});$(\'#auto_0,#auto_1\').css({\'background\':\'transparent\',\'color\':\'#000\'});demo(2);" id="auto_2" style="width: 30%;height: 3.5rem; border: 1px solid #bfbfbf;text-align: center;border-radius: 5px;line-height: 3.5rem">百分比</a>' +
                '</div>' +
                '<input style="width: 93%; margin: 0 auto;text-align: left;background:#f2f2f2;"  name="auto_price_num" id="auto_price_num" value="" placeholder="请输入数值" class="form-control  search-input">' +
                '<p style="font-size:.95rem;color: #999999;padding: 0 10px;margin-top: 10px; line-height: 1.6rem">*自动同步商品价格,是根据您选择的提升类型,自动提升最新商品的价格(只同步后期新上架商品)</p>'+
                '</div>'+

                '</div>' +
                '</div>',
            btn1: function(index, layero){
                layer.closeAll();
            },
            btn2: function(index, layero){
                var type = $('#auto_price_type').val();
                
                if (type == "") {
                    layer.msg("请选择自动提升类型");
                    return false;
                }
                var price_num = $('#auto_price_num').val();
                var re = /^[0-9]+.?[0-9]*$/;
                if (!re.test(price_num)) {
                    layer.msg("请填写数字数值");
                    return false;
                }
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: 'ajax_user.php?act=auto_price',
                    cache: false,
                    data: { auto_price: type, auto_price_num: price_num},
                    success: function (data) {

                        layer.alert('修改成功', {icon: 1}, function () {
                            window.location.reload();
                        });
                    },
                    error: function (data) {
                        layer.alert('修改成功', {icon: 1}, function () {
                            window.location.reload();
                        });
                    }
                });

            },
            success: function(layero, index){
                $('#auto_'+ 0).css({'background':'#438ff3','color':'#fff'});
                var btn1= $(".layui-layer-btn .layui-layer-btn0");
                btn1.css({
                    "width":" 50%",
                    "height": "100%",
                    "padding": "0",
                    "margin":"0",
                    "line-height": "4.5rem",
                    "border-radius":" 0",
                    "border":" 1px solid transparent",
                    "background": "transparent",
                    "color":"#999999",
                })
                var btn2= $(".layui-layer-btn .layui-layer-btn1");
                btn2.css({
                    "width":" 50%",
                    "height": "100%",
                    "padding": "0",
                    "margin":"0",
                    "line-height": "4.5rem",
                    "border-radius":" 0",
                    "border":" 1px solid transparent",
                    "border-left": "1px solid #f2f2f2",
                    "background": "transparent",
                    "color":"#000",
                })

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
                '<font style="font-weight: 800;line-height: 3rem">如何提升商品售价？</font><br>'+
                '<font style="color: #999999">点击提升售价，选择百分比或者固定金额，输入数字整数，百分比输入10=提升10%售价，固定金额输入10=提升10元售价，商品售价不做上限要求，具体由您自己设定。</font><br>'+
                '</div>'+
                '<div class="text-left" style="width:100%;padding: 15px;background:#f2f2f2 ">'+
                '<font style="font-weight: 800;line-height: 3rem">修改价格之后首页价格没变化？</font><br>'+
                '<font style="color: #999999"> 因为您当前的账号属于站长级别，看到的当然是您自己的价格，需要您退出当前登录的账号后首页才能看到您设定的售价，否则看到的都是系统成本价。</font><br>'+
                '</div>'+
                
                '<div class="showtip-btn display-row justify-center align-center" >' +
                '<a  href="javascript:layer.closeAll();" class="showtip-btn-yes display-column justify-center align-center" style="height:4rem;color: #0b9ff5">确定</a>' +
                '</div>'+
                '</div>'+
                '</center>',
        });

    }
    function demo(id){
        if(id==0){
            $("#auto_price_num").val('0');

        }else if(id==1){
            $("#auto_price_num").val('1');
        }
        else if(id==2){
            $("#auto_price_num").val('');
        }
    }
</script>
<div class="layui-layer-move"></div>
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

<!DOCTYPE html>
      <html lang="zh-cn" style="" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths"><head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>分站排行榜</title>
  <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../assets/simple/css/plugins.css">
  <link rel="stylesheet" href="../assets/simple/css/main.css">
  <link rel="stylesheet" href="../assets/css/common.css">
    <link href="//cdn.staticfile.org/layui/2.5.7/css/layui.css" rel="stylesheet">
  <script src="//cdn.staticfile.org/modernizr/2.8.3/modernizr.min.js"></script>
  <link rel="stylesheet" href="../assets/user/css/my.css">
   <script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdn.staticfile.org/layui/2.5.7/layui.all.js"></script><link id="layuicss-laydate" rel="stylesheet" href="http://cdn.staticfile.org/layui/2.5.7/css/modules/laydate/default/laydate.css?v=5.0.9" media="all"><link id="layuicss-layer" rel="stylesheet" href="http://cdn.staticfile.org/layui/2.5.7/css/modules/layer/default/layer.css?v=3.1.1" media="all"><link id="layuicss-skincodecss" rel="stylesheet" href="http://cdn.staticfile.org/layui/2.5.7/css/modules/code.css" media="all">
<style>body{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style></head>
<body>
<style>
    .layui-carousel, .layui-carousel>[carousel-item]>* {
        background-color:transparent;
    }
</style>
<body><link rel="stylesheet" href="../assets/user/css/work.css">
<style>
    .item-c-title{
        width: 25%;
    }
    .list-item .list-item-c .item-c-txet .item-c-data{
        margin-left: 0;
    }
    input::placeholder{
        text-align: right;
    }
    input{
        text-align: right;
    }
    .form-control[disabled]{
        background-color:transparent;
    }
    .search-input::placeholder{
        text-align: left;
    }
    .layui-layer {
        /*background: #fff;*/
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
/**
 * 分站排行
**/
include("../includes/common.php");
$title='分站排行榜';

if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<?php
if(!$conf['fenzhan_rank'])showmsg('当前排行榜功能未开放');
if($userrow['power']==0){
	showmsg('你没有权限使用此功能！',3);
}
$thtime=date("Y-m-d").' 00:00:00';
$lastday=date("Y-m-d",strtotime("-1 day")).' 00:00:00';
$limit = $conf['rank_reward']>10?$conf['rank_reward']:10;
if($_GET['last']==1){
	$sql = "select a.zid,(select b.sitename from pre_site as b where a.zid=b.zid) as sitename,count(id) as count,sum(money) as money from pre_orders as a where addtime>'$lastday' and addtime<'$thtime' and zid>1 group by zid order by money desc limit {$limit}";
	$addstr = '已发放奖励';
}else{
	$sql = "select a.zid,(select b.sitename from pre_site as b where a.zid=b.zid) as sitename,count(id) as count,sum(money) as money from pre_orders as a where addtime>'$thtime' and zid>1 group by zid order by money desc limit {$limit}";
	$addstr = '预计发放奖励';
}

?>

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
            <font><a href="">分站排行榜</a></font>

            </div>
                </div>
            <div  style="background: #f2f2f2; height: 10px"></div>
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
            <div class="my-cell-title display-row justify-between align-center">
                    <div class="my-cell-title-l left-title" style="font-size:1.4rem">排行榜说明</div>
                    <div class="my-cell-title-r  display-row  align-center">
                    </div>
                </div>
                
            <div style="font-size: 1.3rem;color: #999999;padding: 5px 10px">
                <p>站长排行榜奖励会在每天0点后发放前一天的，奖励对象为销量排行榜前<?php echo $conf['rank_reward']?>名，当前额外提成奖励为销售金额的<?php echo $conf['rank_percentage']?>%！</p>

</div></div>

        <div style="background: #f2f2f2; height: 10px"></div>
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
            <div class="my-cell-title display-row justify-between align-center">
                <div class="my-cell-title-l left-title" style="font-size:1.4rem">排行榜详情</div>
            </div>
            
<ul class="nav nav-tabs"  style="width: 100%;display: inline-block;border-radius: 0px;box-shadow: 0px 0px 0px #e2dfdf;border:  1px solid #f2f2f2;">
<li class="<?php echo $_GET['last']!=1?'active':null;?>" style="width:50%"><a href="rank.php"><center>今日销售排行</center></a></li>
<li class="<?php echo $_GET['last']==1?'active':null;?>" style="width:50%"><a href="rank.php?last=1"><center>昨日销售排行</center></a></li>
</ul>


          <tbody>
<?php
$rs=$DB->query($sql);
$i=1;
while($res = $rs->fetch())
{
    echo '<div class="list-item">
                                 <div class="list-item-top">
                                      <div class="item-logo-3" style="width: auto;padding-right: 8px">
                                         <div class="item-logo-img" style="width: auto;padding: 0 10px">第'.$i.'名</div>
                                      </div>
                                 </div>
<div class="list-item-c">
                                     <div class="item-c-txet">
                                         <div class="item-c-title">站点ID</div>
                                         <div class="item-c-data">'.$res['zid'].'</div>
                                     </div>
                                     <div class="item-c-txet">
                                         <div class="item-c-title">站点名称</div>
                                         <div class="item-c-data">'.mb_substr($res['sitename'], 0, 10, 'utf-8').'</div>
                                     </div>
                                     <div class="item-c-txet">
                                         <div class="item-c-title">订单数</div>
                                         <div class="item-c-data">'.$res['count'].'</div>
                                     </div>
                                     <div class="item-c-txet">
                                         <div class="item-c-title">销售金额</div>
                                         <div class="item-c-data">￥'.$res['money'].'</div>
                                     </div>
                                 </div>
                              </div>';


echo '</tr>';
$i++;
}
?>
          </tbody>
        </table>
      </div>
    </div>
 </div>
</div>
<?php include './foot.php';?>
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
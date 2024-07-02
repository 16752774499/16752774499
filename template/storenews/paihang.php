<?php
if(!defined('IN_CRONLITE'))exit();
?>
<?php
/**
 * 商品销量排行榜
**/
include("../includes/common.php");
$title='商品销量排行榜';
?>
<?php
$thtime=date("Y-m-d",strtotime("-1 day")).' 00:00:00';

$lastday=date("Y-m-d",strtotime("-2 day")).' 00:00:00';
$Weeklysales=date("Y-m-d",strtotime("-7 day")).' 00:00:00';
$Monthlysales=date("Y-m-d",strtotime("-30 day")).' 00:00:00';
if($_GET['last']==0){
	$sql = "SELECT B.tid,B.name,count(A.id) num FROM pre_orders A LEFT JOIN pre_tools B ON A.tid=B.tid WHERE A.addtime>='$thtime' GROUP BY B.tid ORDER BY num DESC LIMIT 100";
}
if($_GET['last']==1){
	$sql = "SELECT B.tid,B.name,count(A.id) num FROM pre_orders A LEFT JOIN pre_tools B ON A.tid=B.tid WHERE A.addtime>='$lastday' AND A.addtime<'$thtime' GROUP BY B.tid ORDER BY num DESC LIMIT 100";
}
if($_GET['last']==2){
	$sql = "SELECT B.tid,B.name,count(A.id) num FROM pre_orders A LEFT JOIN pre_tools B ON A.tid=B.tid WHERE A.addtime>='$Weeklysales' AND A.addtime<'$thtime' GROUP BY B.tid ORDER BY num DESC LIMIT 100";
}
if($_GET['last']==3){
	$sql = "SELECT B.tid,B.name,count(A.id) num FROM pre_orders A LEFT JOIN pre_tools B ON A.tid=B.tid WHERE A.addtime>='$Monthlysales' AND A.addtime<'$thtime' GROUP BY B.tid ORDER BY num DESC LIMIT 100";
}
?>
<style type="text/css">
<!--
.STYLE3 {font-size: 14px}
-->
</style>

<!DOCTYPE html>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>商品销量排行榜</title>
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
</style>
<style>
    body{
        max-width:550px;
        margin:0 auto;
      overflow: auto;height: auto !important;
    }
    .container {
        margin:10px 0px;
  width: 0%;
  text-align: center;
}

    
    .top{
      background-color: #<?php echo $conf['rgb01']; ?>;
      width: 100%;
      max-width: 550px;
      padding-bottom:15px;
      }
    .top1{
      background-color: #<?php echo $conf['rgb01']; ?>;
      width: 100%;
      max-width: 550px;0
      padding-bottom:0px;
      position: fixed;
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
      height: 60px;
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
  .alert-info {
  background-color: #fff1dc;
  color:#fc7032;
  -webkit-box-shadow: 0 2px #ffa56a;
  box-shadow: 0 2px #ffa56a;
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
    
    <div class="top">
    <div class="top1" style="z-index:10000;">
        <a href="./" class="home">
            <i class="layui-icon layui-icon-return"></i>
        </a>
        <div class="toptitle" style="font-size: 15px;">
            <a href="" style="color: #ffffff;">商品销量排行榜</a>
        </div>
            </div>
                </div>
    <div class="likebox" style="padding-bottom: 3em;"></div>


<div class="block">

<ul class="nav nav-pills">
<li class="<?php echo $_GET['last']==0?'active':null;?>" style="width:24.5%"><a href="/?mod=paihang" style="font-size: 13px;"><center>24h销量<br>TOP100</center></a></li>
<li class="<?php echo $_GET['last']==1?'active':null;?>" style="width:24.5%"><a href="/?mod=paihang&last=1" style="font-size: 13px;"><center>48h销量<br>TOP100</center></a></li>
<li class="<?php echo $_GET['last']==2?'active':null;?>" style="width:24.5%"><a href="/?mod=paihang&last=2" style="font-size: 13px;"><center>7日销量<br>TOP100</center></a></li>
<li class="<?php echo $_GET['last']==3?'active':null;?>" style="width:24.5%"><a href="/?mod=paihang&last=3" style="font-size: 13px;"><center>30日销量<br>TOP100</center></a></li>
</ul>

      <div>

            <br>
          <tbody>

<?php
$rs=$DB->query($sql);
$i=1;
while($res = $rs->fetch())
{
    echo '<div class="list-item">
                                  <div class="list-item-top" style="padding-bottom: 10px">
                                      <div class="item-logo-7" style="width: auto;padding-right: 18px">
                                         <div class="item-logo-img" style="width: auto;padding: 0 25px">NO.'.$i.'</div>
                                      </div>
                                 </div>
<div class="list-item-c">
                                     <div class="item-c-txet">
                                         <div class="item-c-title" style="font-size: 13px;"><a style="color: #666666;" href="/?mod=buy3&tid='.$res['tid'].'">【查看商品】</a></div>
                                         <div class="item-c-data" style="font-size: 13px;">&nbsp;&nbsp;&nbsp;'.$res['name'].'</div>
                                     </div>
                                 </div>
                              </div>';
echo '</tr>';
$i++;
}
?>
          </tbody>
      </div>
    </div>
 </div>
</div>
</div>
<br>
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
<?php
/**
 * 商品销量排行
**/
include("../includes/common.php");
$title='商品销量排行';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
    <div class="col-xs-12 col-md-10 center-block" style="float: none;">
<?php
$thtime=date("Y-m-d").' 00:00:00';
$lastday=date("Y-m-d",strtotime("-1 day")).' 00:00:00';
$Weeklysales=date("Y-m-d",strtotime("-7 day")).' 00:00:00';
$Monthlysales=date("Y-m-d",strtotime("-31 day")).' 00:00:00';
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
<div class="block">
     <div class="block-title"><h2>商品销量排行</h2></div>
<ul class="nav nav-tabs">
<li class="<?php echo $_GET['last']==0?'active':null;?>" style="width:25%"><a href="shoprank.php"><center>今日销量</center></a></li>
<li class="<?php echo $_GET['last']==1?'active':null;?>" style="width:25%"><a href="shoprank.php?last=1"><center>昨日销量</center></a></li>
<li class="<?php echo $_GET['last']==2?'active':null;?>" style="width:25%"><a href="shoprank.php?last=2"><center>7天销量</center></a></li>
<li class="<?php echo $_GET['last']==3?'active':null;?>" style="width:25%"><a href="shoprank.php?last=3"><center>30天销量</center></a></li>
</ul>

      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th class="text-center">排名</th><th class="text-center">商品ID</th><th class="text-center">商品名称</th><th class="text-center">订单数量</th></thead>
          <tbody>
<?php
$rs=$DB->query($sql);
$i=1;
while($res = $rs->fetch())
{
echo '<tr><td class="text-center"><span class="badge badge-danger">'.$i.'</span></td><td class="text-center"><b>'.$res['tid'].'</b></td><td class="text-center">'.$res['name'].'</td><td class="text-center">'.$res['num'].'</td></tr>';
$i++;
}
?>
          </tbody>
        </table>
      </div>
    </div>
 </div>
</div>
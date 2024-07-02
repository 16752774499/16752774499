<?php

include("../includes/common.php");
$title='投稿商品审核';
include './head.php';
adminpermission('shop', 1);
if($_GET['cg']){
    	$tid=intval($_GET['cg']);
    	
    		$DB->exec("update pre_tools set close='0' where tid='{$tid}'");
}
if($_GET['close']){
    	$tid=intval($_GET['close']);
    		$DB->exec("update pre_tools set close='1' where tid='{$tid}'");
}
if($_GET['jj']){
    	$tid=intval($_GET['jj']);
    		$DB->exec("update pre_tools set close='88' where tid='{$tid}'");
    		$DB->exec("update pre_tools set active='0' where tid='{$tid}'");
}
if($_GET['fb']){
    	$tid=intval($_GET['fb']);
    		$DB->exec("update pre_tools set close='1' where tid='{$tid}'");
    		$DB->exec("update pre_tools set active='1' where tid='{$tid}'");
}
if($_GET['sc']){
    	$tid=intval($_GET['sc']);
    		$DB->exec("DELETE FROM pre_orders WHERE tid='$tid'");
}
$shequlist=$DB->getAll("SELECT id,url FROM pre_shequ order by id asc");
$shequurls=[];
foreach($shequlist as $res){
	$shequurls[$res['id']]=$res['url'].($res['remark']?' ('.$res['remark'].')':null);
}

function display_shoptype($type, $shequ=0){
	global $shequurls;
	if($type==1||$type==2)
		return '<span class="btn-warning btn-xs enable-tooltips" title="'.$shequurls[$shequ].'" data-toggle="tooltip" data-original-title="'.$shequurls[$shequ].'">对接</span>';
	elseif($type==4)
		return '<span class="btn-success btn-xs">发卡</span>';
	else
		return '<span class="btn-info btn-xs">自营</span>';
}

$classlist=$DB->getAll("SELECT * FROM pre_class WHERE active=1 order by sort asc");
$select='<option value="0">未分类</option>';
$shua_class[0]='未分类';
foreach($classlist as $res){
	$shua_class[$res['cid']]=$res['name'];
	$select.='<option value="'.$res['cid'].'">'.$res['name'].'</option>';
}

if($_SESSION['price_class']){
	$price_class = $_SESSION['price_class'];
}else{
	$pricelist=$DB->getAll("SELECT * FROM pre_price order by id asc");
	$price_class[0]='不加价';
	foreach($pricelist as $res){
		$price_class[$res['id']]=$res['name'];
	}
}

$pagesize = isset($_GET['num'])?intval($_GET['num']):30;
$orderby = 'A.tid desc';
	$numrows=$DB->getColumn("SELECT count(*) from pre_tools WHERE pro>'0'");
	$sql=" pro>'0'";
	$con='系统共有 <b>'.$numrows.'</b> 个商品';
?>
<?php 
if(isset($_POST['tcprice'])){
  $spid=$_POST['tctid'];
  $tcprice=$_POST['tcprice'];
  	$DB->exec("update pre_tools set tc='{$tcprice}' where tid='{$spid}'");
}
if($_GET['tc']){
    $spid=$_GET['tc'];
	$row=$DB->getRow("select * from pre_tools where tid='$spid' limit 1");

?>
<div class="col-md-12 center-block" style="float: none;">
<div class="block">
<div class="block-title clearfix">
<h2>用户提成设置</h2></div>

<form onsubmit="return saveSetting(this)" method="post" class="form-horizontal form-bordered" role="form">
    
    	<div class="form-group">
	  <label class="col-sm-3 control-label">商品ID</label>
	  <div class="col-sm-9"><input type="text" name="tctid" value="<?php echo $_GET['tc']?>" class="form-control" placeholder="商品ID"></div>
	  	  
	</div>
	
	<div class="form-group">
	  <label class="col-sm-3 control-label">提成金额</label>
	  <div class="col-sm-9"><input type="text" name="tcprice" value="<?php echo $row['tc']?>" class="form-control" placeholder="提成金额"></div>
	  	  
	</div>

	<div class="form-group">
	  <div class="col-sm-offset-3 col-sm-9"><input type="submit" name="submit" value="修改" class="btn btn-primary btn-block">
	 </div>
	</div>

  </form>

</div>
</div>
<?php die;}?>
<div class="col-md-12 center-block" style="float: none;">
<div class="block">
<div class="block-title clearfix">
<h2>用户共投稿 <b><?php echo $numrows ?></b> 个商品</h2></div>
	  <form name="form1" id="form1">
	  <div class="table-responsive">
        <table class="table table-striped table-bordered table-vcenter orderList">
          <thead><tr><th>商品ID</th><th>用户ZID</th><th>商品名称</th><th>商品价格</th><th>资源链接</th><th>用户微信号</th><th>状态</th><th>操作</th></tr></thead>
          <tbody>
<?php
$pages=ceil($numrows/$pagesize);
$page=isset($_GET['page'])?intval($_GET['page']):1;
$offset=$pagesize*($page - 1);

$rs=$DB->query("SELECT A.*,B.name classname FROM pre_tools A LEFT JOIN pre_class B ON A.cid=B.cid WHERE{$sql} order by {$orderby} limit $offset,$pagesize");
while($res = $rs->fetch())
{
if($res['is_curl']==4){
	$stock = '发卡';
}elseif($res['stock']===null){
	$stock = '无限';
}else{
	$stock = $res['stock'];
}
if($res['close']=='88'){
    $susu='&nbsp;<a href="?fb='.$res['tid'].'" class="btn btn-xs btn-success">放白</a>';$sup=1;
}else{ $sup=null;
    $susu='&nbsp;<a href="?jj='.$res['tid'].'" class="btn btn-xs" style="background-color: #7f8f99; border-color: #7f8f99;color:#fff;}">拒绝</a>';}
echo '<tr><td><a href="./shoplist.php?tid='.$res['tid'].'">'.$res['tid'].'</a></td><td><a href="./sitelist.php?zid='.$res['pro'].'">'.$res['pro'].'</a></td><td>'.$res['name'].'</td>'.($res['prid']>0?'<td><span onclick="getPrice('.$res['tid'].')"><font color="blue">'.$price_class[$res['prid']].'</font>&nbsp;(成本:'.$res['price'].')</span></td>':'<td><span onclick="getPrice('.$res['tid'].')">'.$res['price'].'｜'.$res['cost'].'｜'.$res['cost2'].'</span>
</td>').'<td>'.$res['zyurl'].'</td><td>'.$res['wx_test'].'</td><td>'.($res['close']==1?'
    <a class="btn btn-xs btn-warning" href="?cg='.$res['tid'].'">待审核</a>':'
    <a class="btn btn-xs btn-success" href="?close='.$res['tid'].'">上架中</a>').''.$susu.'</td><td><a href="./shopedit.php?my=edit&tid='.$res['tid'].'" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="?
tc='.$res['tid'].'" class="btn btn-xs btn-info">提成</a>&nbsp;<a href="?
sc='.$res['tid'].'" class="btn btn-xs btn-danger">删除</a></td></tr>
';
}
?>
          </tbody>
        </table>
</div>
</form>
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="javascript:void(0)" onclick="listTable(\'page='.$first.$link.'\')">首页</a></li>';
echo '<li><a href="javascript:void(0)" onclick="listTable(\'page='.$prev.$link.'\')">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
$start=$page-10>1?$page-10:1;
$end=$page+10<$pages?$page+10:$pages;
for ($i=$start;$i<$page;$i++)
echo '<li><a href="javascript:void(0)" onclick="listTable(\'page='.$i.$link.'\')">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$end;$i++)
echo '<li><a href="javascript:void(0)" onclick="listTable(\'page='.$i.$link.'\')">'.$i .'</a></li>';
if ($page<$pages)
{
echo '<li><a href="javascript:void(0)" onclick="listTable(\'page='.$next.$link.'\')">&raquo;</a></li>';
echo '<li><a href="javascript:void(0)" onclick="listTable(\'page='.$last.$link.'\')">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
?>

<script>

$("#blocktitle").html('<?php echo $con?>');
</script>
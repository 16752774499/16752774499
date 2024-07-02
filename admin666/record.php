<?php
/**
 * 收支明细
**/
include("../includes/common.php");
$title='收支明细';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
    <div class="col-md-12 center-block" style="float: none;">
<?php
$link = '';
$sql = " 1";
$zid = 0;
if(isset($_GET['zid'])){
	$zid = intval($_GET['zid']);
	$sql .= " AND zid=$zid";
	$link .= '&zid='.$zid;
}
if(isset($_GET['kw']) && !empty($_GET['kw'])) {
	$type=intval($_GET['type']);
	$kw=daddslashes($_GET['kw']);
	if($type == 1) $sql .= " AND `action`='$kw'";
	elseif($type == 2) $sql .= " AND `point`='$kw'";
	elseif($type == 3) $sql .= " AND `bz` LIKE '%$kw%'";
	elseif($type == 4) $sql .= " AND `orderid`='$kw'";
	$link .= '&type='.$type.'&kw='.$kw;
}

$thtime=date("Y-m-d").' 00:00:00';
$lastday=date("Y-m-d",strtotime("-1 day")).' 00:00:00';
$income_today=$DB->getColumn("SELECT sum(point) FROM pre_points WHERE action='提成' AND{$sql} AND addtime>'$thtime'");
$outcome_today=$DB->getColumn("SELECT sum(point) FROM pre_points WHERE action='消费' AND{$sql} AND addtime>'$thtime'");
$income_lastday=$DB->getColumn("SELECT sum(point) FROM pre_points WHERE action='提成' AND{$sql} AND addtime<'$thtime' AND addtime>'$lastday'");
$outcome_lastday=$DB->getColumn("SELECT sum(point) FROM pre_points WHERE action='消费' AND{$sql} AND addtime<'$thtime' AND addtime>'$lastday'");
if(isset($_GET['zid'])){
$income_all=$DB->getColumn("SELECT sum(point) FROM pre_points WHERE action='提成' AND{$sql}");
$outcome_all=$DB->getColumn("SELECT sum(point) FROM pre_points WHERE action='消费' AND{$sql}");
}

?>
<div class="block">
     <div class="block-title"><h2><?php echo ($zid>0?'分站ZID:<b>'.$zid.'</b> ':'全部分站')?>收支明细【<a href="payorder.php">查看支付明细</a>】</h2></div>
		  <div class="table-responsive">
<table class="table table-bordered">
<tbody>
<tr height="25">
<td align="center"><font color="#808080"><b>&nbsp;QQ钱包</b></br><span id="count12"></span>元</font></td>
<td align="center"><font color="#808080"><b>&nbsp;微信</b></br><span id="count13"></span>元</font></td>
<td align="center"><font color="#808080"><b>&nbsp;支付宝</b></br><span id="count14"></span>元</font></td>
<td align="center"><font color="#808080"><b>&nbsp;今日消费</b></br><?php echo round($outcome_today,2)?>元</font></td>
<?php if(isset($_GET['zid'])){?>
<td align="center"><font color="#808080"><b><span class="glyphicon glyphicon-tint"></span>总计收益</b></br><?php echo round($income_all,2)?>元</font></td>
<td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-check"></i>总计消费</b></br></span><?php echo round($outcome_all,2)?>元</font></td>
<?php }?>
</tr>
</tbody>
</table>
<form action="./record.php" method="GET" class="form-inline">
  <?php if(isset($_GET['zid'])){?><input type="hidden" name="zid" value="<?php echo $_GET['zid']?>"><?php }?>
  <div class="form-group">
    <label><b>搜索</b></label>
	<select name="type" class="form-control" default="<?php echo @$_GET['type']?>"><option value="1">类型</option><option value="2">金额</option><option value="3">详情</option><option value="4">订单号</option></select>
    <input type="text" class="form-control" name="kw" placeholder="输入搜索内容" value="<?php echo @$_GET['kw']?>">
	<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp;搜索</button>
  </div>
</form>
      <div class="table-responsive">
        <table class="table table-striped">
<thead><tr><th>ID</th><th>站点ID</th><th>类型</th><th>订单号</th><th>金额</th><th>详情</th><th>时间</th></tr></thead>          <tbody>
<?php
$numrows=$DB->getColumn("SELECT count(*) from pre_points WHERE{$sql}");

$pagesize=30;
$pages=ceil($numrows/$pagesize);
$page=isset($_GET['page'])?intval($_GET['page']):1;
$offset=$pagesize*($page - 1);

$rs=$DB->query("SELECT * FROM pre_points WHERE{$sql} order by id desc limit $offset,$pagesize");
while($res = $rs->fetch())
{
echo '<tr><td><b>'.$res['id'].'</b></td><td><a href="sitelist.php?zid='.$res['zid'].'">'.$res['zid'].'</a></td><td>'.$res['action'].'</td><td>'.($res['orderid']?'<a href="./list.php?id='.$res['orderid'].'" target="_blank">'.$res['orderid'].'</a>':'无').'</td><td><font color="'.(in_array($res['action'],array('提成','奖励','赠送','退款','退回','充值','加款'))?'red':'green').'">'.$res['point'].'</font></td><td>'.$res['bz'].'</td><td>'.$res['addtime'].'</td></tr>';
}
?>
          </tbody>
        </table>
      </div>
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="record.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="record.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
$start=$page-10>1?$page-10:1;
$end=$page+10<$pages?$page+10:$pages;
for ($i=$start;$i<$page;$i++)
echo '<li><a href="record.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$end;$i++)
echo '<li><a href="record.php?page='.$i.$link.'">'.$i .'</a></li>';
if ($page<$pages)
{
echo '<li><a href="record.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="record.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
?>
    </div>
  </div>
 </div>
</div>
<script>
$(document).ready(function(){
	$('#title').html('正在加载数据中...');
	$.ajax({
		type : "GET",
		url : "ajax.php?act=getcount",
		dataType : 'json',
		async: true,
		success : function(data) {
			$('#title').html('后台管理首页');
			$('#yxts').html(data.yxts);
			$('#count1').html(data.count1);
			$('#count2').html(data.count2);
			$('#count3').html(data.count3);
			$('#count4').html(data.count4);
			$('#count5').html(data.count5);
			$('#count6').html(data.count6);
			$('#count7').html(data.count7);
			$('#count8').html(data.count8);
			$('#count9').html(data.count9);
			$('#count10').html(data.count10);
			$('#count11').html(data.count11);
			$('#count12').html(data.count12);
			$('#count13').html(data.count13);
			$('#count14').html(data.count14);
			$('#count15').html(data.count15);
			$('#count16').html(data.count16);
			$('#count17').html(data.count17);

			var t=$("#chart-classic-dash");$.plot(t,[{label:"订单量",data:data.chart.orders,lines:{show:!0,fill:!0,fillColor:{colors:[{opacity:.6},{opacity:.6}]}},points:{show:!0,radius:5}},{label:"交易量",data:data.chart.money,lines:{show:!0,fill:!0,fillColor:{colors:[{opacity:.6},{opacity:.6}]}},points:{show:!0,radius:5}}],{colors:["#5ccdde","#454e59"],legend:{show:!0,position:"nw",backgroundOpacity:0},grid:{borderWidth:0,hoverable:!0,clickable:!0},yaxis:{show:!1,tickColor:"#f5f5f5",ticks:3},xaxis:{ticks:data.chart.date,tickColor:"#f9f9f9"}});var s=null,r=null;t.bind("plothover",function(o,t,i){if(i){if(s!==i.dataIndex){s=i.dataIndex,$("#chart-tooltip").remove();var l=(i.datapoint[0],i.datapoint[1]);r=1===i.seriesIndex?"$ <strong>"+l+"</strong>":0===i.seriesIndex?"<strong>"+l+"</strong> sales":"<strong>"+l+"</strong> tickets",$('<div id="chart-tooltip" class="chart-tooltip">'+r+"</div>").css({top:i.pageY-45,left:i.pageX+5}).appendTo("body").show()}}else $("#chart-tooltip").remove(),s=null});
			$.ajax({
				url: '<?php echo $checkupdate?>',
				type: 'get',
				dataType: 'jsonp',
				async: true,
				jsonpCallback: 'callback'
			}).done(function(data){
				$("#checkupdate").html(data.msg);
			})
		}
	});
})
</script>
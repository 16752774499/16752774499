<?php
/**
 * 后台数据管理中心
**/
include("../includes/common.php");
$title='后台数据管理中心';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<?php
$mysqlversion=$DB->getColumn("select VERSION()");
$sec_msg = sec_check();
$checkupdate = getCheckString();
?>
<style>
@media (max-width:767px){
.showcountl{padding-right: 5px;}
.showcountr{padding-left: 3px;}
}
</style>
<div class="col-xs-4 col-lg-2 showcountr">
	<a href="javascript:void(0)" class="widget" title="只统计今日用户消费余额">
	<div class="widget-content widget-content-mini text-right clearfix">
		<h2 class="widget-heading h5 text-warning" style="color:#cc4125">
		<strong><span id="fzjr_xf">0</span>/<span id="fzzr_xf">0</span></strong>
		</h2>
		<span class="text-muted">今昨消费余额</span>
	</div>
	</a>
</div>
<div class="col-xs-4 col-lg-2 showcountr">
	<a href="javascript:void(0)" class="widget" title="只统计今日和昨日新增用户和分站总和">
	<div class="widget-content widget-content-mini text-right clearfix">
		<h2 class="widget-heading h5 text-warning" style="color:#4a86e8">
		<strong><span id="count7">0</span></strong>/<strong><span id="count10">0</span></strong>
		</h2>
		<span class="text-muted">今昨新增用户</span>
	</div>
	</a>
</div>
<div class="col-xs-4 col-lg-2 showcountr">
	<a href="javascript:void(0)" class="widget" title="只统计今日和昨日下单的订单数量">
	<div class="widget-content widget-content-mini text-right clearfix">
		<h2 class="widget-heading h5 text-success" style="color:#6aa84f">
		<strong><span id="count4">0</span>/<span id="count9">0</span></strong>
		</h2>
		<span class="text-muted">今昨订单数量</span>
	</div>
	</a>
</div>
</div>

<div class="row">
<div class="col-xs-4 col-lg-2 showcountr">
	<a href="javascript:void(0)" class="widget" title="统计平台分站和用户余额总和">
	<div class="widget-content widget-content-mini text-right clearfix">
		<h2 class="widget-heading h5 text-warning" style="color:#cc4125">
		<strong><span id="daili_money">0</span></strong>
		</h2>
		<span class="text-muted">全站用户余额</span>
	</div>
	</a>
</div>
<div class="col-xs-4 col-lg-2 showcountr">
	<a href="javascript:void(0)" class="widget" title="只统计今日和昨日新增用户和分站总和">
	<div class="widget-content widget-content-mini text-right clearfix">
		<h2 class="widget-heading h5 text-warning" style="color:#4a86e8">
		<strong><span id="count99">0</span></strong>
		</h2>
		<span class="text-muted">近30天新用户</span>
	</div>
	</a>
</div>
<div class="col-xs-4 col-lg-2 showcountr">
	<a href="javascript:void(0)" class="widget" title="只统计近30天下单的订单总数量">
	<div class="widget-content widget-content-mini text-right clearfix">
		<h2 class="widget-heading h5 text-warning" style="color:#6aa84f">
		<strong><span id="count98">0</span></strong>
		</h2>
		<span class="text-muted">近30天订单量</span>
	</div>
	</a>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-4 col-lg-6">
	<div class="widget">
		<div class="widget-content border-bottom">
			<span class="pull-right text-muted"></span>
<i class="fa fa-angle-double-right"></i> 商品统计 <span style="color: #666666;font-size: 12px;"><?php echo $date ?></span>
		</div>
		<div class="widget-content widget-content-full">
			<div class="row text-center">
				<div class="col-xs-3 push-inner-top-bottom border-right">
					<h5 class="widget-heading">商品总数<br><br>
					<center><span id="numrows">0</span>件</center></h5>
				</div>
				<div class="col-xs-3 push-inner-top-bottom border-right">
					<h5 class="widget-heading">已上架商品<br><br>
					<center><span id="numrows1">0</span>件</center></h5>
				</div>
				<div class="col-xs-3 push-inner-top-bottom">
					<h5 class="widget-heading">今日新增<br><br>
					<center><span id="numrows2">0</span>件</center></h5>
				</div>
				<div class="col-xs-3 push-inner-top-bottom border-left">
					<h5 class="widget-heading">昨日新增<br><br>
					<center><span id="numrows3">0</span>件</center></h5>
				</div>
			</div>
		</div>
	</div>
        </div></div>

<div class="row">
<div class="col-sm-4 col-lg-6">
	<div class="widget">
		<div class="widget-content border-bottom">
			<span class="pull-right text-muted"></span>
<i class="fa fa-angle-double-right"></i> 待处理订单统计
		</div>
		<div class="widget-content widget-content-full-top-bottom border-bottom">
			<div class="row text-center">
				<div class="col-xs-4 push-inner-top-bottom border-right">
					<h5 class="widget-heading"><i class="fa fa-comment text-dark push"></i>&nbsp;待处理工单<br>
					<center><a id="count17" href="workorder.php">0</a>个</center></h5>
				</div>
				<div class="col-xs-4 push-inner-top-bottom border-right">
					<h5 class="widget-heading"><i class="fa fa-money text-dark push"></i>&nbsp;待处理提现<br>
					<center><a id="count11" href="tixian.php">0</a>元</center></h5>
				</div>
				<div class="col-xs-4 push-inner-top-bottom border-right">
					<h5 class="widget-heading"><i class="fa fa-hourglass-half text-dark push"></i>&nbsp;待处理订单<br>
					<center><a id="count3" href="./list.php?type=0">0</a>个</center></h5>
				</div>
			</div>
		</div>
	</div>
</div>
	</div>
  
<div class="row">
<div class="col-sm-4 col-lg-6">
	<div class="widget">
		<div class="widget-content border-bottom">
<i class="fa fa-angle-double-right"></i> 充值统计 <span style="color: #980000;font-size: 12px;">今天:<span id="count5" >0</span> | 昨天:<span id="count18">0</span> | 30天:<span id="count97">0</span></span>
		</div>
		<div class="widget-content widget-content-full">
			<div class="row text-center">
				<div class="col-xs-4 push-inner-top-bottom border-right">
					<h5 class="widget-heading"><i class="fa fa-qq text-dark push-bit"></i>&nbsp;QQ钱包<br>
					<center><span id="count12">0</span>元</center></h5>
				</div>
				<div class="col-xs-4 push-inner-top-bottom">
					<h5 class="widget-heading"><i class="fa fa-wechat text-dark push-bit"></i>&nbsp;微信<br>
					<center><span id="count13">0</span>元</center></h5>
				</div>
				<div class="col-xs-4 push-inner-top-bottom border-left">
					<h5 class="widget-heading"><i class="fa fa-credit-card text-dark push-bit"></i>&nbsp;支付宝<br>
					<center><span id="count14">0</span>元</center></h5>
				</div>
			</div>
		</div>
	</div>
        </div></div>
        
<div class="row">
<div class="col-sm-4 col-lg-6">
	<div class="widget">
		<div class="widget-content border-bottom">
<i class="fa fa-angle-double-right"></i> 快捷通道 <a style="font-size: 12px;" href="userlist.php">[普通用户]</a> | <a style="font-size: 12px;" href="sitelist.php">[分站代理]</a>
</div>
    </div>
        </div>
            </div>
        
<div class="row">
<div class="col-sm-4 col-lg-6">
	<div class="widget">
		<div class="widget-content border-bottom">
<i class="fa fa-angle-double-right"></i> 签到统计
		</div>
<table class="table table-bordered">
	<tbody>
		<tr>
			<td style="font-size: 13px;" class="text-center">
				今日签到<br><span id="count21">0</span>人
			</td>
			<td style="font-size: 13px;" class="text-center">
				昨日签到<br><span id="count22">0</span>人
			</td>
			<td style="font-size: 13px;" class="text-center">
				累计签到<br><span id="count23">0</span>人
			</td>
		</tr>
		<tr>
			<td style="font-size: 13px;" class="text-center">
				今日送出余额<br><span id="count24">0</span>元
			</td>
			<td style="font-size: 13px;" class="text-center">
				昨日送出余额<br><span id="count25">0</span>元
			</td>
			<td style="font-size: 13px;" class="text-center">
				累计送出余额<br><span id="count26">0</span>元
			</td>
		</tr>
	</tbody>
</table>
            </div>
                 </div>
                    </div>

<div class="row">
<div class="col-sm-4 col-lg-6">
	<div class="widget">
		<div class="widget-content border-bottom">
<i class="fa fa-angle-double-right"></i> 安全中心
		</div>
<table class="table table-bordered">
<?php
foreach($sec_msg as $row){
	echo $row;
}
if(count($sec_msg)==0)echo '<li class="list-group-item">系统正常，暂未发现网站安全问题！</li>';
?>
</table>
            </div>
                 </div>
                    </div>

<div class="row">
<div class="col-sm-4 col-lg-6">
	<div class="widget">
		<div class="widget-content border-bottom">
<i class="fa fa-angle-double-right"></i> 环境中心
		</div>
		<div class="widget-content widget-content-full-top-bottom border-bottom">
			<div class="row text-center">
				<div class="col-xs-6 push-inner-top-bottom border-right">
                    <ul class="nav nav-pills nav-stacked" style="text-align:center;">
	<li>
		<a>PHP版本<br>
		<center style="color: #7d7c7c;"><?php echo phpversion() ?></center></a>
	</li>
	<li>
		<a>MySQL版本<br>
		<center style="color: #7d7c7c;"><?php echo $mysqlversion ?></center></a>
	</li>
	</div>
	
		<div class="widget-content widget-content-full-top-bottom border-bottom">
			<div class="row text-center">
				<div class="col-xs-6 push-inner-top-bottom border-right">
                    <ul class="nav nav-pills nav-stacked" style="text-align:center;">
	<li>
		<a>服务器软件<br>
		<center style="color: #7d7c7c;"><?php echo $_SERVER['SERVER_SOFTWARE'] ?></center></a>
	</li>
	<li>
		<a>服务器时间<br>
		<center style="color: #7d7c7c;"><?php echo $date ?></center></a>
	</li>
</ul>
</div>
	</div>
	    </div>
            </div>
        </div></div>
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
			$('#count18').html(data.count18);
			$('#count21').html(data.count21);
			$('#count22').html(data.count22);
			$('#count23').html(data.count23);
			$('#count24').html(data.count24);
			$('#count25').html(data.count25);
			$('#count26').html(data.count26);
			$('#count97').html(data.count97);
			$('#count98').html(data.count98);
			$('#count99').html(data.count99);
			$('#numrows').html(data.numrows);
			$('#numrows1').html(data.numrows1);
			$('#numrows2').html(data.numrows2);
			$('#numrows3').html(data.numrows3);
			$('#daili_money').html(data.daili_money);
			$('#daili_point').html(data.daili_point);
			$('#fzjr_xf').html(data.fzjr_xf);
			$('#fzzr_xf').html(data.fzzr_xf);
			
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
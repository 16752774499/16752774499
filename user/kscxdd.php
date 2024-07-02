<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>订单管理</title>
  <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../assets/simple/css/plugins.css">
  <link rel="stylesheet" href="../assets/simple/css/main.css">
  <link rel="stylesheet" href="../assets/css/common.css">
    <link href="//cdn.staticfile.org/layui/2.5.7/css/layui.css" rel="stylesheet"/>
  <script src="//cdn.staticfile.org/modernizr/2.8.3/modernizr.min.js"></script>
  <link rel="stylesheet" href="../assets/user/css/my.css">
   <script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdn.staticfile.org/layui/2.5.7/layui.all.js"></script>
    <script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
  <!--[if lt IE 9]>
    <script src="//cdn.staticfile.org/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
<style>body{ background:#ecedf0 url("//cn.bing.com/th?id=OHR.RedBellied_ZH-CN8667089924_768x1366.jpg&rf=LaDigue_768x1366.jpg&pid=hp") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style></head>
<body>
<style>
    .layui-carousel, .layui-carousel>[carousel-item]>* {
        background-color:transparent;
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
 * 订单管理
**/
include("../includes/common.php");
$title='订单管理';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<style>
td.wbreak{max-width:420px;word-break:break-all;}
#orderItem .orderTitle{word-break:keep-all;}
#orderItem .orderContent{word-break:break-all;}
.form-inline .form-control {
    display: inline-block;
    width: auto;
    vertical-align: middle;
}
.form-inline .form-group {
    display: inline-block;
    margin-bottom: 0;
    vertical-align: middle;
}
</style>
<div class="col-xs-12 col-sm-10 col-md-6 col-lg-4 center-block " style="float: none; background-color:#f2f2f2;padding:0;max-width: 550px;">
    <div class="block  block-all">
        <div class="block-white">
            <div class="block-back display-row align-center justify-between">
                <div style="border-width: .5px;
    border-radius: 100px;
    border-color: #dadbde;
    background-color: #f2f2f2;
    padding: 3px 7px;
    opacity: .8;align-items: center;justify-content: space-between;display: flex; flex-direction: row;height: 30px;">
                <a href="/?mod=query"  class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.4rem" src="../assets/img/fanhui.png">&nbsp;
                </a>
                <div style="margin: 0px 8px; border-left: 1px solid rgb(214, 215, 217); height: 16px; border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-bottom-color: rgb(214, 215, 217);"></div>
                <a href="../" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.8rem" src="../assets/img/home1.png">&nbsp;
                </a>
            </div>
            <div style="font-size: 15px;">
            <font><a href="">订单管理</a></font>
            </div>
                </div>
<div align="center">
<form action="./kscxdd.php" method="GET" class="form-inline">
    <div style="background: #f2f2f2; height: 10px"></div>
  <div>
	<select name="type" class="form-control"><option value="-1">全部状态</option><option value="0">待处理</option><option value="2">正在处理</option><option value="1">已完成</option><option value="3">异常</option><option value="4">已退单</option></select>
	<button type="submit" class="btn btn-info"><i class="fa fa-search"></i>&nbsp;查看</button>
  </div>
</form>
</div>
<?php
function display_zt($zt){
	if($zt==1)
		return '<font color=green>已完成</font>';
	elseif($zt==2)
		return '<font color=orange>正在处理</font>';
	elseif($zt==3)
		return '<font color=red>异常</font>';
	elseif($zt==4)
		return '<font color=grey>已退款(平台余额)</font>';
	else
		return '<font color=blue>待处理</font>';
		
}

$sqls = $userrow['power']>0?"A.zid='{$userrow['zid']}'":"A.userid='{$userrow['zid']}'";
$links = '';

if(isset($_GET['kw']) && !empty($_GET['kw'])) {
	$kw=daddslashes($_GET['kw']);
	$sql=" (A.`input`='{$kw}' OR A.`id`='{$kw}' OR A.`tradeno`='{$kw}') AND {$sqls}";
	$numrows=$DB->getColumn("SELECT count(*) FROM pre_orders A WHERE{$sql}");
	$con='
	<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;"> '.$_GET['kw'].' 订单查询 - [<a href="kscxdd.php" style="color:#fff00f">查看全部</a>]</div>
	<div class="well well-sm" style="margin: 0;">此为 '.$_GET['kw'].' 的订单</div>
	<div class="wrapper">';
	$link='&kw='.$_GET['kw'].$links;
}else{
	$sql=" {$sqls}";
	if(isset($_GET['type']) && $_GET['type']>=0) {
		$type = intval($_GET['type']);
		$sql.=" AND `status`='$type'";
		$links.="&type=".$type;
		$numrows=$DB->getColumn("SELECT count(*) FROM pre_orders A WHERE{$sql}");
		$con='
    <div style="background: #f2f2f2; height: 10px"></div>
        <div style="font-size: 1.3rem;color: #999999;padding: 5px 10px">
            <p>
             此为 '.display_zt($_GET['type']).' 的订单<br></p>
            </div>
	<div class="wrapper">';
	}else{
		$user_id = $userrow['zid']; 

$numrows=$DB->getColumn("SELECT count(*) FROM pre_orders A WHERE{$sql} AND userid='{$user_id}'");
		$ondate=$DB->getColumn("SELECT count(*) FROM pre_orders A WHERE status=1 AND{$sql} AND userid='{$user_id}'");
		$ondate2=$DB->getColumn("SELECT count(*) FROM pre_orders A WHERE status=2 AND{$sql} AND userid='{$user_id}'");
		$ondate3=$DB->getColumn("SELECT count(*) FROM pre_orders A WHERE status=3 AND{$sql} AND userid='{$user_id}'");
		$ondate4=$DB->getColumn("SELECT count(*) FROM pre_orders A WHERE status=4 AND{$sql} AND userid='{$user_id}'");
		$con='
    <div style="background: #f2f2f2; height: 10px"></div>
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
            <div class="my-cell-title display-row justify-between align-center">
                <div class="my-cell-title-l left-title" style="font-size:1.4rem">订单统计</div>
                <div class="my-cell-title-r  display-row  align-center">
                    <span style="color: #939393;font-size:1.3rem">当前共有'.$numrows.'个订单</span>
                </div>
            </div>
            
            <div style="font-size: 1.3rem;color: #999999;padding: 5px 10px">
                <p>
                    已完成的有 <b>'.$ondate.'</b> 个，正在处理的有 <b>'.$ondate2.'</b> 个<br> 异常的有 <b> '.$ondate3.'</b>个，已退款的有 <b>'.$ondate4.'</b> 个<br></p>
            </div>
            
        </div>
	<div class="wrapper">';
	}
	$link=$links;
}
echo $con;
?>
			</div>
			<div class="table-responsive">
				<table class="table table-striped b-t b-light" style="font-size: 13px;">
					<thead>
						<tr>
							<th style="font-size: 14px;">
								操作
							</th>
							<th style="font-size: 14px;">
								状态
							</th>
							<th style="font-size: 14px;">
								金额
							</th>
							<th style="font-size: 14px;">
								订单ID
							</th>
							<th style="font-size: 14px;">
								商品名称
							</th>
							<th style="font-size: 14px;">
								下单信息
							</th>
							<th style="font-size: 14px;">
								份数
							</th>
							<th style="font-size: 14px;">
								下单时间
							</th>
						</tr>
					</thead>
					<tbody>
        <div style="background: #f2f2f2; height: 10px"></div>
<?php
$pagesize=9999;
$pages=ceil($numrows/$pagesize);
$page=isset($_GET['page'])?intval($_GET['page']):1;
$offset=$pagesize*($page - 1);

$rs=$DB->query("SELECT A.*,B.name FROM pre_orders A left join pre_tools B on A.tid=B.tid WHERE{$sql} ORDER BY id DESC LIMIT $offset,$pagesize");
while($res = $rs->fetch())
{

	if($res['userid']!=$userrow['zid']){
		continue;
	}else{
		$input = $res['input'];
	}
echo '<tr>
	<td>
								'.($res['userid']==$userrow['zid']?'<a href="javascript:showOrder('.$res['id'].',\''.md5($res['id'].SYS_KEY.$res['id']).'\')" title="查看订单详细" class="btn btn-info btn-xs">详细</a>':'<a href="javascript:;" class="btn btn-info btn-xs" disabled title="不是你支付的订单">详细</a>').'
							</td>
							<td>
								<font color=green>
									'.display_zt($res['status']).'
								</font>
							</td>
							<td>
								'.$res['money'].'
							</td>
							<td>
								'.$res['id'].'
							</td>
							<td>
								'.$res['name'].'
							</td>
							<td class="wbreak">
								'.$input.'
							</td>
							<td>
								'.$res['value'].'
							</td>
							<td>
								'.$res['addtime'].'
							</td>
						</tr>';}
?>
					</tbody>
				</table>
			</div>
			<center>
<?php
echo'<ul class="pagination"  style="margin-left:1em">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="kscxdd.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="kscxdd.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
$start=$page-10>1?$page-10:1;
$end=$page+10<$pages?$page+10:$pages;
for ($i=$start;$i<$page;$i++)
echo '<li><a href="kscxdd.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$end;$i++)
echo '<li><a href="kscxdd.php?page='.$i.$link.'">'.$i .'</a></li>';
if ($page<$pages)
{
echo '<li><a href="kscxdd.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="kscxdd.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul></center>';
#分页
?>
	</div>
</div>

<script>
function showOrder(id,skey){
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	var status = ['<span class="label label-primary">待处理</span>','<span class="label label-success">已完成</span>','<span class="label label-warning">处理中</span>','<span class="label label-danger">异常</span>','<font color=red>已退款</font>'];
	$.ajax({
		type : "POST",
		url : "../ajax.php?act=order",
		data : {id:id,skey:skey},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				var item = '<table class="table table-condensed table-hover" id="orderItem">';
				item += '<tr><td colspan="6" style="text-align:center" class="orderTitle"><b>订单基本信息</b></td></tr><tr class="orderTitle"><td class="info" class="orderTitle">订单编号</td><td colspan="5" class="orderContent">'+id+'</td></tr><tr><td class="info" class="orderTitle">商品名称</td><td colspan="5" class="orderContent">'+data.name+'</td></tr><tr><td class="info">订单金额</td class="orderTitle"><td colspan="5" class="orderContent">'+data.money+'元</td></tr><tr><td class="info">购买时间</td class="orderTitle"><td colspan="5">'+data.date+'</td></tr><tr><td class="info" class="orderTitle">下单信息</td><td colspan="5" class="orderContent">'+data.inputs+'</td><tr><td class="info" class="orderTitle">订单状态</td><td colspan="5" class="orderContent">'+status[data.status]+'</td></tr>';
				if(data.complain){
					item += '<tr><td class="info" class="orderTitle">订单操作</td><td class="orderContent"><a href="./workorder.php?my=add&orderid='+id+'&skey='+skey+'" onclick="return checklogin('+data.islogin+')" class="btn btn-xs btn-default">售后反馈</a>';
					if(data.selfrefund == 1 && data.islogin == 1 && (data.status == 0 || data.status == 3)){
						item += '&nbsp;<a onclick="return apply_refund('+id+',\''+skey+'\')" class="btn btn-xs btn-danger">申请退款</a>';
					}
					item += '</td></tr>';
				}
				if(data.list && data.list.order_state){
					item += '<tr><td colspan="6" style="text-align:center" class="orderTitle"><b>订单实时状态</b></td><tr><td class="warning">下单数量</td><td>'+data.list.num+'</td><td class="warning">下单时间</td><td colspan="3">'+data.list.add_time+'</td></tr><tr><td class="warning">初始数量</td><td>'+data.list.start_num+'</td><td class="warning">当前数量</td><td>'+data.list.now_num+'</td><td class="warning">订单状态</td><td><font color=blue>'+data.list.order_state+'</font></td></tr>';
				}else if(data.kminfo){
					item += '<tr><td colspan="6" style="text-align:center" class="orderTitle"><b>以下是你的卡密信息</b></td><tr><td colspan="6" class="orderContent">'+data.kminfo+'</td></tr>';
				}else if(data.result){
					item += '<tr><td colspan="6" style="text-align:center" class="orderTitle"><b>补充信息</b></td><tr><td colspan="6" class="orderContent">'+data.result+'</td></tr>';
				}
				if(data.desc){
					item += '<tr><td colspan="6" style="text-align:center" class="orderTitle"><b>商品简介</b></td><tr><td colspan="6" class="orderContent">'+data.desc+'</td></tr>';
				}
				item += '</table>';
				var area = [$(window).width() > 480 ? '480px' : '90%', ';max-height:90%'];
				layer.open({
				  type: 1,
				  area: area,
				  title: '订单详细信息',
				  skin: 'layui-layer-rim',
				  content: item
				});
			}else{
				layer.alert(data.msg);
			}
		}
	});
}
function checklogin(islogin){
	if(islogin==1){
		return true;
	}else{
		var confirmobj = layer.confirm('为方便反馈处理结果，投诉订单前请先登录网站！', {
		  btn: ['登录','注册','取消']
		}, function(){
			window.location.href='./login.php';
		}, function(){
			window.location.href='./reg.php';
		}, function(){
			layer.close(confirmobj);
		});
		return false;
	}
}
function apply_refund(id,skey){
	var confirmobj = layer.confirm('待处理或异常状态订单可以申请退款，退款之后资金会退到用户余额，是否确认退款？', {
	  btn: ['确认退款','取消']
	}, function(){
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "../ajax.php?act=apply_refund",
			data : {id:id,skey:skey},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					layer.alert('成功退款'+data.money+'元到余额！', {icon:1}, function(){ window.location.reload(); });
				}else{
					layer.alert(data.msg, {icon:2});
				}
			}
		});
	}, function(){
		layer.close(confirmobj);
	});
}
</script>
</body>
</html>
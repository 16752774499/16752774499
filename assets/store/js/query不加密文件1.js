var $_GET = (function(){
    var url = window.document.location.href.toString();
    var u = url.split("?");
    if(typeof(u[1]) == "string"){
        u = u[1].split("&");
        var get = {};
        for(var i in u){
            var j = u[i].split("=");
            get[j[0]] = j[1];
        }
        return get;
    } else {
        return {};
    }
})();
if($_GET['buyok']){
	var id = $("#order_all>.layui-card:first").find(".xiangqing").data("id");
	var skey = $("#order_all>.layui-card:first").find(".xiangqing").data("skey");
	if(id){
		showOrder(id,skey);
	}

}
function OrderQuery(){
	var kw = $('#query').val();
	window.location.href="./?mod=query&data="+kw;
}
function LastPage(){
	var kw = $('#query').val();
	var page = parseInt($('#page').val());
	var status = $('#q_status').val();
	if(page=='1')return;
	page = page-1;
	window.location.href="./?mod=query&status="+status+"&data="+kw+"&page="+page;
}
function NextPage(){
	var kw = $('#query').val();
	var page = parseInt($('#page').val());
	var status = $('#q_status').val();
	page = page+1;
	window.location.href="./?mod=query&status="+status+"&data="+kw+"&page="+page;
}
function changepwd(id,skey) {
	pwdlayer = layer.open({
	  type: 1,
	  title: '修改密码',
	  skin: 'layui-layer-rim',
	  content: '<div class="form-group"><div class="bl_view_title"><div class="input-group-addon">密码</div><input type="text" id="pwd" value="" class="search_input2" placeholder="请填写新的密码" required/></div></div><div class="go_buy"><input type="submit" id="save" onclick="saveOrderPwd('+id+',\''+skey+'\')" class="btn btn-primary btn-block" value="保存"></div>'
	});
}
function saveOrderPwd(id,skey) {
	var pwd=$("#pwd").val();
	if(pwd==''){layer.alert('请确保每项不能为空！');return false;}
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : "POST",
		url : "ajax.php?act=changepwd",
		data : {id:id,pwd:pwd,skey:skey},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				layer.msg('保存成功！');
				layer.close(pwdlayer);
			}else{
				layer.alert(data.msg);
			}
		} 
	});
}
function showOrder(id,skey){
var ii = layer.load(2, {shade:[0.1,'#fff']});
	var status = ['待处理','已完成','处理中','异常','已退款'];
	$.ajax({
		type : "POST",
		url : "ajax.php?act=order",
		data : {id:id,skey:skey},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				var item = '<table class="table " id="orderItem">';
				item += '<tbody class="tbody"><tr><td colspan="6" style="text-align:center" class="orderTitle"></td></tr>';
				item += '<tr><td colspan="6" class="orderTitle page-title" style="padding:0"><b>订单详情</b></td></tr></tbody>' +
					'<tbody class="tbody" style="background: #f7f7f8;border-radius: 0px " border="0px" >'+

					'<tr><td class="orderTitle">商品名称</td><td colspan="5" class="orderContent">'+data.name+'</td></tr>' +
					'<tr><td class="orderTitle">订单编号</td><td colspan="5" class="orderContent"><span id="orderid">'+id+'</span></td></tr>' +
					'<tr><td class="orderTitle">订单金额</td><td colspan="5" class="orderContent">￥'+data.money+'</td></tr>' +
					'<tr><td class="orderTitle">订单状态</td><td colspan="5" class="orderContent">'+status[data.status]+'</td></tr>' +
					'<tr><td class="orderTitle">下单时间</td><td colspan="5">'+data.date+'</td></tr>' +
					'<tr><td class="orderTitle">下单信息</td><td colspan="5" class="orderContent">'+data.inputs+'</td></tr>';
				if(data.complain){
					item += '<tr><td class="orderTitle">订单操作</td><td class="orderContent"><a href="./user/workorder.php?my=add&orderid='+id+'&skey='+skey+'" onclick="return checklogin('+data.islogin+')" class="text-primary">售后反馈</a>';
						
					if(data.selfrefund == 1 && data.islogin == 1 && (data.status == 0 || data.status == 3)){
						item += '&nbsp;<a onclick="return apply_refund('+id+',\''+skey+'\')" class="text-danger">申请退款</a>';
					}
					item += '</td></tr>';

				}
				item += '</tbody><tbody>'+
						'<tr><td colspan="6" style="text-align:center" class="orderTitle"></td></tr>' +
						'</tr><td colspan="6" style="background:#f7f7f8" class="orderTitle"></td></tr>';
				if(data.list && typeof data.list === "object"){
					if(typeof data.list.order_state !== "undefined" && data.list.order_state && typeof data.list.now_num !== "undefined"){
				item += '<tbody class="tbody"><tr><td colspan="6" style="text-align:center" class="orderTitle"></td></tr>';
				item += '<tr><td colspan="6" class="orderTitle page-title" style="padding:0"><b>实时状态</b></td></tr></tbody>' +
					'<tbody class="tbody" style="background: #f7f7f8;border-radius: 0px " border="0px" >'+

					'<tr><td class="orderTitle">下单数量</td><td colspan="5" class="orderContent">'+data.list.num+'</td></tr>' +
					'<tr><td class="orderTitle">初始数量</td><td colspan="5" class="orderContent">'+data.list.start_num+'</td></tr>' +
					'<tr><td class="orderTitle">当前数量</td><td colspan="5" class="orderContent">'+data.list.now_num+'</td></tr>' +
					'<tr><td class="orderTitle">订单状态</td><td colspan="5" class="orderContent">'+data.list.order_state+'</td></tr>';

						if(typeof data.list.result !== "undefined" && data.list.result){
							item += '<tr><td class="warning orderTitle">异常信息</td><td class="orderContent">'+data.list.result+'</td></tr>';
						}
					}else{
					item += '<tr><td colspan="6"  class="orderTitle page-title" style="padding:5px 15px"><b>售后规则</b></td><tr class="tbody" border="0px"><td class="orderContent"><img style="width: 100%;" src="../assets/img/shgz1.jpeg"></td></tr>'+
						'<tr><td colspan="6" style="text-align:center" class="orderTitle"></td></tr>' +
						'</tr><td colspan="6" style="background:#f7f7f8" class="orderTitle"></td></tr>'+
						'<tr><td colspan="6"  class="orderTitle page-title" style="padding:5px 15px"><b>实时状态</b></tr>';
						$.each(data.list, function(i, v){
							item += '<tr class="tbody" style="background: #fcf7e3;border-radius: 0px " border="0px"><td class="orderTitle" >'+i+'：'+v+'</td></tr>';
						});
					}
				item += '</tbody><tbody>'+
						'<tr><td colspan="6" style="text-align:center" class="orderTitle"></td></tr>' +
						'</tr><td colspan="6" style="background:#f7f7f8" class="orderTitle"></td></tr>';
				
				}else if(data.kminfo){
					item += '<tr><td colspan="6"  class="orderTitle page-title" style="padding:5px 15px"><b>网盘教程</b></td>' +
						'<tr><td colspan="6"  class="orderContent"><div style="display: flex;align-items: center;justify-content: space-around;">' +
						'<a style="width: 45%;" href="https://caihong2.oss-cn-beijing.aliyuncs.com/baiduawangp.mp4" target="_blank" >' +
						'<div style="display: flex;align-items: center;justify-content: space-around;width: 100%; border-radius: 10px;border: 1px solid #ddd;float: left;padding: 5px 5px;background: #f7f7f8">' +
						'<img style="width:1.1rem;height:1.1rem;" src="../assets/img/baidu.png">'+
						'<div><span style="font-weight: 800;color:#000">百度网盘</span><br><span style="font-size:10px;color:#918f8f">文件下载教程</span></div>' +
						'</div></a>'+
						'<a style="width: 45%;" href="https://jingyan.baidu.com/article/624e745986b0c075e9ba5a6b.html" target="_blank">' +
						'<div style="display: flex;align-items: center;justify-content: space-around; width: 100%;border-radius: 10px;border: 1px solid #ddd;float: right;padding: 5px 5px;background: #f7f7f8">' +
						'<img style="width:1.1rem;height:1.1rem;" src="../assets/img/lanzou.png">'+
						'<div><span style="font-weight: 800;color:#000">蓝奏云网盘</span><br><span style="font-size:10px;color:#918f8f">文件下载教程</span></div>' +
						'</div></a>'+
						'</div></td></tr>' +
						'<tr><td colspan="6" style="text-align:center" class="orderTitle"></td></tr>' +
						'</tr><td colspan="6" style="background:#f7f7f8" class="orderTitle"></td></tr>' +
					
						'<tr><td colspan="6" class="orderTitle page-title" style="padding:5px 15px"><b>卡密信息</b></td></tr>' +
						'<tr><td colspan="6" class="orderContent"><div class="kami"><center><a href="./?mod=faka&amp;id='+id+'&amp;skey='+skey+'" class="btn btn-sm btn-primary">点此查看卡密</a></center></div></td></tr>' +
						'</tr><td colspan="6" class="orderTitle"></td></tr>' +

					    '</tr><td colspan="6" style="background:#f7f7f8" class="orderTitle"></td></tr>';
				}else if(data.result){
					item += '<tr><td colspan="6"  class="orderTitle page-title" style="padding:5px 15px"><b>处理结果</b></span></td><tr class="tbody" style="background: #f7f7f8;border-radius: 0px " border="0px"><td class="orderContent">'+data.result+'</td></tr>'+
					'<tr><td colspan="6" style="text-align:center" class="orderTitle"></td></tr>' +
					'</tr><td colspan="6" style="background:#f7f7f8" class="orderTitle"></td></tr>';
				}
				if(data.desc){
					item += '<tr><td colspan="6"  class="orderTitle page-title" style="padding:5px 15px"><b>平台消息</b></span></td><tr class="tbody" style="background: #f7f7f8;border-radius: 0px " border="0px"><td class="orderContent">'+data.spxq_xx+'</td></tr>'+
					'<tr><td colspan="6" style="text-align:center" class="orderTitle"></td></tr>' +
					'</tr><td colspan="6" style="background:#f7f7f8" class="orderTitle"></td></tr>' +
					'<tr><td colspan="6"  class="orderTitle page-title" style="padding:5px 15px"><b>商品简介</b></td><tr class="tbody" style="background: #f7f7f8;border-radius: 0px " border="0px"><td class="orderContent">'+data.desc+'</td></tr>';
				}
				item += '</tbody></table>';
				var area = [$(window).width() > 480 ? '480px' : '95%', '90%'];
				layer.open({
				  type: 1,
				  area: area,
				  title: '订单详细信息',
				  btnAlign:"c",
				  zIndex: 2001,
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
			window.location.href='./user/login.php';
		}, function(){
			window.location.href='./user/reg.php';
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
			url : "ajax.php?act=apply_refund",
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
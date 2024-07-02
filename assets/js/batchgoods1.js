
function selectAll(checkbox) {
	$('input[type=checkbox]').prop('checked', $(checkbox).prop('checked'));
}
$(document).ready(function () {
	$("#getGoods").click(function () {
		const shequ = $("select[name='shequ']").val();
		if (shequ == '' || !shequ) { layer.alert('请先选择一个对接网站'); return false; }
		$('#goodslist').empty();
		var ii = layer.load(2, { shade: [0.1, '#fff'] });
		$.ajax({
			type: "POST",
			url: "ajax_shop.php?act=getGoodsList",
			data: { shequ },
			dataType: 'json',
			success: function (data) {
				layer.close(ii);
				if (data.code == 0) {
					$('#getGoods').attr('type', data.type);
					var num = 0;
					$.each(data.data, function (i, item) {
						$('#goodslist').append('<label class="checkbox-inline"><input type="checkbox" name="batchgoods[]" value="' + item.id + '"> ' + item.name + '</label>');
						num++;
					});
					layer.msg('共获取到' + num + '个可一键上架的商品');
				} else {
					layer.alert(data.msg);
				}
			},
			error: function (data) {
				layer.msg('服务器错误');
				return false;
			}
		});
	});
});

function BatchGoods(obj) {
	const shequ = $("select[name='shequ']").val();
	const prid = $("select[name='prid']").val();
	if (shequ == '') { layer.alert('请先选择一个对接网站'); return false; }
	if (prid == 0) { layer.alert('请先选择一个加价模板'); return false; }
	const ii = layer.load(2, { shade: [0.1, '#fff'] });

	$.ajax({
		type: 'POST',
		url: 'ajax_shop.php?act=batch_goodsid',
		data: $(obj).serialize(),
		dataType: 'json',
		success: function (data) {
			layer.close(ii);
			if (data.code == 0) {
				layer.msg('开始上架商品,本次共需上架商品数量为：' + data.num + '个！', {
					icon: 16,
					time: 999999,
					shade: [0.5, '#000']
				});
				batch_conversion(data.goodsid_list, data.num, 0,$("select[name='jump']").val(),0);
			} else {
				layer.alert(data.msg, { icon: 2 })
			}
		},
		error: function (data) {
			layer.msg('服务器错误');
			return false;
		}
	});
	return false;
}
function batch_conversion(goodsid_list, num, sum, jump,fail) {
	if (num <= sum) {
		layer.close();
		let cid = $("select[name='cid']").val();
		layer.alert(`恭喜你,商品已经全部上架完！<br>本次共成功上架${num-fail}个商品！`, {
			anim: 4,
			icon: 1,
			title: '商品上架成功提醒！',
			btn: ['确定', '查看上架的商品'],
			shade: [0.5, '#000'],
			btn2: function (layero, index) {
				window.open('shoplist.php?cid=' + cid);
			}
		});
		return false;
	}

	let goods_id = goodsid_list.split('|')[sum];

	setTimeout(function () {
		batch_merchandise(goods_id, goodsid_list, num, (sum + 1), jump,fail);
	}, 1100);
}
function batch_merchandise(goods_id, goodsid_list, num, sum, jump,fail) {
	const shequ = $("select[name='shequ']").val();
	const cid = $("select[name='cid']").val();
	const prid = $("select[name='prid']").val();
	const repeat = $("select[name='repeat']").val();
	const delay = $("input[name='delay']").val();
	$.ajax({
		type: 'POST',
		url: 'ajax_shop.php?act=batch_merchandise',
		data: { shequ, goods_id, repeat, cid, prid, jump },
		dataType: 'json',
		success: function (res) {
			layer.close();
			if (res.code == 0) {
				setTimeout(function () {
					layer.msg(`正在上架第 ${sum} 个商品<font color=#228b22>[ ${res.name} ]</font><br/>共需上架：${num}个商品！<br/><font color=green>状态:</font> ${res.msg}`, {
						icon: 16,
						time: 999999,
						shade: [0.5, '#000'],
						anim: Math.ceil(Math.random() * 6)
					});
					if(res.msg.includes('跳过'))
					{
						fail = fail+1
					}
					
					batch_conversion(goodsid_list, num, sum, jump,fail);
				}, delay);
			} else {
				layer.alert('对接终止,出现对接失败商品');
			}
		},
		error: function (res) {
			layer.msg('失败！');
			return false;
		}
	});
	return false;
}
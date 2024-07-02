<?php

/**
 * 网站其他配置
 **/
include("../includes/common.php");
$title = '网站其他配置';
include './head.php';
if ($islogin == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">

	<?php

	$mod = isset($_GET['mod']) ? $_GET['mod'] : null;


	if ($mod == 'cleanbom') {
		adminpermission('set', 1);
		$filename = ROOT . 'config.php';
		$contents = file_get_contents($filename);
		$charset[1] = substr($contents, 0, 1);
		$charset[2] = substr($contents, 1, 1);
		$charset[3] = substr($contents, 2, 1);
		if (ord($charset[1]) == 239 && ord($charset[2]) == 187) {
			$rest = substr($contents, 3);
			file_put_contents($filename, $rest);
			showmsg('找到BOM并已自动去除', 1);
		} else {
			showmsg('没有找到BOM', 2);
		}
	?>
	<?php
	} elseif ($mod == 'sitee') {
		adminpermission('set', 1);
	?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-18 center-block" style="float: none;">
<div class="block">
<div class="block-title"><h3 class="panel-title">网站其他配置①</h3><ul class="nav nav-tabs">
  <li class="active"><a href="#fenzhan_1001" data-toggle="tab" aria-expanded="true">首页相关</a></li>
  <li><a href="#fenzhan_1002" data-toggle="tab" aria-expanded="true">会员中心相关</a></li>
  <li><a href="#fenzhan_1003" data-toggle="tab" aria-expanded="true">商品相关</a></li>
  <li><a href="#fenzhan_1004" data-toggle="tab" aria-expanded="true">其他相关</a></li>
</ul></div>
<div class="">
<div id="myTabContent" class="tab-content">

<!--fenzhan_1001开始-->
<div class="tab-pane fade active in" id="fenzhan_1001">
<form onsubmit="return saveSetting(this)" method="post" class="form-horizontal form-bordered" role="form">

					<div class="form-group">
						<label class="col-sm-2 control-label">开启首页广告位</label>
						<div class="col-sm-10"><select class="form-control" name="syggw_car" default="<?php echo $conf['syggw_car']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">开启首页公告</label>
						<div class="col-sm-10"><select class="form-control" name="xwgg_car" default="<?php echo $conf['xwgg_car']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
    
					<div class="form-group">
						<label class="col-sm-2 control-label">公告文字介绍</label>
						<div class="col-sm-10"><textarea name="xwgg" style="width:100%;height:75px" /><?php echo $conf['xwgg']; ?></textarea><font color="green">html代码，随便在发布个新通知里编辑好然后复制HTML代码即可</font></div>
					</div>
					
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="保存/修改" class="btn btn-primary btn-block"/>
	 </div>
	</div>
  </form>
</div>
<!--fenzhan_1001结束-->

<!--fenzhan_1002开始-->
<div class="tab-pane fade in" id="fenzhan_1002">
<form onsubmit="return saveSetting(this)" method="post" class="form-horizontal form-bordered" role="form">

					<div class="form-group">
						<label class="col-sm-2 control-label">每日发展1名合伙人</label>
						<div class="col-sm-10"><input type="text" name="jiangli" value="<?php echo $conf["jiangli"];?>" class="form-control" placeholder=""/><font color="green">奖励单位：元</a></font></div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">每日发展3名合伙人</label>
						<div class="col-sm-10"><input type="text" name="jiangli2" value="<?php echo $conf["jiangli2"];?>" class="form-control" placeholder=""/><font color="green">奖励单位：元</a></font></div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">每日发展5名合伙人</label>
						<div class="col-sm-10"><input type="text" name="jiangli3" value="<?php echo $conf["jiangli3"];?>" class="form-control" placeholder=""/><font color="green">奖励单位：元</a></font></div>
					</div>
					
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="保存/修改" class="btn btn-primary btn-block"/>
	 </div>
	</div>
  </form>
</div>
<!--fenzhan_1002结束-->

<!--fenzhan_1003开始-->
<div class="tab-pane fade in" id="fenzhan_1003">
<form onsubmit="return saveSetting(this)" method="post" class="form-horizontal form-bordered" role="form">


					<div class="form-group">
						<label class="col-sm-2 control-label">是否开启商品推荐展示</label>
						<div class="col-sm-10"><select class="form-control" name="spzs_car" default="<?php echo $conf['spzs_car']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">商品推荐展示1图片</label>
						<div class="col-sm-10"><input type="text" name="sptjzstp01" value="<?php echo $conf['sptjzstp01']; ?>" class="form-control" /><font color="green">在图床里上传图片，上传成功复制图片URL链接即可：<a style="color: #0000ff;" href="https://zmingcx.com/favorites/%E5%85%8D%E8%B4%B9%E5%9B%BE%E5%BA%8A/" target="_blank">前往图床</a></font></div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">商品推荐展示1文字</label>
						<div class="col-sm-10"><input type="text" name="sptjzswz01" value="<?php echo $conf['sptjzswz01']; ?>" class="form-control" /><font color="green">填写商品名称</font></div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">商品推荐展示1价格</label>
						<div class="col-sm-10"><input type="text" name="sptjzsjg01" value="<?php echo $conf['sptjzsjg01']; ?>" class="form-control" /><font color="green">也可填写文字</font></div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">商品推荐展示1链接</label>
						<div class="col-sm-10"><input type="text" name="sptjzslj01" value="<?php echo $conf['sptjzslj01']; ?>" class="form-control" /><font color="green">填写网址链接，填写平台站点某链接可使用./或../来指引</font></div>
					</div>
					
					<hr>
					<div class="form-group">
						<label class="col-sm-2 control-label">商品推荐展示2图片</label>
						<div class="col-sm-10"><input type="text" name="sptjzstp02" value="<?php echo $conf['sptjzstp02']; ?>" class="form-control" /><font color="green">在图床里上传图片，上传成功复制图片URL链接即可：<a style="color: #0000ff;" href="https://zmingcx.com/favorites/%E5%85%8D%E8%B4%B9%E5%9B%BE%E5%BA%8A/" target="_blank">前往图床</a></font></div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">商品推荐展示2文字</label>
						<div class="col-sm-10"><input type="text" name="sptjzswz02" value="<?php echo $conf['sptjzswz02']; ?>" class="form-control" /><font color="green">填写商品名称</font></div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">商品推荐展示2价格</label>
						<div class="col-sm-10"><input type="text" name="sptjzsjg02" value="<?php echo $conf['sptjzsjg02']; ?>" class="form-control" /><font color="green">也可填写文字</font></div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">商品推荐展示2链接</label>
						<div class="col-sm-10"><input type="text" name="sptjzslj02" value="<?php echo $conf['sptjzslj02']; ?>" class="form-control" /><font color="green">填写商品ID</font></div>
					</div>
					
					<hr>
					<div class="form-group">
						<label class="col-sm-2 control-label">自定义推荐展示3图片</label>
						<div class="col-sm-10"><input type="text" name="sptjzstp03" value="<?php echo $conf['sptjzstp03']; ?>" class="form-control" /><font color="green">在图床里上传图片，上传成功复制图片URL链接即可：<a style="color: #0000ff;" href="https://zmingcx.com/favorites/%E5%85%8D%E8%B4%B9%E5%9B%BE%E5%BA%8A/" target="_blank">前往图床</a></font></div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">自定义推荐展示3文字</label>
						<div class="col-sm-10"><input type="text" name="sptjzswz03" value="<?php echo $conf['sptjzswz03']; ?>" class="form-control" /><font color="green">填写名称</font></div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">自定义推荐展示3价格</label>
						<div class="col-sm-10"><input type="text" name="sptjzsjg03" value="<?php echo $conf['sptjzsjg03']; ?>" class="form-control" /><font color="green">也可填写文字</font></div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">自定义推荐展示3链接</label>
						<div class="col-sm-10"><input type="text" name="sptjzslj03" value="<?php echo $conf['sptjzslj03']; ?>" class="form-control" /><font color="green">填写网址链接，填写平台站点某链接可使用./或../来指引</font></div>
					</div>
					
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="保存/修改" class="btn btn-primary btn-block"/>
	 </div>
	</div>
  </form>
</div>
<!--fenzhan_1003结束-->

<!--fenzhan_1004开始-->
<div class="tab-pane fade in" id="fenzhan_1004">
<form onsubmit="return saveSetting(this)" method="post" class="form-horizontal form-bordered" role="form">

					<div class="form-group">
						<label class="col-sm-2 control-label">订单详情-平台消息</label>
						<div class="col-sm-10"><input type="text" name="spxq_xx" value="<?php echo $conf['spxq_xx']; ?>" class="form-control" /><font color="green">如：购买商品成功，祝您新年快乐！</font></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">提现-结算周期说明</label>
						<div class="col-sm-10"><input type="text" name="tixian_js" value="<?php echo $conf['tixian_js']; ?>" class="form-control" /><font color="green">如：你提交的提现申请将会在24小时内到账，请耐心等待客服打款。</font></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">未绑定域名显示404页面文字（未开启404则不需要填）</label>
						<div class="col-sm-10"><input type="text" name="404" value="<?php echo $conf['404']; ?>" class="form-control"/><font color="green">如：把域名中间的12344改成12345即可</font></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">COS活码推广链接（小白勿动）</label>
						<div class="col-sm-10"><input type="text" name="cos01" value="<?php echo $conf['cos01']; ?>" class="form-control"/><font color="green">如：https://1-1302784280.cos-website.ap-nanjing.myqcloud.com，最后面不要带/即可</font></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">COS活码永久地址（小白勿动）</label>
						<div class="col-sm-10"><input type="text" name="cos02" value="<?php echo $conf['cos02']; ?>" class="form-control"/><font color="green">如：https://1-1302784280.cos-website.ap-nanjing.myqcloud.com，最后面不要带/即可</font></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">API对接域名①</label>
						<div class="col-sm-10"><input type="text" name="api01" value="<?php echo $conf['api01']; ?>" class="form-control" /></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">API对接域名②</label>
						<div class="col-sm-10"><input type="text" name="api02" value="<?php echo $conf['api02']; ?>" class="form-control" /></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">平台部分分面颜色</label>
						<div class="col-sm-10"><input type="text" name="rgb01" value="<?php echo $conf['rgb01']; ?>" class="form-control" /><font color="green">颜色代码去掉#即可，颜色代码表：<a href="http://tools.jb51.net/static/colorpicker/" target="_blank">http://tools.jb51.net/static/colorpicker/</a></font></div>
					</div>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="保存/修改" class="btn btn-primary btn-block"/>
	 </div>
	</div>
  </form>
</div>
<!--fenzhan_1004结束-->

</div>
</div>
</div>



<?php } ?>
<script src="<?php echo $cdnpublic ?>layer/3.1.1/layer.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script>
$("select[name='ui_bing']").change(function(){
	if($(this).val() == 0){
		$("#frame_set1").css("display","inherit");
		$("#frame_set2").css("display","none");
	}else if($(this).val() == 3){
		$("#frame_set1").css("display","none");
		$("#frame_set2").css("display","inherit");
	}else{
		$("#frame_set1").css("display","none");
		$("#frame_set2").css("display","none");
	}
});
$("select[name='faka_input']").change(function(){
	if($(this).val() == 5){
		$("#frame_set3").css("display","inherit");
	}else{
		$("#frame_set3").css("display","none");
	}
});
$('.input-colorpicker').colorpicker({format: 'hex'});
</script>
<script>
	var items = $("select[default]");
	for (i = 0; i < items.length; i++) {
		$(items[i]).val($(items[i]).attr("default") || 0);
	}
	function saveSetting(obj) {
		if ($("input[name='fenzhan_domain']").length > 0) {
			var fenzhan_domain = $("input[name='fenzhan_domain']").val();
			$("input[name='fenzhan_domain']").val(fenzhan_domain.replace("，", ","));
		}
		if ($("input[name='fenzhan_remain']").length > 0) {
			var fenzhan_remain = $("input[name='fenzhan_remain']").val();
			$("input[name='fenzhan_remain']").val(fenzhan_remain.replace("，", ","));
		}
		var ii = layer.load(2, {
			shade: [0.1, '#fff']
		});
		$.ajax({
			type: 'POST',
			url: 'ajax.php?act=set',
			data: $(obj).serialize(),
			dataType: 'json',
			success: function(data) {
				layer.close(ii);
				if (data.code == 0) {
					layer.alert('设置保存成功！', {
						icon: 1,
						closeBtn: false
					}, function() {
						window.location.reload()
					});
				} else {
					layer.alert(data.msg, {
						icon: 2
					})
				}
			},
			error: function(data) {
				layer.msg('服务器错误');
				return false;
			}
		});
		return false;
	}

</script>
</div>
</div>
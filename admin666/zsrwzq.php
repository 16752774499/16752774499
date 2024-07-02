<?php

/**
 * 任务赚钱配置
 **/
include("../includes/common.php");
$title = '任务赚钱配置';
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
<div class="block-title"><h3 class="panel-title">任务赚钱配置</h3>（<a style="color: #0000ff;" href="https://zmingcx.com/favorites/%E5%85%8D%E8%B4%B9%E5%9B%BE%E5%BA%8A/" target="_blank">图片上传</a>） 上传成功复制图片URL链接即可<ul class="nav nav-tabs">
  <li class="active"><a href="#fenzhan_1001" data-toggle="tab" aria-expanded="true">1-5号位</a></li>
  <li><a href="#fenzhan_1002" data-toggle="tab" aria-expanded="true">6-10号位</a></li>
  <li><a href="#fenzhan_1003" data-toggle="tab" aria-expanded="true">11-15号位</a></li>
  <li><a href="#fenzhan_1004" data-toggle="tab" aria-expanded="true">16-20号位</a></li>
</ul></div>
<div class="">
<div id="myTabContent" class="tab-content">

<!--fenzhan_1001开始-->
<div class="tab-pane fade active in" id="fenzhan_1001">
<form onsubmit="return saveSetting(this)" method="post" class="form-horizontal form-bordered" role="form">
    
					<div class="form-group">
						<label class="col-sm-2 control-label">分级_01</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_01" default="<?php echo $conf['rwkq_01']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_01" value="<?php echo $conf['rwbt_01']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_01" value="<?php echo $conf['rwnr_01']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_01" value="<?php echo $conf['rwlj_01']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_01" value="<?php echo $conf['rwtp_01']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					
					<hr>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">分级_02（加红）</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_02" default="<?php echo $conf['rwkq_02']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_02" value="<?php echo $conf['rwbt_02']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_02" value="<?php echo $conf['rwnr_02']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_02" value="<?php echo $conf['rwlj_02']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_02" value="<?php echo $conf['rwtp_02']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					
					<hr>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">分级_03</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_03" default="<?php echo $conf['rwkq_03']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_03" value="<?php echo $conf['rwbt_03']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_03" value="<?php echo $conf['rwnr_03']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_03" value="<?php echo $conf['rwlj_03']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_03" value="<?php echo $conf['rwtp_03']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					
					<hr>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">分级_04</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_04" default="<?php echo $conf['rwkq_04']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_04" value="<?php echo $conf['rwbt_04']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_04" value="<?php echo $conf['rwnr_04']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_04" value="<?php echo $conf['rwlj_04']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_04" value="<?php echo $conf['rwtp_04']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					
					<hr>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">分级_05（加红）</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_05" default="<?php echo $conf['rwkq_05']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_05" value="<?php echo $conf['rwbt_05']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_05" value="<?php echo $conf['rwnr_05']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_05" value="<?php echo $conf['rwlj_05']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_05" value="<?php echo $conf['rwtp_05']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					

	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary btn-block"/>
	 </div>
	</div>
  </form>
</div>
<!--fenzhan_1001结束-->

<!--fenzhan_1002开始-->
<div class="tab-pane fade in" id="fenzhan_1002">
<form onsubmit="return saveSetting(this)" method="post" class="form-horizontal form-bordered" role="form">

					<div class="form-group">
						<label class="col-sm-2 control-label">分级_06</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_06" default="<?php echo $conf['rwkq_06']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_06" value="<?php echo $conf['rwbt_06']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_06" value="<?php echo $conf['rwnr_06']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_06" value="<?php echo $conf['rwlj_06']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_06" value="<?php echo $conf['rwtp_06']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					
					<hr>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">分级_07</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_07" default="<?php echo $conf['rwkq_07']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_07" value="<?php echo $conf['rwbt_07']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_07" value="<?php echo $conf['rwnr_07']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_07" value="<?php echo $conf['rwlj_07']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_07" value="<?php echo $conf['rwtp_07']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					
					<hr>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">分级_08（加红）</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_08" default="<?php echo $conf['rwkq_08']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_08" value="<?php echo $conf['rwbt_08']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_08" value="<?php echo $conf['rwnr_08']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_08" value="<?php echo $conf['rwlj_08']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_08" value="<?php echo $conf['rwtp_08']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					
					<hr>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">分级_09</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_09" default="<?php echo $conf['rwkq_09']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_09" value="<?php echo $conf['rwbt_09']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_09" value="<?php echo $conf['rwnr_09']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_09" value="<?php echo $conf['rwlj_09']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_09" value="<?php echo $conf['rwtp_09']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					
					<hr>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">分级_10</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_10" default="<?php echo $conf['rwkq_10']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_10" value="<?php echo $conf['rwbt_10']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_10" value="<?php echo $conf['rwnr_10']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_10" value="<?php echo $conf['rwlj_10']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_10" value="<?php echo $conf['rwtp_10']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					
					
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary btn-block"/>
	 </div>
	</div>
  </form>
</div>
<!--fenzhan_1002结束-->

<!--fenzhan_1003开始-->
<div class="tab-pane fade in" id="fenzhan_1003">
<form onsubmit="return saveSetting(this)" method="post" class="form-horizontal form-bordered" role="form">

					<div class="form-group">
						<label class="col-sm-2 control-label">分级_11</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_11" default="<?php echo $conf['rwkq_11']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_11" value="<?php echo $conf['rwbt_11']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_11" value="<?php echo $conf['rwnr_11']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_11" value="<?php echo $conf['rwlj_11']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_11" value="<?php echo $conf['rwtp_11']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					
					<hr>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">分级_12</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_12" default="<?php echo $conf['rwkq_12']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_12" value="<?php echo $conf['rwbt_12']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_12" value="<?php echo $conf['rwnr_12']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_12" value="<?php echo $conf['rwlj_12']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_12" value="<?php echo $conf['rwtp_12']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					
					<hr>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">分级_13</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_13" default="<?php echo $conf['rwkq_13']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_13" value="<?php echo $conf['rwbt_13']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_13" value="<?php echo $conf['rwnr_13']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_13" value="<?php echo $conf['rwlj_13']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_13" value="<?php echo $conf['rwtp_13']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					
					<hr>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">分级_14</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_14" default="<?php echo $conf['rwkq_14']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_14" value="<?php echo $conf['rwbt_14']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_14" value="<?php echo $conf['rwnr_14']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_14" value="<?php echo $conf['rwlj_14']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_14" value="<?php echo $conf['rwtp_14']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					
					<hr>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">分级_15（加红）</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_15" default="<?php echo $conf['rwkq_15']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_15" value="<?php echo $conf['rwbt_15']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_15" value="<?php echo $conf['rwnr_15']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_15" value="<?php echo $conf['rwlj_15']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_15" value="<?php echo $conf['rwtp_15']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					

	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary btn-block"/>
	 </div>
	</div>
  </form>
</div>
<!--fenzhan_1003结束-->

<!--fenzhan_1004开始-->
<div class="tab-pane fade in" id="fenzhan_1004">
<form onsubmit="return saveSetting(this)" method="post" class="form-horizontal form-bordered" role="form">

					<div class="form-group">
						<label class="col-sm-2 control-label">分级_16</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_16" default="<?php echo $conf['rwkq_16']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_16" value="<?php echo $conf['rwbt_16']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_16" value="<?php echo $conf['rwnr_16']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_16" value="<?php echo $conf['rwlj_16']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_16" value="<?php echo $conf['rwtp_16']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					
					<hr>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">分级_17</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_17" default="<?php echo $conf['rwkq_17']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_17" value="<?php echo $conf['rwbt_17']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_17" value="<?php echo $conf['rwnr_17']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_17" value="<?php echo $conf['rwlj_17']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_17" value="<?php echo $conf['rwtp_17']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					
					<hr>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">分级_18</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_18" default="<?php echo $conf['rwkq_18']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_18" value="<?php echo $conf['rwbt_18']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_18" value="<?php echo $conf['rwnr_18']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_18" value="<?php echo $conf['rwlj_18']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_18" value="<?php echo $conf['rwtp_18']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					
					<hr>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">分级_19</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_19" default="<?php echo $conf['rwkq_19']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_19" value="<?php echo $conf['rwbt_19']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_19" value="<?php echo $conf['rwnr_19']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_19" value="<?php echo $conf['rwlj_19']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_19" value="<?php echo $conf['rwtp_19']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					
					<hr>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">分级_20</label>
						<div class="col-sm-10"><select class="form-control" name="rwkq_20" default="<?php echo $conf['rwkq_20']; ?>">
						<option value="0">关闭</option>
						<option value="1">开启</option>
						</select></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标题</label>
						<div class="col-sm-10"><input type="text" name="rwbt_20" value="<?php echo $conf['rwbt_20']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">内容</label>
						<div class="col-sm-10"><input type="text" name="rwnr_20" value="<?php echo $conf['rwnr_20']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">链接</label>
						<div class="col-sm-10"><input type="text" name="rwlj_20" value="<?php echo $conf['rwlj_20']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">图片地址</label>
						<div class="col-sm-10"><input type="text" name="rwtp_20" value="<?php echo $conf['rwtp_20']; ?>" class="form-control" placeholder="没啥好介绍的，自己看着填"/></div>
					</div>
					
					
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary btn-block"/>
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
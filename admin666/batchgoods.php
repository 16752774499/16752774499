
<?php
/**
 * 单分类批量对接商品
**/
include("../includes/common.php");
$title = '单分类批量对接商品';
include './head.php';
if ($islogin == 1) {
} else {
	exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
?>
<div class="col-md-12 col-lg-10 center-block" style="float: none;">
	<?php
	adminpermission('super', 1);
	$act = isset($_GET['act']) ? $_GET['act'] : NULL;
	if ($act == 'data') {
		$shequ = intval($_GET['shequ']);
		$row = $DB->getRow('select * from pre_shequ where id=\'' . $shequ . '\' limit 1');
		if ($row['type'] == 'daishua') {
			$returndata = third_call('daishua', $row, 'class_list');
		} else {
			showmsg('该对接网站类型不支持批量添加商品', 4);
		}
		if (!is_array($returndata)) {
			showmsg('获取数据失败：' . $returndata, 4);
		}
		$select = '<option value="-1">--请选择分类--</option><option value="0">未分类商品</option>';
		foreach ($returndata as $res) {
			$select = $select . '<option value="' . $res['cid'] . '" data-shopimg="' . $res['shopimg'] . '" sort="' . $res['sort'] . '">' . $res['name'] . '</option>';
		}
		$select2 = '<option value="-1">--请选择分类--</option><option value="0">未分类商品</option>';
		$classlist = $DB->getAll('SELECT * FROM pre_class WHERE 1 order by sort asc');
		foreach ($classlist as $res) {
			$select2 = $select2 . '<option value="' . $res['cid'] . '">' . $res['name'] . '</option>';
		}
		$select2 = $select2 . '<option value="new" id="newclass">--新建分类【】--</option>';
		$pricelist = $DB->getAll('SELECT * FROM pre_price ORDER BY id ASC');
		$priceselect = '<option value="-1">--请选择加价模板--</option>';
		foreach ($pricelist as $res) {
			$kind = ($res['kind'] == 1 ? '元' : '倍');
			$priceselect = $priceselect . '<option value="' . $res['id'] . '" kind="' . $res['kind'] . '" p_2="' . $res['p_2'] . '" p_1="' . $res['p_1'] . '" p_0="' . $res['p_0'] . '" >' . $res['name'] . '(' . $res['p_2'] . $kind . '|' . $res['p_1'] . $kind . '|' . $res['p_0'] . $kind . ')</option>';
		}
		
	?>
		<div class="block">
			<div class="block-title">
				<h3 class="panel-title">批量单分类对接商品</h3>
			</div>
			<div class="">
				<form action="?" role="form">
					<input type="hidden" name="shequ" value="<?php echo $shequ ?>" />
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">当前对接站点</div>
							<input class="form-control" value="<?php echo $row['url'] ?>" disabled><span class="input-group-btn"><a href="./batchgoods.php" class="btn btn-default">重新选择</a></span>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">选择对接站点商品分类</div>
							<select class="form-control" id="cid">
								<?php echo $select ?>
							</select>
						</div>
					</div>
					<table class="table table-bordered table-vcenter table-hover" id="shoptable">
						<tbody id="shoplist">
						</tbody>
					</table>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">选择保存到本站的分类</div>
							<select class="form-control" id="mcid">
								<?php echo $select2 ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">选择使用的加价模板</div>
							<select class="form-control" id="prid">
								<?php echo $priceselect ?>
							</select><span class="input-group-btn"><a href="./price.php" class="btn btn-default">加价模板管理</a></span>
						</div>
					</div>
					<p><input type="button" name="submit" value="确定添加/更新选中商品" class="btn btn-primary btn-block" id="add_submit" /></p>
				</form>
			</div>
		</div>
	<?php
	}
	if (!$act) {
		$shequlist = $DB->getAll('SELECT * FROM pre_shequ WHERE type=\'daishua\' order by id asc');
		$shequselect = '';
		foreach ($shequlist as $res) {
			$shequselect = $shequselect . '<option value="' . $res['id'] . '" type="' . $res['type'] . '" domain="' . $res['url'] . '">[' . display_third_title($res['type']) . ']' . $res['url'] . ($res['remark'] ? '(' . $res['remark'] . ')' : null) . '</option>';
		}
	?>
		<div class="block">
			<div class="block-title">
				<h3 class="panel-title">批量对接商品</h3><a href="./batchgoods1.php" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;跳转到多分类对接模式</a></div>
			</div>
			<div class="">
				<div class="alert alert-info">
					批量单分类对接商品目前只支持同系统对接的类型。更多请点击：跳转到多分类对接模式。
				</div>
				<form action="?" method="GET" role="form">
					<input type="hidden" name="act" value="data" />
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">选择对接站点</div>
							<select class="form-control" name="shequ">
								<?php echo $shequselect ?>
							</select>
						</div>
					</div>
					<p><input type="submit" name="submit" value="获取商品分类" class="btn btn-primary btn-block" /></p>
				</form>
			</div>
		</div>
	<?php
	}
	?>
</div>
</div>
<script src="<?php echo $cdnpublic ?>layer/3.1.1/layer.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="assets/js/batchgoods.js?ver=<?php echo VERSION ?>"></script>
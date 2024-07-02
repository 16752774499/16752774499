<?php
include("../includes/common.php");
$title = '用户管理';
include './head.php';
if ($islogin == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<style>
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
<div class="col-md-12 center-block" style="float: none;">
	<div class="modal" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">搜索用户</h4>
				</div>
				<div class="modal-body">
					<input type="text" class="form-control" name="kw" placeholder="请输入用户名"><br />
					<button type="button" class="btn btn-primary btn-block" id="search_submit">搜索</button>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="modal-rmb">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">余额充值</h4>
				</div>
				<div class="modal-body">
					<form id="form-rmb">
						<input type="hidden" name="zid" value="">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon p-0">
									<select name="do" style="-webkit-border-radius: 0;height:20px;border: 0;outline: none !important;border-radius: 5px 0 0 5px;padding: 0 5px 0 5px;">

										<option value="0">充值</option>
										<option value="1">扣除</option>
									</select>
								</span>
								<input type="number" class="form-control" name="rmb" placeholder="输入金额">
								<span class="input-group-addon">元</span>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon">备注信息</span>
								<input type="text" class="form-control" name="remark" placeholder="可留空">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-info" data-dismiss="modal">取消</button>
					<button type="button" class="btn btn-primary" id="recharge">确定</button>
				</div>
			</div>
		</div>
	</div>
	<?php
	adminpermission('site', 1);
	$my = (isset($_GET['my']) ? $_GET['my'] : NULL);
	if ($my == 'add') {
	?>
		<div class="block">
			<div class="block-title">
				<h3 class="panel-title">添加一个用户</h3>
			</div>
			<div class="">
				<form action="./userlist.php?my=add_submit" method="POST">
					<div class="form-group">
						<label>用户名:</label><br>
						<input type="text" class="form-control" name="user" value="" required>
					</div>
					<div class="form-group">
						<label>密码:</label><br>
						<input type="text" class="form-control" name="pwd" value="123456" required>
					</div>
					<div class="form-group">
						<label>余额:</label><br>
						<input type="text" class="form-control" name="rmb" value="0" required>
					</div>
					<div class="form-group">
						<label>QQ:</label><br>
						<input type="text" class="form-control" name="qq" value="">
					</div>
					<input type="submit" class="btn btn-primary btn-block" value="确定添加">
				</form>
				<br /><a href="./userlist.php">>>返回用户列表</a>
			</div>
		</div>
	<?php
	}
	if ($my == 'edit') {
		$zid = $_GET['zid'];
		$row = $DB->getRow('select * from pre_site where zid=\'' . $zid . '\'limit 1');
	?>
		<div class="block">
			<div class="block-title">
				<h3 class="panel-title">修改分站信息</h3>
			</div>
			<div class="">
				<form action="./userlist.php?my=edit_submit&zid=<?php echo $zid ?>" method="POST">
					<div class="form-group">
						<label>上级站点ID:</label><br>
						<input type="text" class="form-control" name="upzid" value="<?php echo $row['upzid'] ?>" disabled>
					</div>
					<div class="form-group">
						<label>余额:</label><br>
						<input type="text" class="form-control" name="rmb" value="<?php echo $row['rmb'] ?>" required>
					</div>
					<div class="form-group">
						<label>QQ:</label><br>
						<input type="text" class="form-control" name="qq" value="<?php echo $row['qq'] ?>">
					</div>
					<div class="form-group">
						<label>QQ快捷登录Openid:</label><br>
						<input type="text" class="form-control" name="qq_openid" value="<?php echo $row['qq_openid'] ?>">
					</div>
					<div class="form-group">
						<label>微信快捷登录Openid:</label><br>
						<input type="text" class="form-control" name="wx_openid" value="<?php echo $row['wx_openid'] ?>">
					</div>
					<div class="form-group">
						<label>重置密码:</label><br>
						<input type="text" class="form-control" name="pwd" value="" placeholder="不重置请留空">
					</div>
					<input type="submit" class="btn btn-primary btn-block" value="确定修改">
				</form>
				<br /><a href="./userlist.php">>>返回用户列表</a>
				<script>
					var items = $("select[default]");
					for (i = 0; i < items.length; i++) {
						$(items[i]).val($(items[i]).attr("default") || 0);
					}
				</script>
			</div>
		</div>
	<?php
	}
	if ($my == 'add_submit') {
		if (!checkRefererHost()) {
			exit;
		}
		$user = trim($_POST['user']);
		$pwd = trim($_POST['pwd']);
		$rmb = $_POST['rmb'];
		$qq = trim($_POST['qq']);
		if (($user == NULL || $pwd == NULL) || $qq == NULL) {
			showmsg('保存错误,请确保每项都不为空!', 3);
		}
		$rows = $DB->getRow('select * from pre_site where user=\'' . $user . '\' limit 1');
		if ($rows) {
			showmsg('用户名已存在！', 3);
		}
		$sql = "insert into `pre_site` (`power`,`user`,`pwd`,`rmb`,`qq`,`addtime`,`status`) values ('0', '$user', '$pwd', '$rmb', '$qq', '$date', '1')";
		if ($DB->exec($sql) !== false) {
			showmsg('添加用户成功！<br/><br/><a href="./userlist.php">>>返回用户列表</a>', 1);
		} else {
			showmsg('添加用户失败！' . $DB->error(), 4);
		}
	}
	if ($my == 'edit_submit') {
		if (!checkRefererHost()) {
			exit;
		}
		$zid = intval($_GET['zid']);
		$rows = $DB->getRow('select * from shua_site where zid=\'' . $zid . '\' limit 1');
		if (!$rows) {
			showmsg('当前记录不存在！', 3);
		}
		$rmb = $_POST['rmb'];
		$qq = trim($_POST['qq']);
		$qq_openid = trim($_POST['qq_openid']);
		$wx_openid = trim($_POST['wx_openid']);
		if (!empty($_POST['pwd'])) {
			$pwd = $_POST['pwd'];
			$sql = ",pwd = '$pwd'";
		}
		if ($rmb == NULL) {
			showmsg('保存错误,请确保每项都不为空!', 3);
		}
		$sql = "update pre_site set rmb = '$rmb',qq = '$qq' $sql,qq_openid = '$qq_openid',wx_openid = '$wx_openid' where zid= '$zid'";
		if ($DB->exec($sql) !== false) {
			showmsg('修改用户成功！<br/><br/><a href="./userlist.php">>>返回用户列表</a>', 1);
		} else {
			showmsg('修改用户失败！' . $DB->error(), 4);
		}
	}
	if (!$my) {
		$numrows = $DB->getColumn('SELECT count(*) from pre_site WHERE power=0');
	?>
		<div class="block">
			<div class="block-title clearfix">
				<h2>系统共有 <b><?php echo $numrows ?></b> 个用户</h2>
			</div>
			<a href="./userlist.php?my=add" class="btn btn-primary">添加用户</a>&nbsp;
			<a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">搜索</a>&nbsp;
			<label class="form-inline" for="tabSort" style="font-weight: normal;">按余额&nbsp;
				<select class="form-control" id="tabSort" style="font-weight: normal;">
					<option value="">请选择</option>
					<option value="0">正序</option>
					<option value="1">倒序</option>
				</select>
			</label>&nbsp;
			<a href="javascript:listTable('start')" class="btn btn-default" title="刷新用户列表"><i class="fa fa-refresh"></i></a>
			<div id="listTable"></div>
		</div>
</div>
</div>
<script src="<?php echo $cdnpublic ?>layer/3.1.1/layer.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="assets/js/userlist.js?ver=<?php echo VERSION ?>"></script>
</body>

</html>
<?php
	}

<?php
/**
 * 加价模板
**/
include("../includes/common.php");
$title='加价模板';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
    <div class="col-sm-12 col-md-10 center-block" style="float: none;">
<?php
adminpermission('price', 1);

function display_kind($zt){
	if($zt==1)
		return '<span class="btn-info btn-xs">固定金额加价</span>';
	else
		return '<span class="btn-primary btn-xs">倍数加价</span>';
}


$numrows=$DB->getColumn("SELECT count(*) from pre_price");
?>

<div class="modal" id="modal-store" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated flipInX">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span
							aria-hidden="true">&times;</span><span
							class="sr-only">Close</span></button>
				<h4 class="modal-title" id="modal-title">加价模板修改/添加</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="form-store">
					<input type="hidden" id="action"/>
					<input type="hidden" name="prid" id="prid"/>
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right"></label>
						<div class="col-sm-10">
							<div class="alert alert-warning">
								注意：设置的加价规则应满足：用户加价&gt;=普及版加价&gt;=专业版加价
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">模板名称</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="name" id="name" placeholder="输入模板名称">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">加价方式</label>
						<div class="col-sm-10">
							<select name="kind" id="kind" class="form-control" onchange="changeKind()">
								<option value="0">倍数加价</option>
								<option value="1">固定金额加价</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">假设商品成本价</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" value="100" id="test_price" onkeyup="changeTest()">
							<pre>此价格作为下面加价后价格显示预览，无实际意义！</pre>
						</div>
					</div>
												<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">专业版加价</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="p_2" id="p_2" onkeyup="changeTest('p_2')">
							<div class="form-control" style="color: red">加价后价格:<span id="test_p_2"></span></div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">普及版加价</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="p_1" id="p_1" onkeyup="changeTest('p_1')">
							<div class="form-control" style="color: red">加价后价格:<span id="test_p_1"></span></div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label no-padding-right">普通用户加价</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="p_0" id="p_0" onkeyup="changeTest('p_0')">
							<div class="form-control" style="color: red">加价后价格:<span id="test_p_0"></span></div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-primary" id="store" onclick="save()">保存</button>
			</div>
		</div>
	</div>
</div>

<div class="block">
<div class="block-title clearfix">
<h2>加价模板&nbsp;<a class="btn-xs btn-default" href="javascript:addframe()">
                            <i class="fa fa-plus"></i> 新增</a></h2>
</div>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>名称</th><th>类型</th><th>加价规则</th><th>操作</th></tr></thead>
          <tbody>
<?php
$rs=$DB->query("SELECT * FROM pre_price WHERE 1 order by id desc");
while($res = $rs->fetch())
{
echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['name'].'</td><td>'.display_kind($res['kind']).'</td><td>'.$res['p_2'].'|'.$res['p_1'].'|'.$res['p_0'].'</td><td><a href="./shoplist.php?prid='.$res['id'].'" target="_blank" class="btn btn-success btn-xs">商品</a>&nbsp;<a href="javascript:editframe('.$res['id'].')" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="javascript:delItem('.$res['id'].')" class="btn btn-xs btn-danger">删除</a>&nbsp;<a href="javascript:change('.$res['id'].')" class="btn btn-xs btn-default">批量更改</a></td></tr>';
}
?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php
$rs=$DB->query("SELECT * FROM pre_class WHERE active=1 order by sort asc");
$select='<option value="0">未分类商品</option>';
while($res = $rs->fetch()){
	$select.='<option value="'.$res['cid'].'">'.$res['name'].'</option>';
}
?>
<div id="class-select" style="display:none;">
	<div class="form-group">
	  <label>请选择要应用该加价模板的分类</label><br/>
	  <select name="cids" multiple="multiple" class="form-control" style="height:100px;"><?php echo $select?></select>
	  <font color="green">按住Ctrl键可多选</font>
	</div>
</div>
<script src="<?php echo $cdnpublic?>layer/3.1.1/layer.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="assets/js/price.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>
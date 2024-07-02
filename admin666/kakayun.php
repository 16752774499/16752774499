<?php
include("../includes/common.php");
global $islogin,$DB;
$title = '批量对接卡卡云';
if ($islogin == 1) {
} else {
    exit("<script language='javascript'>window.location.href='./login.php';</script>");
}
$act = isset($_GET['act']) ? $_GET['act'] : null;

// ajax请求
if($act == 'ajax_category'){
    $shequ = intval($_GET['shequ']);

    $row = $DB->getRow('select * from pre_shequ where id=\'' . $shequ . '\' limit 1');
    if ($row['type'] != 'kakayun') {
        echo json_encode(['code' => 0, 'msg' => '该对接网站类型不支持批量添加商品']);
        exit;
    }

    $category = third_call('kakayun', $row, 'get_category');
    if (!is_array($category)) {
        echo json_encode(['code' => 0, 'msg' => '获取数据失败：' . $category]);
        exit;
    }

    echo json_encode(['code' => 1, 'msg' => '获取成功','data' => $category]);
    exit;
}

if($act == 'ajax_goods'){
    $shequ = intval($_GET['shequ']);
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $cid = isset($_GET['cid']) ? intval($_GET['cid']) : 1;

    $row = $DB->getRow('select * from pre_shequ where id=\'' . $shequ . '\' limit 1');
    if ($row['type'] != 'kakayun') {
        echo json_encode(['code' => 0, 'msg' => '该对接网站类型不支持批量添加商品']);
        exit;
    }

    $goods = third_call('kakayun', $row, 'get_goods',[$cid,$page]);
    if (!is_array($goods)) {
        echo json_encode(['code' => 0, 'msg' => '获取数据失败：' . $goods]);
        exit;
    }

    if($page == 1 && count($goods['data']) == 0){
        echo json_encode(['code' => 0, 'msg' => '此分类下暂无数据']);
        exit;
    }

    foreach ($goods['data'] as $key => $item){
        $tool=$DB->getRow("SELECT * FROM pre_tools WHERE shequ=:shequ AND goods_id=:goods_id LIMIT 1", [':shequ'=>$shequ, ':goods_id'=>$item['goodsid']]);
        if($tool){
            $goods['data'][$key]['is_ok'] = true;
        }else{
            $goods['data'][$key]['is_ok'] = false;
        }
    }

    $result = [
        'code' => 1,
        'msg' => '获取成功',
        'data' => $goods['data'],
        'page' => $page,
        'allpage' => $goods['allpage']
    ];
    echo json_encode($result);
    exit;
}

if($act == 'ajax_post'){
    $shequ=isset($_POST['shequ'])?intval($_POST['shequ']):exit('{"code":-1,"msg":"no shequ"}');
    $mcid=isset($_POST['mcid'])?intval($_POST['mcid']):exit('{"code":-1,"msg":"no mcid"}');
    $prid=isset($_POST['prid'])?intval($_POST['prid']):exit('{"code":-1,"msg":"no prid"}');
    if(empty($_POST['data']))exit('{"code":-1,"msg":"商品数据为空"}');
    if($_POST['mcid']=='new'){
        $sort = $DB->getColumn("select sort from pre_class order by sort desc limit 1");
        $sql="insert into `pre_class` (`name`,`shopimg`,`sort`,`active`) values (:name,:shopimg,:sort,1)";
        if(!$DB->exec($sql, [':name'=>$_POST['cname'], ':shopimg'=>$_POST['cimg'], ':sort'=>$sort+1])){
            exit('{"code":-1,"msg":"新建分类失败！'.$DB->error().'"}');
        }
        $mcid=$DB->lastInsertId();
    }

    $row = $_POST['data'];
    if(!$row['tid']) exit('{"code":-1,"msg":"导入失败"}');

    // 获取商品数据
    $qu = $DB->getRow('select * from pre_shequ where id=\'' . $shequ . '\' limit 1');
    if ($qu['type'] != 'kakayun') {
        echo json_encode(['code' => -1, 'msg' => '该对接网站类型不支持批量添加商品']);
        exit;
    }
    $goods = third_call('kakayun', $qu, 'get_goods_detail',[$row['tid']]);
    if (!is_array($goods)) {
        echo json_encode(['code' => -1, 'msg' => '获取数据失败：' . $goods]);
        exit;
    }

    // 为空两个附加字段都没有
    $row['input'] = '';
    $row['inputs'] = '';

    if(count($goods['attach']) >= 1){
        $field = array_column($goods['attach'],'title');
        $row['input'] = array_shift($field);
        if(count($field) > 0){
            $row['inputs'] = implode('|',$field);
        }
    }

    $row['min'] = $goods['buyminnum'];
    $row['max'] = $goods['buymaxnum'];
    $row['desc'] = $goods['details'];
    $row['alert'] = $goods['msgboxtip'];
    $row['shopimg'] = $goods['imgurl'];

    $tool = $DB->getRow("SELECT * FROM pre_tools WHERE shequ=:shequ AND goods_id=:goods_id LIMIT 1", [':shequ'=>$shequ, ':goods_id'=> $row['tid']]);
    if($tool){
        $sql = "UPDATE `pre_tools` SET `cid`=:cid,`name`=:name,`price`=:price,`prid`=:prid,`cost`=:cost,`cost2`=:cost2,`prices`=:prices,`input`=:input,`inputs`=:inputs,`desc`=:desc,`alert`=:alert,`shopimg`=:shopimg,`value`=:value,`is_curl`=:is_curl,`curl`=:curl,`shequ`=:shequ,`goods_id`=:goods_id,`goods_type`=:goods_type,`goods_param`=:goods_param,`repeat`=:repeat,`multi`=:multi,`min`=:min,`max`=:max,`validate`=:validate,`valiserv`=:valiserv,`close`=:close WHERE `tid`=:tid";
        $data = [
             ':cid'=>$mcid,
            ':name'=>$row['name'],
            ':price'=>$row['price'],
            ':cost'=>0,
            ':cost2'=>0,
            ':prid'=>$prid,
            ':prices'=>'',
            ':input'=>$row['input'],
            ':inputs'=>$row['inputs'],
            ':desc'=>$row['desc'],
            ':alert'=>$row['alert'],
            ':shopimg'=>$row['shopimg'],
            ':value'=>1,
            ':is_curl'=>2,
            ':curl'=>null,
            ':shequ'=>$shequ,
            ':goods_id'=>$row['tid'],
            ':goods_type'=>$row['isfaka']?'1':'0',
            ':goods_param'=>null,
            ':repeat'=>$row['repeat'],
            ':multi'=>$row['multi'],
            ':min'=>$row['min'],
            ':max'=>$row['max'],
            ':validate'=>$row['validate'],
            ':valiserv'=>$row['valiserv'],
            ':close'=>$row['close'],
            ':tid'=>$tool['tid']
        ];

        if(!$DB->exec($sql, $data)){
            exit('{"code":-1,"msg":"导入失败: '.$DB->error().'"}');
        }
    }else{
        $sql="INSERT INTO `pre_tools` (`cid`,`name`,`price`,`cost`,`cost2`,`prid`,`prices`,`input`,`inputs`,`desc`,`alert`,`shopimg`,`value`,`is_curl`,`curl`,`shequ`,`goods_id`,`goods_type`,`goods_param`,`repeat`,`multi`,`min`,`max`,`validate`,`valiserv`,`close`,`active`,`addtime`) VALUES (:cid,:name,:price,:cost,:cost2,:prid,:prices,:input,:inputs,:desc,:alert,:shopimg,:value,:is_curl,:curl,:shequ,:goods_id,:goods_type,:goods_param,:repeat,:multi,:min,:max,:validate,:valiserv,:close,:active,NOW())";
        $data = [
                ':cid'=>$mcid,
            ':name'=>$row['name'],
            ':price'=>$row['price'],
            ':cost'=>0,
            ':cost2'=>0,
            ':prid'=>$prid,
            ':prices'=>'',
            ':input'=>$row['input'],
            ':inputs'=>$row['inputs'],
            ':desc'=>$row['desc'],
            ':alert'=>$row['alert'],
            ':shopimg'=>$row['shopimg'],
            ':value'=>1,
            ':is_curl'=>2,
            ':curl'=>null,
            ':shequ'=>$shequ,
            ':goods_id'=>$row['tid'],
            ':goods_type'=>$row['isfaka']?'1':'0',
            ':goods_param'=>null,
            ':repeat'=>$row['repeat'],
            ':multi'=>$row['multi'],
            ':min'=>$row['min'],
            ':max'=>$row['max'],
            ':validate'=>$row['validate'],
            ':valiserv'=>$row['valiserv'],
            ':close'=>$row['close'],
            ':active'=>1
        ];

        if(!$DB->exec($sql, $data)){
            exit('{"code":-1,"msg":"导入失败: '.$DB->error().'"}');
        }
    }

    $result=['code'=>0, 'msg'=>'成功添加'];
    exit(json_encode($result));
}

include './head.php';
?>
<style>
    .font-reset,.font-reset > *{
        font-size: 15px!important;
        vertical-align: middle!important;
    }
</style>

<!--获取分类数据-->
<?php if(!$act){ ?>
<?php
    $shequlist = $DB->getAll('SELECT * FROM pre_shequ WHERE type=\'kakayun\' order by id asc');
    $shequselect = '';
    foreach ($shequlist as $res) {
        $shequselect = $shequselect . '<option value="' . $res['id'] . '" type="' . $res['type'] . '" domain="' . $res['url'] . '">[' . display_third_title($res['type']) . ']' . $res['url'] . ($res['remark'] ? '(' . $res['remark'] . ')' : null) . '</option>';
    }
?>
<div class="col-md-12 col-lg-10 center-block" style="float: none;">
<div class="block">
    <div class="block-title">
        <h3 class="panel-title">批量对接卡卡云</h3>
    </div>
    <div class="">
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
            <p><input type="submit" class="btn btn-primary btn-block" /></p>
        </form>
    </div>
</div>
</div>
<?php } ?>

<!--获取卡卡云数据-->
<?php if($act == 'data'){ ?>
<?php
    $shequ = intval($_GET['shequ']);
    $row = $DB->getRow('select * from pre_shequ where id=\'' . $shequ . '\' limit 1');
    if ($row['type'] != 'kakayun') {
        showmsg('该对接网站类型不支持批量添加商品', 4);
    }
?>
    <div class="col-md-12 col-lg-10 center-block" style="float: none;">
        <div class="block">
            <div class="block-title">
                <h3 class="panel-title">批量对接卡卡云</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr class="font-reset">
                            <th>分类ID</th>
                            <th>分类名称</th>
                            <th>品牌名称</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="categoryTbody">
                        <tr>
                            <td style="text-align: center" colspan="4">数据加载中</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(function (){
            loadCategory(<?php echo $shequ;?>)
        })
    </script>
<?php } ?>

<!--一键对接-->
<?php if($act == 'info'){ ?>
<?php
$shequ = intval($_GET['shequ']);
$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 1;
$name = isset($_GET['name']) ? $_GET['name'] : '未知分类';
$img = isset($_GET['img']) ? $_GET['img'] : '';

$row = $DB->getRow('select * from pre_shequ where id=\'' . $shequ . '\' limit 1');
if ($row['type'] != 'kakayun') {
    showmsg('该对接网站类型不支持批量添加商品', 4);
}

// 卡卡云分类
$cate = ['groupname' => $name, 'groupimgurl' => $img];

// 本地分类
$select2 = '<option value="-1">--请选择分类--</option><option value="0">未分类商品</option>';
$classlist = $DB->getAll('SELECT * FROM pre_class WHERE 1 order by sort asc');
foreach ($classlist as $res) {
    $select2 = $select2 . '<option value="' . $res['cid'] . '">' . $res['name'] . '</option>';
}
// 加价模板
$pricelist = $DB->getAll('SELECT * FROM pre_price ORDER BY id ASC');
$priceselect = '<option value="-1">--请选择加价模板--</option>';
foreach ($pricelist as $res) {
    $kind = ($res['kind'] == 1 ? '元' : '倍');
    $priceselect = $priceselect . '<option value="' . $res['id'] . '" kind="' . $res['kind'] . '" p_2="' . $res['p_2'] . '" p_1="' . $res['p_1'] . '" p_0="' . $res['p_0'] . '" >' . $res['name'] . '(' . $res['p_2'] . $kind . '|' . $res['p_1'] . $kind . '|' . $res['p_0'] . $kind . ')</option>';
}

?>
    <div class="col-md-12 col-lg-10 center-block" style="float: none;">
        <a href="javascript:history.go(-1);" style="margin-bottom: 10px;display: inline-block">返回分类</a>
    </div>
    <div class="col-md-12 col-lg-10 center-block" style="float: none;">
        <div class="block">
            <div class="block-title">
                <h3 class="panel-title">商品信息</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr class="font-reset">
                        <th width="120">
                            <label class="csscheckbox csscheckbox-primary">
                                <input type="checkbox" onclick="SelectAll(this)">
                                <span></span>
                            </label>
                            &nbsp;ID
                        </th>
                        <th>封面</th>
                        <th>名称</th>
                        <th>进货价格</th>
                        <th>库存</th>
                        <th>是否对接</th>
                    </tr>
                    </thead>
                    <tbody id="shopListTbody">
                        <tr><td style="text-align: center" colspan="6">数据加载中...</td></tr>
                    </tbody>
                </table>
            </div>
            <div style="text-align: right">
                <ul class="pagination" style="margin: 5px 0">
                    <li class="disabled"><a id="prefixPage" href="javascript:;">上一页</a></li>
                    <li class="disabled"><a id="nextPage" href="javascript:;">下一页</a></li>
                </ul>
            </div>
        </div>
        <div class="block">
            <div class="block-title">
                <h3 class="panel-title">批量对接设置</h3>
            </div>
            <div class="">
                <form action="?" role="form">
                    <input type="hidden" name="shequ" value="<?php echo $shequ ?>" />
                    <input type="hidden" name="cname" value="<?php echo $cate['groupname'];?>" />
                    <input type="hidden" name="cimg" value="<?php echo $cate['groupimgurl'];?>" />
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">对接的商品分类</div>
                            <input disabled class="form-control" type="text" value="<?php echo $cate['groupname'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">保存到本站分类</div>
                            <select class="form-control" id="mcid">
                                <?php echo $select2 ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">使用的加价模板</div>
                            <select class="form-control" id="prid">
                                <?php echo $priceselect ?>
                            </select><span class="input-group-btn"><a href="./price.php" class="btn btn-default">加价模板管理</a></span>
                        </div>
                    </div>
                    <p><input type="button" value="一键对接/更新商品" class="btn btn-primary btn-block" id="add_submit" /></p>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            loadGoods(<?php echo $shequ;?>,<?php echo $cid;?>)
        })
    </script>
<?php } ?>

<script src="<?php echo $cdnpublic ?>layer/3.1.1/layer.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="assets/js/kakayun.js?ver=<?php echo time(); ?>"></script>
<?php
/**
 * 多分类批量对接商品
**/
include("../includes/common.php");
if (!$islogin) exit("<script language='javascript'>window.location.href='./login.php';</script>");
$title = '多分类批量对接商品';
include './head.php';
?>
<div class="col-sm-12 col-md-10 center-block" style="float: none;">
    <?php
    adminpermission('shop', 1);
    $rs = $DB->query("SELECT `cid`,`name` FROM pre_class WHERE active=1 order by sort asc");
    $classSelect = '<option value="0">不进行分类</option>';
    while ($res = $rs->fetch()) {
        $classSelect .= '<option value="' . $res['cid'] . '">' . $res['name'] . '</option>';
    }
    unset($rs);
    $rs = $DB->query('SELECT `id`,`type`,`url`,`remark` FROM pre_shequ order by id asc');
    $shequselect = '';
    while ($res = $rs->fetch()) {
        $getInfo = \lib\Plugin::getConfig('third_' . $res['type']);
        $shequselect .= '<option value="' . $res['id'] . '" type="' . $res['type'] . '">[<font color=blue>' . $getInfo['title'] . '</font>] ' . $res['url'] . ($res['remark'] ? ' (' . $res['remark'] . ')' : '') . '</option>';
    }
    unset($rs);
    $rs = $DB->query("SELECT `id`,`kind`,`p_0`,`p_1`,`p_2`,`name` FROM pre_price order by id asc");
    $priceselect = '<option value="0">请先选择加价模板</option>';
    while ($res = $rs->fetch()) {
        $kind = $res['kind'] == 1 ? '元' : '倍';
        $priceselect .= '<option value="' . $res['id'] . '" kind="' . $res['kind'] . '" p_2="' . $res['p_2'] . '" p_1="' . $res['p_1'] . '" p_0="' . $res['p_0'] . '" >' . $res['name'] . '(' . $res['p_2'] . $kind . '|' . $res['p_1'] . $kind . '|' . $res['p_0'] . $kind . ')</option>';
    }
    unset($rs);
    ?>
    <div class="block">
        <div class="block-title"><h3 class="panel-title">批量多分类对接商品 [ 不支持卡易信、卡商网、卡易速 ]</h3><a href="./batchgoods.php" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;跳转到单分类对接模式</a></div>
        <div class="">
            <form onsubmit="return BatchGoods(this)" method="post" class="form" role="form">
                <div class="form-group">
                    <label>选择对接网站:</label>&nbsp;(<a href="shequlist.php" target="_blank">添加</a>)<br>
                    <div class="input-group">
                        <select class="form-control" id="shequ-select" name="shequ"><?php echo $shequselect ?></select>
                        <span class="input-group-addon btn btn-success" id="getGoods">获取</span>
                    </div>
                </div>
                <div class="form-group">
                    <label>是否跳过已对接商品</label><br>
                    <select name="jump" class="form-control">
                        <option value="1">1_跳过</option>
                        <option value="2">2_不跳过(重复对接)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>需要上架商品的分类:</label>&nbsp;(<a href="./classlist.php" target="_blank">管理</a>)<br>
                    <select name="cid" class="form-control"><?php echo $classSelect ?></select>
                </div>
                <div class="form-group">
                    <label>是否删除该分类下的全部旧商品！</label><br>
                    <select name="delete" class="form-control">
                        <option value="1">删除该分类下的全部商品</option>
                        <option value="2">保留该分类下的全部商品</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>需要上架商品的加价模板:</label>&nbsp;(<a href="./price.php" target="_blank">管理</a>)<br>
                    <select name="prid" class="form-control"><?php echo $priceselect ?></select>
                </div>
                <div class="form-group">
                    <label>一键商品缓冲间隔时间(ms,1000=1s)</label><br>
                    <input type="number" value="2000" name="delay" class="form-control"
                           placeholder="如填2000则一个商品上架完后,间隔2s再上架另外一个！">
                    <font color="green">根据服务器配置而定,如果低配且速度过快可能会造成宕机</font>
                </div>
                <div class="form-group">
                    <label>允许重复下单:</label><br>
                    <div class="input-group">
                        <select class="form-control" name="repeat">
                            <option value="0">0_否</option>
                            <option value="1">1_是</option>
                        </select>
                        <a tabindex="0" class="input-group-addon" role="button" data-toggle="popover"
                           data-trigger="focus" title="" data-placement="bottom"
                           data-content="是指相同下单输入内容（非同一用户）当天只能下单一次，或上一条订单未处理的情况下不能重复下单"><span
                                    class="glyphicon glyphicon-info-sign"></span>
                        </a>
                    </div>
                </div>
                <div class="form-group">
                    <label>选择需要上架的商品<font color="red">(可多选):</font></label> <label
                            class="checkbox-inline"><input type="checkbox" onclick="selectAll(this);"
                                                           value="batchgoods"> 全选</label><br>
                    <div id="goodslist"></div>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="立即上架" class="btn btn-info"/>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo $cdnpublic ?>layer/3.1.1/layer.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="assets/js/batchgoods1.js"></script>
</body>
</html>
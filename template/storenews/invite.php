
<?php
if (!defined('IN_CRONLITE')) exit();
if(!$conf['invite_tid'])exit("<script language='javascript'>alert('当前站点未开启推广链接功能');window.location.href='./';</script>");

$shops = array();
$rs=$DB->query("SELECT A.*,B.name,B.shopimg FROM pre_inviteshop A LEFT JOIN pre_tools B ON A.tid=B.tid WHERE A.active=1 ORDER BY A.sort ASC");
while($res = $rs->fetch())
{
	$shops[] = $res;
}
?>
    
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"/>
  <title><?php echo $conf['sitename'] ?> - 推广链接生成</title>
  <meta name="keywords" content="<?php echo $conf['keywords']?>">
  <meta name="description" content="<?php echo $conf['description']?>">
  <link href="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/simple/css/plugins.css">
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/simple/css/main.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $cdnpublic ?>layui/2.5.7/css/layui.css"/>
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/simple/css/oneui.css">
  <link rel="stylesheet" href="<?php echo $cdnserver?>assets/css/common.css?ver=<?php echo VERSION ?>">
  <script src="<?php echo $cdnpublic?>modernizr/2.8.3/modernizr.min.js"></script>
<style>html{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style>
</head>
<style>
    body{
        max-width:550px;
        margin:0 auto;
      overflow: auto;height: auto !important;
    }
    .container {
        margin:10px 0px;
  width: 80%;
  text-align: center;
}

    
    .top{
      background-color: #<?php echo $conf['rgb01']; ?>;
      width: 100%;
      max-width: 550px;
      padding-bottom:15px;
      }
    .top1{
      background-color: #<?php echo $conf['rgb01']; ?>;
      width: 100%;
      max-width: 550px;
      padding-bottom:10px;
      position: fixed;
      }
      .home{
              text-align: center;
    line-height: 25px;
        height: 25px;
        width: 25px;
        border-radius: 50%;
        background-color: #fff;
        position: fixed;
        top: 18px;
        margin-left: 18px;
      }
      .toptitle{
      font-weight:600;
      color:#fff;
      text-align: center;
      height: 55px;
      line-height: 65px;
      }
      .article-content img {
      max-width: 100% !important;
      }
      .main[data-v-cc2d9c72] {
      width: 93%;
      }
      .main {
      margin: 0 auto;
      }
  .alert-info {
  background-color: #fff1dc;
  color:#fc7032;
  -webkit-box-shadow: 0 2px #ffa56a;
  box-shadow: 0 2px #ffa56a;
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
<body>
    
    <div class="top">
    <div class="top1" style="z-index:10000;">
        <a href="javascript:history.back()" class="home">
            <i class="layui-icon layui-icon-return"></i>
        </a>
        <div class="toptitle" style="font-size: 15px;">
            <a href="" style="color: #ffffff;">推广赚钱</a>
        </div>
            </div>
                </div>
    <div class="likebox" style="padding-bottom: 2.9em;"></div>

<!--开通分站-->
<font color="#666666">
<div class="block animated bounceInDown btn-rounded" style="border:1px solid #FFF0F5;margin-top:10px;font-size:13px;padding:13px;/* border-radius:15px; */background-color: white;"><div class="panel-heading"><h3 class="panel-title" types=""><font color="#000000"><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;<b>推广奖励统计</b></font></h3></div>
<div class="btn-group btn-group-justified">
<a target="_blank" class="btn btn-effect-ripple btn-default collapsed"><b><font>领取ＱＱ</font></b></a>
<a target="_blank" class="btn btn-effect-ripple btn-default collapsed"><b><font>完成时间</font></b></a>
<a target="_blank" class="btn btn-effect-ripple btn-default collapsed"><b><font>获得奖励</font></b></a>
</div>  
<marquee class="zmd" behavior="scroll" direction="UP" onmouseover="this.stop()" onmouseout="this.start()" scrollamount="5" style="height:16em">
	<table class="table table-hover table-striped" style="text-align:center">
		<thead>
                    <?php
                    $c = 80;
                    for ($a = 0; $a < $c; $a++) {
                        $sim = rand(1, 4); #随机数
                        $a1 = 'https://xy-1256220921.cos.ap-shanghai.myqcloud.com/20220701214649430.jpeg'; #现金红包
                        $a2 = 'https://xy-1256220921.cos.ap-shanghai.myqcloud.com/20220701214649430.jpeg'; #现金红包
                        $a3 = 'https://xy-1256220921.cos.ap-shanghai.myqcloud.com/20220701214649430.jpeg'; #现金红包
                        $a4 = 'https://tp01-1302784280.cos.ap-nanjing.myqcloud.com/image/shop_fdf329eaa3b95dd8e78f6d76967c4394.png'; #顶级合伙人
                        $a5 = 'https://ae01.alicdn.com/kf/H62814210ab734f578208b4e0276dd392k.png'; #
                        $e = 'a' . $sim;
                        if ($sim == '1') {
                            $name = '5元现金红包';
                        } else if ($sim == '2') {
                            $name = '10元现金红包';
                        } else if ($sim == '3') {
                            $name = '30元现金红包';
                        } else if ($sim == '4') {
                            $name = '免费升级平台顶级合伙人';
                        } else if ($sim == '5') {
                            $name = rand(1000, 100000) . '名片赞';
                        }
                        $date = date('Y-m-d'); #今日
                        $time = date("Y-m-d", strtotime("-1 day"));
                        if ($a > 50) {
                            $date = $time;
                        } else {
                            if (date('H') == 0 || date('H') == 1 || date('H') == 2) {
                                if ($a > 8) {
                                    $date = $time;
                                }
                            }
                        }
                        echo '<tr></tr><tr><td>恭喜用户<br>' . rand(10, 999) . '**' . rand(100, 999) . '**</td><td>' . $date . '<br>推广成功</td><td><font color="salmon">获得奖励<br><img src="' . $$e . '" width="15">' . $name . '</font></td></tr>';
                    }
                    ?>
					</thead>
	</table>
</marquee>
</div>

<font color="#ff0000">
    
<div class="block animated bounceInDown btn-rounded" style="border:0px solid #FFF0F5;margin-top:10px;font-size:13px;padding:0px;/* border-radius:15px; */background-color: white;"><div class="panel-heading">
            <ul class="nav nav-pills" data-toggle="tabs">
                <li class="active" style="width:49.5%"><a href="#share" data-toggle="tab">
                        <center>推广奖励</center>
                    </a></li>
                <li style="width:49.5%" class=""><a href="#query" data-toggle="tab">
                        <center>进度查询</center>
                    </a></li>
            </ul>
            <div class="block-content">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="share">
                        <div class="alert alert-info">
                            注：请选择下方的商品，填写好相关信息，然后点击生成您的专属推广链接，复制链接或者广告语发送到QQ好友/QQ群聊/微信好友/朋友圈/空间/贴吧/论坛等地方宣传。<br><br>
                            邀请他人完成正常访问后，您即可获得<font color="red">指定商品奖励</font>！<br><br>
                            邀请好友访问邀请的人数越多，领取的福利越好、越多！领取无上限！赶快生成您的专属『推广链接』把网站分享给更多人吧！
                            <br><br>
                            如发现作弊的将永久拉黑IP和QQ并封禁账号！不做任何提醒请大家自觉遵守。
                            
                        </div>
                         <div class="list-group">
                            <?php foreach ($shops as $row) {
							if(empty($row['shopimg']))$row['shopimg'] = 'https://ae01.alicdn.com/kf/H62814210ab734f578208b4e0276dd392k.png';
							?>
								<div class="list-group-item" style="padding:5px"><label class="css-input css-radio css-radio-primary" style="font-size: 14px;"><input type="radio" name="ctool" data-tid="<?php echo $row['tid'] ?>" data-type="<?php echo $row['type'] ?>" data-value="<?php echo $row['value'] ?>" value="<?php echo $row['id'] ?>"><span></span>
										<img src="<?php echo $row['shopimg'] ?>"  width="18px">&nbsp;<?php echo $row['name'] ?>
									</label>
								</div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
							<div class="hide" id="tidframe"></div>
                            <div class="input-group">
                                <div class="input-group-addon">查单QQ号</div>
                                <input type="text" name="query_qq" id="query_qq" class="form-control" placeholder="请输入用于查询订单的QQ账号" required="required">
                            </div>
                            <hr />

                            <div id="inputsname"></div>


							<div id="alert_invite" style="display: none" class="alert alert-success"></div>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" id="submit_buy" value="立即创建推广订单" class="btn btn-primary btn-block" style="background-color: #ffa56a; border-color: #ffa56a;">
                        </div>
						<div id="resulturl" style="display:none;">
                        </div>
                    </div>
                    <div class="tab-pane fade in" id="query">
                        <div class="form-group">
                            <div class="alert alert-info">
                                提示：输入获取推广信息时填写的查单QQ，即可查询进度<br>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        查单QQ号
                                    </div>
                                    <input type="text" name="qq" id="qq" class="form-control"
                                           placeholder="请输入用于查询订单的QQ账号,查询推广进度" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" id="submit_sublog" value="立即查询"
                                       class="btn btn-primary btn-block"
                                       style="background-color: #ffa56a; border-color: #ffa56a;">
                            </div>
                            <div id="result" class="form-group" style="display:none">
                                <div class="table-responsive">
                                    <table class="table table-vcenter table-condensed table-striped">
                                        <thead>
                                        <tr>
                                            <th>领取账号</th>
                                            <th>商品名称</th>
											<th>奖励次数</th>
											<th>状态</th>
											<th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody id="list" style="font-size: 13px;"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        
<script src="<?php echo $cdnpublic ?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic ?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic ?>jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="<?php echo $cdnpublic ?>layer/2.3/layer.js"></script>
<script src="<?php echo $cdnpublic ?>clipboard.js/1.7.1/clipboard.min.js"></script>
<script type="text/javascript">
    var hashsalt =<?php echo $addsalt_js?>;
</script>
<script src="assets/js/invite.js?ver=<?php echo VERSION ?>"></script>
</body>
</html>
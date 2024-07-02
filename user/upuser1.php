<!DOCTYPE html>
      <html lang="zh-cn" style="" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths"><head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>分站管理</title>
  <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="//cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/simple/css/plugins.css">
  <link rel="stylesheet" href="../assets/simple/css/main.css">
  <link rel="stylesheet" href="../assets/css/common.css">
    <link href="//cdn.staticfile.org/layui/2.5.7/css/layui.css" rel="stylesheet">
  <script src="//cdn.staticfile.org/modernizr/2.8.3/modernizr.min.js"></script>
  <link rel="stylesheet" href="../assets/user/css/my.css">
   <script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdn.staticfile.org/layui/2.5.7/layui.all.js"></script><link id="layuicss-laydate" rel="stylesheet" href="http://cdn.staticfile.org/layui/2.5.7/css/modules/laydate/default/laydate.css?v=5.0.9" media="all"><link id="layuicss-layer" rel="stylesheet" href="http://cdn.staticfile.org/layui/2.5.7/css/modules/layer/default/layer.css?v=3.1.1" media="all"><link id="layuicss-skincodecss" rel="stylesheet" href="http://cdn.staticfile.org/layui/2.5.7/css/modules/code.css" media="all">
  <!--[if lt IE 9]>
    <script src="//cdn.staticfile.org/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
<body><link rel="stylesheet" href="../assets/user/css/work.css">
<style>
    .item-c-title{
        width: 25%;
    }
    .list-item .list-item-c .item-c-txet .item-c-data{
        margin-left: 0;
    }
    input::placeholder{
        text-align: right;
    }
    input{
        text-align: right;
    }
    .form-control[disabled]{
        background-color:transparent;
    }
    .search-input::placeholder{
        text-align: left;
    }
    .layui-layer {
        /*background: #fff;*/
    }
    
</style>

<?php
/**
 * 分站管理
**/
include("../includes/common.php");
$title='分站管理';

if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>

		<div class="panel panel-default" style="width: 100%;display: inline-block;border-radius: 5px;box-shadow: 1px 1px 2px #e2dfdf;border:  1px solid #f2f2f2;">
<div class="modal fade" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">搜索分站</h4>
      </div>
      <div class="modal-body">
      <form action="upuser.php" method="GET">
<input type="text" class="form-control" name="kw" placeholder="请输入分站用户名或域名或QQ"><br/>
<input type="submit" class="btn btn-primary btn-block" value="搜索"></form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
if($userrow['power']<2){
	showmsg('你没有权限使用此功能！',3);
}
$my=isset($_GET['my'])?$_GET['my']:null;



if($my=='add')
{
$domains=explode(',',$conf['fenzhan_domain']);
$select='';
foreach($domains as $domain){
	$select.='<option value="'.$domain.'">'.$domain.'</option>';
}
echo '<div class="col-xs-12 col-sm-10 col-md-6 col-lg-4 center-block " style="float: none; background-color:#f2f2f2;padding:0">
    <div class="block  block-all">
        <div class="block-back block-white">
            <a href="./userlist.php" class="font-weight display-row align-center">
                <img style="height: 2rem" src="../assets/user/img/close.png"></img>&nbsp;&nbsp;
                <font>添加分站</font>
            </a>
        </div>
        <div style="background: #f2f2f2; height: 10px"></div>
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
            <div class="my-cell-title display-row justify-between align-center">
                    <div class="my-cell-title-l left-title" style="font-size:1.3rem">添加分站</div>
                </div>';
echo '<div class="panel-body">';
echo '<form action="./upuser1.php?my=add_submit" method="POST">
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%" >
                                <div class="input-group-addon" >
                                    账号
                                </div>
<input type="text" class="form-control" name="user" value="" placeholder="输入账号用户名" required>
</div></div>
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    密码
                                </div>
<input type="text" class="form-control" name="pwd" placeholder="输入密码" value="123456" required>
</div></div>
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    绑定域名
                                </div>
<input type="text" class="form-control" name="qz" value="" placeholder="输入二级前缀" required>
<div class="input-group-addon"><select name="domain">'.$select.'</select></div>
</div></div>
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    网站名称
                                </div>
<input type="text" class="form-control" name="sitename" value="'.$conf['sitename'].'">
</div></div>
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    站长ＱＱ
                                </div>
<input type="text" class="form-control" name="qq" value="" placeholder="输入QQ">
</div></div>
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    到期时间
                                </div>
<input type="date" class="form-control" name="endtime" value="'.date("Y-m-d",strtotime("+1 years")).'" required>
</div></div>
                <div class="text-center" style="padding: 30px 0;">
                    <input type="submit" class="btn submit_btn" style="width: 80%;padding:8px;" value="确定添加">
                </div></form>';
echo '</div></div>';
}
elseif($my=='edit')
{
    
 
    
$zid=intval($_GET['zid']);
$row=$DB->getRow("SELECT * FROM pre_site WHERE zid='$zid' AND upzid='{$userrow['zid']}' AND power=2 LIMIT 1");
if(!$row)


$select='';
$list=explode(',',$conf['fenzhan_domain']);

foreach($list as $domain){
	$select.='<option value="'.$domain.'">'.$domain.'</option>';

}
$pricec=$conf['fenzhan_cost2'];	
echo '<div class="col-xs-12 col-sm-10 col-md-6 col-lg-4 center-block " style="float: none; background-color:#f2f2f2;padding:0">
    <div class="block  block-all">
        <div class="block-back block-white">
            <a href="./userlist.php" class="font-weight display-row align-center">
                <img style="height: 2rem" src="../assets/user/img/close.png"></img>&nbsp;&nbsp;
                <font>
站点升级</font>
            </a>
        </div>
        <div style="background: #f2f2f2; height: 10px"></div>
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
            <div class="my-cell-title display-row justify-between align-center">
                    <div class="my-cell-title-l left-title" style="font-size:1.3rem">
站点升级</div>
                </div>';
echo '<div class="panel-body">';
echo '<form action="./upuser1.php?my=edit_submit&zid='.$zid.'" method="POST">
                       


<div class="form-group form-group-transparent form-group-border-bottom">
                    <div class="input-group" style="width:100%">
                        <div class="input-group-addon">
                            开通版本
                        </div>
                        <select name="kind" class="form-control" style="text-align: right">
                            <option value="2">顶级合伙人</option>
       
                        </select>
                    </div>
                </div>
                  
                  
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    开通价格
                                </div>
<input type="text" class="form-control" name="sitename" value="'.$pricec.'" disabled="disabled">
</div></div>
                
                <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    绑定域名
                                </div>
<input type="text" class="form-control" name="qz" value="" placeholder="输入二级前缀" required>
<div class="input-group-addon"><select name="domain">'.$select.'</select></div>
</div></div>
                      
                
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    站点名称
                                </div>
<input type="text" class="form-control" name="sitename" value="'.$row['sitename'].'">
</div></div>
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    到期时间
                                </div>
 <input type="date" class="form-control" name="endtime" value="'.date("Y-m-d",strtotime("+1 years")).'" required>

</div></div>


                <div class="text-center" style="padding: 30px 0;">
                        <input type="submit" class="btn submit_btn" style="width: 80%;padding:8px;" value="确定修改">
                    </div>            ';
echo '</div></div>';
}
elseif($my=='add_submit')
{
if(!$conf['fenzhan_adds'])showmsg('请在前台开通分站');
$user=trim(htmlspecialchars(strip_tags(daddslashes($_POST['user']))));
$pwd=trim(htmlspecialchars(strip_tags(daddslashes($_POST['pwd']))));
$qz = trim(htmlspecialchars(strtolower(daddslashes($_POST['qz']))));
$domain = trim(htmlspecialchars(strtolower(strip_tags(daddslashes($_POST['domain'])))));
$qq=trim(htmlspecialchars(strip_tags(daddslashes($_POST['qq']))));
$endtime=trim(htmlspecialchars(strip_tags(daddslashes($_POST['endtime']))));
$sitename=trim(htmlspecialchars(strip_tags(daddslashes($_POST['sitename']))));







$keywords=$conf['keywords'];
$description=$conf['description'];
$domain = $qz . '.' . $domain;
$thtime =date("Y-m-d").' 00:00:00';
if($user==NULL or $pwd==NULL or $qz==NULL or $domain==NULL or $endtime==NULL){
	showmsg('保存错误,请确保每项都不为空!',3);
} elseif (!in_array($_POST['domain'],explode(',',$conf['fenzhan_domain']))) {
	showmsg('域名后缀不存在！');
} elseif (strlen($qz) < 2 || strlen($qz) > 10 || !preg_match('/^[a-z0-9\-]+$/',$qz)) {
	showmsg('域名前缀不合格！');
} elseif (!preg_match('/^[a-zA-Z0-9]+$/',$user)) {
	showmsg('用户名只能为英文或数字！');
} elseif (!preg_match('/^[a-zA-Z0-9\_\-\.]+$/',$domain)) {
	showmsg('域名格式不正确');
} elseif ($DB->getRow("SELECT zid FROM pre_site WHERE user=:user LIMIT 1", [':user'=>$user])) {
	showmsg('用户名已存在！');
} elseif (strlen($pwd) < 6) {
	showmsg('密码不能低于6位');
} elseif (strlen($sitename) < 2) {
	showmsg('网站名称太短！');
} elseif (strlen($qq) < 5 || !preg_match('/^[0-9]+$/',$qq)) {
	showmsg('QQ格式不正确！');
} elseif ($DB->getRow("SELECT zid FROM pre_site WHERE domain=:domain OR domain=:domain LIMIT 1", [':domain'=>$domain]) || $qz=='www' || $domain==$_SERVER['HTTP_HOST'] || in_array($domain,explode(',',$conf['fenzhan_remain']))) {
	showmsg('此前缀已被使用！');
} elseif ($DB->getColumn("SELECT count(*) FROM pre_site WHERE upzid='{$userrow['zid']}' and addtime>'$thtime'")>20) {
	showmsg('你今天添加的分站较多，暂无法后台手动添加，请直接使用前台网址自助开通分站！',3);
} else {
if($conf['fenzhan_html']==1){
	$anounce=$conf['anounce'];
	$alert=$conf['alert'];
}
$sql="INSERT INTO `pre_site` (`upzid`,`power`,`domain`,`domain`,`user`,`pwd`,`rmb`,`qq`,`sitename`,`keywords`,`description`,`anounce`,`alert`,`addtime`,`endtime`,`status`) VALUES (:upzid, :power, :domain, NULL, :user, :pwd, :rmb, :qq, :sitename, :keywords, :description, :anounce, :alert, NOW(), :endtime, 1)";
$data = [':upzid'=>$userrow['zid'], ':power'=>2, ':domain'=>$domain,  ':rmb'=>'0.00', ':qq'=>$qq, ':sitename'=>$sitename, ':keywords'=>$keywords, ':description'=>$description, ':anounce'=>$anounce, ':alert'=>$alert, ':endtime'=>$endtime];
if($DB->exec($sql, $data)){
    showmsg('添加分站成功！<br/><br/><a href="./upuser.php">>>返回分站列表</a>',1);
}else
	showmsg('添加分站失败！'.$DB->error(),4);
}
}
	
elseif($my=='edit_submit')
{
$zid=intval($_GET['zid']);
$ktjg=$conf['fenzhan_cost2'];


    
$rows=$DB->getColumn("SELECT count(*) FROM pre_site WHERE upzid='{$userrow['zid']}' AND power=0");           

$uid=$userrow['zid'];

if(!$rows)
	showmsg('当前记录不存在！',3);
	$qz = trim(htmlspecialchars(strtolower(daddslashes($_POST['qz']))));

$qq=trim(htmlspecialchars(strip_tags(daddslashes($_POST['qq']))));

$domain=trim(strtolower(htmlspecialchars(strip_tags(daddslashes($_POST['domain'])))));
$endtime=trim(htmlspecialchars(strip_tags(daddslashes($_POST['endtime']))));
$sitename=trim(htmlspecialchars(strip_tags(daddslashes($_POST['sitename']))));

$domain = $qz . '.' . $domain;







if($sitename==NULL or $endtime==NULL  or    $qz==NULL or $domain==NULL or $endtime==NULL){
showmsg('保存错误,请确保每项都不为空!',3);
} elseif (!empty($domain) && !preg_match('/^[a-zA-Z0-9\_\-\.]+$/',$domain)) {
	showmsg('域名格式不正确');
} else {
if (!empty($domain) && $DB->getRow("SELECT zid FROM pre_site WHERE (domain=:domain OR domain=:domain) AND zid!=:zid LIMIT 1", [':domain'=>$domain, ':zid'=>$zid]) || $domain==$_SERVER['HTTP_HOST'] || !empty($domain) && (in_array($domain,explode(',',$conf['fenzhan_remain'])) || in_array($domain,explode(',',$conf['fenzhan_domain'])))) {
	showmsg('此域名已被使用！');
}elseif(strpos($domain,'www.')!==false){
	$domain=str_replace('www.','',$domain);
	if(in_array($domain,explode(',',$conf['fenzhan_remain'])) || in_array($domain,explode(',',$conf['fenzhan_domain'])))
		showmsg('此域名已被使用！');
}

if($ktjg>$userrow['rmb']){
    	showmsg('余额不足！',3);
}else{
    $rmb=$userrow['rmb']-$ktjg;
    $uid=$userrow['zid'];
    $DB->exec("UPDATE pre_site SET  rmb=:rmb WHERE zid=:zid", [':rmb'=>$rmb,':zid'=>$uid]);
}


if($DB->exec("UPDATE pre_site SET  domain=:domain,power=:power, sitename=:sitename,endtime=:endtime WHERE zid=:zid", [':domain'=>$domain,':sitename'=>$sitename, ':endtime'=>$endtime,  ':power'=>2,':zid'=>$zid])!==false)
  showmsg('<script type="text/javascript">
           
    		layer.open({
                type: 1,
                area: ["30rem", "22rem"],
                title: false,
                shade: 0.3,
                skin: "layerdemo",
                time:3000,
                shadeClose: false,
                closeBtn: 0,
                content: "<center><div class=\"showtip display-column justify-between align-center\" style=\"width:30rem;height: 22rem;\"><div class=\"showtip-title\"></div><div class=\"showtip-center  display-column justify-center align-center\"><img src=\"../assets/user/img/warning.png\" style=\"height:30%\"><div class=\"showtip-center-msg\">开通分站成功</div><div class=\"showtip-center-num\">3秒后返回首页</div></div><div class=\"showtip-btn display-row justify-center align-center\"><a href=\"./\" class=\"showtip-btn-yes display-column justify-center align-center\">确认</a></div></div></center>",
                end: function(){ 
                  if(3){ 
                    window.location.href="./";
                  }
                 
                }
            });
    	</script>',1);
	
else
	showmsg('修改分站失败！'.$DB->error(),3);
}
}
elseif($my=='delete')
{
$zid=intval($_GET['zid']);
$srow=$DB->getRow("SELECT * FROM pre_site WHERE zid='{$zid}' limit 1");


if($srow['rmb']>=1)showmsg('当前站点余额较多，无法删除',3);
$sql="DELETE FROM pre_site WHERE zid='$zid' AND upzid='{$userrow['zid']}' AND power=1";
if($DB->exec($sql)!==false)
	showmsg('删除成功！',1);
else
	showmsg('删除失败！'.$DB->error(),4);
}
else
{

//$numrows=$DB->getColumn("SELECT count(*) FROM pre_site WHERE upzid='{$userrow['zid']}' AND power=1");
$numrows=$DB->getColumn("SELECT count(*) FROM pre_site WHERE upzid='{$userrow['zid']}' AND (power=1 or power=2)");


  if(isset($_GET['zid']))
                            {
                    	   $zid=intval($_GET['zid']);
                    	   $sql = " zid={$zid} AND upzid='{$userrow['zid']}' AND power=0";
                            }elseif(isset($_GET['kw'])){
	                       $kw=daddslashes($_GET['kw']);
	                       $sql = " (user='{$kw}' OR qq='{$kw}') AND upzid='{$userrow['zid']}' AND power=0";
                            }else
                            {
	                       $sql = " upzid='{$userrow['zid']}' AND power=0";
                            }
                        

$con='

 
                '.($conf['fenzhan_adds']==1?'
':null).'';


echo $con;
echo '</div>';

?>
       


      </div>
          </tbody>
        </table>
      </div>
<?php
echo'<ul class="pagination" style="margin-left:1em">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="upuser.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="upuser.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
$start=$page-10>1?$page-10:1;
$end=$page+10<$pages?$page+10:$pages;
for ($i=$start;$i<$page;$i++)
echo '<li><a href="upuser.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$end;$i++)
echo '<li><a href="upuser.php?page='.$i.$link.'">'.$i .'</a></li>';
if ($page<$pages)
{
echo '<li><a href="upuser.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="upuser.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
}
?>
    </div>
  </div>
  </script>
</body>
</html>
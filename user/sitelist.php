<!DOCTYPE html>
      <html lang="zh-cn" style="" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths"><head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>分站管理</title>
  <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../assets/simple/css/plugins.css">
  <link rel="stylesheet" href="../assets/simple/css/main.css">
  <link rel="stylesheet" href="../assets/css/common.css">
    <link href="//cdn.staticfile.org/layui/2.5.7/css/layui.css" rel="stylesheet">
  <script src="//cdn.staticfile.org/modernizr/2.8.3/modernizr.min.js"></script>
  <link rel="stylesheet" href="../assets/user/css/my.css">
   <script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdn.staticfile.org/layui/2.5.7/layui.all.js"></script><link id="layuicss-laydate" rel="stylesheet" href="http://cdn.staticfile.org/layui/2.5.7/css/modules/laydate/default/laydate.css?v=5.0.9" media="all"><link id="layuicss-layer" rel="stylesheet" href="http://cdn.staticfile.org/layui/2.5.7/css/modules/layer/default/layer.css?v=3.1.1" media="all"><link id="layuicss-skincodecss" rel="stylesheet" href="http://cdn.staticfile.org/layui/2.5.7/css/modules/code.css" media="all">
<style>body{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style>
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
    .list-btn{
        position: absolute;
        top: 45%;
        right: 0;
        width: 8.5rem;

    }
    .list-btn-item{
        width: 100%;
        height: 3.15rem;
        text-align: center;
        line-height: 3.1rem;
        margin-bottom: 10px;
        color: #fff;
        border-radius: 50px 0 0 50px;
        font-size: 1.15rem;
        box-shadow: 1px 1px 5px #e2dfdf, 1px 1px 5px #dedede;
    }
  


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

<?php
/**
 * 分站管理
**/
include("../includes/common.php");
$title='分站管理';

if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>


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
echo '<div class="col-xs-12 col-sm-10 col-md-6 col-lg-4 center-block " style="float: none; background-color:#fff;padding:0;max-width: 550px;">
    <div class="block  block-all">
        <div class="block-white">
            <div class="block-back display-row align-center justify-between">
                <div style="border-width: .5px;
    border-radius: 100px;
    border-color: #dadbde;
    background-color: #f2f2f2;
    padding: 3px 7px;
    opacity: .8;align-items: center;justify-content: space-between;display: flex; flex-direction: row;height: 30px;">
                <a href="sitelist.php"  class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.4rem" src="../assets/img/fanhui.png">&nbsp;
                </a>
                <div style="margin: 0px 8px; border-left: 1px solid rgb(214, 215, 217); height: 16px; border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-bottom-color: rgb(214, 215, 217);"></div>
                <a href="../" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.8rem" src="../assets/img/home1.png">&nbsp;
                </a>
            </div>
            <div style="font-size: 15px;">
            <font><a href="">添加分站站长</a></font>

            </div>
                </div>
            <div class="form-group form-group-transparent" style="background: #f2f2f2; padding:2px 0px;padding-left: 0px;margin: 0 0px;">
                <div class="input-group" style="width:100%">
                    <div class="input-group-addon">
                        分站信息
                    </div>
                    <div style="color:#696969" class="form-control form-control-left"></div>
                </div>
            </div>';
echo '<form action="./sitelist.php?my=add_submit" method="POST">
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%" >
                                <div class="input-group-addon" >
                                    账号
                                </div>
<input type="text" class="form-control" name="user" value="" placeholder="输入登录账号" required>
</div></div>
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    密码
                                </div>
<input type="text" class="form-control" name="pwd" placeholder="输入登录密码" value="123456" required>
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
                                    二级前缀
                                </div>
<input type="text" class="form-control" name="qz" value="" placeholder="输入自定义二级前缀" required>

</div></div>
                      
            <div class="form-group form-group-transparent form-group-border-bottom">
                <div class="input-group" style="width:100%">
                    <div class="input-group-addon">
                        选择后缀
                    </div>
                    <select name="domain" style="text-align: right" class="form-control">'.$select.'</select>
                </div>
            </div>
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
                                    到期时间
                                </div>
<input type="date" class="form-control" name="endtime" value="'.date("Y-m-d",strtotime("+100 years")).'" required>
</div></div></div>
                <div class="text-center" style="padding: 30px 0;">
                    <input type="submit" class="btn submit_btn" style="width: 80%;padding:8px;" value="确定添加">
                </div></form>';
echo '</div></div>';
}
elseif($my=='edit')
{
$zid=intval($_GET['zid']);
$row=$DB->getRow("SELECT * FROM pre_site WHERE zid='$zid' AND upzid='{$userrow['zid']}' AND power=1 LIMIT 1");
if(!$row)
	showmsg('顶级合伙人禁止编辑！',3);
echo '<div class="col-xs-12 col-sm-10 col-md-6 col-lg-4 center-block " style="float: none; background-color:#f2f2f2;padding:0">
    <div class="block  block-all">
        <div class="block-back block-white">
            <a href="./sitelist.php" class="font-weight display-row align-center">
                <img style="height: 2rem" src="../assets/user/img/close.png"></img>&nbsp;&nbsp;
                <font>修改分站信息</font>
            </a>
        </div>
        <div style="background: #f2f2f2; height: 10px"></div>
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
            <div class="my-cell-title display-row justify-between align-center">
                    <div class="my-cell-title-l left-title" style="font-size:1.3rem">修改分站信息</div>
                </div>';
echo '<div class="panel-body">';
echo '<form action="./sitelist.php?my=edit_submit&zid='.$zid.'" method="POST">
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    绑定域名
                                </div>
<input type="text" class="form-control" name="domain" value="'.$row['domain'].'" disabled>
</div></div>
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    额外域名
                                </div>
<input type="text" class="form-control" name="domain2" value="'.$row['domain2'].'" placeholder="没有请留空">
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
<input type="date" class="form-control" name="endtime" value="'.date("Y-m-d",strtotime($row['endtime'])).'" required>
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
} elseif (strlen($qz) < 3 || strlen($qz) > 10 || !preg_match('/^[a-z0-9\-]+$/',$qz)) {
	showmsg('域名前缀不合格，至少3位数！');
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
} elseif ($DB->getRow("SELECT zid FROM pre_site WHERE domain=:domain OR domain2=:domain LIMIT 1", [':domain'=>$domain]) || $qz=='www' || $domain==$_SERVER['HTTP_HOST'] || in_array($domain,explode(',',$conf['fenzhan_remain']))) {
	showmsg('此前缀已被使用！');
} elseif ($DB->getColumn("SELECT count(*) FROM pre_site WHERE upzid='{$userrow['zid']}' and addtime>'$thtime'")>20) {
	showmsg('你今天添加的分站较多，暂无法后台手动添加，请直接使用前台网址自助开通分站！',3);
} else {
if($conf['fenzhan_html']==1){
	$anounce=$conf['anounce'];
	$alert=$conf['alert'];
}
$sql="INSERT INTO `pre_site` (`upzid`,`power`,`domain`,`domain2`,`user`,`pwd`,`rmb`,`qq`,`sitename`,`keywords`,`description`,`anounce`,`alert`,`addtime`,`endtime`,`status`) VALUES (:upzid, :power, :domain, NULL, :user, :pwd, :rmb, :qq, :sitename, :keywords, :description, :anounce, :alert, NOW(), :endtime, 1)";
$data = [':upzid'=>$userrow['zid'], ':power'=>1, ':domain'=>$domain, ':user'=>$user, ':pwd'=>$pwd, ':rmb'=>'0.00', ':qq'=>$qq, ':sitename'=>$sitename, ':keywords'=>$keywords, ':description'=>$description, ':anounce'=>$anounce, ':alert'=>$alert, ':endtime'=>$endtime];
if($DB->exec($sql, $data)){
    showmsg("<script language='javascript'>alert('添加分站成功！');history.go(-1);</script>",1);
}else
	showmsg('添加分站失败！'.$DB->error(),4);
}
}
	
elseif($my=='edit_submit')
{
$zid=intval($_GET['zid']);
$rows=$DB->getRow("SELECT * FROM pre_site WHERE zid='$zid' AND upzid='{$userrow['zid']}' AND power=1 LIMIT 1");
if(!$rows)
	showmsg('当前记录不存在！',3);
$domain2=trim(strtolower(htmlspecialchars(strip_tags(daddslashes($_POST['domain2'])))));
$endtime=trim(htmlspecialchars(strip_tags(daddslashes($_POST['endtime']))));
$sitename=trim(htmlspecialchars(strip_tags(daddslashes($_POST['sitename']))));









if($sitename==NULL or $endtime==NULL){
showmsg('保存错误,请确保每项都不为空!',3);
} elseif (!empty($domain2) && !preg_match('/^[a-zA-Z0-9\_\-\.]+$/',$domain2)) {
	showmsg('域名格式不正确');
} else {
if (!empty($domain2) && $DB->getRow("SELECT zid FROM pre_site WHERE (domain=:domain OR domain2=:domain) AND zid!=:zid LIMIT 1", [':domain'=>$domain2, ':zid'=>$zid]) || $domain2==$_SERVER['HTTP_HOST'] || !empty($domain2) && (in_array($domain2,explode(',',$conf['fenzhan_remain'])) || in_array($domain2,explode(',',$conf['fenzhan_domain'])))) {
	showmsg('此域名已被使用！');
}elseif(strpos($domain2,'www.')!==false){
	$domain=str_replace('www.','',$domain2);
	if(in_array($domain,explode(',',$conf['fenzhan_remain'])) || in_array($domain,explode(',',$conf['fenzhan_domain'])))
		showmsg('此域名已被使用！');
}
if($DB->exec("UPDATE pre_site SET domain2=:domain2,   sitename=:sitename,endtime=:endtime WHERE zid=:zid", [':domain2'=>$domain2,':sitename'=>$sitename, ':endtime'=>$endtime, ':zid'=>$zid])!==false)
	showmsg("<script language='javascript'>alert('修改分站成功！');history.go(-1);</script>",1);
else
	showmsg('修改分站失败！'.$DB->error(),4);
}
}
elseif($my=='delete')
{
$zid=intval($_GET['zid']);
$srow=$DB->getRow("SELECT * FROM pre_site WHERE zid='{$zid}' limit 1");
if($srow['rmb']>=1)showmsg('当前站点余额较多，无法删除',3);
$sql="DELETE FROM pre_site WHERE zid='$zid' AND upzid='{$userrow['zid']}' AND power=1";
if($DB->exec($sql)!==false)
	showmsg("<script language='javascript'>alert('删除分站成功！');history.go(-1);</script>",1);
else
	showmsg('删除失败！'.$DB->error(),4);
}
else
{

//$numrows=$DB->getColumn("SELECT count(*) FROM pre_site WHERE upzid='{$userrow['zid']}' AND power=1");
$numrows=$DB->getColumn("SELECT count(*) FROM pre_site WHERE upzid='{$userrow['zid']}' AND (power=1 or power=2)");
if(isset($_GET['zid'])){
	$zid=intval($_GET['zid']);
//	$sql = " zid={$zid} AND upzid='{$userrow['zid']}' AND power=1";
	$sql = " zid={$zid} AND upzid='{$userrow['zid']}' AND (power=1 or power=2)";
}elseif(isset($_GET['kw'])){
	$kw=daddslashes($_GET['kw']);
//	$sql = " (user='{$kw}' OR domain='{$kw}' OR qq='{$kw}') AND upzid='{$userrow['zid']}' AND power=1";
	$sql = " (user='{$kw}' OR domain='{$kw}' OR qq='{$kw}') AND upzid='{$userrow['zid']}'  AND (power=1 or power=2)";
}else{
//	$sql = " upzid='{$userrow['zid']}' AND power=1";
	$sql = " upzid='{$userrow['zid']}' AND (power=1 or power=2)";
}
$con='
<div class="col-xs-12 col-sm-10 col-md-6 col-lg-4 center-block " style="float: none; background-color:#fff;padding:0;max-width: 550px;">
    <div class="block  block-all">
        <div class="block-white">
            <div class="block-back display-row align-center justify-between">
                <div style="border-width: .5px;
    border-radius: 100px;
    border-color: #dadbde;
    background-color: #f2f2f2;
    padding: 3px 7px;
    opacity: .8;align-items: center;justify-content: space-between;display: flex; flex-direction: row;height: 30px;">
                <a href="./"  class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.4rem" src="../assets/img/fanhui.png">&nbsp;
                </a>
                <div style="margin: 0px 8px; border-left: 1px solid rgb(214, 215, 217); height: 16px; border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-bottom-color: rgb(214, 215, 217);"></div>
                <a href="../" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.8rem" src="../assets/img/home1.png">&nbsp;
                </a>
            </div>
            <div style="font-size: 15px;">
            <font><a href="">分站管理</a></font>

            </div>
                </div>
            <div  style="background: #f2f2f2; height: 10px"></div>
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
            <div class="my-cell-title display-row justify-between align-center">
                    <div class="my-cell-title-l left-title" style="font-size:1.3rem">分站管理</div>
                    <div class="my-cell-title-r  display-row  align-center">
                        <span style="color: #939393;font-size:1.3rem">共'.$numrows.'个分站</span>
                    </div>
                </div>
                <a href="./sitelist.php?my=add"   style="width: 100%;">
                    <div class="submit_btn" style="width:95%;height: 4.2rem;margin:10px auto;text-align: center;line-height: 4.2rem;border-radius: 5px"><i class="fa fa-plus"></i>  添加分站</div>
                </a>
            </div>
            <div class="max-width">
                <form action="sitelist.php" method="GET">
                    <div class="form-group" style="margin-top: 15px">
                        <div class="input-group">
                            <input type="text" class="form-control search-input" style="background: #fff;text-align: left;" name="kw" placeholder="请输入分站用户名或域名或QQ">
                            <div class="input-group-addon" style="padding: 0 12px">
                                <input type="submit" style="border: 1px solid transparent; color: #0b9ff5" value="搜索">
                            </div>
                        </div>

                    </div>
                </form>
 
                '.($conf['fenzhan_adds']==1?'
':null).'';


echo $con;
echo '</div>';

?>
      
        <div class="my-cell" style="background: #f2f2f2;margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
  
            
            
            
          
<?php



 /*
        <div class="item-c-txet">
                                         <div class="item-c-title">到期时间</div>
                                         <div class="item-c-data">   '.$res['endtime'].'</div>
                                     </div>     
            */ 



$pagesize=10;
$pages=ceil($numrows/$pagesize);
$page=isset($_GET['page'])?intval($_GET['page']):1;
$offset=$pagesize*($page - 1);
$power=                 $userrow['power']==2?'顶级合伙人':'分站站长';
$rs=$DB->query("SELECT * FROM pre_site WHERE{$sql} ORDER BY zid DESC LIMIT $offset,$pagesize");
while($res = $rs->fetch())
{

echo '<div class="list-item">
                                 <div class="list-item-top">
                                      <div class="item-logo-1" style="width: auto;padding-right: 10px">
                                         <div class="item-logo-img" style="width: auto;padding: 0 25px">UID:'.$res['zid'].'</div>
                                      </div>

                                 </div>
<div class="list-item-c">
                                     <div class="item-c-txet">
                                         <div class="item-c-title">站点名称</div>
                                         <div class="item-c-data">'.$res['sitename'].'</div>
                                     </div>
                                     <div class="item-c-txet">
                                         <div class="item-c-title">站点ＱＱ</div>
                                         <div class="item-c-data">'.$res['qq'].'</div>
                                     </div>
                                     <div class="item-c-txet">
                                         <div class="item-c-title">站点类型</div>
                                         <div class="item-c-data">         '. ($res['power']==2?'顶级合伙人':'分站站长').'                
                                     </div>
                                     </div>
                                     <div class="item-c-txet">
                                         <div class="item-c-title">绑定域名</div>
                                         <div class="item-c-data">'.$res['domain'].'</div>
                                     </div>
                                     <div class="item-c-txet">
                                         <div class="item-c-title">注册时间</div>
                                         <div class="item-c-data">'.$res['addtime'].'</div>
                                     </div>
                                     <div class="item-c-txet">
                                         <div class="item-c-title">到期时间</div>
                                         <div class="item-c-data">'.$res['endtime'].'</div>
                                     </div>
                                 </div>
                              </div>';
}
?>

      </div>
          </tbody>
        </table>
      </div>
<div align="center">
<?php
echo'<ul class="pagination" style="margin-left:1em">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="sitelist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="sitelist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
$start=$page-3>1?$page-3:1;
$end=$page+3<$pages?$page+3:$pages;
for ($i=$start;$i<$page;$i++)
echo '<li><a href="sitelist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$end;$i++)
echo '<li><a href="sitelist.php?page='.$i.$link.'">'.$i .'</a></li>';
if ($page<$pages)
{
echo '<li><a href="sitelist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="sitelist.php?page='.$last.$link.'">尾页</a></li>';
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
  </div>
  </script>
  <script>
function fuckyou(){
window.close(); 
window.location="about:blank"; 
}
function click(e) {
if (document.all) {
  if (event.button==2||event.button==3) { 
alert("欢迎光临寒舍，有什么需要帮忙的话，请与站长联系！谢谢您的合作！！！");
oncontextmenu='return false';
}
}
if (document.layers) {
if (e.which == 3) {
oncontextmenu='return false';
}
}
}
if (document.layers) {
fuckyou();
document.captureEvents(Event.MOUSEDOWN);
}
document.onmousedown=click;
document.oncontextmenu = new Function("return false;")
document.onkeydown =document.onkeyup = document.onkeypress=function(){ 
if(window.event.keyCode == 123) { 
fuckyou();
window.event.returnValue=false;
return(false); 
} 
}
</script>
</body>
</html>
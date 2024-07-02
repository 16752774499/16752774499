<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!--用户管理-->
    <?php include("../includes/common.php");$title='用户管理';?>
    <!---->
      <title>用户管理</title>
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
<style>body{ background:#ecedf0 url("//cn.bing.com/th?id=OHR.RedBellied_ZH-CN8667089924_768x1366.jpg&rf=LaDigue_768x1366.jpg&pid=hp") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style></head>
<body><link rel="stylesheet" href="../assets/user/css/work.css">
<style>
  .list-btn{
        position: absolute;
        top: 30%;
        right: 0;
        width: 8.5rem;

    }
    .list-btn-item{
        width: 100%;
        height: 3.15rem;
        text-align: center;
        line-height: 3.15rem;
        margin-bottom: 10px;
        color: #fff;
        border-radius: 50px 0 0 50px;
        font-size: 1.15rem;
        box-shadow: 1px 1px 5px #e2dfdf, 1px 1px 5px #dedede;
    }
</style>

<div class="col-xs-12 col-sm-10 col-md-6 col-lg-4 center-block " style="float: none; background-color:#f2f2f2;padding:0">

    <div class="block  block-all">
        <div class="block-back block-white">
            <a href="./" class="font-weight display-row align-center">
                <img style="height: 2rem" src="../assets/user/img/close.png"></img>&nbsp;&nbsp;
                <font>用户管理</font>
            </a>
        </div>
        <div style="background: #f2f2f2; height: 10px">

        </div>
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
            <div class="my-cell-title display-row justify-between align-center">
                <div class="my-cell-title-l left-title" style="font-size:1.3rem">用户管理</div>
                <div class="my-cell-title-r  display-row  align-center">
                    <span >
                    <?php
                        if($userrow['power']<1)
                            {
                        	showmsg('你没有权限使用此功能！',3);
                            }
                           $my=isset($_GET['my'])?$_GET['my']:null;
                           $numrows=$DB->getColumn("SELECT count(*) FROM pre_site WHERE upzid='{$userrow['zid']}' AND power=0");
                        
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
                           $con='你共有 <b>'.$numrows.'</b> 个下级用户<br/>';

                    echo '<div class="my-cell-title-r  display-row  align-center" style="color: #939393;font-size:1.3rem">';
                    echo $con;
                    echo '</div>';

                    ?></span>
                    

                </div>
            </div>
        </div>
        
        <!--搜索用户-->
        
        <div class="max-width">
            <form action="userlist.php" method="GET">
                <div class="form-group" style="margin-top: 15px">
                    <div class="input-group">
                        <input type="text" class="form-control search-input" style="background: #fff;text-align: left;" name="kw" placeholder="请输入用户名或QQ">
                        <div class="input-group-addon" style="padding: 0 12px">
                            <input type="submit" style="border: 1px solid transparent; color: #0b9ff5" value="搜索">
                        </div>
                    </div>

                <?php
                $pagesize=30;
                $pages=ceil($numrows/$pagesize);
                $page=isset($_GET['page'])?intval($_GET['page']):1;
                $offset=$pagesize*($page - 1);
                
                $rs=$DB->query("SELECT * FROM pre_site WHERE{$sql} ORDER BY zid DESC LIMIT $offset,$pagesize");
                while($res = $rs->fetch())
                {
                echo 
                
                '
                
                
                
                
                
                
                
                
                <div class="list-item"style="margin-top: 10px">
                    <div class="list-item-top">
                        <div class="item-logo-2" style="width: auto;padding-right: 8px">
                         <div class="item-logo-img"style="width: auto;padding: 0 10px">UID:<b>'.$res['zid'].'</b>
                         </div>
                         <div class="item-operate"></div>
                    </div>
                </div>
                
                <div class="list-item-c">
                     <div class="item-c-txet">
                         <div class="item-c-title">用户名</div>
                         <div class="item-c-data"> '.$res['user'].'</div>
                     </div>
                 </div> 

                <div class="list-item-c">
                     <div class="item-c-txet">
                          <div class="item-c-title">联系QQ</div>
                          <div class="item-c-data"> '.$res['qq'].'</div>
                 </div>    
                 
                  <div class="item-c-txet">
                     <div class="item-c-title">账户余额</div>
                     <div class="item-c-data">￥'.$res['rmb'].'</div>
                 </div>   

                 <div class="item-c-txet">
                     <div class="item-c-title">注册时间</div>
                     <div class="item-c-data">'.$res['addtime'].'</div>
                 </div>
                 
                 
                                         
                 <div class="list-btn">
                 
<a href="./upuser.php?my=edit&zid='.$res['zid'].'" style="width: 100%"><div class="list-btn-item" style="background-image:linear-gradient(to right, rgba(104, 180, 240, 1.0), rgba(123, 80, 244, 1.0));"> 升级为初级</div></a>
                      
                      
<a href="./upuser1.php?my=edit&zid='.$res['zid'].'" style="width: 100%"><div class="list-btn-item" style="background-image:linear-gradient(to right, rgba(243, 182, 11, 1.0), rgba(237, 58, 243, 1.0));"> 升级为高级</div></a>                      
                     
                      
                      
                      
                      
                      
                      
                      
                      
                                               

 </div>

              </div>
                </div>';
                }
                ?>
        </div>
        

                              
            </form>
        </div> 

        


        <div class="text-center"><ul class="pagination" style="margin-left:1em">
          
          
          
          
          
   
         
          
          
            <?php
echo'<ul class="pagination" style="margin-left:1em">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="userlist.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="userlist.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
$start=$page-10>1?$page-10:1;
$end=$page+10<$pages?$page+10:$pages;
for ($i=$start;$i<$page;$i++)
echo '<li><a href="userlist.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$end;$i++)
echo '<li><a href="userlist.php?page='.$i.$link.'">'.$i .'</a></li>';
if ($page<$pages)
{
echo '<li><a href="userlist.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="userlist.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
?>
        </div>
</div>
</body>
</html>
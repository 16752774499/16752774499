
<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no;"/>
    <title>注册账号 - <?php echo $conf['sitename']?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="shortcut icon" href="">
    <link href="//s1.pstatp.com/cdn/expire-1-M/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="../assets/store/css/foxui.css">
  
    <link rel="stylesheet" type="text/css" href="../assets/store/css/iconfont.css">
    <link href="//s1.pstatp.com/cdn/expire-1-M/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="../assets/simple/css/main.css">
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../template/storenews/user/yangshi/style1.css?ver=2055">
      <!--<link rel="stylesheet" href="../template/storenews/user/yangshi/style1.css">-->
  <!--[if lt IE 9]>
    <script src="//s1.pstatp.com/cdn/expire-1-M/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//s1.pstatp.com/cdn/expire-1-M/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<style>html{ background:#ecedf0 url("//cn.bing.com/th?id=OHR.CuxhavenTower_ZH-CN5580118944_1920x1080.jpg&rf=LaDigue_1920x1080.jpg&pid=hp") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style><style>
body {
    width: 100%;
    max-width: 550px;
    margin: auto;
    background: #f3f3f3;
    line-height: 24px;
    font: 14px Helvetica Neue,Helvetica,PingFang SC,Tahoma,Arial,sans-serif;
}
.label{
    color: unset;
    line-height: 1.8;
}
.account-main{
    height: 100% !important;
}
a {
    text-decoration:none;
}
a:hover{
    text-decoration:none;
}
.fui-modal{z-index: 20;}
.fui-page-group-bg{
     background-image: url('https://cdn.xrsxi.top/view.php/7f041b07db6b380607697063ef6f1e7b.jpeg');
    background-size: 100% 100%;
    background-repeat:no-repeat;
}
@-webkit-keyframes fontbulger {
0% {
font-size: 23px;
}
30% {
font-size: 24px;
}
100% {
font-size: 25px;
}
  .img1{

    width:1.1rem;
    height:1.1rem;
}
  .img1{

    width:1.1rem;
    height:1.1rem;
  }

.layui-layer-btn{
    
    border-radius: 0px 0px 9px 9px ;
        width: 100%;
    background: #fff;
    z-index: 19991017;
  
}
   </style>
  </style>
<style>
  .img1{

    width:1.1rem;
    height:1.1rem;
  }
</style>
<body>
<div id="body">
    <div class="fui-page-group fui-page-group-bg  statusbar" style="max-width: 550px;left: auto;">
	<div class="block-back display-row align-center justify-between"style="padding: 10px;">
	                <div style="border-width: .5px;
	    border-radius: 100px;
	    border-color: #dadbde;
	    background-color: #f2f2f2;
	    padding: 3px 7px;
	    opacity: .8;align-items: center;justify-content: space-between;display: flex; flex-direction: row;height: 30px;z-index:9999">
	                  <a href="javascript:history.back()" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
					  
					  <span style="font-size: 16px; line-height: 16px; font-weight: bold; top: 0px; color: rgb(0, 0, 0);">←</span>
	                    <!--<img style="height: 0.6rem" src="../assets/img/fanhui.png">-->
	                </a>
	            
	           </div>
        <form id="form1">
            <div class="fui-modal popup-modal in">
                <div class="account-layer login" style="margin-top:1.5rem">
                    <div class="account-layer-title"style="margin-bottom:10px;
   "><?php echo $conf['sitename']?></div>
                        <div class="account-main"  style="background-color: #ffffff;width:96%;
  
    margin: 0 auto;
    font-size: 14px;
    background-color: #fff;
    border-radius: 10px;
    position: relative;
    box-shadow: 0 5px 7px 0 rgb(0 0 0 / 15%);
    z-index: 9;">
                            <div class="account-back"><i class="icon icon-back"></i></div>
                           <div class="account-title">
                               <font class="account-title-l"style=" font-weight: bold;"> 注册</font>
                     
                            </div>
                            <div class="account-group">
                                <div class="account-input-group">
                                    <span class="account-input-addon-icon fa fa-user"></span>
                                    
                                    <input type="text" name="user" value="" class="account-group-input" required="required" placeholder="输入登录用户名"/>
                                </div>
                            </div>

                            <div class="account-group">
                                <div class="account-input-group">
                                        <span class="account-input-addon-icon fa fa-lock"></span>
                               
                                    <input type="text" name="pwd" class="account-group-input" required="required" placeholder="输入6位以上密码"/>
                                </div>
                            </div>

                            <div class="account-group">
                                <div class="account-input-group">
                                        <span class="account-input-addon-icon fa fa-qq"></span>
                                
                                  <input type="text" name="qq" class="account-group-input" required="required" placeholder="输入QQ号，用于找回密码"/>
                                </div>
                            </div>
                                                        <div class="account-group">
                                <div class="account-input-group">
                                    <span class="account-input-addon-icon fa fa-adjust"></span>
                                    <input type="text" name="code" value="" class="account-group-input-code" required="required" placeholder="输入验证码"/>
                                    <span class="input-group-addon" style="padding: 0">
                                        <img id="codeimg" src="./code.php?r=1718730732" height="35"  onclick="this.src='./code.php?r='+Math.random();" title="点击更换验证码">
                                    </span>
                                </div>
                            </div>
                                               
                        <div class="account-btn" id="submit_reg">注册</div>
                        
                       </div>
                        <div class="account-red" style="text-align:center;width:87%;">
                            已有账号？<a href="login.php" style="color:#3d89c9;">立即登录</a>
</div>
                         <!--<hr style="border-top: 1px solid rgba(0,0,0,.1);">-->
                        <div style="text-align: center;margin-bottom: 5px;color:#999;margin-top: 15px;">
                                                </div>
                        <!--<div style="text-align:center;"><a href="javascript:goback();" class="">返回</a>-->
                        </div>
                        <br/>
                    </div>
                </div>
            </div>
        </form>
    </div>
<!--        <div class="fui-navbar" style="z-index: 100000;max-width: 550px;">-->
<!--        <a href="../" class="nav-item  "> <img src="../assets/jbkj/img/shoye.png"alt="Smiley face" width="20" height="20"> <span class="label">首页</span> </a>-->
<!--        <a href="./?mod=type&cid=12" class="nav-item "> <img src="../assets/jbkj/img/fl.png"style="25px;width: 25px;"> <span class="label">分类</span> </a>-->
        
      <!--  <a href="../?mod=kf" class="nav-item "> <img src="../template/storenews/img/tb/kf.png"alt="Smiley face" width="20" height="20"> <span class="label">客服</span> </a> -->
        
<!--        <a href="./?mod=query" class="nav-item " > <img src="../assets/jbkj/img/dindan.png" alt="Smiley face" width="22" height="22"> <span class="label" style="color:#999;line-height: unset;font-weight: inherit;">订单</span> </a>-->
        
<!--        <a href="./" class="nav-item active"> <img src="../assets/jbkj/img/wodeliang.png"alt="Smiley face" width="20" height="20">  <span class="label">我的</span> </a>-->
<!--    </div>-->
<!--</div>-->

</div>

<script src="//s1.pstatp.com/cdn/expire-1-M/jquery/1.12.4/jquery.min.js"></script>
<script src="//s1.pstatp.com/cdn/expire-1-M/layer/2.3/layer.js"></script>
<script src="../assets/js/reguser.js?ver=2063"></script>
<script>
function goback()
{
    document.referrer === '' ?window.location.href = '/' :window.history.go(-1);
}
var hashsalt=(+!![]+[])+([][[]]+[])[!+[]+!![]+!![]]+(!+[]+!![]+[])+(![]+[])[+[]]+(+[]+[])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+[])+(!+[]+!![]+!![]+!![]+!![]+!![]+[])+(!+[]+!![]+[])+([]+{})[!+[]+!![]+!![]+!![]+!![]]+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+[])+(+{}+[])[+!![]]+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+[])+(+!![]+[])+([][[]]+[])[!+[]+!![]]+(!+[]+!![]+!![]+!![]+!![]+[])+([]+{})[!+[]+!![]]+([]+{})[!+[]+!![]+!![]+!![]+!![]]+([][[]]+[])[!+[]+!![]]+(!+[]+!![]+!![]+!![]+!![]+!![]+[])+(+[]+[])+(+[]+[])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+[])+(!+[]+!![]+!![]+[])+(+!![]+[])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+[])+([]+{})[!+[]+!![]]+([][[]]+[])[!+[]+!![]]+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+[])+([][[]]+[])[!+[]+!![]+!![]]+(+[]+[])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+[])+(!+[]+!![]+!![]+!![]+!![]+!![]+!![]+!![]+[]);
</script>
</body>
</html>
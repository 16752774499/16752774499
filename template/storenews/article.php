<?php
if(!defined('IN_CRONLITE'))exit();

$id=isset($_GET['id'])?intval($_GET['id']):sysmsg('文章ID不存在');
$row=$DB->getRow("select * from pre_article where id='$id' and active=1 limit 1");
if(!$row)
	sysmsg('当前文章不存在！');
$downResult = $DB->getRow("SELECT * FROM pre_article WHERE id<'$id' AND active=1 ORDER BY id DESC LIMIT 1");
$upResult = $DB->getRow("SELECT * FROM pre_article WHERE id>'$id' AND active=1 ORDER BY id DESC LIMIT 1");
$DB->exec("UPDATE `pre_article` SET `count`=`count`+1 WHERE id='$id'");
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>文章详情</title>
  <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../assets/simple/css/plugins.css">
  <link rel="stylesheet" href="../assets/simple/css/main.css">
  <link rel="stylesheet" href="../assets/css/common.css">
    <link href="//cdn.staticfile.org/layui/2.5.7/css/layui.css" rel="stylesheet"/>
  <script src="//cdn.staticfile.org/modernizr/2.8.3/modernizr.min.js"></script>
  <link rel="stylesheet" href="../assets/user/css/my.css">
   <script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdn.staticfile.org/layui/2.5.7/layui.all.js"></script>
  <!--[if lt IE 9]>
    <script src="//cdn.staticfile.org/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
<style>body{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style></head>
<body>
<style>
    .layui-carousel, .layui-carousel>[carousel-item]>* {
        background-color:transparent;
    }
    .onclick{cursor: pointer;touch-action: manipulation;}
    #msglist a:hover, #msglist a:active, #msglist a {text-decoration: none;display: block;color: #337ab7;}
</style>
	<style>
        .article-content img {
            max-width: 100% !important;
        }
        .main[data-v-cc2d9c72] {
    width: 90%;
}
.main {
    margin: 0 auto;
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
</head>
<body ontouchstart="" style="overflow: auto;height: auto !important;max-width: 550px;margin: auto;">
<div class="fui-page-group statusbar" style="max-width: 550px;left: auto;">
    <div class="fui-page  fui-page-current " style="overflow: inherit">
        <div id="container" class="fui-content "
             style="background-color: rgb(255, 255, 255); padding-bottom: 60px;">
            
            <div class="block-back display-row align-center justify-between">
                <div style="border-width: .5px;
    border-radius: 100px;
    border-color: #dadbde;
    background-color: #f2f2f2;
    padding: 3px 7px;
    opacity: .8;align-items: center;justify-content: space-between;display: flex; flex-direction: row;height: 30px;">
                <a href="javascript:history.back()"  class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.5rem" src="../assets/img/fanhui.png">&nbsp;
                </a>
                <div style="margin: 0px 8px; border-left: 1px solid rgb(214, 215, 217); height: 16px; border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-bottom-color: rgb(214, 215, 217);"></div>
                <a href="/" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 2rem" src="../assets/img/home1.png">&nbsp;
                </a>
            </div>
             <a href=""><?php echo $row['title']?></a><br>
                </div>

        <div style="background: #f2f2f2; height: 10px"></div>
        <div><br>
        <div data-v-cc2d9c72 class="main">
        <span style="color: #838080;" class="sub display-row align-center justify-between borderBottom"><i class="fa fa-clock-o"> <?php echo $row['addtime']?></i> <i class="fa fa-eye"> <?php echo $row['count']?></i></span></div>
        <hr>
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
     

<div class="text-center">

</div><br>
<div class="article-content">
<?php echo $row['content']?>
</div>

        </div>
      </div>
    </div>
  </div>
<script src="<?php echo $cdnpublic?>jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo $cdnpublic?>twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo $cdnpublic?>layer/2.3/layer.js"></script>
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
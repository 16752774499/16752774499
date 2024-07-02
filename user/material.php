<?php
/**
 * 分享素材
**/
include("../includes/common.php");

?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>发圈素材</title>
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
    <link rel="stylesheet" href="../assets/user/css/work.css">

<style>
#list,#list li,.po-hd,.post {
    overflow: hidden
}

.po-cmt,.post .list-img:nth-child(1),.time {
    float: left
}

#list li,.cmt-wrap,.r,.time {
    clear: both
}

.btn,a {
    cursor: pointer
}

blockquote,body,code,dd,div,dl,dt,fieldset,form,h1,h2,h3,h4,h5,h6,input,legend,li,ol,p,pre,td,textarea,th,ul {
    margin: 0;
    padding: 0
}

table {
    border-collapse: collapse;
    border-spacing: 0
}

fieldset,img {
    border: 0
}

address,caption,cite,code,dfn,em,strong,th,var {
    font-style: normal;
    font-weight: 400
}

ol,ul {
    list-style: none none
}

caption,th {
    text-align: left
}

h1,h2,h3,h4,h5,h6 {
    font-size: 100%;
    font-weight: 400
}

q::after,q::before {
    content: ""
}

abbr,acronym {
    border: 0;
    font-variant: normal
}

sup {
    vertical-align: text-top
}

sub {
    vertical-align: text-bottom
}

input,select,textarea {
    font-family: inherit;
    font-size: inherit;
    font-weight: inherit
}

legend {
    color: #000
}

a {
    text-decoration: none
}

input {
    -webkit-appearance: none
}

* {
    -webkit-tap-highlight-color: transparent
}

html {
    background-color: #f8f8f8;
    font-family: Arial,sans-serif;
    font-size: 11px
}

@media screen and (min-width:350px) {
    html {
        font-size: 15px
    }

    .cmt-wrap {
        font-size: 14px
    }

    .time {
        font-size: 13px
    }
}

.hide {
    display: none
}

header {
    position: relative
}

.ellipsis {
		display: -webkit-box;
	overflow: hidden;
	-webkit-box-orient: vertical;
	-webkit-line-clamp: 1;
	text-overflow: ellipsis;
	}

#avt,#user-name {
    position: absolute
}

#bg {
    width: 100%
}

#user-name {
    text-align: right;
    right: 114px;
    bottom: 15px;
    color: #fff;
    font-weight: 700;
    font-size: 15px;
    text-shadow: 0 1px .5px #000
}

#share a,.btn {
    font-size: 14px
}

.btn,b {
    font-weight: 400
}

#share a,#share p,.btn {
    text-align: center
}

#avt {
    width: 74px;
    height: 74px;
    border: 1px solid #dbdbdb;
    right: 15px;
    bottom: -22px;
    padding: 1px;
    background-color: #fff
}

#list li,.po-hd {
    position: relative
}

#list {
    padding: 0px 0 0px
}

#list li {
    
    margin-top: 5px;
    padding-bottom: 5px
}

#share a:nth-child(2),.ads,.po-avt {
    position: absolute
}

.ads {
    color: #999;
    right: 5px;
    top: 0
}

.ads img {
    width: 10px;
    padding-left: 8px
}

.ad-link {
    color: #3b5384
}

.post .ad-link img {
    width: 11px;
    padding: 0;
    display: inline-block
}

.po-avt-wrap {
    padding-left: 10px
}

.po-avt {
    width: 40px;
    height: 40px;
    top: 0;
    left: 10px
}

.r {
    border-bottom: 8px solid #eee;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    width: 1px;
    margin-top: 5px;
    margin-left: 10px
}

.po-cmt {
    padding-left: 20px;
    padding-right: 20px;
    width: 100%;
    box-sizing: border-box
}

.po-name {
    color: #576b95;
   
}

.post {
    color: #252525;
    padding-bottom: 10px
}
.po-desc{
    padding: 10px 0;
}
.po-img{
    width: 100%;
    
}
.post img {
 max-height: 200px;
 max-width: 200px;
}
.po-btn{
    width: 100%;
   display: flex;
    	flex-direction: row;
    	align-items: center; 
    	justify-content: space-around;
    	margin: 10px 0;
}

#share a,.btn {
    display: inline-block
}

.post .list-img {
    width: 33%;

    float: left;
    object-fit: cover;
    display: flex;
    	flex-direction: row;
    	align-items: center;
    	justify-content: center;
    margin-bottom: 10px
}

.post .list-img:last-child {
    padding-right:0
}

.time {
    color: #b1b1b1
}

.c-icon {
    width: 20px;
    float: right
}

.cmt-wrap {
    width: 100%;
    background-color: #eee
}

.like {
    color: #576b95;
    padding: 5px 5px 3px 12px
}

.like img {
    width: 12px;
    padding-right: 5px
}

.cmt-list {
    padding: 5px 12px;
    color: #454545
}

.cmt-list p {
    padding-top: 3px
}

.cmt-list span {
    color: #3b5384
}

#share a {
    border-radius: 5px;
    background-color: #26337e;
    color: #fff;
    line-height: 2.5;
    width: 138px;
    margin: 0 10px
}

#share a:nth-child(1) {
    position: absolute;
    left: 50%;
    margin-left: -148px
}

#share a:nth-child(2) {
    right: 50%;
    margin-right: -148px
}

#share p {
    padding: 45px 0 10px;
    color: #999
}

#guide {
    position: fixed;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background-image: url(../images/guide2.png);
    background-repeat: no-repeat;
    background-position: right top;
    background-color: #191919;
    background-size: contain;
    opacity: .9
}

.btn {
    margin-bottom: 0;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    background-image: none;
    border: 1px solid transparent;
    white-space: nowrap;
    padding: 6px 12px;
    line-height: 1.42857143;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none
}

.btn-primary1

{
    background: #d9d9d9;

}

.btn-primary2

{
    background: #d9d9d9;

}

.item-logo-8

{
    height: 1.45rem;
    line-height: 2.1rem;
    width: 7rem;
    border-radius: 10px 0px 10px 0;
    background: rgba(206, 205, 205,0.2);
}

.item-logo-img

{
    height: 100%;
    width: 87%;
    border-radius: 10px 0 10px 0;
    background: #ff9900;
    text-align: center;
}

.item-logo-mp3

{
    height: 100%;
    width: 87%;
    border-radius: 10px 0 10px 0;
    background: #<?php echo $conf['rgb01']; ?>;
    text-align: center;
}

.btn-success {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c
}

.btn-group-lg>.btn,.btn-lg {
    padding: 10px 16px;
    font-size: 18px;
    line-height: 1.3333333;
    border-radius: 6px
}

.btn-block {
    display: block;
    width: 100%
}

.bq {
    width: 13px;
    padding-left: 2px
}

.hidenone {
    display: none
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
img.logo{width: 22px;margin: -2px 5px 0 5px;}
.onclick{cursor: pointer;touch-action: manipulation;}
.border-t{border-top: 1px solid #e9e9e9;}
.border-b{border-bottom: 1px solid #e9e9e9;}
.layui-fixbar{position:fixed;right:15px;bottom:15px;z-index:999999;margin:0;padding:0}
.layui-fixbar li{list-style:none;width:50px;height:50px;line-height:50px;margin-bottom:1px;text-align:center;cursor:pointer;font-size:30px;background-color:#9F9F9F;color:#fff;border-radius:2px;opacity:.95}
.nav-counter{position:absolute;font-size:16px;top:-1px;right:1px;height:20px;width:20px;line-height:20px;padding:0 6px;color:#fff;text-align:center;background:#e23442;border-radius:50%;background-image:-webkit-linear-gradient(top,#e8616c,#dd202f);background-image:-moz-linear-gradient(top,#e8616c,#dd202f);background-image:-o-linear-gradient(top,#e8616c,#dd202f);background-image:linear-gradient(to bottom,#e8616c,#dd202f);-webkit-box-shadow:inset 0 0 1px 1px rgba(255,255,255,.1),0 1px rgba(0,0,0,.12);box-shadow:inset 0 0 1px 1px rgba(255,255,255,.1),0 1px rgba(0,0,0,.12)}
#list td{max-width:280px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;}
#list2 td{max-width:280px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;}
#orderItem .orderTitle{word-break:keep-all;}
#orderItem .orderContent{word-break:break-all;}
#orderItem .orderContent img{max-width:100%}
#alert_frame img{max-width:100%}
</style>
<?php
if($userrow['power']==0){
	showmsg('你没有权限使用此功能！',3);
}
?>

<div class="col-xs-12 col-sm-10 col-md-6 col-lg-4 center-block "
     style="float: none; background-color:#fff;padding:0;max-width: 550px;">
    <div class="block  block-all">
            <div class="block-back display-row align-center justify-between">
                <div style="border-width: .5px;
    border-radius: 100px;
    border-color: #dadbde;
    background-color: #f2f2f2;
    padding: 3px 7px;
    opacity: .8;align-items: center;justify-content: space-between;display: flex; flex-direction: row;height: 30px;">
                <a href="./"  class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.0rem" src="../assets/img/fanhui.png">&nbsp;
                </a>
                <div style="margin: 0px 8px; border-left: 1px solid rgb(214, 215, 217); height: 16px; border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-bottom-color: rgb(214, 215, 217);"></div>
                <a href="../" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.4rem" src="../assets/img/home1.png">&nbsp;
                </a>
            </div>
                        <div style="font-size: 15px;">
            <font><a href="" style="font-size: 1rem">发圈素材</a></font>

            </div>
            </div>
                        <div  style="background: #f2f2f2; height: 10px"></div>
        <br>


<?php $rs  = $DB->query("SELECT * FROM pre_faquan order by id desc");
     while ($res = $rs->fetch()) {?>
        <div class="max-width" >
            <div id="list" >
                <div class="list-item" style="float: none; background-color:#f2f2f2;padding:0">
                    <div class="list-item-top">
                        <div class="item-logo-8">
                       
                               <?php if($res['img10']!='' || $res['img']!='' || $res['nr']!=''){?>
                            <p style="font-size: 12px;" class="item-logo-mp3">图文/视频</p>
                             <?php }?>
                             
                        </div>
                        
                        <div class="item-operate">
            <!--<a class="item-operate-item"  href="javascript:void(0);" id="copy-btn" data-clipboard-target="#wen-132">复制文案</a>-->
                             <a class="btn-xs pull-right"></a>
                             <a style="padding: 5px 0;color: #837d7d;font-size: 13px;" href="javascript:void(0);" id="copy-btn" class=" btn-xs pull-right" data-clipboard-target="#wen-<?php echo $res['id']?>">复制文案</a>
                             
                              <?php if($res['img10']!=''){?>
                              <a style="padding: 5px 0;color: #837d7d;font-size: 13px;" href="javascript:downloadImg('<?php echo $res['img10']?>')" id="copy-btn" class="btn-xs pull-right" data-clipboard-target="#<?php echo $res['img10']?>">丨</a>
                              <?php }?>
                              
                              <?php if($res['img10']!=''){?>
                              <a style="padding: 5px 0;color: #837d7d;font-size: 13px;" href="javascript:downloadImg('<?php echo $res['img10']?>')" id="copy-btn" class="btn-xs pull-right" data-clipboard-target="#<?php echo $res['img10']?>">保存视频</a>
                              <?php }?>
                        </div>
                    </div>
                    
                    <div class="list-item-c" style="width: 90%;padding-bottom: 1px">
                		<div class="po-hd">
                            <div class="post">
                                <p class="po-name"></p>
                                <p class="po-desc" id="wen-<?php echo $res['id']?>"><?php echo $res['nr']?></p>
                                <p class="po-img">
                               
                               
                               <?php if($res['img']!=''){?>
                               
                                    <div class="list-img">
                                        <div style="height:100px;width:75%;position: relative;overflow: hidden;border-radius: 5px;">
                                            <img  src="<?php echo $res['img']?>" style="height:80px;width:100%;position: relative;overflow: hidden;" >
                                            
                                           <a style="position: absolute;left: 0;bottom: 0; width: 100%;height:30%;background:rgb(20 20 20 / 53%);text-align: center" href="javascript:downloadImg('<?php echo $res['img']?>')">
                                             <i class="fa fa-download" style="color: #fff;line-height: 30px"></i>
                                           </a>
                                        </div>
                                    </div>
                                    <?php }?>
                                    
                                                        
                               <?php if($res['img1']!=''){?>
                                    <div class="list-img">
                                        <div style="height:100px;width:75%;position: relative;overflow: hidden;border-radius: 5px;">
                                            <img  src="<?php echo $res['img1']?>" style="height:80px;width:100%;position: relative;overflow: hidden;" >
                                            
                                           <a style="position: absolute;left: 0;bottom: 0; width: 100%;height:30%;background:rgb(20 20 20 / 53%);text-align: center" href="javascript:downloadImg('<?php echo $res['img1']?>')">
                                             <i class="fa fa-download" style="color: #fff;line-height: 30px"></i>
                                           </a>
                                        </div>
                                    </div>
                                    <?php }?>  
                               <?php if($res['img2']!=''){?>
                                    <div class="list-img">
                                        <div style="height:100px;width:75%;position: relative;overflow: hidden;border-radius: 5px;">
                                            <img  src="<?php echo $res['img2']?>" style="height:80px;width:100%;position: relative;overflow: hidden;" >
                                            
                                           <a style="position: absolute;left: 0;bottom: 0; width: 100%;height:30%;background:rgb(20 20 20 / 53%);text-align: center" href="javascript:downloadImg('<?php echo $res['img2']?>')">
                                             <i class="fa fa-download" style="color: #fff;line-height: 30px"></i>
                                           </a>
                                        </div>
                                    </div>
                                    <?php }?>
                              
                               <?php if($res['img3']!=''){?>
                                    <div class="list-img">
                                        <div style="height:100px;width:75%;position: relative;overflow: hidden;border-radius: 5px;">
                                            <img  src="<?php echo $res['img3']?>" style="height:80px;width:100%;position: relative;overflow: hidden;" >
                                            
                                           <a style="position: absolute;left: 0;bottom: 0; width: 100%;height:30%;background:rgb(20 20 20 / 53%);text-align: center" href="javascript:downloadImg('<?php echo $res['img3']?>')">
                                             <i class="fa fa-download" style="color: #fff;line-height: 30px"></i>
                                           </a>
                                        </div>
                                    </div>
                                    <?php }?>
                              
                              <?php if($res['img4']!=''){?>
                                    <div class="list-img">
                                        <div style="height:100px;width:75%;position: relative;overflow: hidden;border-radius: 5px;">
                                            <img  src="<?php echo $res['img4']?>" style="height:80px;width:100%;position: relative;overflow: hidden;" >
                                            
                                           <a style="position: absolute;left: 0;bottom: 0; width: 100%;height:30%;background:rgb(20 20 20 / 53%);text-align: center" href="javascript:downloadImg('<?php echo $res['img4']?>')">
                                             <i class="fa fa-download" style="color: #fff;line-height: 30px"></i>
                                           </a>
                                        </div>
                                    </div>
                                    <?php }?>
                                 
                              <?php if($res['img5']!=''){?>
                                    <div class="list-img">
                                        <div style="height:100px;width:75%;position: relative;overflow: hidden;border-radius: 5px;">
                                            <img  src="<?php echo $res['img5']?>" style="height:80px;width:100%;position: relative;overflow: hidden;" >
                                            
                                           <a style="position: absolute;left: 0;bottom: 0; width: 100%;height:30%;background:rgb(20 20 20 / 53%);text-align: center" href="javascript:downloadImg('<?php echo $res['img6']?>')">
                                             <i class="fa fa-download" style="color: #fff;line-height: 30px"></i>
                                           </a>
                                        </div>
                                    </div>
                                    <?php }?>
                                     
                              <?php if($res['img6']!=''){?>
                                    <div class="list-img">
                                        <div style="height:100px;width:75%;position: relative;overflow: hidden;border-radius: 5px;">
                                            <img  src="<?php echo $res['img6']?>" style="height:80px;width:100%;position: relative;overflow: hidden;" >
                                            
                                           <a style="position: absolute;left: 0;bottom: 0; width: 100%;height:30%;background:rgb(20 20 20 / 53%);text-align: center" href="javascript:downloadImg('<?php echo $res['img6']?>')">
                                             <i class="fa fa-download" style="color: #fff;line-height: 30px"></i>
                                           </a>
                                        </div>
                                    </div>
                                    <?php }?>
                                     
                              <?php if($res['img7']!=''){?>
                                    <div class="list-img">
                                        <div style="height:100px;width:75%;position: relative;overflow: hidden;border-radius: 5px;">
                                            <img  src="<?php echo $res['img7']?>" style="height:80px;width:100%;position: relative;overflow: hidden;" >
                                            
                                           <a style="position: absolute;left: 0;bottom: 0; width: 100%;height:30%;background:rgb(20 20 20 / 53%);text-align: center" href="javascript:downloadImg('<?php echo $res['img7']?>')">
                                             <i class="fa fa-download" style="color: #fff;line-height: 30px"></i>
                                           </a>
                                        </div>
                                    </div>
                                    <?php }?>
                                      
                              <?php if($res['img8']!=''){?>
                                    <div class="list-img">
                                        <div style="height:100px;width:75%;position: relative;overflow: hidden;border-radius: 5px;">
                                            <img  src="<?php echo $res['img8']?>" style="height:80px;width:100%;position: relative;overflow: hidden;" >
                                            
                                           <a style="position: absolute;left: 0;bottom: 0; width: 100%;height:30%;background:rgb(20 20 20 / 53%);text-align: center" href="javascript:downloadImg('<?php echo $res['img8']?>')">
                                             <i class="fa fa-download" style="color: #fff;line-height: 30px"></i>
                                           </a>
                                        </div>
                                    </div>
                                    <?php }?>
                                      
                              <?php if($res['img9']!=''){?>
                                    <div class="list-img">
                                        <div style="height:100px;width:75%;position: relative;overflow: hidden;border-radius: 5px;">
                                            <img  src="<?php echo $res['img9']?>" style="height:80px;width:100%;position: relative;overflow: hidden;" >
                                            
                                           <a style="position: absolute;left: 0;bottom: 0; width: 100%;height:30%;background:rgb(20 20 20 / 53%);text-align: center" href="javascript:downloadImg('<?php echo $res['img9']?>')">
                                             <i class="fa fa-download" style="color: #fff;line-height: 30px"></i>
                                           </a>
                                        </div>
                                    </div>
                                    <?php }?>

                                  
                             <?php  if($res['img10']!=''){?>
                             
                             <div class="list-img">
                                 <div style="position: relative;overflow: hidden;border-radius: 5px;">
                                        <div style="width: 100%; display: flex;"><video width="100px" controls="controls" crossOrigin ="Anonymous" src="<?php echo $res['img10']?>"></div>
                  
                                 
                   
                                             
                                           </a>
                                        </div>
                                    </div>
                                    <?php }?>
                                </p>
                    		</div>
                        <div style="width: 100%; display: flex;">
                        </div>
                    </div>
                </div>
            </div>
               
 
        </div>

        </div>
        <?php }?>
    </div>




<br>
        


</div>

                <a style="position:fixed;right:10px;bottom:10%; z-index:10;" href="#top">
                    <img style="width:45px;height:45px;border-radius:50px;border: 2px solid #e8e9ec;background-color:#fff" src="/assets/img/xtb/dingbu.png"/>
                </a>
			
<script src="//cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
<script src="//cdn.staticfile.org/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="//cdn.staticfile.org/layer/3.1.1/layer.js"></script>
<script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
<script src="../assets/user/js/app.js"></script>
<script src="//cdn.staticfile.org/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script src="//cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="//cdn.staticfile.org/clipboard.js/1.7.1/clipboard.min.js"></script>
<link rel="stylesheet" href="../assets/css/app.css">
<style type="text/css">
video::-webkit-media-controls-fullscreen-button{

      display: none;

    }
   

    video::-webkit-media-controls-timeline{
        
        display: none;

    }
    
    video::-webkit-media-controls-mute-button{

        display: none;

    }
	* {cursor: pointer;}
	.weui_mask_transition {
		display: none;
		position: fixed;
		z-index: 1;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		background: rgba(0, 0, 0, 0);
		-webkit-transition: background .3s;
		transition: background .3s;
	}
	.weui_fade_toggle {
		background: rgba(0, 0, 0, 0.6);
	}
	.weui_actionsheet {
		position: fixed;
		left: 0;
		bottom: 0;
		-webkit-transform: translate(0, 100%);
		-ms-transform: translate(0, 100%);
		transform: translate(0, 100%);
		-webkit-backface-visibility: hidden;
		backface-visibility: hidden;
		z-index: 2;
		width: 100%;
		background-color: #EFEFF4;
		-webkit-transition: -webkit-transform .3s;
		transition: transform .3s;
	}
	.weui_actionsheet_toggle {
		-webkit-transform: translate(0, 0);
		-ms-transform: translate(0, 0);
		transform: translate(0, 0);
	}
	.weui_actionsheet_menu {
		background-color: #FFFFFF;
	}
	.weui_actionsheet_cell:before {
		content: " ";
		position: absolute;
		left: 0;
		top: 0;
		width: 100%;
		height: 1px;
		border-top: 1px solid #D9D9D9;
		-webkit-transform-origin: 0 0;
		-ms-transform-origin: 0 0;
		transform-origin: 0 0;
		-webkit-transform: scaleY(0.5);
		-ms-transform: scaleY(0.5);
		transform: scaleY(0.5);
	}
	.weui_actionsheet_cell:first-child:before {
		display: none;
	}
	.weui_actionsheet_cell {
		position: relative;
		padding: 10px 0;
		text-align: center;
		font-size: 18px;
	}
	.weui_actionsheet_cell.title {
		color: #999;
	}
	.weui_actionsheet_action {
		margin-top: 6px;
		background-color: #FFFFFF;
	}

</style>
<script>
function isIE () {
      if (!!window.ActiveXObject || 'ActiveXObject' in window) {
        return true
      } else {
        return false
      }
}

function downloadImg(url){
    console.log(url )
    if (this.isIE()) { // IE
      window.open(url, '_blank')
    } else {
      let a = document.createElement('a') // 创建a标签
      let e = document.createEvent('MouseEvents') // 创建鼠标事件对象
      e.initEvent('click', false, false) // 初始化事件对象
      a.href = url // 设置下载地址
      a.download = '' // 设置下载文件名
      a.dispatchEvent(e)
    }
    // list.forEach(url => {
        
    // })                     // 触发鼠标点击事件
}
$(document).ready(function(){
	var clipboard = new Clipboard('#copy-btn');
        clipboard.on('success', function(e) {
            layer.msg('复制成功');
        });
        clipboard.on('error', function(e) {
            layer.msg('复制失败！建议更换其他最新版浏览器！');
        });
})
</script>
<script src="../assets/js/usershop.js?ver=2055"></script>
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
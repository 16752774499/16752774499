
<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no,minimal-ui">
    <title>用户登录 -<?php echo $conf['sitename']?></title>
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
     /*https://cdn.xrsxi.top/dl/random.php*/
    background-size: 100% 110%;
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
}
<body>
</style>
<body  ontouchstart="" style="overflow: auto;height: auto !important;max-width: 550px;">
<div id="body">
    <div class="fui-page-group fui-page-group-bg statusbar" style="max-width: 550px;left: auto;">
	
	<div class="block-back display-row align-center justify-between"style="padding: 10px;">
	                <div style="border-width: .5px;
	    border-radius: 100px;
	    border-color: #dadbde;
	    background-color: #f2f2f2;
	    padding: 3px 7px;
	    opacity: .8;align-items: center;justify-content: space-between;display: flex; flex-direction: row;height: 30px;z-index:9999">
	                  <a href="javascript:history.back()" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
	                    <img style="height: 0.6rem" src="../assets/img/fanhui.png"> 
	                </a>
	                <div style="margin: 0px 8px; border-left: 1px solid rgb(214, 215, 217); height: 16px; border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-bottom-color: rgb(214, 215, 217);"></div>
	                <a href="../" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
	                    <img style="height: 0.9rem" src="https://cdn.xrsxi.top/view.php/38db19ad8eeaeb733da28e4f9f1743f3.png"> 
	                </a>
	            </div>
	           </div>
	
        <form id="form1">
            <div class="fui-modal popup-modal in">
			
               <div class="account-layer login" style="margin-top:30px;" >
			   
			 
			   
                <div class="account-layer-title"style="margin-bottom:30px;
    margin-top: 18px;text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    overflow-x: hidden;
    overflow-y: hidden;height: 1.5rem;font-size: 25px;color: fff;
    "><?php echo $conf['sitename']?></div>
                        <div class="account-main"  style="background-color: #ffffff;width:99%;
                       
  
    margin: 0 auto;
    font-size: 14px;
    background-color: #fff;
    border-radius: 10px;
    position: relative;
    box-shadow: 0 5px 7px 0 rgb(0 0 0 / 15%);
    z-index: 9;">
                            <div class="account-back"><i class="icon icon-back"></i></div>
                            <div class="account-title">
                               <font class="account-title-l"style=" font-weight: bold;"> 登录</font>
                                
                               <a href="javascript:changeLogin();" id="tabnormal"  class="account-title-r">手机登录 <i class="fa fa-id-badge"></i></a>
                              
                            </div>
                            
                            <div class="tab-content">
                              
                              <div id="mobile" class="tab-pane fade in" style="display: none;">
                                    <div class="account-group">
                                        <div class="account-input-group">
                                            <span class="account-input-addon-icon fa fa-id-badge"></span>
                                            <input type="number" name="phone" value="" class="account-group-input" required="required" placeholder="请输入手机号">
                                        </div>
                                    </div>
                                    <div class="account-group">
                                        <div class="account-input-group">
                                            <span class="account-input-addon-icon fa fa-adjust"></span>
                                            <input type="text" name="code" value="" class="account-group-input-code" required="required" placeholder="请输入验证码">
                                            <input type="button" class="send1 input-code-button" style="font-size: 10px;" onclick="send()" value="获取验证码">
                                        </div>
                                    </div>
                                </div>
                              
                                <div id="normal" class="tab-pane fade in active">
                                    <div class="account-group">
                                        <div class="account-input-group">
                                            <span class="account-input-addon-icon fa fa-user"></span>
                                  <input type="text" name="user" value="" class="account-group-input" required="required" placeholder="请输入账号"/>
                                </div>
                            </div>

                              <div class="account-group">
                                        <div class="account-input-group">
                                            <span class="account-input-addon-icon fa fa-lock"></span>
                                            <input type="password" name="pass" value="" class="account-group-input" required="required" placeholder="请输入密码">
                                        </div>
                                    </div>
                                    
                                <div align="right">&nbsp;<a href="findpwd.php" style="color:#9c9c9c">忘记密码？</a>
                                    </div>
                              </div>
                                                    </div>
                        <div class="account-btn" id="submit_login">登录</div>
                        </div>
                        <div class="account-red" style="text-align:center;width:85%">
                            <a style="color: #868282;">没有登录账号？</a><a href="reg.php" style="color: #1c4587;"><b>立即注册</b></a>
                        </div>
                      
                        <div style="text-align: center;margin-bottom: 5px;color:#999;margin-top: 15px;"> 
                        <?php if($conf['login_qq']>=1 || $conf['login_wx']>=1){?>
                        <div style="text-align: center;margin-bottom: 5px;color:#999;margin-top: 15px;">  
                        

							<?php if($conf['login_wx']>=1){?><div onclick="javascript:connect('wx')" style=" width: 42px;height:42px; border: 1px solid rgba(213, 213, 213, 1); border-radius: 21px;  margin: 15px ; margin-top: 10px;   background-image: url(../assets/img/logowx.png);background-size: 100%;display: inline-block;"></div><?php }?>
                            <?php if($conf['login_qq']>=1){?><div onclick="javascript:connect('qq')" style="width: 42px;height:42px; border: 1px solid rgba(213, 213, 213, 1); border-radius: 21px;  margin: 15px ; margin-top: 10px;   background-image: url(../assets/img/logoqq.png);background-size: 100%;display: inline-block;"></div><?php }?>
                        <?php } ?>
                        </div>
                        
                        
                        <br/> 
                </div>
            </div>
        
         <style>
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
  
<style>
  .img1{

    width:1.1rem;
    height:1.1rem;
  }

  </style>
  <style>
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
.layui-layer-btn0{
    
    background: #fff !important;
    border:0px !important;    color: rgb(41, 121, 255) !important;
}.layui-layer-btn{
    width:100% !important;
        text-align: center;
    padding-top: 8px !important;
    
       border-radius: 9px !important;
}
.layui-layer{
       border-radius: 9px !important;
}
.layui-layer-title{
        border-radius: 9px !important;
}
</style>

     			<style>
      .quelb{
              display: block;
    font-size: 0.55rem;
    position: relative;
    top: -0.1rem;
    white-space: normal;
    padding: 0;
      }
      </style>

  

  
  

<script src="//s1.pstatp.com/cdn/expire-1-M/jquery/1.12.4/jquery.min.js"></script>
<script src="//s1.pstatp.com/cdn/expire-1-M/layer/2.3/layer.js"></script>
<!-- <script src="../assets/js/login.js?ver=2052"></script> -->

<script>
var l=0;
function changeLogin(){
if(l==0){
     $("#tabnormal").html('账号登录  <i class="glyphicon glyphicon-user"></i>');
     $("#normal").hide();
     $("#mobile").show();
    l++;
}else{
   
      $("#tabnormal").html('手机登录  <i class="fa fa-id-badge"></i>'); 
      $("#mobile").hide();
     $("#normal").show();
    l--;
}
    
}

function send(){
   	var phone = $("input[name='phone']").val();
		var code = $("input[name='code']").val();
     	layer.open({
                title: '请输入验证码'
                , btn: ['获取验证码']
                , content: '<div class="form-group" style="border-radius: 50px;overflow:hidden;border: 0px solid #ccc;background: #f1f1f1;">'+
                    '<div class="input-group" style="margin-top: 0px;  margin-bottom: 0px;">'+
                        '<div class="input-group-addon" style="border: 0px solid #ccc;background-color: #f1f1f1;"><span class="fa fa-shield"></span></div>'+
                        '<input type="text" name="phone_verify" id="phone_verify" style="height:35px;border-color:#f1f1f1 ;background: #f1f1f1;" class="form-control input-lg" required="required" placeholder="请输入验证码"/>'+
                       ' <span class="input-group-addon" style="padding: 0">'+
                             '<img id="codeimg" src="./code.php?r=1718729969" height="35" onclick="this.src=\'./code.php?r=\'+Math.random();" title="点击更换验证码">'+
                        '</span>'+
                   ' </div>'+
                '</div>',
                yes: function (index,layero) {
                    var phone_verify = $('#phone_verify').val();
                    if(phone_verify == "")
                    {
                        layer.msg("请输入验证码");
                        return false;
                    }
                    var time = 60;
               $.ajax({
			type : "POST",
			url : "ajax.php?act=regcode",
			data :{phone:phone,type:'login',phone_verify:phone_verify},
			dataType : 'json',
			success : function(data) {
			   
		if(data.code == 1){
					layer.alert(data.msg);
				}else{
					layer.alert(data.msg);
				}
			} 
		});
                },
            });
	/*	*/
}

function goback()
{
document.referrer === '' ?window.location.href = '/' :window.history.go(-1);
}
var $_GET = (function(){
    var url = window.document.location.href.toString();
    var u = url.split("?");
    if(typeof(u[1]) == "string"){
        u = u[1].split("&");
        var get = {};
        for(var i in u){
            var j = u[i].split("=");
            get[j[0]] = j[1];
        }
        return get;
    } else {
        return {};
    }
})();
function connect(type){
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : "POST",
		url : "ajax.php?act=connect",
		data : {type:type,back:$_GET['back']},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				window.location.href = data.url;
			}else{
				layer.alert(data.msg, {icon: 7});
			}
		} 
	});
}
function quickreg(type){
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : "POST",
		url : "ajax.php?act=quickreg",
		data : {type:type,submit:'do'},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				if($_GET['back']=='index'){
					layer.msg('登录成功，正在跳转到首页', {icon: 1,shade: 0.01,time: 15000});
					window.location.href='../';
				}else if($_GET['back']=='recharge'){
					layer.msg('登录成功，正在跳转到充值页面', {icon: 1,shade: 0.01,time: 15000});
					window.location.href='./recharge.php';
				}else if($_GET['back']=='workorder'){
					layer.msg('登录成功，正在跳转到工单页面', {icon: 1,shade: 0.01,time: 15000});
					window.location.href='./workorder.php';
				}else{
					layer.msg('登录成功，正在跳转到用户中心', {icon: 1,shade: 0.01,time: 15000});
					window.location.href='./';
				}
			}else{
				layer.alert(data.msg, {icon: 7});
			}
		} 
	});
}
var handlerEmbed = function (captchaObj) {
	captchaObj.appendTo('#captcha');
	captchaObj.onReady(function () {
		$("#captcha_wait").hide();
	}).onSuccess(function () {
		var result = captchaObj.getValidate();
		if (!result) {
			return alert('请完成验证');
		}
		$("#captchaform").html('<input type="hidden" name="geetest_challenge" value="'+result.geetest_challenge+'" /><input type="hidden" name="geetest_validate" value="'+result.geetest_validate+'" /><input type="hidden" name="geetest_seccode" value="'+result.geetest_seccode+'" />');
	});
};
var handlerEmbed2 = function (token) {
	if (!token) {
		return alert('请完成验证');
	}
	$("#captchaform").html('<input type="hidden" name="token" value="'+token+'" />');
};
var handlerEmbed3 = function (vaptchaObj) {
	vaptchaObj.render();
	$('#captcha_text').hide();
	vaptchaObj.listen('pass', function() {
		var token = vaptchaObj.getToken();
		if (!token) {
			return alert('请完成验证');
		}
		$("#captchaform").html('<input type="hidden" name="token" value="'+token+'" />');
	})
};
$(document).ready(function(){
	var captcha_type = $("input[name='captcha_type']").val();

	//判断手机号是否注册过,增加自动跳转
	$("input[name='phone']").blur(function(){
        var phone = $(this).val();
        if(phone){
            $.get("ajax.php?act=checkphone", { 'phone' : phone},function(data){
                    if( data == 0 ){
                        layer.alert('该手机未注册，请前往注册！',()=>{
							location.href="reg.php";
						});
						setTimeout(()=>{
							location.href="reg.php";
						},2000)	
                    }
            });
        }
    });

	$("#submit_login").click(function(){
	    	if(l==1){
	    	var phone = $("input[name='phone']").val();
			var code = $("input[name='code']").val();

			if(phone=='' || code==''){layer.alert('请输入手机号或验证码，不能为空！');return false;}
				var data = {phone:phone, code:code};
			}else{
				var user = $("input[name='user']").val();
				var pass = $("input[name='pass']").val();

			if(user=='' || pass==''){layer.alert('请输入账号和密码，不能为空！');return false;}
				var data = {user:user, pass:pass};
					
			}
			if(captcha_type == 1){
				var geetest_challenge = $("input[name='geetest_challenge']").val();
				var geetest_validate = $("input[name='geetest_validate']").val();
				var geetest_seccode = $("input[name='geetest_seccode']").val();
				if(geetest_challenge == undefined){
					layer.alert('请先完成滑动验证！'); return false;
				}
				var adddata = {geetest_challenge:geetest_challenge, geetest_validate:geetest_validate, geetest_seccode:geetest_seccode};
			}else if(captcha_type == 2||captcha_type == 3){
					var token = $("input[name='token']").val();
				if(token == undefined){
					layer.alert('请先完成滑动验证！'); return false;
				}
				var adddata = {token:token};
		}
		var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=login",
			data : Object.assign(data, adddata),
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					if($_GET['back']=='index'){
						layer.msg('登录成功，正在跳转到首页', {icon: 1,shade: 0.01,time: 15000});
						window.location.href='../';
					}else if($_GET['back']=='recharge'){
						layer.msg('登录成功，正在跳转到充值页面', {icon: 1,shade: 0.01,time: 15000});
						window.location.href='./recharge.php';
					}else if($_GET['back']=='workorder'){
						layer.msg('登录成功，正在跳转到工单页面', {icon: 1,shade: 0.01,time: 15000});
						window.location.href='./workorder.php';
					}else{
						layer.msg('登录成功，正在跳转到用户中心', {icon: 1,shade: 0.01,time: 15000});
						window.location.href='./';
					}
				}else{
					layer.alert(data.msg, {icon: 2});
				}
			} 
		});
	});
	
	if(captcha_type == 1){
		$.getScript("//static.geetest.com/static/tools/gt.js", function() {
			$.ajax({
				url: "../ajax.php?act=captcha&t=" + (new Date()).getTime(),
				type: "get",
				dataType: "json",
				success: function (data) {
					$('#captcha_text').hide();
					$('#captcha_wait').show();
					initGeetest({
						gt: data.gt,
						challenge: data.challenge,
						new_captcha: data.new_captcha,
						product: "popup",
						width: "100%",
						offline: !data.success
					}, handlerEmbed);
				}
			});
		});
	}else if(captcha_type == 2){
		var appid = $("input[name='appid']").val();
		$.getScript("//cdn.dingxiang-inc.com/ctu-group/captcha-ui/index.js", function() {
			var myCaptcha = _dx.Captcha(document.getElementById('captcha'), {
				appId: appid,
				type: 'basic',
				style: 'oneclick',
				width: "",
				success: handlerEmbed2
			})
			myCaptcha.on('ready', function () {
				$('#captcha_text').hide();
			})
		});
	}else if(captcha_type == 3){
		var appid = $("input[name='appid']").val();
		$.getScript("//v.vaptcha.com/v3.js", function() {
			vaptcha({
				vid: appid,
				type: 'click',
				container: '#captcha',
				offline_server: 'https://management.vaptcha.com/api/v3/demo/offline'
			}).then(handlerEmbed3);
		});
	}
});
</script>

</div>
                        
                        <br/> 
                </div>
            </div>
        </form>
         <style>
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
  <style>
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
.layui-layer-btn0{
    
    background: #fff !important;
    border:0px !important;    color: rgb(41, 121, 255) !important;
}.layui-layer-btn{
    width:100% !important;
        text-align: center;
    padding-top: 8px !important;
    
       border-radius: 9px !important;
}
.layui-layer{
       border-radius: 9px !important;
}
.layui-layer-title{
        border-radius: 9px !important;
}
</style>

     			<style>
      .quelb{
              display: block;
    font-size: 0.55rem;
    position: relative;
    top: -0.1rem;
    white-space: normal;
    padding: 0;
      }
      </style>

  

  
  
   <!--<div class="fui-navbar" style="max-width: 550px;z-index: 100;">-->
   <!--         <a href="../" class="nav-item"> <img src="https://cdn.xrsxi.top/view.php/540bea7283f4c66562a8ce0cb5af3e17.png" alt="Smiley face" width="20" height="20"><span class="label">首页</span>-->
   <!--         </a>-->
   <!--         <a href="../?mod=type&cid=﻿" class="nav-item ">  <img src="https://cdn.xrsxi.top/view.php/41bead526d8d47d42266f815b88882b6.png" alt="Smiley face" width="20" height="20"><span class="label">分类</span> </a>-->
		
           <!--  
            
   <!--         <a href="./?mod=cart" class="nav-item " > <img src="../template/storenews/img/tb/gowuche.png" alt="Smiley face" width="22" height="22"> <span class="label" style="color:#999;line-height: unset;font-weight: inherit;">购物车</span> </a>-->
            
   <!--         <a href="../?mod=query" class="nav-item ">  <img src="https://cdn.xrsxi.top/view.php/281841bf9e35b6cada355c82f7aaad48.png" alt="Smiley face" width="20" height="20"><span class="label">订单</span> </a>-->
            
   <!--         </a>-->
            
   <!--         <a href="../?mod=wzkf" class="nav-item "> <img src="https://cdn.xrsxi.top/view.php/d8af5a9cdebf13f9cdd2740bc790a5b7.png" alt="Smiley face" width="20" height="20"> <span class="label">客服</span>-->
   <!--         <a href="./" class="nav-item active "> <img src="https://cdn.xrsxi.top/view.php/9820352ea3dbc080da827ee37c4913b6.png" alt="Smiley face" width="20" height="20"><span class="label">我的</span> </a>-->
   <!--     </div>-->

<script>
// var l=0;
// function changeLogin(){
// if(l==0){
//      $("#tabnormal").html('账号登录  <i class="glyphicon glyphicon-user"></i>');
//      $("#normal").hide();
//      $("#mobile").show();
//     l++;
// }else{
   
//       $("#tabnormal").html('手机登录  <i class="fa fa-id-badge"></i>'); 
//       $("#mobile").hide();
//      $("#normal").show();
//     l--;
// }
    
// }
// function send(){
//    	var phone = $("input[name='phone']").val();
// 		var code = $("input[name='code']").val();
//      	layer.open({
//                 title: '请输入验证码'
//                 , btn: ['获取验证码']
//                 , content: '<div class="form-group" style="border-radius: 50px;overflow:hidden;border: 0px solid #ccc;background: #f1f1f1;">'+
//                     '<div class="input-group" style="margin-top: 0px;  margin-bottom: 0px;">'+
//                         '<div class="input-group-addon" style="border: 0px solid #ccc;background-color: #f1f1f1;"><span class="fa fa-shield"></span></div>'+
//                         '<input type="text" name="phone_verify" id="phone_verify" style="height:35px;border-color:#f1f1f1 ;background: #f1f1f1;" class="form-control input-lg" required="required" placeholder="请输入验证码"/>'+
//                        ' <span class="input-group-addon" style="padding: 0">'+
//                              '<img id="codeimg" src="./code.php?r=1718729969" height="35" onclick="this.src=\'./code.php?r=\'+Math.random();" title="点击更换验证码">'+
//                         '</span>'+
//                    ' </div>'+
//                 '</div>',
//                 yes: function (index,layero) {
//                     var phone_verify = $('#phone_verify').val();
//                     if(phone_verify == "")
//                     {
//                         layer.msg("请输入验证码");
//                         return false;
//                     }
//                     var time = 60;
//                $.ajax({
// 			type : "POST",
// 			url : "ajax.php?act=regcode",
// 			data :{phone:phone,type:'login',phone_verify:phone_verify},
// 			dataType : 'json',
// 			success : function(data) {
			   
// 		if(data.code == 1){
// 					layer.alert(data.msg);
// 				}else{
// 					layer.alert(data.msg);
// 				}
// 			} 
// 		});
//                 },
//             });
// 	/*	*/
// }

// function goback()
// {
// document.referrer === '' ?window.location.href = '/' :window.history.go(-1);
// }
// var $_GET = (function(){
//     var url = window.document.location.href.toString();
//     var u = url.split("?");
//     if(typeof(u[1]) == "string"){
//         u = u[1].split("&");
//         var get = {};
//         for(var i in u){
//             var j = u[i].split("=");
//             get[j[0]] = j[1];
//         }
//         return get;
//     } else {
//         return {};
//     }
// })();
// function connect(type){
// 	var ii = layer.load(2, {shade:[0.1,'#fff']});
// 	$.ajax({
// 		type : "POST",
// 		url : "ajax.php?act=connect",
// 		data : {type:type,back:$_GET['back']},
// 		dataType : 'json',
// 		success : function(data) {
// 			layer.close(ii);
// 			if(data.code == 0){
// 				window.location.href = data.url;
// 			}else{
// 				layer.alert(data.msg, {icon: 7});
// 			}
// 		} 
// 	});
// }
// function quickreg(type){
// 	var ii = layer.load(2, {shade:[0.1,'#fff']});
// 	$.ajax({
// 		type : "POST",
// 		url : "ajax.php?act=quickreg",
// 		data : {type:type,submit:'do'},
// 		dataType : 'json',
// 		success : function(data) {
// 			layer.close(ii);
// 			if(data.code == 0){
// 				if($_GET['back']=='index'){
// 					layer.msg('登录成功，正在跳转到首页', {icon: 1,shade: 0.01,time: 15000});
// 					window.location.href='../';
// 				}else if($_GET['back']=='recharge'){
// 					layer.msg('登录成功，正在跳转到充值页面', {icon: 1,shade: 0.01,time: 15000});
// 					window.location.href='./recharge.php';
// 				}else if($_GET['back']=='workorder'){
// 					layer.msg('登录成功，正在跳转到工单页面', {icon: 1,shade: 0.01,time: 15000});
// 					window.location.href='./workorder.php';
// 				}else{
// 					layer.msg('登录成功，正在跳转到用户中心', {icon: 1,shade: 0.01,time: 15000});
// 					window.location.href='./';
// 				}
// 			}else{
// 				layer.alert(data.msg, {icon: 7});
// 			}
// 		} 
// 	});
// }
// var handlerEmbed = function (captchaObj) {
// 	captchaObj.appendTo('#captcha');
// 	captchaObj.onReady(function () {
// 		$("#captcha_wait").hide();
// 	}).onSuccess(function () {
// 		var result = captchaObj.getValidate();
// 		if (!result) {
// 			return alert('请完成验证');
// 		}
// 		$("#captchaform").html('<input type="hidden" name="geetest_challenge" value="'+result.geetest_challenge+'" /><input type="hidden" name="geetest_validate" value="'+result.geetest_validate+'" /><input type="hidden" name="geetest_seccode" value="'+result.geetest_seccode+'" />');
// 	});
// };
// var handlerEmbed2 = function (token) {
// 	if (!token) {
// 		return alert('请完成验证');
// 	}
// 	$("#captchaform").html('<input type="hidden" name="token" value="'+token+'" />');
// };
// var handlerEmbed3 = function (vaptchaObj) {
// 	vaptchaObj.render();
// 	$('#captcha_text').hide();
// 	vaptchaObj.listen('pass', function() {
// 		var token = vaptchaObj.getToken();
// 		if (!token) {
// 			return alert('请完成验证');
// 		}
// 		$("#captchaform").html('<input type="hidden" name="token" value="'+token+'" />');
// 	})
// };
// $(document).ready(function(){
// 	var captcha_type = $("input[name='captcha_type']").val();
	
// 	$("#submit_login").click(function(){
// 	    	if(l==1){
// 	    	var phone = $("input[name='phone']").val();
// 		var code = $("input[name='code']").val();

// 		if(phone=='' || code==''){layer.alert('请输入手机号或验证码，不能为空！');return false;}
// 		var data = {phone:phone, code:code};
// 	    	}else{
// 		var user = $("input[name='user']").val();
// 		var pass = $("input[name='pass']").val();

// 		if(user=='' || pass==''){layer.alert('请输入账号和密码，不能为空！');return false;}
// 		var data = {user:user, pass:pass};
	    	    
// 	    	}
// 		if(captcha_type == 1){
// 			var geetest_challenge = $("input[name='geetest_challenge']").val();
// 			var geetest_validate = $("input[name='geetest_validate']").val();
// 			var geetest_seccode = $("input[name='geetest_seccode']").val();
// 			if(geetest_challenge == undefined){
// 				layer.alert('请先完成滑动验证！'); return false;
// 			}
// 			var adddata = {geetest_challenge:geetest_challenge, geetest_validate:geetest_validate, geetest_seccode:geetest_seccode};
// 		}else if(captcha_type == 2||captcha_type == 3){
// 			var token = $("input[name='token']").val();
// 			if(token == undefined){
// 				layer.alert('请先完成滑动验证！'); return false;
// 			}
// 			var adddata = {token:token};
// 		}
// 		var ii = layer.load(2, {shade:[0.1,'#fff']});
// 		$.ajax({
// 			type : "POST",
// 			url : "ajax.php?act=login",
// 			data : Object.assign(data, adddata),
// 			dataType : 'json',
// 			success : function(data) {
// 				layer.close(ii);
// 				if(data.code == 0){
// 					if($_GET['back']=='index'){
// 						layer.msg('登录成功，正在跳转到首页', {icon: 1,shade: 0.01,time: 15000});
// 						window.location.href='../';
// 					}else if($_GET['back']=='recharge'){
// 						layer.msg('登录成功，正在跳转到充值页面', {icon: 1,shade: 0.01,time: 15000});
// 						window.location.href='./recharge.php';
// 					}else if($_GET['back']=='workorder'){
// 						layer.msg('登录成功，正在跳转到工单页面', {icon: 1,shade: 0.01,time: 15000});
// 						window.location.href='./workorder.php';
// 					}else{
// 						layer.msg('登录成功，正在跳转到用户中心', {icon: 1,shade: 0.01,time: 15000});
// 						window.location.href='./';
// 					}
// 				}else{
// 					layer.alert(data.msg, {icon: 2});
// 				}
// 			} 
// 		});
// 	});
	
// 	if(captcha_type == 1){
// 		$.getScript("//static.geetest.com/static/tools/gt.js", function() {
// 			$.ajax({
// 				url: "../ajax.php?act=captcha&t=" + (new Date()).getTime(),
// 				type: "get",
// 				dataType: "json",
// 				success: function (data) {
// 					$('#captcha_text').hide();
// 					$('#captcha_wait').show();
// 					initGeetest({
// 						gt: data.gt,
// 						challenge: data.challenge,
// 						new_captcha: data.new_captcha,
// 						product: "popup",
// 						width: "100%",
// 						offline: !data.success
// 					}, handlerEmbed);
// 				}
// 			});
// 		});
// 	}else if(captcha_type == 2){
// 		var appid = $("input[name='appid']").val();
// 		$.getScript("//cdn.dingxiang-inc.com/ctu-group/captcha-ui/index.js", function() {
// 			var myCaptcha = _dx.Captcha(document.getElementById('captcha'), {
// 				appId: appid,
// 				type: 'basic',
// 				style: 'oneclick',
// 				width: "",
// 				success: handlerEmbed2
// 			})
// 			myCaptcha.on('ready', function () {
// 				$('#captcha_text').hide();
// 			})
// 		});
// 	}else if(captcha_type == 3){
// 		var appid = $("input[name='appid']").val();
// 		$.getScript("//v.vaptcha.com/v3.js", function() {
// 			vaptcha({
// 				vid: appid,
// 				type: 'click',
// 				container: '#captcha',
// 				offline_server: 'https://management.vaptcha.com/api/v3/demo/offline'
// 			}).then(handlerEmbed3);
// 		});
// 	}
// });
</script>
</body>
</html>
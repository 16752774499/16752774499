
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>APP在线生成</title>
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
<style>body{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style>
<body><style>
#orderItem .orderTitle{word-break:keep-all;}
#orderItem .orderContent{word-break:break-all;}
a:hover{color:#000;text-decoration:none;}
input::placeholder{
    text-align: right;
}
.input-group-addon{
    padding: 6px 0;
    text-align: left;
}
.layerdemo{
    border-radius: 10px;
    color:black;
    overflow: hidden;
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
 * APP在线生成
**/
include("../includes/common.php");
$title='APP在线生成';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<style>
#orderItem .orderTitle{word-break:keep-all;}
#orderItem .orderContent{word-break:break-all;}
.STYLE1 {
	font-size: 14px;
	font-weight: bold;
}
</style>

<?php
if(!$conf['appcreate_open'] || !$conf['appcreate_key'])showmsg('未开启自助生成APP功能',3);

if($userrow['power']==2){
    $price = $conf['appcreate_price2']>0?$conf['appcreate_price2'].'元':'免费';
}else{
    $price = $conf['appcreate_price']>0?$conf['appcreate_price'].'元':'免费';
}


$url = 'http://'.$userrow['domain'];

$select='<option value="'.$ur2.'">'.$ur2.'</option>';
$select='<option value="'.$url.'">'.$url.'</option>';
if(!empty($userrow['domain2'])){
    $url2 = 'http://'.$userrow['domain2'];
    $select.='<option value="'.$url2.'">'.$url2.'</option>';
}
?>



<?php

 

// 生成随机数

$Num1 = rand(); 

//输出



print_r(""); 

//在一个范围内生成随机数

$Num2 = rand(10000,999999999); 

//输出


?>


<?php
if($userrow['power']==0){
	showmsg('你没有权限使用此功能！',3);
}
?>


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
            <font><a href="">APP在线生成</a></font>

            </div>
                </div>
            <div  style="background: #f2f2f2; height: 10px"></div>

           <div class="my-cell " style="margin-bottom: 0px;padding: 0 15px;">
               <div class="my-cell-title display-row justify-between align-center form-group-border-bottom" style="border-radius: 0rem;padding: 0.75rem 0.65rem">
                   <div class="my-cell-title-l left-title" style="font-size:1.3rem">APP在线生成</div>
                   <div class="my-cell-title-r  display-row  align-center" >

                       <a class="submit_btn " style="font-size:1.1rem;color: #3793ff; color: #fff; background-image:linear-gradient(to right, rgba(252, 198, 108, 1), rgba(249, 138, 63, 1));padding: .9rem 1.1rem" href="./appList.php">我的生成  <i class="fa fa-angle-right" style="font-size:1.3rem"></i></a>
                   </div>
               </div>

               <div class="form-group form-group-transparent form-group-border-bottom" >
                   <div class="input-group" style="width:100%">
                       <div class="input-group-addon">
                           应用名称
                       </div>
                       <input type="text" name="name" class="form-control" value="<?php echo $userrow['sitename']?>" maxlength="12" placeholder="请输入应用名称">
                   </div>
               </div>
               <div class="form-group form-group-transparent" style="font-size:1.15rem; color: #FF0000;">
温馨提示：应用名称↑不能带有“资源”两个字的违禁词，如果你的应用名称内有违禁词，请手动修改或更换后再生成APP。
</div>


               <div class="form-group form-group-transparent form-group-border-bottom">
                   <div class="input-group" style="width:100%">
                       <div class="input-group-addon">
                           应用网址
                       </div>
                <select name="url" class="form-control">
                   <option value="http://<?php echo $Num2?>.appyw.top/?zid=<?php echo $zid ?>">http://<?php echo $Num2?>.appyw.top/?zid=<?php echo $zid ?></option>
                       </select>
                   </div>
               </div>
               <div class="form-group form-group-transparent" style="font-size:1.15rem; color: #FF0000;">
                   温馨提示：点击生成后等待3-5分钟即可到首页右下角或【会员中心-APP下载】进行下载，无需再次生成。长时间首页或【会员中心-APP下载】未有反应可发起重新生成或在售后反馈处上报工单，会有客服处理！
               </div>

               
                                  <div class="form-group form-group-transparent form-group-border-bottom" style="padding: 4.5px 0;">
                       <div class="input-group" style="width:100%">
                           <div class="input-group-addon" style="line-height: 2rem">
                               应用图标<br>
                               <span style="font-size: 9px;color: #a5a5a5;font-weight: normal;">不上传则使用默认图标</span>
                           </div>
                           <input type="file" id="file_icon" onchange="fileUpload(this, 'icon')" style="display:none;"/>
                           <input type="text" class="form-control" id="icon"  name="icon"  style="visibility: hidden;">
                           <span class="input-group-btn" style="padding-right: 10px">
                            <a href="javascript:fileSelect('file_icon')" title="上传图片" class="display-row  align-center">
                                 <img style="width: 6rem; height: 6rem; " id="img_file_icon" src="../assets/user/img/add_img.svg"></img>
                                <i class="fa fa-angle-right" style="font-size:2.4rem;color: #a5a5a5;padding-left: 5px"></i>
                            </a>
                        </span>

                       </div>
                   </div>
                   <div class="form-group form-group-transparent" style="padding: 4.5px 0;">
                       <div class="input-group" style="width:100%">
                           <div class="input-group-addon" style="line-height: 2rem">
                               应用启动图<br>
                               <span style="font-size: 9px;color: #a5a5a5;font-weight: normal;">不上传则使用默认启动图</span>
                           </div>
                           <input type="file" id="file_background" onchange="fileUpload(this, 'background')" style="display:none;"/>
                           <input type="text" class="form-control" id="background"  name="background"  style="visibility: hidden;">
                           <span class="input-group-btn" style="padding-right: 10px">
                                <a href="javascript:fileSelect('file_background')" title="上传图片" class="display-row  align-center">
                                     <img style="width: 6rem; height: 6rem; " id="img_file_background" src="../assets/user/img/add_img.svg"></img>
                                    <i class="fa fa-angle-right" style="font-size:2.4rem;color: #a5a5a5;padding-left: 5px"></i>
                                </a>
                            </span>

                       </div>
                   </div>

                          </div>

          </div>
            <div  style="background: #f2f2f2; height: 10px"></div>

           <div style="padding: 9px 12px;font-size: 1.2rem;color: #85855;">
               * 把网站打包成APP进行推广，方便快捷，APP支持安卓和IOS系统<br>
               * 首先确定访问的是自己的网站，如不是请勿生成<br>
               * 我的网站链接：<a style="text-align:center;color:#7a7a7a" href="http://<?php echo $userrow['domain']?>/" rel="noreferrer" ><?php echo $userrow['domain']?>（点击进入）</a><br>

       <?php  if($userrow['power']==0 || $userrow['power']==1){?>
                <a style="color: #ff9900;">&nbsp;&nbsp;升级到顶级合伙人可免费生成APP！</a>
               <?php }?>
           </div>
           <a id="submit"   style="width: 100%;">
               <div class="submit_btn" style="width: 90%;height: 4.2rem;margin:24px auto;text-align: center;line-height: 4.2rem;">立即生成[<?php echo $price?>]</div>
           </a>
       </form>
   </div>
</div>
<script>
    document.documentElement.addEventListener('touchstart', function (event) {
        if (event.touches.length > 1) {
            event.preventDefault();
        }
    }, {
        passive: false
    });

    // 禁用双击放大
    var lastTouchEnd = 0;
    document.documentElement.addEventListener('touchend', function (event) {
        var now = Date.now();
        if (now - lastTouchEnd <= 300) {
            event.preventDefault();
        }
        lastTouchEnd = now;
    }, {
        passive: false
    });
function fileSelect(obj){
	$("#"+obj).trigger("click");
}
function fileUpload(obj, des){

	var fileObj = $(obj)[0].files[0];

	if (typeof (fileObj) == "undefined" || fileObj.size <= 0) {
		return;
	}
	var formData = new FormData();
	formData.append("file",fileObj);

	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		url: "ajax_user.php?act=app_upload",
		
		data: formData,
		type: "POST",
		dataType: "json",
		cache: false,
		processData: false,
		contentType: false,
		success: function (data) {
			layer.close(ii);
			if(data.code == 0){
				$("input[name='"+des+"']").val('图片上传成功('+data.fileid+')');
                $("input[name='"+des+"']").attr('data-fileid', data.fileid);
                var objUrl = getObjectURL(fileObj) ;
                $("#img_file_"+des).attr('src' ,objUrl);

			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	})
}
    function querytask(){
        var ii = layer.load(0);
        $("#result").hide();
        $.ajax({
            type : 'GET',
            url : 'ajax_user.php?act=app_query',
            dataType : 'json',
            success : function(data) {
                layer.close(ii);
                if(data.code == 0){
                    var item = '<table class="table table-condensed table-hover" id="orderItem">';
				    item += '<tr><td colspan="6" style="text-align:center" class="orderTitle"><b>APP生成任务结果<a href="javascript:querytask()" class="pull-right btn btn-xs btn-default"><i class="fa fa-refresh"></i>&nbsp;刷新</a></b></td></tr><tr><td class="info orderTitle">应用名称</td><td colspan="5" class="orderContent">'+data.data.name+'</td></tr><tr><td class="info orderTitle">应用网址</td><td colspan="5" class="orderContent">'+data.url+'</td></tr></tr><tr><td class="info orderTitle">创建时间</td><td colspan="5" class="orderContent">'+data.data.created_at+'</td></tr><tr><td class="info orderTitle">任务状态</td><td colspan="5" class="orderContent">'+(data.data.status==1?'<span class="label label-success">成功</span>':data.data.status==-1?'<span class="label label-danger">打包失败</span>':'<span class="label label-warning">正在打包，请稍候点击刷新按钮查看</span>')+'</td></tr>';
                    if(data.data.status==1){
                       item += '<tr><td class="info orderTitle">双端下载页面</td><td colspan="5" class="orderContent"><a href="'+data.download_url+'" target="_blank" style="color:blue">'+data.download_url_show+'</a><br/></td></tr>';
						item += '<tr><td class="info orderTitle">安卓APP下载</td><td colspan="5" class="orderContent"><a href="'+data.android_url+'" target="_blank" style="color:blue">'+data.android_url+'</a></tr>';
						item += '<tr><td class="info orderTitle">iOS APP下载</td><td colspan="5" class="orderContent"><a href="'+data.download_url+'" target="_blank" style="color:blue">'+data.download_url_show+'</a>（必须Safari访问）</tr>';
                        if(navigator.userAgent.indexOf('Windows')>-1){
                            item += '<tr><td class="info orderTitle">扫码下载</td><td colspan="5" class="orderContent"><img style="box-shadow: 3px 3px 16px #eee" src="//api.qrserver.com/v1/create-qr-code/?size=150x150&margin=10&data='+encodeURIComponent(data.download_url_show)+'"></td></tr>';
                        }
                    }
                    item += '</table>';
                    $("#result").html(item);
                    $("#result").show();
                }else{
                    item = '<div class="alert alert-danger"><i class="glyphicon glyphicon-info-sign"></i>&nbsp;'+data.msg+'</div>';
                    $("#result").html(item);
                    $("#result").show();
                }
            }
        });
    }
$(document).ready(function(){
    $("#submit").click(function(){
		var name = $("input[name='name']").val();
		var url = $("select[name='url']").val();
        var icon = $("input[name='icon']").attr('data-fileid');
        var background = $("input[name='background']").attr('data-fileid');
		if(name==''){layer.alert('应用名称不能为空！');return false;}
        var confirmobj = layer.confirm('请确认你的APP信息↓<br/>应用名称：<font color="blue">'+name+'</font><br/>应用网址：<font color="blue">'+url+'</font>', {
            btn: ['确定','取消']
        }, function(){
            var ii = layer.load(0);
            $.ajax({
                type : 'POST',
                url : 'ajax_user.php?act=app_submit',
                data : {name: name, url: url, icon: icon, background: background},
                dataType : 'json',
                success : function(data) {
                    layer.close(ii);
                    if(data.code == 0){
                        var icon = "../assets/user/img/success.png";
                    }else{
                        var icon = "../assets/user/img/danger.png";
                    }
                    var width = '30rem';
                    var height = '22rem';
                    var html =
                        '<div class="showtip display-column justify-between align-center" style="width:'+ width +';height: '+ height +';">' +
                            '<div class="showtip-title"></div>' +
                            '<div class="showtip-center  display-column justify-center align-center">' +
                                '<img src="'+icon+'" style="height:30%">' +
                                '<div class="showtip-center-msg">APP生成成功</div>' +
                                '<div class="showtip-center-num">'+ data.msg +'</div>'+
                            '</div>' +
                            '<div class="showtip-btn display-row justify-center align-center">' +
                                '<a href="./appList.php" class="showtip-btn-yes display-column justify-center align-center">查看</a>' +
                                '<a href="javascript:layer.closeAll()" class="showtip-btn-yes display-column justify-center align-center">关闭</a>' +
                            '</div>' +
                        '</div>';
                    layer.open({
                        type: 1,
                        area: [width, height],
                        title: false,
                        shade: 0.3,
                        skin: "layerdemo",
                        shadeClose: false,
                        closeBtn: 0,
                        content: "<center>"+ html +"</center>",
                        end: function(){

                        }
                    });
                }
            });
        }, function(){
            layer.close(confirmobj);
        });
	});
})

function getObjectURL(file) {undefined

    var url = null ;

// 下面函数执行的效果是一样的，只是需要针对不同的浏览器执行不同的 js 函数而已

    if (window.createObjectURL!=undefined) { // basic

        url = window.createObjectURL(file) ;

    } else if (window.URL!=undefined) { // mozilla(firefox)

        url = window.URL.createObjectURL(file) ;

    } else if (window.webkitURL!=undefined) { // webkit or chrome

        url = window.webkitURL.createObjectURL(file) ;

    }

    return url ;

}

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
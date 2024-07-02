<?php
if($conf['cdnpublic']==1){
	$cdnpublic = '//lib.baomitu.com/';
}elseif($conf['cdnpublic']==2){
	$cdnpublic = 'https://cdn.bootcdn.net/ajax/libs/';
}elseif($conf['cdnpublic']==4){
	$cdnpublic = '//s1.pstatp.com/cdn/expire-1-M/';
}else{
	$cdnpublic = '//cdn.staticfile.org/';
}
if(!empty($conf['staticurl'])){
	$cdnserver = '//'.$conf['staticurl'].'/';
}else{
	$cdnserver = '../';
}
require '../includes/common.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$title='网站设置';
if($conf['fenzhan_cost2']<=0)$conf['fenzhan_cost2']=$conf['fenzhan_price2'];
?>

<html lang="zh-cn" style="" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths"><head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>网站设置</title>
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
  <!--[if lt IE 9]>
    <script src="//cdn.staticfile.org/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
<style>body{ background:#ecedf0 url("https://api.dujin.org/bing/1920.php") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style></head>
<body><style>
    .form-control[disabled]{
        background-color:transparent;
        color: #999999;
    }

    form-control1::placeholder{
        text-align: left;
    }
    .form-control{
        text-align: right;
    }
    input::placeholder{
        text-align: right;
        font-size: 1.3rem;
    }
    .del_icon{
        display:none;
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
$mod=isset($_GET['mod'])?$_GET['mod']:null;
if($mod=='user_n'){
	if(!checkRefererHost())exit();
	$qq=daddslashes(htmlspecialchars(strip_tags($_POST['qq'])));
	$pay_type=daddslashes(intval($_POST['pay_type']));
	$pay_account=daddslashes(htmlspecialchars(strip_tags($_POST['pay_account'])));
	$pay_name=daddslashes(htmlspecialchars(strip_tags($_POST['pay_name'])));
	$name=daddslashes(htmlspecialchars(strip_tags($_POST['name'])));
	$pwd=daddslashes(htmlspecialchars(strip_tags($_POST['pwd'])));
	if(!empty($pwd) && !preg_match('/^[a-zA-Z0-9\_\!\@\#\$~\%\^\&\*.,]+$/',$pwd)){
		exit("<script language='javascript'>alert('密码只能为英文与数字！');history.go(-1);</script>");
	}elseif(!preg_match('/^[0-9]{5,11}+$/', $qq)){
		exit("<script language='javascript'>alert('QQ格式不正确！');history.go(-1);</script>");
	}else{
		$DB->exec("UPDATE pre_site SET qq=:qq,name=:name,pay_type=:pay_type,pay_account=:pay_account,pay_name=:pay_name WHERE zid=:zid", [':qq'=>$qq, ':pay_type'=>$pay_type, ':pay_account'=>$pay_account, ':pay_name'=>$pay_name, ':name'=>$name, ':zid'=>$userrow['zid']]);
		if(!empty($pwd))$DB->exec("update pre_site set pwd=:pwd where zid=:zid" ,[':pwd'=>$pwd, ':zid'=>$userrow['zid']]);
		exit("<script language='javascript'>alert('修改保存成功！');history.go(-1);</script>");
	}
}elseif($mod=='user'){
	$url = 'https://api.fcypay.com/';
    $m = md5(rand(1000000,9999999).date('YmdHis').uniqid());
    $code_url = $url.'get_openid_qrcode?mark='.$m;
    $cron_url = $url.'get_openid_status?mark='.$m;
?><body><style>
    .form-control[disabled]{
        background-color:transparent;
        color: #999999;
    }

    form-control1::placeholder{
        text-align: left;
    }
    .form-control{
        text-align: right;
    }
    input::placeholder{
        text-align: right;
        font-size: 1.3rem;
    }
    .del_icon{
        display:none;
    }
</style>

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
            <font><a href="">个人信息</a></font>

            </div>
                </div>
            <div class="form-group form-group-transparent" style="background: #f2f2f2; padding:8px 10px">
                <div class="input-group" style="width:100%">
                    <div class="input-group-addon" style="color:#969494;font-size:13px;">
                        个人信息
                    </div>
                    <div></div>
                </div>
            </div>
            <form action="./uset.php?mod=user_n" method="post" role="form" enctype="multipart/form-data">
                <div class="block-white" style="padding:0 10px">

                    <div class="form-group form-group-transparent form-group-border-bottom">
                        <div class="input-group" style="width:100%">
                            <div class="input-group-addon">
                                用户名
                            </div>
                            <input type="text" value="<?php echo $userrow['user']; ?>" class="form-control" disabled="false">
                        </div>
                    </div>
     <div class="form-group form-group-transparent form-group-border-bottom">
                        <div class="input-group" style="width:100%">
                            <div class="input-group-addon">
                                设置昵称
                            </div>
                            <input type="text" name="name" value="<?php echo $userrow['name']; ?>" class="form-control" placeholder="设置昵称" required="">
                        </div>
                    </div>
                                        <div class="form-group form-group-transparent form-group-border-bottom">
                        <div class="input-group" style="width:100%">
                            <div class="input-group-addon">
                                联系ＱＱ
                            </div>
                            <input type="text" name="qq" value="<?php echo $userrow['qq']; ?>" class="form-control" placeholder="方便联系和QQ快捷登录" required="">
                        </div>
                    </div>

                    <div class="form-group form-group-transparent form-group-border-bottom">
                        <div class="input-group" style="width:100%">
                            <div class="input-group-addon">
                                注册时间
                            </div>
                            <input type="text" value="<?php echo $userrow['addtime']; ?>" class="form-control" disabled="false">
                        </div>
                    </div>

            		  <?php  if($userrow['power']==1 || $userrow['power']==2){?>
                    <div class="form-group form-group-transparent" style="background: #f2f2f2; padding:8px 0px;padding-left: 10px;margin: 0 -10px;">
                        <div class="input-group" style="width:100%">
                            <div class="input-group-addon" style="color:#969494;font-size:13px;">
                                提现信息
                            </div>
                            <div></div>
                        </div>
                    </div>
                    <div class="form-group form-group-transparent form-group-border-bottom">
                        <div class="input-group" style="width:100%">
                            <div class="input-group-addon">
                                提现方式
                            </div> <select class="form-control" name="pay_type" default="<?php echo $userrow['pay_type']?>"><?php if($conf['fenzhan_tixian_alipay']==1){?><option value="0">支付宝</option><?php } if($conf['fenzhan_tixian_wx']==1){?><option value="1">微信</option><?php } if($conf['fenzhan_tixian_qq']==1){?><option value="2">QQ钱包</option><?php }?></select>
                        </div>
                    </div>
                    <div class="form-group form-group-transparent form-group-border-bottom">
                        <div class="input-group" style="width:100%">
                            <div class="input-group-addon">
                                提现账号
                            </div>
                            <input type="text" name="pay_account" value="<?php echo $userrow['pay_account']; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group form-group-transparent form-group-border-bottom">
                        <div class="input-group" style="width:100%">
                            <div class="input-group-addon">
                                提现姓名
                            </div>
                            <input type="text" name="pay_name" value="<?php echo $userrow['pay_name']; ?>" class="form-control">
                        </div>
                    </div>
                    <?php if($conf['fenzhan_skimg']==1){?>
                    <div class="form-group form-group-transparent form-group-border-bottom">
                                                <div class="input-group" style="width:100%">
                            <div class="input-group-addon">
                                收款码
                            </div>
                            <div class="form-control" value=""></div>
                            <span class="input-group-btn" style="padding-right: 10px">
                                <a href="uset.php?mod=skimg" title="上传图片" class="display-row  align-center">
                                     <img style="width: 6rem; height: 6rem; " id="shoukuan" name="shoukuan" src="../assets/user/img/add_img.svg">
                                    <i class="fa fa-angle-right" style="font-size:2.4rem;color: #a5a5a5;padding-left: 5px"></i>
                                </a>
                           </span>

                        </div>
                    </div>
                    <?php }?>
                        <?php }?>
                    <div style="background: #f2f2f2; margin: 0 -10px;padding-left: 10px;height: 10px"></div>
                    <div class="form-group form-group-transparent form-group-border-bottom">
                        <div class="input-group" style="width:100%">
                            <div class="input-group-addon">
                                重置密码
                            </div>
                            <input type="text" name="pwd" value="" class="form-control" placeholder="不修改请留空">
                        </div>
                    </div>
                </div>
                <div class="text-center" style="padding: 30px 0;">
                    <input type="submit" name="submit" class="btn submit_btn" style="width: 80%;padding:8px;" value="确定修改">
                </div>
            </form>

                            </div>
</div>

<script src="//cdn.staticfile.org/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
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
    function fileSelect(id) {
        $("#" + id).trigger("click");
    }

    function fileUpload(id, fileurl) {

        var fileObj = $("#" + id + "_upload" )[0].files[0];
        if (typeof (fileObj) == "undefined" || fileObj.size <= 0) {
            return;
        }
        var formData = new FormData();
        formData.append("do", "upload");
        formData.append("type", "user");
        formData.append("file", fileObj);
        formData.append("fileurl", fileurl);
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            url: "ajax_user.php?act=upload_qrcode",
            data: formData,
            type: "POST",
            dataType: "json",
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function (xmlHttp) {
                xmlHttp.setRequestHeader("If-Modified-Since", "0");
                xmlHttp.setRequestHeader("Cache-Control", "no-cache");
            },
            success: function (data) {
                layer.close(ii);
                if (data.code == 0) {
                    layer.msg('上传图片成功');
                    $("#" + id).attr("src", '../' + data.url + "?ran=" + Math.random());
                    if(id == 'lunbo'){
                        $("#del_lunbo").removeClass("del_icon");

                    }

                } else {
                    layer.alert(data.msg);
                }
            },
            error: function (data) {
                layer.msg('服务器错误');
                return false;
            }
        })
    }

    function del_img(id, fileurl) {

        var formData = new FormData();
        formData.append("fileurl", fileurl);
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            url: "ajax_user.php?act=del_img",
            data: formData,
            type: "POST",
            dataType: "json",
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) {
                layer.close(ii);
                if (data.code == 0) {
                    layer.msg('删除成功');
                    $("#" + id).attr("src", '../assets/user/img/add_img.svg?ran=' + Math.random());
                    if(id == 'lunbo'){
                        $("#del_lunbo").addClass("del_icon");

                    }
                } else {
                    layer.alert(data.msg);
                }
            },
            error: function (data) {
                layer.msg('服务器错误');
                return false;
            }
        })
    }

    $("#send").click(function () {
        var checked = 1;
        var phone = $("input[name='phone']").val();
        var myreg = /^(((12[0-9]{1})|(13[0-9]{1})|(14[0-9]{1})|(15[0-9]{1})|(16[0-9]{1})|(17[0-9]{1})|(19[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        if (!myreg.test(phone)) {
            layer.alert('请输入有效的手机号码！');
            return false;

        }
        $.get("ajax.php?act=checkphone", {'phone': phone}, function (data) {
            if (data == 1) {
                layer.alert('你所填写的手机号已存在！');
                return false;
            } else {
                layer.open({
                    title: '请输入验证码'
                    ,
                    btn: ['发送验证码']

                    ,
                    btnAlign: 'c'
                    ,
                    content: '<div class="form-group" style="border-radius: 50px;overflow:hidden;border: 0px solid #ccc;background: #f1f1f1;">' +
                        '<div class="input-group" style="margin-top: 0px;  margin-bottom: 0px;">' +
                        '<div class="input-group-addon" style="border: 0px solid #ccc;background-color: #f1f1f1;"><span class="fa fa-shield"></span></div>' +
                        '<input type="text" name="phone_verify" id="phone_verify" style="height:35px;border-color:#f1f1f1 ;background: #f1f1f1;text-align: center;" class="form-control input-lg" required="required" placeholder="输入验证码"/>' +
                        ' <span class="input-group-addon" style="padding: 0">' +
                        '<img id="codeimg" src="./code.php?r=1653172404" height="35" onclick="this.src=\'./code.php?r=\'+Math.random();" title="点击更换验证码">' +
                        '</span>' +
                        ' </div>' +
                        '</div>',
                    yes: function (index, layero) {
                        var phone_verify = $('#phone_verify').val();
                        if (phone_verify == "") {
                            layer.msg("请输入验证码");
                            return false;
                        }
                        var time = 60;
                        $.ajax({
                            type: "POST",
                            url: "ajax.php?act=tx_send",
                            data: {
                                phone: phone,
                                phone_verify, phone_verify
                            },
                            dataType: 'json',
                            success: function (data) {

                                if (data.code == 1) {

                                    layer.alert(data.message);

                                    function timeCountDown() {
                                        if (time == 0) {
                                            clearInterval(timer);
                                            $('#send').val("发送验证码");
                                            $('#send').removeAttr("disabled");
                                            checked = 1;
                                            return true;
                                        }
                                        $('#send').val(time + "S");
                                        time--;
                                        return false;
                                        checked = 0;
                                    }

                                    $('#send').attr("disabled", true);
                                    timeCountDown();
                                    var timer = setInterval(timeCountDown, 1000);

                                } else {

                                    layer.alert(data.message);

                                }

                            }
                        });
                    },
                });
            }
        });
    });
</script>
    <script>





        var items = $("select[default]");
        for (i = 0; i < items.length; i++) {
            $(items[i]).val($(items[i]).attr("default") || 0);
        }
        
        function setpwd() {
            var user = $("input[name='user']").val();
            var pwd = $("input[name='pwd']").val();
            if (user == '' || pwd == '') {
                layer.alert('请确保每项不能为空！');
                return false;
            }
            if (user.length < 3) {
                layer.alert('用户名太短');
                return false;
            } else if (user.length > 20) {
                layer.alert('用户名太长');
                return false;
            } else if (pwd.length < 6) {
                layer.alert('密码不能低于6位');
                return false;
            } else if (pwd.length > 30) {
                layer.alert('密码太长');
                return false;
            }
            var ii = layer.load(2, {shade: [0.1, '#fff']});
            $.ajax({
                type: "POST",
                url: "ajax_user.php?act=setpwd",
                data: {user: user, pwd: pwd},
                dataType: 'json',
                success: function (data) {
                    layer.close(ii);
                    if (data.code == 0) {
                        layer.alert(data.msg, {
                            closeBtn: 0
                        }, function () {
                            window.location.reload();
                        });
                    } else {
                        layer.alert(data.msg, {icon: 0});
                    }
                }
            });
            return false;
        }

        function connect(type) {
            var ii = layer.load(2, {shade: [0.1, '#fff']});
            $.ajax({
                type: "POST",
                url: "ajax.php?act=connect",
                data: {type: type},
                dataType: 'json',
                success: function (data) {
                    layer.close(ii);
                    if (data.code == 0) {
                        window.location.href = data.url;
                    } else {
                        layer.alert(data.msg, {icon: 7});
                    }
                }
            });
        }

        function unbind(type) {
            var confirmobj = layer.confirm('解绑后将无法通过QQ一键登录，是否确定解绑？', function () {
                var ii = layer.load(2, {shade: [0.1, '#fff']});
                $.ajax({
                    type: "POST",
                    url: "ajax.php?act=unbind",
                    data: {type: type},
                    dataType: 'json',
                    success: function (data) {
                        layer.close(ii);
                        if (data.code == 0) {
                            layer.alert(data.msg, {icon: 1}, function () {
                                window.location.reload();
                            });
                        } else {
                            layer.alert(data.msg, {icon: 0});
                        }
                    }
                });
            }, function () {
                layer.close(confirmobj);
            });
        }
    </script>
</body>
<?php
}elseif($mod=='site_n' && $userrow['power']>0){
	if(!checkRefererHost())exit();
	$sitename=trim(htmlspecialchars(strip_tags($_POST['sitename'])));
	$title=trim(htmlspecialchars(strip_tags($_POST['title'])));
	$keywords=trim(htmlspecialchars(strip_tags($_POST['keywords'])));
	$description=trim(htmlspecialchars(strip_tags($_POST['description'])));
	$kfqq=isset($_POST['kfqq'])?trim(htmlspecialchars(strip_tags($_POST['kfqq']))):null;
	$kfwx=isset($_POST['kfwx'])?trim(htmlspecialchars(strip_tags($_POST['kfwx']))):null;
	$anounce=$_POST['anounce'];
	$modal=$_POST['modal'];
	$bottom=$_POST['bottom'];
	$alert=$_POST['alert'];
	$ktfz_price=trim($_POST['ktfz_price']);
	$ktfz_price2=trim($_POST['ktfz_price2']);
	$ktfz_domain=trim($_POST['ktfz_domain']);
	$template=isset($_POST['template'])?trim($_POST['template']):null;
	$appurl=trim($_POST['appurl']);
	if($sitename==null){
		exit("<script language='javascript'>alert('请确保各项不能为空');history.go(-1);</script>");
	}else{
		if(!empty($template) && (!preg_match('/^[a-zA-Z0-9]+$/',$template) || \lib\Template::exists($template)==false))exit("<script language='javascript'>alert('该模板首页文件不存在！');history.go(-1);</script>");
		if($userrow['power']==2){
			if(!is_numeric($ktfz_price) || !preg_match('/^[0-9.]+$/', $ktfz_price) || $ktfz_price<0)exit("<script language='javascript'>alert('分站站长价格输入不规范');history.go(-1);</script>");
			if(!is_numeric($ktfz_price2) || !preg_match('/^[0-9.]+$/', $ktfz_price2) || $ktfz_price2<0)exit("<script language='javascript'>alert('顶级合伙人价格输入不规范');history.go(-1);</script>");
			if($ktfz_price<0.01)exit("<script language='javascript'>alert('分站站长价格不能低于0.01元');history.go(-1);</script>");
			if($ktfz_price2<$conf['fenzhan_cost2'])exit("<script language='javascript'>alert('顶级合伙人价格不能低于成本价');history.go(-1);</script>");
			if($ktfz_price2<$ktfz_price)exit("<script language='javascript'>alert('顶级合伙人价格不能低于分站站长价格');history.go(-1);</script>");
			if($conf['fenzhan_edithtml']==1){
				$sql="UPDATE `pre_site` SET `sitename`=:sitename,`title`=:title,`keywords`=:keywords,`description`=:description,`kfqq`=:kfqq,`kfwx`=:kfwx,`anounce`=:anounce,`modal`=:modal,`bottom`=:bottom,`alert`=:alert,`ktfz_price`=:ktfz_price,`ktfz_price2`=:ktfz_price2,`ktfz_domain`=:ktfz_domain,`template`=:template,`appurl`=:appurl WHERE `zid`=:zid";
				$data = [':sitename'=>$sitename, ':title'=>$title, ':keywords'=>$keywords, ':description'=>$description, ':kfqq'=>$kfqq, ':kfwx'=>$kfwx, ':anounce'=>$anounce, ':modal'=>$modal, ':bottom'=>$bottom, ':alert'=>$alert, ':ktfz_price'=>$ktfz_price, ':ktfz_price2'=>$ktfz_price2, ':ktfz_domain'=>$ktfz_domain, ':template'=>$template, ':appurl'=>$appurl, ':zid'=>$zid];
			}else{
				$sql="UPDATE `pre_site` SET `sitename`=:sitename,`title`=:title,`keywords`=:keywords,`description`=:description,`kfqq`=:kfqq,`kfwx`=:kfwx,`ktfz_price`=:ktfz_price,`ktfz_price2`=:ktfz_price2,`ktfz_domain`=:ktfz_domain,`template`=:template,`appurl`=:appurl WHERE `zid`=:zid";
				$data = [':sitename'=>$sitename, ':title'=>$title, ':keywords'=>$keywords, ':description'=>$description, ':kfqq'=>$kfqq, ':kfwx'=>$kfwx, ':ktfz_price'=>$ktfz_price, ':ktfz_price2'=>$ktfz_price2, ':ktfz_domain'=>$ktfz_domain, ':template'=>$template, ':appurl'=>$appurl, ':zid'=>$zid];
			}
			$sds=$DB->exec($sql, $data);
		}else{
			if($conf['fenzhan_edithtml']==1){
				$sql="UPDATE `pre_site` SET `sitename`=:sitename,`title`=:title,`keywords`=:keywords,`description`=:description,`kfqq`=:kfqq,`kfwx`=:kfwx,`anounce`=:anounce,`modal`=:modal,`bottom`=:bottom,`alert`=:alert,`template`=:template,`appurl`=:appurl WHERE `zid`=:zid";
				$data = [':sitename'=>$sitename, ':title'=>$title, ':keywords'=>$keywords, ':description'=>$description, ':kfqq'=>$kfqq, ':kfwx'=>$kfwx, ':anounce'=>$anounce, ':modal'=>$modal, ':bottom'=>$bottom, ':alert'=>$alert, ':template'=>$template, ':appurl'=>$appurl, ':zid'=>$zid];
			}else{
				$sql="UPDATE `pre_site` SET `sitename`=:sitename,`title`=:title,`keywords`=:keywords,`description`=:description,`kfqq`=:kfqq,`kfwx`=:kfwx,`template`=:template,`appurl`=:appurl WHERE `zid`=:zid";
				$data = [':sitename'=>$sitename, ':title'=>$title, ':keywords'=>$keywords, ':description'=>$description, ':kfqq'=>$kfqq, ':kfwx'=>$kfwx, ':template'=>$template, ':appurl'=>$appurl, ':zid'=>$zid];
			}
			$sds=$DB->exec($sql, $data);
		}
		if($sds!==false)exit("<script language='javascript'>alert('修改保存成功！');history.go(-1);</script>");
		else exit("<script language='javascript'>alert('修改保存失败:".$DB->error()."');history.go(-1);</script>");
	}
}elseif($mod=='site' && $userrow['power']>0){
	$mblist = \lib\Template::getList();
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
            <font><a href="">编辑站点信息</a></font>

            </div>
                </div>
            <div class="form-group form-group-transparent" style="background: #f2f2f2; padding:8px 10px">
                <div class="input-group" style="width:100%">
                    <div class="input-group-addon" style="color:#969494;font-size:13px;">
                        网站信息
                    </div>
                    <div class="form-control form-control-left"><a style="font-size:12px;color:#696969" href="./uset.php?mod=user">前往设置个人信息</a></div>
                    <div></div>
                </div>
            </div>
            <form action="./uset.php?mod=site_n" method="post" role="form" enctype="multipart/form-data">
                <div class="block-white" style="padding:0 10px">
                    <div class="form-group form-group-transparent form-group-border-bottom">
                        <div class="input-group" style="width:100%">
                            <div class="input-group-addon">
                                网站名称
                            </div>
                            <input type="text" name="sitename" value="<?php echo $userrow['sitename']; ?>" class="form-control" required="">
                        </div>
                    </div>


                                            <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    客服ＱＱ
                                </div>
                                <input type="text" name="kfqq" value="<?php echo $userrow['kfqq']; ?>" class="form-control" placeholder="请输入客服ＱＱ">
                            </div>
                        </div>
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    客服微信
                                </div>
                                <input type="text" name="kfwx" value="<?php echo $userrow['kfwx']; ?>" class="form-control" placeholder="请输入客服微信号">
                            </div>
                        </div>
                    
                                            <div class="form-group form-group-transparent" style="background: #f2f2f2; padding:8px 0px;padding-left: 10px;margin: 0 -10px;">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon" style="color:#969494;font-size:13px;">
                                    公告提示
                                </div>
                                <div></div>
                            </div>
                        </div>
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    首页弹出公告
                                </div>
                                <div style="font-size:12px;color:#696969" class="form-control form-control-left">不填则和主站同步显示公告内容</div>
                            </div>
                        </div>
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <textarea class="form-control" name="anounce" rows="4" style="min-height: 100px;text-align: left" placeholder="请输入公告内容..."><?php echo htmlspecialchars($userrow['anounce']);?></textarea>
                        </div>
                        
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    会员中心滚动公告
                                </div>
                                <div style="font-size:12px;color:#696969" class="form-control form-control-left">不填则和主站同步显示公告内容</div>
                            </div>
                        </div>
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <textarea class="form-control" name="modal" rows="4" style="min-height: 100px;text-align: left" placeholder="请输入公告内容..."><?php echo htmlspecialchars($userrow['modal']);?></textarea>
                        </div>
                        
                        <?php  if($userrow['power']==2){?>
                                            <div class="form-group form-group-transparent" style="background: #f2f2f2; padding:8px 0px;padding-left: 10px;margin: 0 -10px;">
                            <div class="input-group display-row align-center justify-between" style="width:100%">
                                <div class="input-group-addon" style="color:#969494;font-size:13px;">
                                    价格设定 ( 单位 : 元 )
                                </div>
                                <div style="font-size:12px;color:#696969" class="form-control form-control-left">下级开通,平台会收取部分成本费用</div>
                            </div>
                        </div>
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    分站站长价格<a style="color: #969494;font-size: 12px;">（成本<?php echo $conf['fenzhan_cost']?>）</a>
                                </div>
                                <input type="text" name="ktfz_price" placeholder="请输入价格，不能低于0.01元" value="<?php echo $userrow['ktfz_price']>0?$userrow['ktfz_price']:$conf['fenzhan_price']; ?>" class="form-control">
                
                            </div>
                        </div>
                        <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    顶级合伙人价格<a style="color: #969494;font-size: 12px;">（成本<?php echo $conf['fenzhan_cost2']?>）</a>
                                </div>
                                <input type="text" name="ktfz_price2" placeholder="请输入价格，不能低于<?php echo $conf['fenzhan_cost2']?>元成本价" value="<?php echo $userrow['ktfz_price2']>$conf['fenzhan_cost2']?$userrow['ktfz_price2']:$conf['fenzhan_price2']; ?>" class="form-control">
                            </div>
                        </div>
                                <?php }?>
                                
                        <div class="form-group form-group-transparent" style="background: #f2f2f2; padding:8px 0px;padding-left: 10px;margin: 0 -10px;">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon" style="color:#969494;font-size:13px;">
                                    分站设定
                                </div>
                                <div></div>
                            </div>
                        </div>
                        <!--<div class="form-group form-group-transparent form-group-border-bottom">-->
                        <!--    <div class="input-group" style="width:100%">-->
                        <!--        <div class="input-group-addon">-->
                        <!--            分站可选择域名-->
                        <!--        </div>-->
                        <!--        <div  style="color:#696969" class="form-control form-control-left">默认使用主站域名，没有请留空</div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="form-group form-group-transparent form-group-border-bottom">-->
                        <!--    <textarea class="form-control" name="ktfz_domain" style="min-height: 100px;text-align: left" placeholder="请勿随意填写！多个域名用,隔开"></textarea>-->
                        <!--</div>-->
                                                                                    <div class="form-group form-group-transparent form-group-border-bottom">
                            <div class="input-group" style="width:100%">
                                <div class="input-group-addon">
                                    本站域名
                                </div>
                                <input type="text" style="text-align: left" name="domain" value="<?php echo $userrow['domain']?>" class="form-control" disabled="">
                                <span class="input-group-addon ">
    	  	                       <a href="cdomain.php" style="color: #0b9ff5;font-size: 1.1rem;font-weight: 0">自助更换</a>
    	                    	</span>
                            </div>
                        </div>
                <!--        <div class="form-group form-group-transparent form-group-border-bottom"> -->
                <!--            <div class="input-group" style="width:100%"> -->
                <!--                <div class="input-group-addon"> -->
                <!--                    备用域名 -->
                <!--                </div> -->
                <!--                <input type="text" style="text-align: left" name="domain2" value="<?php echo $userrow['domain2']?>" class="form-control" disabled=""> -->
                <!--                <div class="input-group-addon "> -->
                <!--                    <a href="cdomain2.php" style="color: #0b9ff5;font-size: 1.1rem;font-weight: 0">自助更换</a> -->
                <!--                </div> -->
                <!--            </div> -->
                <!--        </div> -->
                                        <div class="form-group form-group-transparent form-group-border-bottom">
                        <div class="input-group" style="width:100%">
                            <div class="input-group-addon">
                                APP下载地址
                            </div>
                            <input type="text" name="appurl" value="<?php echo $userrow['appurl']; ?>" class="form-control" placeholder="生成APP后将会自动填入">
                        </div>
                    </div>

                </div>
                <div class="text-center" style="padding: 30px 0;">
                    <input type="submit" name="submit" class="btn submit_btn" style="width: 80%;padding:8px;" value="确定修改">
                </div>
            </form>

                </div>
</div>

<script src="//cdn.staticfile.org/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
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
    function fileSelect(id) {
        $("#" + id).trigger("click");
    }

    function fileUpload(id, fileurl) {

        var fileObj = $("#" + id + "_upload" )[0].files[0];
        if (typeof (fileObj) == "undefined" || fileObj.size <= 0) {
            return;
        }
        var formData = new FormData();
        formData.append("do", "upload");
        formData.append("type", "user");
        formData.append("file", fileObj);
        formData.append("fileurl", fileurl);
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            url: "ajax_user.php?act=upload_qrcode",
            data: formData,
            type: "POST",
            dataType: "json",
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function (xmlHttp) {
                xmlHttp.setRequestHeader("If-Modified-Since", "0");
                xmlHttp.setRequestHeader("Cache-Control", "no-cache");
            },
            success: function (data) {
                layer.close(ii);
                if (data.code == 0) {
                    layer.msg('上传图片成功');
                    $("#" + id).attr("src", '../' + data.url + "?ran=" + Math.random());
                    if(id == 'lunbo'){
                        $("#del_lunbo").removeClass("del_icon");

                    }

                } else {
                    layer.alert(data.msg);
                }
            },
            error: function (data) {
                layer.msg('服务器错误');
                return false;
            }
        })
    }

    function del_img(id, fileurl) {

        var formData = new FormData();
        formData.append("fileurl", fileurl);
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            url: "ajax_user.php?act=del_img",
            data: formData,
            type: "POST",
            dataType: "json",
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) {
                layer.close(ii);
                if (data.code == 0) {
                    layer.msg('删除成功');
                    $("#" + id).attr("src", '../assets/user/img/add_img.svg?ran=' + Math.random());
                    if(id == 'lunbo'){
                        $("#del_lunbo").addClass("del_icon");

                    }
                } else {
                    layer.alert(data.msg);
                }
            },
            error: function (data) {
                layer.msg('服务器错误');
                return false;
            }
        })
    }

    $("#send").click(function () {
        var checked = 1;
        var phone = $("input[name='phone']").val();
        var myreg = /^(((12[0-9]{1})|(13[0-9]{1})|(14[0-9]{1})|(15[0-9]{1})|(16[0-9]{1})|(17[0-9]{1})|(19[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        if (!myreg.test(phone)) {
            layer.alert('请输入有效的手机号码！');
            return false;

        }
        $.get("ajax.php?act=checkphone", {'phone': phone}, function (data) {
            if (data == 1) {
                layer.alert('你所填写的手机号已存在！');
                return false;
            } else {
                layer.open({
                    title: '请输入验证码'
                    ,
                    btn: ['发送验证码']

                    ,
                    btnAlign: 'c'
                    ,
                    content: '<div class="form-group" style="border-radius: 50px;overflow:hidden;border: 0px solid #ccc;background: #f1f1f1;">' +
                        '<div class="input-group" style="margin-top: 0px;  margin-bottom: 0px;">' +
                        '<div class="input-group-addon" style="border: 0px solid #ccc;background-color: #f1f1f1;"><span class="fa fa-shield"></span></div>' +
                        '<input type="text" name="phone_verify" id="phone_verify" style="height:35px;border-color:#f1f1f1 ;background: #f1f1f1;text-align: center;" class="form-control input-lg" required="required" placeholder="输入验证码"/>' +
                        ' <span class="input-group-addon" style="padding: 0">' +
                        '<img id="codeimg" src="./code.php?r=1653171428" height="35" onclick="this.src=\'./code.php?r=\'+Math.random();" title="点击更换验证码">' +
                        '</span>' +
                        ' </div>' +
                        '</div>',
                    yes: function (index, layero) {
                        var phone_verify = $('#phone_verify').val();
                        if (phone_verify == "") {
                            layer.msg("请输入验证码");
                            return false;
                        }
                        var time = 60;
                        $.ajax({
                            type: "POST",
                            url: "ajax.php?act=tx_send",
                            data: {
                                phone: phone,
                                phone_verify, phone_verify
                            },
                            dataType: 'json',
                            success: function (data) {

                                if (data.code == 1) {

                                    layer.alert(data.message);

                                    function timeCountDown() {
                                        if (time == 0) {
                                            clearInterval(timer);
                                            $('#send').val("发送验证码");
                                            $('#send').removeAttr("disabled");
                                            checked = 1;
                                            return true;
                                        }
                                        $('#send').val(time + "S");
                                        time--;
                                        return false;
                                        checked = 0;
                                    }

                                    $('#send').attr("disabled", true);
                                    timeCountDown();
                                    var timer = setInterval(timeCountDown, 1000);

                                } else {

                                    layer.alert(data.message);

                                }

                            }
                        });
                    },
                });
            }
        });
    });
</script>
<?php
/*}elseif($mod=='copygg_n' && $_POST['do']=='submit' && $userrow['power']>0){
	$url=$_POST['url'];
	$content=$_POST['content'];
	$url_arr = parse_url($url);
	if($url_arr['host']==$_SERVER['HTTP_HOST'])showmsg('无法自己复制自己',3);
	$data = get_curl($url.'api.php?act=siteinfo');
	$arr = json_decode($data,true);
	if(array_key_exists('sitename',$arr)){
		if(in_array('anounce',$content))$anounce = str_replace($arr['kfqq'],$userrow['qq'],$arr['anounce']);
		else $anounce = $userrow['anounce'];
		if(in_array('modal',$content))$modal = str_replace($arr['kfqq'],$userrow['qq'],$arr['modal']);
		else $modal = $userrow['modal'];
		if(in_array('bottom',$content))$bottom = str_replace($arr['kfqq'],$userrow['qq'],$arr['bottom']);
		else $bottom = $userrow['bottom'];
		$sds=$DB->exec("UPDATE pre_site SET anounce=:anounce,modal=:modal,bottom=:bottom WHERE zid=:zid", [':anounce'=>$anounce, ':modal'=>$modal, ':bottom'=>$bottom, ':zid'=>$userrow['zid']]);
		if($sds!==false)exit("<script language='javascript'>alert('修改保存成功！');history.go(-1);</script>");
		else exit("<script language='javascript'>alert('修改保存失败:".$DB->error()."');history.go(-1);</script>");
	}else{
		showmsg('获取数据失败，对方网站无法连接或非代刷网站。',4);
	}
}elseif($mod=='copygg'){
?>
<div class="panel panel-default">
<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;">一键复制其他站点排版</div>
<div class="panel-body">
  <form action="./uset.php?mod=copygg_n" method="post" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
	  <label>站点URL</label>
	  <input type="text" name="url" value="" class="form-control" placeholder="http://www.qq.com/" required/>
	</div><br/>
	<div class="form-group">
	  <label>复制内容：</label><br>
	  <label><input name="content[]" type="checkbox" value="anounce" checked/> 首页公告</label><br/><label><input name="content[]" type="checkbox" value="modal" checked/> 弹出公告</label><br/><label><input name="content[]" type="checkbox" value="bottom" checked/> 底部排版</label>
	</div>
	<input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/>
  </form>
</div>
</div>
<?php
*/
}elseif($mod=='logo' && $userrow['power']>0 && $conf['fenzhan_edithtml']==1){
echo '<div class="panel panel-default">
<div class="panel-heading font-bold" style="background-color: #9999CC;color: white;" >更改首页LOGO</div>
<div class="panel-body">提示：部分模板不显示logo图片，是正常现象！<br/>';
if($_POST['s']==1){
if(!checkRefererHost())exit();
$extension=explode('.',$_FILES['file']['name']);
if (($length = count($extension)) > 1) {
$ext = strtolower($extension[$length - 1]);
}
copy($_FILES['file']['tmp_name'], ROOT.'assets/img/logo_'.$userrow['zid'].'.png');
echo "成功上传图片，刷新即可！";
}
if(file_exists(ROOT.'assets/img/logo_'.$userrow['zid'].'.png')){
	$logo = '../assets/img/logo_'.$userrow['zid'].'.png';
}else{
	$logo = '../assets/img/logo.png';
}
echo '<form action="uset.php?mod=logo" method="POST" enctype="multipart/form-data"><label for="file"></label><input type="file" name="file" id="file" /><input type="hidden" name="s" value="1" /><br><input type="submit" class="btn btn-primary form-control" value="确认上传" /></form><br>现在的图片：<br><img src="'.$logo.'" style="max-width:30%">';
echo '</div></div>';
}elseif($mod=='skimg' && $userrow['power']>0){
	
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
                <a href="uset.php?mod=user"  class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.4rem" src="../assets/img/fanhui.png">&nbsp;
                </a>
                <div style="margin: 0px 8px; border-left: 1px solid rgb(214, 215, 217); height: 16px; border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-bottom-color: rgb(214, 215, 217);"></div>
                <a href="../" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.8rem" src="../assets/img/home1.png">&nbsp;
                </a>
            </div>
            <div style="font-size: 15px;">
            <font><a href="">提现收款图设置</a></font>

            </div>
                </div>
            <div  style="background: #f2f2f2; height: 10px"></div>
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
            <div class="my-cell-title display-row justify-between align-center">
                <div class="my-cell-title-l left-title" style="font-size:1.4rem">提现收款图上传</div>
            </div>';
if($_POST['s']==1){
if(!checkRefererHost())exit();
$extension=explode('.',$_FILES['shoukuan']['name']);
if (($length = count($extension)) > 1) {
$ext = strtolower($extension[$length - 1]);
}
copy($_FILES['shoukuan']['tmp_name'], ROOT.'assets/img/skimg/sk_'.$userrow['zid'].'.png');
echo "成功上传图片，刷新即可！";
}
if(file_exists(ROOT.'assets/img/skimg/sk_'.$userrow['zid'].'.png')){
	$logo = '../assets/img/skimg/sk_'.$userrow['zid'].'.png';
}else{
	$logo = '../assets/img/skimg/sk.png';
}
echo '<form action="uset.php?mod=skimg" method="POST" enctype="multipart/form-data"><label for="file"></label>


<input type="file" name="shoukuan" id="shoukuan" />

<input type="hidden" name="s" value="1" /><br>


<div class="text-center" style="padding: 3px 0;">
                    <input type="submit" name="submit" class="btn submit_btn" style="width: 80%;padding:8px;" value="确定上传"><br><br>
                </div>
</form>
 </div>
         <div style="background: #f2f2f2; height: 10px"></div>
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
            <div class="my-cell-title display-row justify-between align-center">
                <div class="my-cell-title-l left-title" style="font-size:1.4rem">现在的收款图</div>
            </div><img src="'.$logo.'" style="max-width:30%">
            <br><br>
               <div class="form-group form-group-transparent" style="font-size:1.15rem; color: #FF0000;">
                   *温馨提示：图片上传一次即可，无需多次上传，即使重新进未刷新也无需再次上传。只是缓存问题而已，换个浏览器即可查看到！
               </div>
            
            ';
echo '</div></div>';
}elseif($mod=='upwxqrcode' && $userrow['power']>0 && $conf['fenzhan_kfqq']==1){
	if(isset($_GET['del']) && $_GET['del']==1){
		if(file_exists(ROOT.'assets/img/qrcode/wxqrcode_'.$userrow['zid'].'.png')){
			unlink(ROOT.'assets/img/qrcode/wxqrcode_'.$userrow['zid'].'.png');
		}
		exit("<script language='javascript'>alert('删除成功');window.location.href='./uset.php?mod=upwxqrcode';</script>");
	}
echo '<div class="col-xs-12 col-sm-10 col-md-6 col-lg-4 center-block " style="float: none; background-color:#f2f2f2;padding:0">
    <div class="block  block-all">
        <div class="block-back block-white">
            <a href="uset.php?mod=site" class="font-weight display-row align-center">
                <img style="height: 2rem" src="../assets/user/img/close.png"></img>&nbsp;&nbsp;
                <font><a href="">微信客服二维码设置</a></font>
            </a>
        </div>
        

        <div style="background: #f2f2f2; height: 10px"></div>
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
            <div class="my-cell-title display-row justify-between align-center">
                <div class="my-cell-title-l left-title" style="font-size:1.4rem">微信客服二维码上传</div>
            </div>';
if($_POST['s']==1){
if(!checkRefererHost())exit();
$extension=explode('.',$_FILES['wxqrcode']['name']);
if (($length = count($extension)) > 1) {
$ext = strtolower($extension[$length - 1]);
}
copy($_FILES['wxqrcode']['tmp_name'], ROOT.'assets/img/qrcode/wxqrcode_'.$userrow['zid'].'.png');
echo "成功上传图片，刷新即可！";
}
if(file_exists(ROOT.'assets/img/qrcode/wxqrcode_'.$userrow['zid'].'.png')){
	$wxqrcode = '<br><img src="../assets/img/qrcode/wxqrcode_'.$userrow['zid'].'.png" style="max-width:30%">';
}elseif(!empty($userrow['kfqq'])){
	$wxqrcode = '当前未上传';
}else{
	$wxqrcode = '<b>自动同步主站</b>';
}
echo '<form action="uset.php?mod=upwxqrcode" method="POST" enctype="multipart/form-data"><label for="file"></label><input type="file" name="wxqrcode" id="wxqrcode" /><input type="hidden" name="s" value="1" /><br>

<div class="text-center" style="padding: 3px 0;">
                    <input type="submit" name="submit" class="btn submit_btn" style="width: 80%;padding:8px;" value="确定上传">
                </div>
<div class="text-center" style="padding: 3px 0;">
<a href="./uset.php?mod=upwxqrcode&del=1" class="btn submit_btn" style="width: 80%;padding:8px;">删除图片</a><br><br>
</form>
 </div> </div>
         <div style="background: #f2f2f2; height: 10px"></div>
        <div class="my-cell" style="margin-bottom: 0px;padding: 5px 10px;border-radius: 0">
            <div class="my-cell-title display-row justify-between align-center">
                <div class="my-cell-title-l left-title" style="font-size:1.4rem">现在的客服二维码</div>
            </div>
<br>'.$wxqrcode.'

            <br><br>
               <div class="form-group form-group-transparent" style="font-size:1.15rem; color: #FF0000;">
                   *温馨提示：图片上传一次即可，无需多次上传，即使重新进未刷新也无需再次上传。只是缓存问题而已，换个浏览器即可查看到！
               </div>

';


echo '</div></div>';
}?>
	</div>
</div>
<?php include './foot.php';?>
<script src="'.$cdnpubli.'jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
<?php if($mod=='user'){?>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default")||0);
}
<?php if($conf['fenzhan_daifu']==1){?>
var getopenid = function () {
    var open = layer.open({
        type:1,
        title:'',
        content:'<div class="layui-card-body"><h3 style="text-align:center">请使用微信扫一扫</h3><div><div id="qrcode" style="padding:15px;"></div></div></div>',
        cancel: function(index, layero){ 
            layer.close(open);
            window.clearInterval(cron); 
        },success: function(){ 
			var code_url = '<?php echo $code_url?>';
			$('#qrcode').qrcode({
				text: code_url,
				width: 230,
				height: 230,
				foreground: "#000000",
				background: "#ffffff",
				typeNumber: -1
			});
        }
    });
    var cron = setInterval(function(){
        $.ajax({
            type: "GET",
            url: '<?php echo $cron_url;?>'+'&r='+Math.random(),
            dataType: "json",
            success: function(data){
                if (data.code) {
                    $("input[name=pay_account]").val(data.data);
                    layer.close(open);
                    window.clearInterval(cron); 
                }
            }
        });
    },3000);
}
$("select[name='pay_type']").change(function(){
	if($(this).val() == 1){
		$("#getopenid").show();
		$("input[name=pay_account]").attr("readOnly","readOnly");
	}else{
		$("#getopenid").hide();
		$("input[name=pay_account]").removeAttr("readOnly");
	}
});
$("select[name='pay_type']").change();
<?php }?>

function setpwd(){
	var user = $("input[name='user']").val();
	var pwd = $("input[name='pwd']").val();
	if(user=='' || pwd==''){layer.alert('请确保每项不能为空！');return false;}
	if(user.length<3){
		layer.alert('用户名太短'); return false;
	}else if(user.length>20){
		layer.alert('用户名太长'); return false;
	}else if(pwd.length<6){
		layer.alert('密码不能低于6位'); return false;
	}else if(pwd.length>30){
		layer.alert('密码太长'); return false;
	}
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : "POST",
		url : "ajax_user.php?act=setpwd",
		data : {user:user, pwd:pwd},
		dataType : 'json',
		success : function(data) {
			layer.close(ii);
			if(data.code == 0){
				layer.alert(data.msg,{
				  closeBtn: 0
				}, function(){
				  window.location.reload();
				});
			}else{
				layer.alert(data.msg, {icon:0});
			}
		} 
	});
	return false;
}
function connect(type){
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		type : "POST",
		url : "ajax.php?act=connect",
		data : {type:type},
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
function unbind(type){
	var confirmobj = layer.confirm('解绑后将无法通过QQ一键登录，是否确定解绑？', function () {
	var ii = layer.load(2, {shade:[0.1,'#fff']});
		$.ajax({
			type : "POST",
			url : "ajax.php?act=unbind",
			data : {type:type},
			dataType : 'json',
			success : function(data) {
				layer.close(ii);
				if(data.code == 0){
					layer.alert(data.msg, {icon: 1}, function(){ window.location.reload();});
				}else{
					layer.alert(data.msg, {icon: 0});
				}
			} 
		});
	}, function(){
	  layer.close(confirmobj);
	});
}
</script>
<?php }?>
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
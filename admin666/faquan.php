
<?php
/**
 * 发圈素材管理
**/
include("../includes/common.php");
$title='发圈素材管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>




<?php if($_GET['typesc']){
$id=$_GET['typesc'];
 $sql = "delete FROM `pre_faquan` where id='" . $id . "'";
 $DB->query($sql);
}?>
<?php if($_GET['type']=='add'){?>
  <script src="https://www.jq22.com/jquery/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="https://www.jq22.com/demo/TGTool202007201551/TGTool.css">
    <script src="https://www.jq22.com/demo/TGTool202007201551/TGTool.js"></script>
    	<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<div class="col-sm-12 col-md-12  col-lg-12 center-block" style="float: none;padding-top:10px ">
<div class="col-sm-12 col-md-12">
<div class="block">
<div class="block-title"><h3 class="panel-title">新增发圈素材</h3></div>


<button  onclick="spbc()" class="btn btn-primary btn-block">确定添加</button><br/>
<div class="form-group">
<label>内容:</label><br>
<textarea class="form-control" id="nr" rows="3" placeholder="请输入内容，若需要换行请在文字后面加上代码：<br>"></textarea>
</div>

<input type="file" onchange="tximg()" style="display: none;" id="tx">
<input type="file" onchange="tximg2()" style="display: none;" id="tx2">
<input type="file" onchange="tximg3()" style="display: none;" id="tx3">
<input type="file" onchange="tximg4()" style="display: none;" id="tx4">
<input type="file" onchange="tximg5()" style="display: none;" id="tx5">
<input type="file" onchange="tximg6()" style="display: none;" id="tx6">
<input type="file" onchange="tximg7()" style="display: none;" id="tx7">
<input type="file" onchange="tximg8()" style="display: none;" id="tx8">
<input type="file" onchange="tximg9()" style="display: none;" id="tx9">
<input type="file" onchange="tximg10()" style="display: none;" id="tx10">

<div class="form-group">
<label>视频:</label><br>
<input type="text" class="form-control" id="img10" value="" required="">
 <button class="btn btn-default" onclick="$('#tx10').click();" style="float:right;margin-top:-35px;">上传视频</button>
</div>
<div class="form-group">
<label>图片1:</label><br>
<input type="text" class="form-control" id="img" value="" required="">
 <button class="btn btn-default" onclick="$('#tx').click();" style="float:right;margin-top:-35px;">上传图片</button>
</div>
<div class="form-group">
<label>图片2:</label><br>
<input type="text" class="form-control" id="img2" value="" required="">
 <button class="btn btn-default" onclick="$('#tx2').click();" style="float:right;margin-top:-35px;">上传图片</button>
</div>
<div class="form-group">
<label>图片3:</label><br>
<input type="text" class="form-control" id="img3" value="" required="">
 <button class="btn btn-default" onclick="$('#tx3').click();" style="float:right;margin-top:-35px;">上传图片</button>
</div>
<div class="form-group">
<label>图片4:</label><br>
<input type="text" class="form-control" id="img4" value="" required="">
 <button class="btn btn-default" onclick="$('#tx4').click();" style="float:right;margin-top:-35px;">上传图片</button>
</div>
<div class="form-group">
<label>图片5:</label><br>
<input type="text" class="form-control" id="img5" value="" required="">
 <button class="btn btn-default" onclick="$('#tx5').click();" style="float:right;margin-top:-35px;">上传图片</button>
</div>
<div class="form-group">
<label>图片6:</label><br>
<input type="text" class="form-control" id="img6" value="" required="">
 <button class="btn btn-default" onclick="$('#tx6').click();" style="float:right;margin-top:-35px;">上传图片</button>
</div>



</div>
<br/>
<script>
  function spbc(){
      var name= $("#name").val();
      var nr= $("#nr").val();
      var img= $("#img").val();
      var img2= $("#img2").val();
      var img3= $("#img3").val();
      var img4= $("#img4").val();
      var img5= $("#img5").val();
      var img6= $("#img6").val();
      var img7= $("#img7").val();
      var img8= $("#img8").val();
      var img9= $("#img9").val();
      var img10= $("#img10").val();
      $.ajax({
type:"POST",//请求方式为post
url:"fqajax.php?act=shopxg",//请求的地址
dataType: "json",
data:{name:name,nr:nr,img:img,img2:img2,img3:img3,img4:img4,img5:img5,img6:img6,img7:img7,img8:img8,img9:img9,img10:img10},//参数
success: function(date){
  var tg = TGTool();
   
      tg.success(date.msg);
        console.log(date);
         window.setTimeout("window.location='faquan.php'",2000);
   
}
});
  }
    function tximg(){
        var formData = new FormData();
        formData.append('tx', $('#tx')[0].files[0]);
        $.ajax({
            url: 'fqajax.php?act=shopimg',
            type: 'POST',
            cache: false,
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false
        }).done(function(mag) {
            var tg = TGTool();
     if(mag.code==1){
        tg.error(mag.msg);
    }else if(mag.code==0){
        tg.success(mag.msg);
       // $("#shopimgdd").attr('src',mag.imgurl); 
        $("#img").val(mag.imgurl); 
    }
        }).fail(function(mag) {
      
        });
    }
        function tximg2(){
        var formData = new FormData();
        formData.append('tx2', $('#tx2')[0].files[0]);
        $.ajax({
            url: 'fqajax.php?act=shopimg2',
            type: 'POST',
            cache: false,
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false
        }).done(function(mag) {
            var tg = TGTool();
     if(mag.code==1){
        tg.error(mag.msg);
    }else if(mag.code==0){
        tg.success(mag.msg);
       // $("#shopimgdd").attr('src',mag.imgurl); 
        $("#img2").val(mag.imgurl); 
    }
        }).fail(function(mag) {
      
        });
    }
        function tximg3(){
        var formData = new FormData();
        formData.append('tx3', $('#tx3')[0].files[0]);
        $.ajax({
            url: 'fqajax.php?act=shopimg3',
            type: 'POST',
            cache: false,
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false
        }).done(function(mag) {
            var tg = TGTool();
     if(mag.code==1){
        tg.error(mag.msg);
    }else if(mag.code==0){
        tg.success(mag.msg);
       // $("#shopimgdd").attr('src',mag.imgurl); 
        $("#img3").val(mag.imgurl); 
    }
        }).fail(function(mag) {
      
        });
    }
        function tximg4(){
        var formData = new FormData();
        formData.append('tx4', $('#tx4')[0].files[0]);
        $.ajax({
            url: 'fqajax.php?act=shopimg4',
            type: 'POST',
            cache: false,
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false
        }).done(function(mag) {
            var tg = TGTool();
     if(mag.code==1){
        tg.error(mag.msg);
    }else if(mag.code==0){
        tg.success(mag.msg);
       // $("#shopimgdd").attr('src',mag.imgurl); 
        $("#img4").val(mag.imgurl); 
    }
        }).fail(function(mag) {
      
        });
    }
        function tximg5(){
        var formData = new FormData();
        formData.append('tx5', $('#tx5')[0].files[0]);
        $.ajax({
            url: 'fqajax.php?act=shopimg5',
            type: 'POST',
            cache: false,
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false
        }).done(function(mag) {
            var tg = TGTool();
     if(mag.code==1){
        tg.error(mag.msg);
    }else if(mag.code==0){
        tg.success(mag.msg);
       // $("#shopimgdd").attr('src',mag.imgurl); 
        $("#img5").val(mag.imgurl); 
    }
        }).fail(function(mag) {
      
        });
    }
        function tximg6(){
        var formData = new FormData();
        formData.append('tx6', $('#tx6')[0].files[0]);
        $.ajax({
            url: 'fqajax.php?act=shopimg6',
            type: 'POST',
            cache: false,
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false
        }).done(function(mag) {
            var tg = TGTool();
     if(mag.code==1){
        tg.error(mag.msg);
    }else if(mag.code==0){
        tg.success(mag.msg);
       // $("#shopimgdd").attr('src',mag.imgurl); 
        $("#img6").val(mag.imgurl); 
    }
        }).fail(function(mag) {
      
        });
    }
        function tximg7(){
        var formData = new FormData();
        formData.append('tx7', $('#tx7')[0].files[0]);
        $.ajax({
            url: 'fqajax.php?act=shopimg7',
            type: 'POST',
            cache: false,
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false
        }).done(function(mag) {
            var tg = TGTool();
     if(mag.code==1){
        tg.error(mag.msg);
    }else if(mag.code==0){
        tg.success(mag.msg);
       // $("#shopimgdd").attr('src',mag.imgurl); 
        $("#img7").val(mag.imgurl); 
    }
        }).fail(function(mag) {
      
        });
    }
        function tximg8(){
        var formData = new FormData();
        formData.append('tx8', $('#tx8')[0].files[0]);
        $.ajax({
            url: 'fqajax.php?act=shopimg8',
            type: 'POST',
            cache: false,
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false
        }).done(function(mag) {
            var tg = TGTool();
     if(mag.code==1){
        tg.error(mag.msg);
    }else if(mag.code==0){
        tg.success(mag.msg);
       // $("#shopimgdd").attr('src',mag.imgurl); 
        $("#img8").val(mag.imgurl); 
    }
        }).fail(function(mag) {
      
        });
    }
        function tximg9(){
        var formData = new FormData();
        formData.append('tx9', $('#tx9')[0].files[0]);
        $.ajax({
            url: 'fqajax.php?act=shopimg9',
            type: 'POST',
            cache: false,
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false
        }).done(function(mag) {
            var tg = TGTool();
     if(mag.code==1){
        tg.error(mag.msg);
    }else if(mag.code==0){
        tg.success(mag.msg);
       // $("#shopimgdd").attr('src',mag.imgurl); 
        $("#img9").val(mag.imgurl); 
    }
        }).fail(function(mag) {
      
        });
    }
        function tximg10(){
        var formData = new FormData();
        formData.append('tx10', $('#tx10')[0].files[0]);
        $.ajax({
            url: 'fqajax.php?act=shopimg10',
            type: 'POST',
            cache: false,
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false
        }).done(function(mag) {
            var tg = TGTool();
     if(mag.code==1){
        tg.error(mag.msg);
    }else if(mag.code==0){
        tg.success(mag.msg);
       // $("#shopimgdd").attr('src',mag.imgurl); 
        $("#img10").val(mag.imgurl); 
    }
        }).fail(function(mag) {
      
        });
    }
    </script>
</script>
<?php die;}?>

<div class="col-sm-12 col-md-12 col-lg-12 center-block" style="float: none;padding-top: 10px;">
            <div class="block">
                <div class="block-title">
                    <h2>发圈列表</h2>
                </div>
                <a href="./faquan.php?type=add" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;发布新素材</a>
                <div id="pcTable" class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                              
                                <th>
                                  id
                                </th>
                                <th>
                                    内容
                                </th>
                                <th>
                                    操作
                                </th>
                            </tr>
                        </thead>
                        <tbody>
   <?php		$rs=$DB->query("SELECT * FROM pre_faquan order by id desc");
    while ($res = $rs->fetch()) {?>
                         
                            <td>  <b><?php echo $res['id']?></b></td>
                            <td><?php echo $res['nr']?></td>
                            <td><a href="?typesc=<?php echo $res['id']?>" class="btn btn-danger btn-xs"> 删除</a>&nbsp;</td
                            >
                       </tr><?php }?>
                       </tbody>
        </table>
      </div>
     
    
            </div>
        </div>

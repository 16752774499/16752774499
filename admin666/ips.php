<?php
include('../includes/common.php');
$title='IP黑名单设置';
include('./head.php');
if ($islogin!=1) 
{
	exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}

$rows=$DB->getRow("select * from shua_ip where id=1 limit 1");
if($_GET){
  
   $sds=$DB->update('ip', array('ips'=>$_GET['ips']), 'id=1');
   if($sds){
     echo ('<script language=\'javascript\'>alert(\'保存成功\');window.location.href=\'./ips.php\';</script>');  
   }else{
     echo ('<script language=\'javascript\'>alert(\'保存失败\');window.location.href=\'./ips.php\';</script>');   
   }
}

?>
  <script src="https://www.jq22.com/jquery/jquery-1.10.2.js"></script>
    <link rel="stylesheet" href="https://www.jq22.com/demo/TGTool202007201551/TGTool.css">
    <script src="https://www.jq22.com/demo/TGTool202007201551/TGTool.js"></script>
    	<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<div class="col-sm-12 col-md-12  col-lg-12 center-block" style="float: none;padding-top:10px ">
<div class="col-sm-12 col-md-12">
<div class="block">
<form action="" method="get">
<p style="font-size: 28px;">IP之间用英文逗号分隔</p>
<button type="submit">提交保存</button><br>
<label for="ips"></label>
<p><textarea  id="ips" name="ips" style="width:400px;height:400px"><?php echo $rows['ips']?></textarea></p>



</form>
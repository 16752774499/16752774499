<?php
include('../includes/common.php');
$title='分销设置';
include('./head.php');
if ($islogin!=1) 
{
	exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}

$rows=$DB->getRow("select * from shua_fxbl where id=1 limit 1");
if($_GET){
   $data=array(
      'lv1'=>$_GET['lv1']?$_GET['lv1']:'', 
      'lv2'=>$_GET['lv2']?$_GET['lv2']:'', 
      'lv3'=>$_GET['lv3']?$_GET['lv3']:'', 
      'lv4'=>$_GET['lv4']?$_GET['lv4']:'', 
      'lv5'=>$_GET['lv5']?$_GET['lv5']:'', 
      'lv6'=>$_GET['lv6']?$_GET['lv6']:'', 
      'lv7'=>$_GET['lv7']?$_GET['lv7']:'', 
      'lv8'=>$_GET['lv8']?$_GET['lv8']:'', 
      'lv9'=>$_GET['lv9']?$_GET['lv9']:'', 
      'lv10'=>$_GET['lv10']?$_GET['lv10']:'', 
      'lv11'=>$_GET['lv11']?$_GET['lv11']:'', 
      'lv12'=>$_GET['lv12']?$_GET['lv12']:'', 
      'lv13'=>$_GET['lv13']?$_GET['lv13']:'', 
      'lv14'=>$_GET['lv14']?$_GET['lv14']:'', 
      'lv15'=>$_GET['lv15']?$_GET['lv15']:'', 
      'lv16'=>$_GET['lv16']?$_GET['lv16']:'', 
      'lv17'=>$_GET['lv17']?$_GET['lv17']:'', 
      'lv18'=>$_GET['lv18']?$_GET['lv18']:'', 
      'lv19'=>$_GET['lv19']?$_GET['lv19']:'', 
      'lv20'=>$_GET['lv20']?$_GET['lv20']:'', 
       ); 

   $sds=$DB->update('fxbl', $data, 'id=1');
   if($sds){
     echo ('<script language=\'javascript\'>alert(\'保存成功\');window.location.href=\'./fxsz.php\';</script>');  
   }else{
     echo ('<script language=\'javascript\'>alert(\'保存失败\');window.location.href=\'./fxsz.php\';</script>');   
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
    
<button type="submit">提交保存</button><br><br>

<p>一级分销佣金设置 <input type="text" name="lv1" value="<?php echo $rows['lv1']?>"></p>
<p>二级分销佣金设置 <input type="text" name="lv2" value="<?php echo $rows['lv2']?>"></p>
<p>三级分销佣金设置 <input type="text" name="lv3" value="<?php echo $rows['lv3']?>"></p>
<p>四级分销佣金设置 <input type="text" name="lv4" value="<?php echo $rows['lv4']?>"></p>

<p>五级分销佣金设置 <input type="text" name="lv5" value="<?php echo $rows['lv5']?>"></p>
<p>六级分销佣金设置 <input type="text" name="lv6" value="<?php echo $rows['lv6']?>"></p>
<p>七级分销佣金设置 <input type="text" name="lv7" value="<?php echo $rows['lv7']?>"></p>
<p>八级分销佣金设置 <input type="text" name="lv8" value="<?php echo $rows['lv8']?>"></p>

<p>九级分销佣金设置 <input type="text" name="lv9" value="<?php echo $rows['lv9']?>"></p>
<p>十级分销佣金设置 <input type="text" name="lv10" value="<?php echo $rows['lv10']?>"></p>
<p>11级分销佣金设置 <input type="text" name="lv11" value="<?php echo $rows['lv11']?>"></p>
<p>12级分销佣金设置 <input type="text" name="lv12" value="<?php echo $rows['lv12']?>"></p>

<p>13级分销佣金设置 <input type="text" name="lv13" value="<?php echo $rows['lv13']?>"></p>
<p>14级分销佣金设置 <input type="text" name="lv14" value="<?php echo $rows['lv14']?>"></p>
<p>15级分销佣金设置 <input type="text" name="lv15" value="<?php echo $rows['lv15']?>"></p>
<p>16级分销佣金设置 <input type="text" name="lv16" value="<?php echo $rows['lv16']?>"></p>

<p>17级分销佣金设置 <input type="text" name="lv17" value="<?php echo $rows['lv17']?>"></p>
<p>18级分销佣金设置 <input type="text" name="lv18" value="<?php echo $rows['lv18']?>"></p>
<p>19级分销佣金设置 <input type="text" name="lv19" value="<?php echo $rows['lv19']?>"></p>
<p>20级分销佣金设置 <input type="text" name="lv20" value="<?php echo $rows['lv20']?>"></p>



</form>
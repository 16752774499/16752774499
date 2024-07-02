<?php 
include "../includes/common.php";
$act=$_GET['act'];
if($act=="shopxg"){
$name=$_POST['name'];
$nr=$_POST['nr'];
$img=$_POST['img'];
$img2=$_POST['img2'];
$img3=$_POST['img3'];
$img4=$_POST['img4'];
$img5=$_POST['img5'];
$img6=$_POST['img6'];
$img7=$_POST['img7'];
$img8=$_POST['img8'];
$img9=$_POST['img9'];
$img10=$_POST['img10'];
 $sql = "INSERT into `pre_faquan` (`name`,`nr`,`img`,`img2`,`img3`,`img4`,`img5`,`img6`,`img7`,`img8`,`img9`,`img10`) VALUES('" . $name . "','" . $nr . "','" . $img . "','" . $img2 . "','" . $img3 . "','" . $img4 . "','" . $img5 . "','" . $img6 . "','" . $img7 . "','" . $img8 . "','" . $img9 . "','" . $img10 . "')";
$DB->exec($sql);
    exit('{"code":0,"msg":"添加成功"}');
}

if($act=="shopimg"){
    $img = $_FILES['tx'];
    //获取上图片后缀
    $type = strstr($img['name'], '.');
    $rand = rand(1000, 9999);
    //命名图片名称
    $pics = date("YmdHis") . $rand . $type; 
    //上传路径
    $pic_path = "../shopimg/". $pics;
    //移动到指定目录，上传图片
    $res = move_uploaded_file($img['tmp_name'], $pic_path);
    if($res){
        exit('{"code":0,"msg":"上传商品图片成功","imgurl":"'.$pic_path.'"}');
    }else{
        exit('{"code":1,"msg":"上传商品图片失败"}');
    }
    
}
if($act=="shopimg2"){
    $img = $_FILES['tx2'];
    //获取上图片后缀
    $type = strstr($img['name'], '.');
    $rand = rand(1000, 9999);
    //命名图片名称
    $pics = date("YmdHis") . $rand . $type; 
    //上传路径
    $pic_path = "../shopimg/". $pics;
    //移动到指定目录，上传图片
    $res = move_uploaded_file($img['tmp_name'], $pic_path);
    if($res){
        exit('{"code":0,"msg":"上传商品图片成功","imgurl":"'.$pic_path.'"}');
    }else{
        exit('{"code":1,"msg":"上传商品图片失败"}');
    }
    
}
if($act=="shopimg3"){
    $img = $_FILES['tx3'];
    //获取上图片后缀
    $type = strstr($img['name'], '.');
    $rand = rand(1000, 9999);
    //命名图片名称
    $pics = date("YmdHis") . $rand . $type; 
    //上传路径
    $pic_path = "../shopimg/". $pics;
    //移动到指定目录，上传图片
    $res = move_uploaded_file($img['tmp_name'], $pic_path);
    if($res){
        exit('{"code":0,"msg":"上传商品图片成功","imgurl":"'.$pic_path.'"}');
    }else{
        exit('{"code":1,"msg":"上传商品图片失败"}');
    }
    
}
if($act=="shopimg4"){
    $img = $_FILES['tx4'];
    //获取上图片后缀
    $type = strstr($img['name'], '.');
    $rand = rand(1000, 9999);
    //命名图片名称
    $pics = date("YmdHis") . $rand . $type; 
    //上传路径
    $pic_path = "../shopimg/". $pics;
    //移动到指定目录，上传图片
    $res = move_uploaded_file($img['tmp_name'], $pic_path);
    if($res){
        exit('{"code":0,"msg":"上传商品图片成功","imgurl":"'.$pic_path.'"}');
    }else{
        exit('{"code":1,"msg":"上传商品图片失败"}');
    }
    
}
if($act=="shopimg5"){
    $img = $_FILES['tx5'];
    //获取上图片后缀
    $type = strstr($img['name'], '.');
    $rand = rand(1000, 9999);
    //命名图片名称
    $pics = date("YmdHis") . $rand . $type; 
    //上传路径
    $pic_path = "../shopimg/". $pics;
    //移动到指定目录，上传图片
    $res = move_uploaded_file($img['tmp_name'], $pic_path);
    if($res){
        exit('{"code":0,"msg":"上传商品图片成功","imgurl":"'.$pic_path.'"}');
    }else{
        exit('{"code":1,"msg":"上传商品图片失败"}');
    }
    
}
if($act=="shopimg6"){
    $img = $_FILES['tx6'];
    //获取上图片后缀
    $type = strstr($img['name'], '.');
    $rand = rand(1000, 9999);
    //命名图片名称
    $pics = date("YmdHis") . $rand . $type; 
    //上传路径
    $pic_path = "../shopimg/". $pics;
    //移动到指定目录，上传图片
    $res = move_uploaded_file($img['tmp_name'], $pic_path);
    if($res){
        exit('{"code":0,"msg":"上传商品图片成功","imgurl":"'.$pic_path.'"}');
    }else{
        exit('{"code":1,"msg":"上传商品图片失败"}');
    }
    
}
if($act=="shopimg7"){
    $img = $_FILES['tx7'];
    //获取上图片后缀
    $type = strstr($img['name'], '.');
    $rand = rand(1000, 9999);
    //命名图片名称
    $pics = date("YmdHis") . $rand . $type; 
    //上传路径
    $pic_path = "../shopimg/". $pics;
    //移动到指定目录，上传图片
    $res = move_uploaded_file($img['tmp_name'], $pic_path);
    if($res){
        exit('{"code":0,"msg":"上传商品图片成功","imgurl":"'.$pic_path.'"}');
    }else{
        exit('{"code":1,"msg":"上传商品图片失败"}');
    }
    
}
if($act=="shopimg8"){
    $img = $_FILES['tx8'];
    //获取上图片后缀
    $type = strstr($img['name'], '.');
    $rand = rand(1000, 9999);
    //命名图片名称
    $pics = date("YmdHis") . $rand . $type; 
    //上传路径
    $pic_path = "../shopimg/". $pics;
    //移动到指定目录，上传图片
    $res = move_uploaded_file($img['tmp_name'], $pic_path);
    if($res){
        exit('{"code":0,"msg":"上传商品图片成功","imgurl":"'.$pic_path.'"}');
    }else{
        exit('{"code":1,"msg":"上传商品图片失败"}');
    }
    
}
if($act=="shopimg9"){
    $img = $_FILES['tx9'];
    //获取上图片后缀
    $type = strstr($img['name'], '.');
    $rand = rand(1000, 9999);
    //命名图片名称
    $pics = date("YmdHis") . $rand . $type; 
    //上传路径
    $pic_path = "../shopimg/". $pics;
    //移动到指定目录，上传图片
    $res = move_uploaded_file($img['tmp_name'], $pic_path);
    if($res){
        exit('{"code":0,"msg":"上传商品图片成功","imgurl":"'.$pic_path.'"}');
    }else{
        exit('{"code":1,"msg":"上传商品图片失败"}');
    }
    
}
if($act=="shopimg10"){
    $img = $_FILES['tx10'];
    //获取上图片后缀
    $type = strstr($img['name'], '.');
    $rand = rand(1000, 9999);
    //命名图片名称
    $pics = date("YmdHis") . $rand . $type; 
    //上传路径
    $pic_path = "../shopimg/". $pics;
    //移动到指定目录，上传图片
    $res = move_uploaded_file($img['tmp_name'], $pic_path);
    if($res){
        exit('{"code":0,"msg":"上传商品图片成功","imgurl":"'.$pic_path.'"}');
    }else{
        exit('{"code":1,"msg":"上传商品图片失败"}');
    }
    
}
?>
<?php

error_reporting(0);
require 'phpqrcode.php';
$id = isset($_GET['id'])?intval($_GET['id']):exit();
$url = isset($_GET['url'])?trim($_GET['url']):exit();
if($id<1 || $id>20)exit();

$backgrounds = array('adv2.jpg','adv3.jpg','adv4.jpg','adv6.jpg','adv9.jpg','adv8.jpg','adv7.jpg','adv5.jpg');//����

$imagesx = array(750,38,520,520,680,140,460,308);//������

$imagesy = array(1600,1430,1750,1780,1512,1615,1580,1092);//���ϵ���

$imagesize = array(220,280,250,250,180,190,200,120);//��С


//ͼƬһ
$path_1 = './img/'.$backgrounds[$id-1];
//ͼƬ��
$QRcode = new QRcode();
ob_start();
$QRcode->png($url, false, 'L', 10, 2);
$qrcodedata = ob_get_contents();
ob_end_clean();

//����ͼƬ����
//imagecreatefrompng($filename)--���ļ��� URL ����һ����ͼ��
$image_1 = imagecreatefromjpeg($path_1);
$image_2 = imagecreatefromstring($qrcodedata);
//���Ŷ�ά��ͼƬ
$qrcodelength = $imagesize[$id-1];
$image_3 = imagecreate($qrcodelength, $qrcodelength);
imagecolorallocate($image_3,255,255,255);
imagecopyresampled($image_3, $image_2, 0, 0, 0, 0, $qrcodelength, $qrcodelength, imagesx($image_2), imagesy($image_2));
//�ϳ�ͼƬ
//imagecopymerge ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h , int $pct )---�������ϲ�ͼ���һ����
//�� src_im ͼ��������� src_x��src_y ��ʼ�����Ϊ src_w���߶�Ϊ src_h ��һ���ֿ����� dst_im ͼ��������Ϊ dst_x �� dst_y ��λ���ϡ���ͼ�񽫸��� pct �������ϲ��̶ȣ���ֵ��Χ�� 0 �� 100���� pct = 0 ʱ��ʵ����ʲôҲû������Ϊ 100 ʱ���ڵ�ɫ��ͼ�񱾺����� imagecopy() ��ȫһ�����������ɫͼ��ʵ���� alpha ͸����
imagecopymerge($image_1, $image_3, $imagesx[$id-1], $imagesy[$id-1], 0, 0, $qrcodelength, $qrcodelength, 100);
// ����ϳ�ͼƬ
//imagepng($image[,$filename]) �� �� PNG ��ʽ��ͼ���������������ļ�
$seconds_to_cache = 3600*24;
header("Pragma: cache");
header("Cache-Control: max-age=$seconds_to_cache");
header('Content-type: image/png');
header("Content-Disposition: filename=icon.png");
imagepng($image_1);
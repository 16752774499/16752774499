
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>免费商品卡密</title>
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
$is_defend=true;
require '../includes/common.php';
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$title = '免费商品卡密';

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
                <a href="javascript:history.back()"  class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.4rem" src="../assets/img/fanhui.png">&nbsp;
                </a>
                <div style="margin: 0px 8px; border-left: 1px solid rgb(214, 215, 217); height: 16px; border-top-color: rgb(214, 215, 217); border-right-color: rgb(214, 215, 217); border-bottom-color: rgb(214, 215, 217);"></div>
                <a href="../" class="font-weight display-row align-center" style="height: 1.6rem;line-height: 1.65rem;width: 50%">
                    <img style="height: 1.8rem" src="../assets/img/home1.png">&nbsp;
                </a>
            </div>
            <div style="font-size: 15px;">
            <font><a href="">API对接免费商品卡密</a></font>

            </div>
                </div>
            <div  style="background: #f2f2f2; height: 10px"></div>
            <div style="font-size: 1.1rem;color: #999999;padding: 5px 10px">
            <p style="color:#454E59;font-size:14px;background-color:#FFFFFF;">当前共32件商品</p>
            </div>

            <div class="my-cell" style="margin-bottom: 0px;padding: 0 8px;">

                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">一部手机每天动动手指就能日入100+可批量操作，新手小白无脑撸，收益无上限</div>
                    <p>链链接:https://pan.baidu.com/s/17TlznTyQLJPmgiUfFACx8g?pwd=dnps提取码:dnps
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/17TlznTyQLJPmgiUfFACx8g?pwd=dnps提取码:dnps">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>

                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">利用QQ查万物，API查询各类信息</div>
                    <p>链接:https://pan.baidu.com/s/1717iowfx2TdjMkQwDh6-vg?pwd=xeiy提取码:xeiy
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1717iowfx2TdjMkQwDh6-vg?pwd=xeiy提取码:xeiy">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>

                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">外面收费108的烟盒回收平台，每天轻松领低保</div>
                    <p>链接:https://pan.baidu.com/s/1hTQJ624N3zWiZaZUBDPkrQ?pwd=rq36提取码:rq36
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1hTQJ624N3zWiZaZUBDPkrQ?pwd=rq36提取码:rq36">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>

                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">外面收费18.88的零撸50/100话费项目，需要有建行卡</div>
                    <p>链接:https://pan.baidu.com/s/1WeKxk9xFmck2UnHFQPd2eQ?pwd=1a7n提取码:1a7n
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1WeKxk9xFmck2UnHFQPd2eQ?pwd=1a7n提取码:1a7n">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>
                
                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">稳定长久的低价接码平台，再也不用担心找不到了</div>
                    <p>链接:https://pan.baidu.com/s/10CnQotu3Sy6mYBWXxSXv7Q?pwd=bmmi提取码:bmmi
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/10CnQotu3Sy6mYBWXxSXv7Q?pwd=bmmi提取码:bmmi">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>

                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">直播间录制工具，支持某音/某手，在线实时录制高清视频下载【永久脚本+详细教程】</div>
                    <p>链接:https://pan.baidu.com/s/1BZdOekIaklVVB6NjZZ2SGw?pwd=h7ry提取码:h7ry
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1BZdOekIaklVVB6NjZZ2SGw?pwd=h7ry提取码:h7ry">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>
                
                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">彩虹发卡网源码官方免授权版，无后门，可做知识付费平台，可对接本平台所有商品自己当老板</div>
                    <p>链接:https://pan.baidu.com/s/1s2ncPhYvkWCHAE4_omWosw?pwd=89gt提取码:89gt
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1s2ncPhYvkWCHAE4_omWosw?pwd=89gt提取码:89gt">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>

                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">Adobe全家桶2023最新版本，永久激活无限使用，附安装包下载(一键安装)</div>
                    <p>链接:https://www.aliyundrive.com/s/MkqJVhsuS4V
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://www.aliyundrive.com/s/MkqJVhsuS4V">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>
                
                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">外面收费398的拼多多最新活赔项目，单号单次净利润100-300+【详细玩法教程】</div>
                    <p>链接:https://pan.baidu.com/s/1trnIWBo1K5n-x0J6Mi96Zw?pwd=5d9n提取码:5d9n
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1trnIWBo1K5n-x0J6Mi96Zw?pwd=5d9n提取码:5d9n">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>

                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">外面收费188的最新携程拍照项目，单号一天100+【详细玩法教程】</div>
                    <p>链接:https://pan.baidu.com/s/1zPXmtXRCYyiDYFq_B-QN3g?pwd=k9pn提取码:k9pn
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1zPXmtXRCYyiDYFq_B-QN3g?pwd=k9pn提取码:k9pn">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>
                
                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">最新联通官方内部通道活动，80元冲100元话费，可上闲鱼，日赚几百【详细玩法教程】</div>
                    <p>链接:https://pan.baidu.com/s/1tPrEThLtfnSAfy8jQJ2pSw?pwd=ijm8提取码:ijm8
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1tPrEThLtfnSAfy8jQJ2pSw?pwd=ijm8提取码:ijm8">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>
				
                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">必备收藏，40多种急救技能视频教学+海姆立克急救法</div>
                    <p>链接:https://pan.baidu.com/s/18XkcpjM38EG5TLFe65BGdg?pwd=15uh提取码:15uh
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/18XkcpjM38EG5TLFe65BGdg?pwd=15uh提取码:15uh">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>

                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">一款自媒体玩家必备的视频自动剪辑的软件，全自动短视频批量剪辑</div>
                    <p>链接:https://pan.baidu.com/s/1vqvB8Q2P8qH9i44e0OOHSw?pwd=j0y2提取码:j0y2
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1vqvB8Q2P8qH9i44e0OOHSw?pwd=j0y2提取码:j0y2">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>
                
                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">最新闲鱼无脑搬砖项目，单号日入20+【详细视频教程】</div>
                    <p>链接:https://pan.baidu.com/s/1toOurMabh96UoXtFMuEoOQ?pwd=bq20提取码:bq20
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1toOurMabh96UoXtFMuEoOQ?pwd=bq20提取码:bq20">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>

                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">汇丰无限撸1.88零撸教程，秒到1.88，多号多撸【详细操作教程】</div>
                    <p>链接:https://pan.baidu.com/s/1PX8avhwPYWxtcQiIE9SM8w?pwd=uaww提取码:uaww
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1PX8avhwPYWxtcQiIE9SM8w?pwd=uaww提取码:uaww">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>
                
                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">最新支付宝0撸68元无门槛红包，多号多撸</div>
                    <p>链接:https://pan.baidu.com/s/1rSIAsLBTIdjD5u4kcam8yg?pwd=hdy1提取码:hdy1
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1rSIAsLBTIdjD5u4kcam8yg?pwd=hdy1提取码:hdy1">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>

                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">几款VPN免费翻墙软件，每日免费时长，上外网必备工具，不花一分钱即可翻墙</div>
                    <p>链接:https://pan.baidu.com/s/17t_M0r3cvcGZyZCQsyGxIg?pwd=8vm9提取码:8vm9
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/17t_M0r3cvcGZyZCQsyGxIg?pwd=8vm9提取码:8vm9">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>

                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">最新0.01撸10元京东E卡项目，轻松白嫖</div>
                    <p>链接:https://pan.baidu.com/s/1OG2h6BQWiAWVI3CW4ozDtg?pwd=2rxv提取码:2rxv
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1OG2h6BQWiAWVI3CW4ozDtg?pwd=2rxv提取码:2rxv">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>
                
                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">最新活动2元领取2斤大米，免费包邮送到家，盘就完事了</div>
                    <p>链接:https://pan.baidu.com/s/1az6U8TApCMxlDWG0onS90Q?pwd=9s57提取码:9s57
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1az6U8TApCMxlDWG0onS90Q?pwd=9s57提取码:9s57">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>

                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">最新无限撸京东10元卡券+20红包教程，限时活动先到先得【详细操作教程】</div>
                    <p>链接:https://pan.baidu.com/s/1PUPR4GySowFV8HSEAg5WFw?pwd=vz6l提取码:vz6l
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1PUPR4GySowFV8HSEAg5WFw?pwd=vz6l提取码:vz6l">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>
                
                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">最新平安好车主零撸12元活动，三分钟到账</div>
                    <p>链接:https://pan.baidu.com/s/1NT7uOykFDsZuOWHE-wkhPQ?pwd=dm4t提取码:dm4t
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1NT7uOykFDsZuOWHE-wkhPQ?pwd=dm4t提取码:dm4t">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>
                
                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">多功能工具箱，小霸王小游戏/视频去水印/全网免费音乐下载等</div>
                    <p>链接:https://wwu.lanzouv.com/s0FQY0a695of
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://wwu.lanzouv.com/s0FQY0a695of">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>

                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">装逼神器，VX充电余额， 装逼引流必备神器</div>
                    <p>链接:https://wwr.lanzoui.com/iJNsl09vkfof
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://wwr.lanzoui.com/iJNsl09vkfof">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>
                
                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">为家有神兽准备的一份小工具，自从用了这个，隔壁的小孩子看到都馋哭了</div>
                    <p>链接:https://pan.baidu.com/s/1ZTItKsxG6be13L_tdRuGFw?pwd=pvxr提取码:pvxr
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1ZTItKsxG6be13L_tdRuGFw?pwd=pvxr提取码:pvxr">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>

                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">百度网盘白嫖VIP会员7天，每个号每月可领一次 </div>
                    <p>链接:https://pan.baidu.com/s/1kz9jSTRS72UWmXCbFTBgZg?pwd=cikc提取码:cikc
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1kz9jSTRS72UWmXCbFTBgZg?pwd=cikc提取码:cikc">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>
                
                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">恶搞娱乐，几百本各种武功秘籍分享</div>
                    <p>链接:https://www.aliyundrive.com/s/rrTyD3m2NkG
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://www.aliyundrive.com/s/rrTyD3m2NkG">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>
                
                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">外面收费188的淘宝拼多多搬砖返现项目，每天可以撸几十（灰）</div>
                    <p>链接:https://pan.baidu.com/s/1ZlqCOmSBVt59nrlriRny8A?pwd=cvjq提取码:cvjq
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1ZlqCOmSBVt59nrlriRny8A?pwd=cvjq提取码:cvjq">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>

                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">科学技术男人梦，男性持久力强化</div>
                    <p>链接:https://www.aliyundrive.com/s/sWEqaFB4Fgg
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://www.aliyundrive.com/s/sWEqaFB4Fgg">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>
                
                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">外面卖998的饿了么美团搬砖项目，简单几步操作即可轻松日入100+</div>
                    <p>链接:https://pan.baidu.com/s/19RY8VR9TOVUU7PVOLECenw?pwd=dijt提取码:dijt
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/19RY8VR9TOVUU7PVOLECenw?pwd=dijt提取码:dijt">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>
                
                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">B站付费视频干货课程合集，最全汇总</div>
                    <p>链接:https://www.aliyundrive.com/s/6D2C4Z2gtDk
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://www.aliyundrive.com/s/6D2C4Z2gtDk">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>

                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">2022年最新微信无限制注册+养号及防封解封技巧</div>
                    <p>链接:https://pan.baidu.com/s/1PVi8PiZXN6pO0U-z2A6arA?pwd=mhvu提取码:mhvu
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1PVi8PiZXN6pO0U-z2A6arA?pwd=mhvu提取码:mhvu">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>
                
                <div style="padding: 10px 15px;background: #f7f7f7;border-radius: 5px;width: 100%;font-size: 1.3rem;margin-bottom: 10px;">
                    <div style="padding: 8px 0;font-size: 1.4rem;">OBS文字识别提取文字【电脑免费版】</div>
                    <p>链接:https://pan.baidu.com/s/1mwMwraMFjCqroPMkSXoT-g?pwd=5uym提取码:5uym
                    <a  style="width: 100%;" href="javascript:;" id="copy-btn" data-clipboard-text="链接:https://pan.baidu.com/s/1mwMwraMFjCqroPMkSXoT-g?pwd=5uym提取码:5uym">
                    <img style="width:20px;height:30px;padding-left:0px" src="../assets/store/img/fuzhi.svg" />
                        </a>
                            </p>
								</div>

				<br><hr>
            </div>
            
<script src="//cdn.staticfile.org/clipboard.js/1.7.1/clipboard.min.js"></script>
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
$(document).ready(function(){
var clipboard = new Clipboard('#copy-btn');
clipboard.on('success', function (e) {
	layer.msg('复制成功');
});
clipboard.on('error', function (e) {
	layer.msg('复制失败，请长按链接后手动复制');
});

$("#recreate_url").click(function(){
	var self = $(this);
	if (self.attr("data-lock") === "true") return;
	else self.attr("data-lock", "true");
	var ii = layer.load(1, {shade: [0.1, '#fff']});
	$.get("ajax_user.php?act=create_url&force=1", function(data) {
		layer.close(ii);
		if(data.code == 0){
			layer.msg('生成链接成功');
			$("#copy-btn").html(data.url);
			$("#copy-btn").attr('data-clipboard-text',data.url);
		}else{
			layer.alert(data.msg);
		}
		self.attr("data-lock", "false");
	}, 'json');
});
});
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
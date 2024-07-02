var template_virtualdata = $("input[name=_template_virtualdata]").val();
var template_showsales = $("input[name=_template_showsales]").val();
var curr_time = $("input[name=_curr_time]").val();

$(function() {
    //排序点击
    $(".goods_sort .item").on("click",function(){
       var sort = $(this).data("order"); //获取排序类型
       if(!sort){
           return false;
       }
       var sort_type = $(this).data("sort"); //获取类型
       if(sort_type == "DESC")
       {
           var sort_type_new = "ASC";
       }else{
           var sort_type_new = "DESC";
       }

        //移除其他已点击
        $(".goods_sort div").attr("class","item item-price");
        $(this).addClass(sort_type); 
        $(this).data("sort",sort_type_new);
        $('.goods_sort div').removeClass('on');
        $(this).addClass("on");
        $("input[name=_sort_type]").val(sort);
        $("input[name=_sort]").val(sort_type);
        get_goods();
    });
    if ($(".swiper-wrapper .content-slide").length > 1) {
        var swiper = new Swiper('.swiper-container', {
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
            renderBullet: function (index, className) {
              return '<span class="' + className + '">' + (index + 1) + '</span>';
            },
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
            mousewheel: true,
            keyboard: true,
            // loop:true,
        });
        $(".swiper-button-next").show();
        $(".swiper-button-prev").show();
    }  
    jQuery(function ($) {
        $(window).resize(function () {
            var width = $('#js-com-header-area').width();
            $('.touchslider-item a').css('width', width);
            $('.touchslider-viewport').css('height', 200 * (width / 640));
        }).resize();
    });

    if(template_virtualdata == 1){
        ka();
    }

    get_goods();
    $(".get_cat").on("click",function()
    {
        var cid = $(this).data("cid");
        var name = $(this).data("name");
         $("#tabtopl").html(name);
        		$.ajax({
		type : "GET",
		url : "./ajax.php?act=cidr&cid="+cid+"",
		dataType : 'json',
		success : function(cidrd) {
	if(cidrd.code>=1){
	   $(".hotxy").hide();
	}else{
	    $(".hotxy").show();
	    if(cid!=cidrd.cid){}else{
	        	$("#classtab").html(null);
	    		$.each(cidrd.data, function (i, res) {
					$("#classtab").append(' <a data-cid="'+res.cid+'" data-name="'+res.name+'" onclick="cidr('+res.cid+')" class="get_tab tab-bottom-item">'+res.name+'</a>');
					
				});
			
	    }
	}
		}
	
	});
        $(".ico img").addClass('imgpro');
       
       $("#"+cid).removeClass("imgpro").addClass('');
       
        var name = $(this).data("name");
        if($(this).hasClass("shop_active")){
            //return false;
        }
        $('.device .content-slide a').removeClass('shop_active');
        $("input[name=kw]").val("");
        $("input[name=_cid]").val(cid);
        $("input[name=_cidname]").val(name);
        get_goods();
        $(this).addClass('shop_active');
		history.replaceState({}, null, './?cid='+cid);
    });
    
        $(".get_tab").on("click",function()
    {
        var cid = $(this).data("cid");
        	
        $(".ico img").addClass('imgpro');
       
       $("#"+cid).removeClass("imgpro").addClass('');
       
        var name = $(this).data("name");
        if($(this).hasClass("shop_active")){
            //return false;
        }
        $('.device .content-slide a').removeClass('shop_active');
        $("input[name=kw]").val("");
        $("input[name=_cid]").val(cid);
        $("input[name=_cidname]").val(name);
        get_goods();
        $(this).addClass('shop_active');
		history.replaceState({}, null, './?cid='+cid);
    });
    //点击搜索拦截
    $("#goods_search").submit(function(e){
      var km = $("input[name=kw]").val();
      if(km == "")
      {
          layer.msg("请输入关键词进行查询");
          return false;
      }
      $("input[name=_cid]").val("");
      $("input[name=_cidname]").val("");
    $(".catname_show").html("正在获取数据");
    $(".show_class").hide();
    $('.device .content-slide a').removeClass('shop_active');
      get_goods();
     document.activeElement.blur();
      return false;
    });
    
    if($.cookie('goods_list_style') == 'list'){
        $("#listblock").data("state","gongge");
        $("#listblock").removeClass("icon-sort");
        $("#listblock").addClass("icon-app");
        $("#goods-list-container").removeClass("block three");
    }
    
    /*点击切换风格*/
    $("#listblock").on("click",function(){
        var index = layer.msg('加载中', {
          icon: 16
          ,shade: 0.01
        });
        var attr = $(this).data("state");
        if(attr == 'gongge'){
            $(this).data("state","list");
            $(this).removeClass("icon-app");
            $(this).addClass("icon-sort");
            $("#goods-list-container").addClass("block three");
        }else{
            $(this).data("state","gongge");
            $(this).removeClass("icon-sort");
            $(this).addClass("icon-app");
            $("#goods-list-container").removeClass("block three");
        }
        //设置cookie
        var cookietime = new Date(); 
        cookietime.setTime(cookietime.getTime() + (86400));
        $.cookie('goods_list_style', attr, { expires: cookietime });
        layer.close(index);
    });
        
    //弹窗广告
    if( !$.cookie('op')){
        $('.tzgg').show();
        $.cookie('op', false, { expires: 1});
    }
    
        /**
     * 兼容iphone
     * @type {number | boolean | *}
     */
    var isIphoneX = window.devicePixelRatio && window.devicePixelRatio === 3 && window.screen.width === 375 && testUA('iPhone');

    if (isIphoneX && window.history.length <= 2) {
        // document.body.classList.add('fix-iphonex-bottom');
//        $(".fui-navbar,.cart-list,.fui-footer,.fui-content.navbar").addClass('iphonex')
        $(".fui-navbar").css("bottom", "0px");
    } else {
        $(".fui-navbar,.cart-list,.fui-footer,.fui-content.navbar").removeClass('iphonex');
    }
});

function ka() {
	setInterval("get_data()",6000);
}
function get_data() {
	$.ajax({
		type : "get",
		url : "./other/getdatashow.php",
		async: true,
		dataType : 'json',
		success : function(data) {
			if(data.code==1){
				$('#xn_text').text(data.text+" "+data.time+'前');
				$('#xn_text').fadeIn(1000);
				setTimeout("$('#xn_text').fadeOut(1000);",4000);
			}
		}
	});
}



function testUA(str) {
    return navigator.userAgent.indexOf(str) > -1
}

function load(text="商品加载中...")
{

}

function get_goods() {
    var regex_match = /(nokia|iphone|android|motorola|^mot-|softbank|foma|docomo|kddi|up.browser|up.link|htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte-|longcos|pantech|gionee|^sie-|portalmmm|jigs browser|hiptop|^benq|haier|^lct|operas*mobi|opera*mini|320x320|240x320|176x220)/i;
    var u = navigator.userAgent;
    if (null == u) {
        return true;
    }
    var result = regex_match.exec(u);

    if (null == result) {
        var wap = 1;
    } else {
        var wap = 2;
    }

     $("#goods_list").remove();
     $(".flow_load").append("<div id=\"goods_list\" ></div>");



    layui.use(['flow'], function(){
        var flow = layui.flow;
        var cid  = $("input[name=_cid]").val();
        var name  = $("input[name=_cidname]").val();
        var kw = $("input[name=kw]").val();
        var sort_type = $("input[name=_sort_type]").val();
        var sort = $("input[name=_sort]").val();
        var mb = testUA('Safari')?180:100;
        var end = kw?"-- 暂无更多 --":" ";
        limit = 100
        if(name != "")
        {
            var index = load();
        }
        var ProjectListAjaxData = sessionStorage.getItem("ProjectListAjaxData");
        if (ProjectListAjaxData == null) {
            ProjectListAjaxData = '';
            $.cookie("ProjectListTotal", 0, { path: '/' });//记录翻页的页数
            $.cookie("ProjectListPageIndex", 0, { path: '/' });//记录翻页的页数
            $.cookie("ProjectListPosition", false, { path: '/' });
            $.cookie("ProjectListScrollTop", 0, { path: '/' });
        }else {
            page_total = $.cookie("ProjectListTotal")? parseInt($.cookie("ProjectListTotal")): 0;
            page_index = $.cookie("ProjectListPageIndex") ? parseInt($.cookie("ProjectListPageIndex")): 0;

        }
        //写入数据
        $(".show_class").show();  
        flow.load({
                elem: '#goods_list' //流加载容器
                ,isAuto:true
                ,mb:mb
                ,isLazyimg:true
                ,end:end
                ,done: function(page, next){ //执行下一页的回调
                    var lis = [];
                    //以jQuery的Ajax请求为例，请求下一页数据（注意：page是从2开始返回）
                    $.ajax({
                    type : "post",
                    url : "./ajax.php?act=gettoolnew",
                    data : {page:page,limit:limit,cid:cid,kw:kw,sort_type:sort_type,sort:sort},
                    dataType : 'json',
                    success : function(res) {
                        console.log(res);
							$(".tag_name").hide();
							$(".tag_name ul").html("");
                            
                            //假设你的列表返回在data集合中
                            
                            layui.each(res.data, function(index, item){
                                html = '<a class="fui-goods-item" title="'+item.name+'" onclick="ifbox(\'./?mod=buy5&tid='+item.tid+'\')">';
                                html += '<div class="image">';
                                if(!item.shopimg){
                                    item.shopimg="./assets/store/picture/error_img.jpg"
                                }
                                if(item.show_tag){
                                    show_tag = item.show_tag;
                                }else{
                                    if((curr_time-(item.addtime)) <= 259200)
                                    {
                                        show_tag = "";
                                    }else{
                                        show_tag = "";
                                    }
                                }


                                //显示商品标签
                                 show_tag_html = "";
                                if(show_tag)
                                {
                                    show_tag_html = '<div class="bantou" style="background: -webkit-linear-gradient(left, #f10707, #b92b2b);color:#FFFFFF;width: 40%;text-align: center;font-size:.6rem; padding:5px 0; border-radius: 10px 0 15px 0;position: absolute;">'+show_tag+'</div>';
                                }

                                //库存为0的
                                    var shoukong = '';
                                    var kucun = '<p style="font-size:.50rem;">24小时全自动发货</p>';
                                    if(item.is_stock_err == 1){
                                        shoukong = '';
                                    }

                                    if(item.stock > 0){
                                    kucun = '库存:'+item.stock+'份';
                                    }

                                    if(template_showsales == 1){

                                    }
                                    html += ''+show_tag_html+'<img class="lazy" lay-src="'+item.shopimg+'" src="./assets/store/picture/loadimg.gif" alt="'+item.name+'">'+shoukong+'';
                                    html += '</div>';
                                    
                                    
                                console.log(wap);
                                if (wap == '1') {
                                    html += '<div class="detail" style="height:unset;">';
                                    html += '<div class="name" style="color: #34495e; font-size: .4rem;">'+item.name+'</div>';
                                    html += '<div class="addtime" style="color: #797979;font-size:.4rem;margin-bottom: 5px;"><i class="layui-icon layui-icon-time" style="font-size:.4rem;"></i>上架时间:'+timestampToTime(item.addtime)+'</div>';
                                    var price = '<p class="minprice" style="font-size:.65rem;"><font style="font-size:.45rem; "><b>￥</font>'+item.price+'<font style="font-size:.55rem; ">元</font></b></p>';
                                    if(item.price <=0){
                                        price = '<p class="minprice" style="font-size:.6rem;"><b>免费商品</b></p>';
                                    }
                                    html += '';
                                    
                                     html += `<div class="right-dibu">
                                         <span class="zhiliang">售价:${item.price}</span>
                                         ${ item.stock !=='0' ? '<span class="youhuo">有货</span>':'<span class="wuhuo">无货</span>' }
                                         ${ item.close !=='1' ? '<span class="geshu">热卖中</span>':'<span class="wuhuo">已下架</span>' }
                                         <span class="xiaoliang">库存:${item.stock !== null ? item.stock + ''  : '无限'}</span>
                                   </div>`;
                                     //html += '<div style="display: flex; margin-top: 5px; font-size: 12px;">';
                                //html += '<div><i class="layui-icon layui-icon-time"></i>&nbsp;' + item.time + '</div>';
                                //html += '<div style="margin-left: 10px;">已售:&nbsp;' + item.sales + '</div>';
                                //html += '<div style="margin-left: auto; font-size: 12px;"><i class="layui-icon layui-icon-rmb"></i>&nbsp;' + item.price + '</div>';
                                html += '</div>';
                                } else if (wap == '2') {
                                    
                                //html += '<div style="display: flex; margin-top:5px; justify-content: space-between; font-size: 12px;">';
                                //html += '<div><i class="layui-icon layui-icon-time"></i>' + item.time + '</div>';
                                //html += '<div>已售:' + item.sales + '</div>';
                                //html += '<div><i class="layui-icon layui-icon-rmb"></i>' + item.price + '</div>';
                                //html += '</div>';
                                    html += '<div class="detail" style="height:unset;">';
                                    html += '<div class="name" style="color: #34495e; font-size: .55rem;">'+item.name+'</div>';
                                    html += '<div class="addtime" style="color: #797979;font-size:.45rem;"><i class="layui-icon layui-icon-time" style="font-size:.45rem;"></i>上架时间:'+timestampToTime(item.addtime)+'</div>';
                                    var price = '<p class="minprice" style="font-size:.65rem;"><font style="font-size:.45rem; "><b>￥</font>'+item.price+'<font style="font-size:.55rem; ">元</font></b></p>';
                                    if(item.price <=0){
                                        price = '<p class="minprice" style="font-size:.6rem;"><b>免费商品</b></p>';
                                    }
                                    html += '';
                                    
                                     html += `<div class="right-dibu">
                                         <span class="zhiliang">售价:${item.price}</span>
                                         ${ item.stock !=='0' ? '<span class="youhuo">有货</span>':'<span class="wuhuo">无货</span>' }
                                         ${ item.close !=='1' ? '<span class="geshu">热卖中</span>':'<span class="wuhuo">已下架</span>' }
                                         <span class="xiaoliang">库存:${item.stock !== null ? item.stock + ''  : '无限'}</span>
                                   </div>`;
                                }

                                html += '</div>';
                                html += '</a>';
                                lis.push(html);
                            });
                            
                            if(cid == "")
                            {
                                      
                                 $(".catname_c").hide(); $(".catname_show").show();  $(".catname_cc").hide();
                                $(".catname_show").html('共找到<font style="color: #7d7c7a;font-size: 12px;">'+res.total+'件商品</font>');
                            }else if(name != ""){
                                  $(".catname_c").hide(); $(".catname_show").show();  $(".catname_cc").hide();
                                $(".catname_show").html('<font style="color: #7d7c7a;font-size: 12px;">'+name+'</font>共有'+res.total+'件商品');
                             
                            }
                            if(kw != ""){
                            
                                   $(".catname_c").hide(); $(".catname_show").show();  $(".catname_cc").hide();
                                $(".catname_show").html('当前共有<font style="">'+res.total+'</font>件商品');
                            }else{
                                   $(".catname_c").hide(); $(".catname_show").show();  $(".catname_cc").hide();
                                   $(".catname_show").html('（全站商品共有'+res.count+'个,当前有'+res.total+'个）');                            }
                            layer.closeAll();
                            next(lis.join(''), page < res.pages);
                           
                        },
                        error:function(data){
                            layer.msg("获取数据超时");
                            layer.close(index);
                            return false;
                        }
                });
                }
          });
        
    });
}
function timestampToTime(timestamp) {
        var date = new Date(timestamp * 1000);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
        var Y = date.getFullYear() + '年';
        var M = (date.getMonth()+1 < 10 ? ''+(date.getMonth()+1) : date.getMonth()+1) + '月';
        var D = date.getDate() + '日';
        var h = date.getHours() + ':';
        var m = date.getMinutes() + ':';
        var s = date.getSeconds();
        return Y+M+D;
    }
var audio_init = {
	changeClass: function (target,id) {
       	var className = $(target).attr('class');
       	var ids = document.getElementById(id);
       	(className == 'on')
           	? $(target).removeClass('on').addClass('off')
           	: $(target).removeClass('off').addClass('on');
       	(className == 'on')
           	? ids.pause()
           	: ids.play();
   	},
	play:function(){
		document.getElementById('media').play();
	}
}
if($('#audio-play').is(':visible')){
	audio_init.play();
}

/*layui.use(['util'], function(){
    var util = layui.util;
    //固定块客服
    util.fixbar({
        bar1: true
        ,bar2: true
        ,css: {right:8,bottom: '25%','z-index':1}
        ,bgcolor: '#393D49'
        ,click: function(type){
          if(type === 'bar1'){
            window.location.href = ("./?mod=kf");
          } else if(type === 'bar2') {
            window.location.href = ("./?mod=articlelist");
          }
        }
    });
});*/
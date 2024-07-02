

function tap_tab(t = 'contribute') {
    if(t == 'thing'){
        $('#thing').addClass('a_tap');
        $('#contribute').removeClass('a_tap');
    }else{
        $('#contribute').addClass('a_tap');
        $('#thing').removeClass('a_tap');

    }
    get_list(t);
}

function get_list(type = 'contribute') {
    layui.use(['flow'], function(){
        var flow = layui.flow;
        $("#list").remove();
        $(".flowlist").append("<div id=\"list\" ></div>");
        var end = "没有更多数据了";
        var mb = 180;
        var layui_index = load();
        $(".show_class").show();
        flow.load({
            elem: '#list', //流加载容器
            isAuto:true,
            end:end,
            mb:mb,
            done: function(page, next){ //执行下一页的回调
                var lis = [];
                //以jQuery的Ajax请求为例，请求下一页数据（注意：page是从2开始返回）
                $.ajax({
                    type : "post",
                    url : "./ajax.php?act=thing",
                    data : {page:page,limit:10,type:type},
                    dataType : 'json',
                    success : function(res) {

                        layui.each(res.data, function(index, item){
                            var status = '<font >待审核</font>';
                            if(item.status == 0){
                                status ='<font color="#6495ed">已通过</font>';
                            }else if(item.status == 1){
                                status ='<font color="red">待审核</font>';
                            }else if(item.status == 88){
                                 status ='<font color="#555555">未通过</font>';
                            }
                            html  = '<div class="list-item">';
                            html +=      '<div class="list-item-top">';
                            if(type == 'contribute'){
                                html +=       '<div class="item-logo-1">';
                                html +=          '<div class="item-logo-img">总站</div>';
                                html +=      '</div>';
                            }else {
                                html +=      '<div class="item-logo-2">';
                                html +=          '<div class="item-logo-img">平台</div>';
                                html +=      '</div>';
                            }
                            html +=          '<div class="item-operate">';
                            html +=              '<a class="item-operate-item item-operate-border" onclick="delete_item(\'' + type + '.php?my=delete&tid=' + item.id + '\')">删除</a><a class="item-operate-item"  href="' + type+ '.php?my=edit&tid=' + item.id + '">编辑</a>';
                            html +=          '</div>';
                            html +=      '</div>';
                            html +=      '<div class="list-item-c">';
                            html +=          '<div class="item-c-txet">';
                            html +=              '<div class="item-c-title">商品名称</div>';
                            html +=              '<div class="item-c-data ellipsis1">' + item.name + '</div>';
                            html +=          '</div>';
                            html +=          '<div class="item-c-txet">';
                            html +=              '<div class="item-c-title">商品销售</div>';
                            html +=              '<div class="item-c-data">' + item.sales + '</div>';
                            html +=          '</div>';
                            html +=          '<div class="item-c-txet">';
                            html +=              '<div class="item-c-title">商品状态</div>';
                            html +=              '<div class="item-c-data">' + status + '</div>';
                            html +=          '</div>';
                            if(item.status == 2 && item.msg){
                                html +=          '<div style=" background:#f2f2f2;color: #a9a9a9;font-size: 1.1rem;border-radius: 5px;padding:5px 10px;line-height: 1.8rem">' + item.msg + '</div>';
                            }
                            html +=          '<div class="item-c-txet">';
                            html +=              '<div class="item-c-title">投稿时间</div>';
                            html +=              '<div class="item-c-data">' + item.addtime + '</div>';
                            html +=          '</div>';
                            html +=      '</div>';
                            html += '</div>';
                            lis.push(html);
                        });
                        $(".catname_show").html('<font >共找到'+res.total+'个商品</font>');
                        layer.close(layui_index);
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

function delete_item (url){
    if(!confirm('删除后将不可恢复,确定删除吗?')){
        return false;
    }

    window.location.href = url;
}

function load(text="加载中")
{
    var index = layer.load(1, {
        shade: [0.1,'#fff'] //0.1透明度的白色背景
    });
    return index;
}

function  openmsg1() {
    layer.open({
        type:1,
        title: false,
        area: ['30rem'],
        shade: 0.3,
        skin: "layerdemo",
        shadeClose: false,
        closeBtn: 0,
        resize:0,
        content: '<center><div class="showtip display-column  align-center" style="background:#FFF">'+

            '<b></b>'+
            '<div class="text-left" style="width:100%;padding: 15px">'+
            '<font style="font-weight: 800;line-height: 3rem">一、投稿资格</font><br>'+
            '<font style="color: #999999">凡升级成为本站站长，且手里有靠谱项目的，均可在本页面提交投稿申请。</font><br>'+
            '</div>'+
            '<div class="text-left" style="width:100%;padding: 15px;background:#f2f2f2 ">'+
            '<font style="font-weight: 800;line-height: 3rem">二、平台优势</font><br>'+
            '<font style="color: #999999">所有站点都将显示你的项目，平台所有人帮你推广，收益直接到余额！</font><br>'+
            '</div>'+
            '<div class="text-left" style="width:100%;padding: 15px">'+
            '<font style="font-weight: 800;line-height: 3rem">三、审核机制</font><br>'+
            '<font style="color: #999999">1、顶级合伙人投稿优先审核。<br>2、项目介绍及文案课程齐全优先审核。<br>3、项目内容合法合规的优先审核。</font><br>'+
            '</div>'+
            '<div class="text-left" style="width:100%;padding: 15px;background:#f2f2f2 ">'+
            '<font style="font-weight: 800;line-height: 3rem">四、收益模式</font><br>'+
            '<font style="color: #999999">项目投稿一经平台采纳，则按本订单一单一结，每笔订单享受0.3-8元的投稿分成。</font><br>'+
            '</div>'+
            '<div class="showtip-btn display-row justify-center align-center" >' +
            '<a  href="javascript:$(\'#switch1\').attr(\'checked\',\'checked\');layer.closeAll();" class="showtip-btn-yes display-column justify-center align-center" style="height:4rem">确定</a>' +
            '</div>'+
            '</div>'+
            '</center>',

    });

}
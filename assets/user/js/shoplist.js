
function reset_price(cid) {
    layer.open({
        type:1,
        title: false,
        area: '28rem',
        shade: 0.7,
        skin: "layerdemo",
        shadeClose: false,
        closeBtn: 0,
        offset: '30%',
        btnAlign: 'c',
        btn: ['确认', '再想想'],
        content:
            '<div class="showtip display-column align-center" style="letter-spacing:.05rem;">' +
            '<div class="showtip-title" style="height: 3rem"></div>' +
            '<div class="showtip-center  display-column justify-center align-center" style="margin-bottom: 3rem">'+
            '<img src="../assets/user/img/warning.png" style="height:4rem">'+
            '<div class="showtip-center-msg">恢复价格</div>'+
            '<div class="showtip-center-num" style="font-size: 1.1rem">重置所有商品价格设定至最初状态</div>' +
            '</div>'+
            '</div>',
        btn1: function(index, layero){
            $.ajax({
                type: "post",
                url: "ajax_user.php?act=reset_price",
                data: {
                    cid: cid
                },
                dataType: "json",
                success: function (data) {
                    if (data.code == 0) {
                        layer.close(index);
                        layer.alert('恢复价格成功！', {icon: 1}, function () {
                            window.location.reload();
                        });
                    } else {

                        layer.alert(data.msg);
                    }
                }
            });
        },
        btn2: function(index, layero){
            layer.closeAll();

        },
        success: function(layero, index){
            var btn1= $(".layui-layer-btn .layui-layer-btn0");
            btn1.css({
                "width":" 50%",
                "height": "100%",
                "padding": "0",
                "margin":"0",
                "line-height": "4.5rem",
                "border-radius":" 0",
                "border":" 1px solid transparent",
                "background": "transparent",
                "color":"#999999",
            })
            var btn2= $(".layui-layer-btn .layui-layer-btn1");
            btn2.css({
                "width":" 50%",
                "height": "100%",
                "padding": "0",
                "margin":"0",
                "line-height": "4.5rem",
                "border-radius":" 0",
                "border":" 1px solid transparent",
                "border-left": "1px solid #f2f2f2",
                "background": "transparent",
                "color":"#000",
            })

        }
    });

}

function up_price(kw="") {
    layer.open({
        type:1,
        title: false,
        area: '28rem',
        shade: 0.7,
        skin: "layerdemo",
        shadeClose: false,
        closeBtn: 0,
        offset: '30%',
        btnAlign: 'c',
        btn: ['取消', '确认'],
        content:
            '<div class="showtip display-column align-center" style="letter-spacing:.05rem;">' +
            '<div class="showtip-title" style="height: 1rem"></div>' +
            '<div class="showtip-center  display-column justify-center align-center" style="width: 100%">'+
            '<div class="showtip-center-msg">一键销售价格提升</div>'+
            '<div class="showtip-center-num" style="width: 100%;margin-bottom: 15px">' +
            '<input type="hidden"  name="tisheng_type" id="tisheng_type" >' +
            '<div class="display-row align-center justify-around" style="width: 100%;margin: 10px 0"> ' +
            '<a onclick="$(\'#tisheng_type\').val(1);$(\'#tisheng_1\').css({\'background\':\'#438ff3\',\'color\':\'#fff\'});$(\'#tisheng_2\').css({\'background\':\'transparent\',\'color\':\'#000\'});" id="tisheng_1" style="width: 43%;height: 3.5rem; border: 1px solid #bfbfbf;text-align: center;border-radius: 5px;line-height: 3.5rem">百分比</a>' +
            '<a onclick="$(\'#tisheng_type\').val(2);$(\'#tisheng_2\').css({\'background\':\'#438ff3\',\'color\':\'#fff\'});$(\'#tisheng_1\').css({\'background\':\'transparent\',\'color\':\'#000\'});" id="tisheng_2" style="width: 43%;height: 3.5rem; border: 1px solid #bfbfbf;text-align: center;border-radius: 5px;line-height: 3.5rem">固定金额</a>' +
            '</div>' +
            '<input style="width: 93%; margin: 0 auto;text-align: left;background:#f2f2f2;"  name="tisheng_value" id="tisheng_value" value="" placeholder="请输入数值" class="form-control  search-input">' +
            '</div>'+

            '</div>' +
            '</div>',
        btn1: function(index, layero){
            layer.closeAll();
        },
        btn2: function(index, layero){

            var type = $('#tisheng_type').val();
            if (type == "") {
                layer.msg("请选择提升类型");
                return false;
            }
            var text = $('#tisheng_value').val();
            if (text == "") {
                layer.msg("请填写数值");
                return false;
            }

            if(!cid && pcid){
                cid = calsslist[pcid].cids;
            }

            $.ajax({
                type: 'post',
                dataType: 'json',
                url: 'ajax_user.php?act=up_price',
                cache: false,
                data: {cid: cid, up: text, type: type, kw: kw},
                success: function (data) {
                    if (data.code == 0) {
                        layer.alert('价格提升成功，刷新即可看到效果', {icon: 1}, function () {
                            window.location.reload();
                        });
                    } else {
                        layer.alert(data.msg);
                    }
                },
                error: function (data) {
                    layer.msg('网络异常，请稍后重试');
                }
            });

        },
        success: function(layero, index){
            var btn1= $(".layui-layer-btn .layui-layer-btn0");
            btn1.css({
                "width":" 50%",
                "height": "100%",
                "padding": "0",
                "margin":"0",
                "line-height": "4.5rem",
                "border-radius":" 0",
                "border":" 1px solid transparent",
                "background": "transparent",
                "color":"#999999",
            })
            var btn2= $(".layui-layer-btn .layui-layer-btn1");
            btn2.css({
                "width":" 50%",
                "height": "100%",
                "padding": "0",
                "margin":"0",
                "line-height": "4.5rem",
                "border-radius":" 0",
                "border":" 1px solid transparent",
                "border-left": "1px solid #f2f2f2",
                "background": "transparent",
                "color":"#000",
            })

        }
    });
}

function auto_price() {
    var content = '<div class="showtip display-column align-center" style="letter-spacing:.05rem;">' +
        '<div class="showtip-title" ></div>' +
        '<div class="showtip-center  display-column justify-center align-center" style="width: 100%">'+
        '<div class="showtip-center-msg">自动同步商品价格</div>'+
        '<div class="showtip-center-num" style="width: 100%;margin-bottom: 5px">' +
        '<div class="left-title form-group-border-bottom" style="font-size:1.45rem;padding: 10px;padding-bottom: 30px; color: #000;font-weight: bold">销售价格设置</div>' +
        '<input type="hidden"  name="auto_price_type" id="auto_price_type" value="'+ set_auto_price +'">' +
        '<div class="display-row align-center justify-around" style="width: 100%;margin: 10px 0"> ' +
        '<a onclick="$(\'#auto_price_type\').val(0);$(\'#auto_0\').css({\'background\':\'#438ff3\',\'color\':\'#fff\'});$(\'#auto_1,#auto_2\').css({\'background\':\'transparent\',\'color\':\'#000\'});" id="auto_0" style="width: 26%;height: 3.5rem; border: 1px solid #bfbfbf;text-align: center;border-radius: 5px;line-height: 3.5rem">关闭</a>' +
        '<a onclick="$(\'#auto_price_type\').val(1);$(\'#auto_1\').css({\'background\':\'#438ff3\',\'color\':\'#fff\'});$(\'#auto_0,#auto_2\').css({\'background\':\'transparent\',\'color\':\'#000\'});" id="auto_1" style="width: 26%;height: 3.5rem; border: 1px solid #bfbfbf;text-align: center;border-radius: 5px;line-height: 3.5rem">固定金额</a>' +
        '<a onclick="$(\'#auto_price_type\').val(2);$(\'#auto_2\').css({\'background\':\'#438ff3\',\'color\':\'#fff\'});$(\'#auto_0,#auto_1\').css({\'background\':\'transparent\',\'color\':\'#000\'});" id="auto_2" style="width: 26%;height: 3.5rem; border: 1px solid #bfbfbf;text-align: center;border-radius: 5px;line-height: 3.5rem">百分比</a>' +
        '</div>' +
        '<input style="width: 93%; margin: 0 auto;text-align: left;background:#f2f2f2;"  name="auto_price_num" id="auto_price_num" value="'+ set_auto_price_num +'" placeholder="请输入数值" class="form-control  search-input">' +

        '</div>';
    if(userrow_power == 2){
        content +='<div class="showtip-center-num" style="width: 100%;margin-bottom: 5px">' +
        '<div class="left-title form-group-border-bottom" style="font-size:1.45rem;padding: 10px;padding-bottom: 30px; color: #000;font-weight: bold">下级价格设置</div>' +
        '<input type="hidden"  name="auto_cost_type" id="auto_cost_type" value="'+ set_auto_cost +'">' +
        '<div class="display-row align-center justify-around" style="width: 100%;margin: 10px 0"> ' +
        '<a onclick="$(\'#auto_cost_type\').val(0);$(\'#cost_0\').css({\'background\':\'#438ff3\',\'color\':\'#fff\'});$(\'#cost_1,#cost_2\').css({\'background\':\'transparent\',\'color\':\'#000\'});" id="cost_0" style="width: 26%;height: 3.5rem; border: 1px solid #bfbfbf;text-align: center;border-radius: 5px;line-height: 3.5rem">关闭</a>' +
        '<a onclick="$(\'#auto_cost_type\').val(1);$(\'#cost_1\').css({\'background\':\'#438ff3\',\'color\':\'#fff\'});$(\'#cost_0,#cost_2\').css({\'background\':\'transparent\',\'color\':\'#000\'});" id="cost_1" style="width: 26%;height: 3.5rem; border: 1px solid #bfbfbf;text-align: center;border-radius: 5px;line-height: 3.5rem">固定金额</a>' +
        '<a onclick="$(\'#auto_cost_type\').val(2);$(\'#cost_2\').css({\'background\':\'#438ff3\',\'color\':\'#fff\'});$(\'#cost_0,#cost_1\').css({\'background\':\'transparent\',\'color\':\'#000\'});" id="cost_2" style="width: 26%;height: 3.5rem; border: 1px solid #bfbfbf;text-align: center;border-radius: 5px;line-height: 3.5rem">百分比</a>' +
        '</div>' +
        '<input style="width: 93%; margin: 0 auto;text-align: left;background:#f2f2f2;"  name="auto_cost_num" id="auto_cost_num" value="'+ set_auto_cost_num +'" placeholder="请输入数值" class="form-control  search-input">' +

        '</div>';
    }
    content +='<p style="font-size:.95rem;color: #999999;padding: 0 10px;margin: 10px 0; line-height: 1.6rem">*自动同步商品价格,是根据您选择的提升类型,自动提升最新商品的价格(只同步最新商品)</p>'+
    '</div>' +
    '</div>';
    layer.open({
        type:1,
        title: false,
        area: '30rem',
        shade: 0.7,
        skin: "layerdemo",
        shadeClose: false,
        closeBtn: 0,
        offset: '25%',
        btnAlign: 'c',
        btn: ['取消', '确认'],
        content:content,
        btn1: function(index, layero){
            layer.closeAll();
        },
        btn2: function(index, layero){

            var auto_price = $('#auto_price_type').val();
            if (auto_price == "") {
                layer.msg("请选择销售自动提升类型");
                return false;
            }
            var price_num = $('#auto_price_num').val();
            var re = /^[0-9]+.?[0-9]*$/;
            if (!re.test(price_num)) {
                layer.msg("请填写销售数字数值");
                return false;
            }
            var post_data = { auto_price: auto_price, auto_price_num: price_num};
            if(userrow_power == 2){
                var auto_cost = $('#auto_cost_type').val();
                if (auto_cost == "") {
                    layer.msg("请选择下级自动提升类型");
                    return false;
                }
                var cost_num = $('#auto_cost_num').val();
                var re = /^[0-9]+.?[0-9]*$/;
                if (!re.test(cost_num)) {
                    layer.msg("请填写下级数字数值");
                    return false;
                }
                post_data.auto_cost = auto_cost;
                post_data.auto_cost_num = cost_num;
            }
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: 'ajax_user.php?act=auto_price',
                cache: false,
                data: post_data,
                success: function (data) {
                    if (data.code == 0) {
                        layer.alert(data.msg, {icon: 1}, function () {
                            window.location.reload();
                        });
                    } else {
                        layer.alert(data.msg);
                    }
                },
                error: function (data) {
                    layer.msg('网络异常，请稍后重试');
                }
            });

        },
        success: function(layero, index){
            $('#auto_'+ set_auto_price).css({'background':'#438ff3','color':'#fff'});
            if(userrow_power == 2){
                $('#cost_'+ set_auto_cost).css({'background':'#438ff3','color':'#fff'});
            }

            var btn1= $(".layui-layer-btn .layui-layer-btn0");
            btn1.css({
                "width":" 50%",
                "height": "100%",
                "padding": "0",
                "margin":"0",
                "line-height": "4.5rem",
                "border-radius":" 0",
                "border":" 1px solid transparent",
                "background": "transparent",
                "color":"#999999",
            })
            var btn2= $(".layui-layer-btn .layui-layer-btn1");
            btn2.css({
                "width":" 50%",
                "height": "100%",
                "padding": "0",
                "margin":"0",
                "line-height": "4.5rem",
                "border-radius":" 0",
                "border":" 1px solid transparent",
                "border-left": "1px solid #f2f2f2",
                "background": "transparent",
                "color":"#000",
            })

        }
    });
}

function xiaji_up_price(kw="") {
    layer.open({
        type:1,
        title: false,
        area: '28rem',
        shade: 0.7,
        skin: "layerdemo",
        shadeClose: false,
        closeBtn: 0,
        offset: '30%',
        btnAlign: 'c',
        btn: ['取消', '确认'],
        content:
            '<div class="showtip display-column align-center" style="letter-spacing:.05rem;">' +
            '<div class="showtip-title" style="height: 1rem"></div>' +
            '<div class="showtip-center  display-column justify-center align-center" style="width: 100%">'+
            '<div class="showtip-center-msg">一键销售价格提升</div>'+
            '<div class="showtip-center-num" style="width: 100%;margin-bottom: 15px">' +
            '<input type="hidden" name="tisheng_type" id="tisheng_type" >' +
            '<div class="display-row align-center justify-around" style="width: 100%;margin: 10px 0"> ' +
            '<a onclick="$(\'#tisheng_type\').val(1);$(\'#tisheng_1\').css({\'background\':\'#438ff3\',\'color\':\'#fff\'});$(\'#tisheng_2\').css({\'background\':\'transparent\',\'color\':\'#000\'});" id="tisheng_1" style="width: 43%;height: 3.5rem; border: 1px solid #bfbfbf;text-align: center;border-radius: 5px;line-height: 3.5rem">百分比</a>' +
            '<a onclick="$(\'#tisheng_type\').val(2);$(\'#tisheng_2\').css({\'background\':\'#438ff3\',\'color\':\'#fff\'});$(\'#tisheng_1\').css({\'background\':\'transparent\',\'color\':\'#000\'});" id="tisheng_2" style="width: 43%;height: 3.5rem; border: 1px solid #bfbfbf;text-align: center;border-radius: 5px;line-height: 3.5rem">固定金额</a>' +
            '</div>' +
            '<input style="width: 93%; margin: 0 auto;text-align: left;background:#f2f2f2;"  name="tisheng_value" id="tisheng_value" value="" placeholder="请输入数值" class="form-control  search-input">' +
            '</div>'+
            '</div>' +
            '</div>',
        btn1: function(index, layero){
            layer.closeAll();
        },
        btn2: function(index, layero){

            var type = $('#tisheng_type').val();
            if (type == "") {
                layer.msg("请选择提升类型");
                return false;
            }
            var text = $('#tisheng_value').val();
            if (text == "") {
                layer.msg("请填写数值");
                return false;
            }

            if(!cid && pcid){
                cid = calsslist[pcid].cids;
            }

            $.ajax({
                type: 'post',
                dataType: 'json',
                url: 'ajax_user.php?act=xiaji_up_price',
                cache: false,
                data: {cid: cid, up: text, type: type, kw: kw},
                success: function (data) {
                    if (data.code == 0) {
                        layer.alert('价格提升成功，刷新即可看到效果', {icon: 1}, function () {
                            window.location.reload();
                        });
                    } else {
                        layer.alert(data.msg);
                    }
                },
                error: function (data) {
                    layer.msg('网络异常，请稍后重试');
                }
            });

        },
        success: function(layero, index){
            var btn1= $(".layui-layer-btn .layui-layer-btn0");
            btn1.css({
                "width":" 50%",
                "height": "100%",
                "padding": "0",
                "margin":"0",
                "line-height": "4.5rem",
                "border-radius":" 0",
                "border":" 1px solid transparent",
                "background": "transparent",
                "color":"#999999",
            })
            var btn2= $(".layui-layer-btn .layui-layer-btn1");
            btn2.css({
                "width":" 50%",
                "height": "100%",
                "padding": "0",
                "margin":"0",
                "line-height": "4.5rem",
                "border-radius":" 0",
                "border":" 1px solid transparent",
                "border-left": "1px solid #f2f2f2",
                "background": "transparent",
                "color":"#000",
            })

        }
    });
}
function setActive(id){

    var i = $("input[type=hidden][name="+id+"]").val();
    console.log(id)
    if(id == 'del'){
        if(i == 1){
            $("#"+ id + " i").removeClass('fa-flip-horizontal');
            $("#"+ id + " i").css({"color":"#0b9ff5"});
            $("input[type=hidden][name="+id+"]").val(0)
        }else {
            $("#"+ id + " i").addClass('fa-flip-horizontal');
            $("#"+ id + " i").css({"color":"#94a7c1"});
            $("input[type=hidden][name="+id+"]").val(1)
        }
    }else if(id=='top'){
        if(i == 1){
            $("#"+ id + " i").addClass('fa-flip-horizontal');
            $("#"+ id + " i").css({"color":"#94a7c1"});
            $("input[type=hidden][name="+id+"]").val(0)
        }else {
            $("#"+ id + " i").removeClass('fa-flip-horizontal');
            $("#"+ id + " i").css({"color":"#0b9ff5"});
            $("input[type=hidden][name="+id+"]").val(1)
        }
    }

}

function open_msg(){
    layer.open({
        type:1,
        title: false,
        area: '28rem',
        shade: 0.7,
        skin: "layerdemo",
        shadeClose: false,
        closeBtn: 0,
        offset: '30%',
        content:
            '<div class="display-column  align-center"  style="position: relative" >'+
            '<div class="text-center" style="height: 3.5rem;line-height: 4.5rem;font-weight: 550;width:100%;font-size: 1.5rem">相关问题</div>'+
            '<div style="padding:10px 15px;font-size: 1.1rem;color: #545454;line-height:2rem;letter-spacing:.1rem;">修改价格之后首页价格没变化？<br>&nbsp;&nbsp;&nbsp;&nbsp;因为你当前的账号属于站长级别，需要你退出当前登录的账号后首页才能看到你设定的售价，否则看到的都是系统成本价</div>'+
            '<div  style="margin-top: 10px;border-top: 1px solid #f2f2f2; width: 100%;text-align: center;">' +
            '<a onclick="layer.closeAll();" href="javascript:void(0)" style="height:4.5rem;width: 100%;line-height: 4.5rem;font-size: 1.6rem;color:#378bd3;font-weight: 510">确定</a>' +
            '</div>'+
            '</div>',

    });
}
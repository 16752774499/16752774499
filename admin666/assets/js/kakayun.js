var ShopList

// SelectAll 选择全部
function SelectAll(chkAll) {
    var items = $('.shop');
    for (i = 0; i < items.length; i++) {
        if (items[i].type == "checkbox") {
            items[i].checked = chkAll.checked;
        }
    }
}

// loadCategory 加载分类数据
function loadCategory(shequ){
    $.ajax({
        type:'get',
        url:'kakayun.php?act=ajax_category&shequ=' + shequ,
        dataType : 'json',
        success:function (result){
            if(result.code !== 1){
                layer.msg(result.msg)
                return
            }

            $("#categoryTbody").html('')
            for (let i = 0; i < result.data.length; i++) {
                let item = result.data[i];
                let url = encodeURIComponent(item['groupimgurl']);
                $("#categoryTbody").append('<tr><td>'+item['groupid']+'</td><td>'+item['groupname']+'</td><td>'+item['brandname']+'</td><td><a href="kakayun.php?act=info&shequ='+shequ+'&cid='+item['groupid']+'&name='+item['groupname']+'&img='+url+'" class="btn btn-info btn-xs">一键对接</a></td></tr>')
            }
        }
    })
}

// loadGoods 加载商品列表
function loadGoods(shequ,cid){
    var localPage = 1

    loadGoodData(shequ,cid,localPage)
    // 上一页
    $("#prefixPage").on('click',function(){
        let p = $(this).parent()
        if(p.hasClass('disabled')){
            console.log('禁止上一页')
            return
        }

        localPage--
        loadGoodData(shequ,cid,localPage)
    })
    // 下一页
    $("#nextPage").on('click',function(){
        let p = $(this).parent()
        if(p.hasClass('disabled')){
            console.log('禁止下一页')
            return
        }
        localPage++
        loadGoodData(shequ,cid,localPage)
    })
}

// loadGoodData 加载商品列表数据
function loadGoodData(shequ,cid,page){
    $.ajax({
        type:'get',
        url:'kakayun.php?act=ajax_goods&shequ=' + shequ + '&cid=' + cid + '&page=' + page,
        dataType : 'json',
        success:function (result){
            $("#shopListTbody").html('')
            if(result.code !== 1){
                $("#shopListTbody").html('<tr><td style="text-align: center" colspan="6">'+result.msg+'</td></tr>')
                return
            }

            ShopList = new Array();

            for (let i = 0; i < result.data.length; i++) {
                let item = result.data[i];
                let status = item['is_ok'] ? '<span class="btn btn-xs btn-success">已对接</span>' : '<span class="btn btn-xs btn-error">未对接</span>';
                ShopList[item['goodsid']] = JSON.stringify(item);

                $("#shopListTbody").append('<tr>' +
                    '<td><label class="csscheckbox csscheckbox-primary">\n' +
                    '<input name="tid[]" type="checkbox" class="shop" value="'+item['goodsid']+'"><span></span></label>&nbsp;&nbsp;'+item['goodsid']+'</td>' +
                    '<td>\n' +
                    ' <img class="img-thumbnail" width="25" height="25" src="'+item['imgurl']+'" alt="">\n' +
                    '</td>\n' +
                    '<td>'+item['goodsname']+'</td>\n' +
                    '<td>'+item['goodsprice']+'</td>\n' +
                    '<td>'+item['stock']+'</td>\n' +
                    '<td>'+ status +'</td>\n' +
                    '</tr>')
            }

            // 页面切换
            $(".pagination > li").removeClass("disabled")
            $(".pagination > li").addClass("disabled")
            if(page > 1){
                $("#prefixPage").parent().removeClass('disabled')
            }

            if(page < result.allpage){
                $("#nextPage").parent().removeClass('disabled')
            }

        }
    })
}

$(function (){

    // 提交事件
    $("#add_submit").on('click',function(){
        var shequ = $("input[name='shequ']").val();
        var cname = $("input[name='cname']").val();
        var cimg = $("input[name='cimg']").val();
        var mcid = $("#mcid").val();
        var prid = $("#prid").val();

        if(mcid == -1){
            layer.alert('请选择保存到本站的分类');return false;
        }
        if(prid == -1){
            layer.alert('请选择使用的加价模板');return false;
        }

        var shops = new Array();
        var items = $('.shop');
        for (i = 0; i < items.length; i++) {
            if (items[i].type == "checkbox" && items[i].checked == true) {
                var tid = items[i].value;
                var op = JSON.parse(ShopList[tid])
                shops.push({
                    tid: op['goodsid'],
                    name: op['goodsname'],
                    price: op['goodsprice'],
                    shopimg: op['imgurl'],
                    isfaka: op['goodstype'] === 1 ? 0 : 1,
                    close: op['goodsstatus'] === 1 ? 0 : 1,
                    input: '',
                    inputs: '',
                    repeat: 1,
                    multi: 1,
                    min: 1,
                    max:1,
                    validate: 0,
                });
            }
        }

        if(shops.length <= 0){
            layer.alert('请至少选中一个商品');return false;
        }

        let execute = function (){

            // 导入/成功/错误的统计
            let importCount = 0,
                errorCount = 0,
                successCount = 0;

            // updateMark 更新统计
            function updateMark(){
                $("#loadingStatusMark").text("正在导入商品，共 "+shops.length+" 个商品 / 导入 "+importCount+" 个商品")
                if(importCount >= shops.length){
                    layer.closeAll();
                    layer.alert("导入完成，成功导入["+successCount+"]个，导入失败["+errorCount+"]个", {icon:1},function(){
                        window.location.reload()
                    });
                }
            }

            for (let i = 0; i < shops.length; i++) {
                let item = shops[i];
                let param = {
                    shequ: shequ,
                    mcid: mcid,
                    prid: prid,
                    data: item,
                    cname: cname,
                    cimg: cimg
                }

                setTimeout(function(){
                    console.log('开始执行' + i)
                    $.ajax({
                        type : "POST",
                        url : "kakayun.php?act=ajax_post",
                        dataType : 'json',
                        data : param,
                        success : function(data) {
                            importCount++;
                            if(data.code == 0){
                                successCount++;
                            }else{
                                errorCount++;
                            }
                            updateMark();
                        },
                        error:function(){
                            importCount++;
                            errorCount++;
                            updateMark();
                        }
                    });
                },500 * i)
            }

        }

        layer.msg('<span id="loadingStatusMark">正在导入商品，共 '+shops.length+' 个商品 / 导入 0 个商品</span>', {
            icon: 16
            ,shade: 0.5
            ,time: 0,
            success: execute
        });

    })

})
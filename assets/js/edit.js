var shoplist;
function checkinput(){
	if($("input[name='name']").val()==''){
		layer.alert("商品名称不能为空");
		return false;
	}
	if($('#cid').val() == '0'){
	    layer.alert("请选择分类");
		return false; 
	}

	if( $("#shopimg").val() == ""){
	    layer.alert("请上传商品图");
		return false;
	}
	window.editor.sync();
	if($("#editor_id").val() == ""){
	   layer.alert("请填写商品简介");
		return false; 
	}
	
	return true;
}
function fileSelect(){
	$("#file").trigger("click");
}
function fileView(){
	var shopimg = $("#shopimg").val();
	if(shopimg=='') {
		layer.alert("请先上传图片，才能预览");
		return;
	}
	if(shopimg.indexOf('http') == -1)shopimg = '../'+shopimg;
	layer.open({
		type: 1,
		area: ['360px', '400px'],
		title: '商品图片查看',
		shade: 0.3,
		anim: 1,
		shadeClose: true,
		content: '<center><img width="300px" src="'+shopimg+'"></center>'
	});
}
function fileUpload(){
	var fileObj = $("#file")[0].files[0];
	if (typeof (fileObj) == "undefined" || fileObj.size <= 0) {
		return;
	}
	var formData = new FormData();
	formData.append("do","upload");
	formData.append("type","shop");
	formData.append("file",fileObj);
	var ii = layer.load(2, {shade:[0.1,'#fff']});
	$.ajax({
		url: "../ajax.php?act=uploadimg",
		data: formData,
		type: "POST",
		dataType: "json",
		cache: false,
		processData: false,
		contentType: false,
		success: function (data) {
			layer.close(ii);
			if(data.code == 0){
				layer.msg('上传图片成功');
				$("#shopimg").val(data.url);
				$('#fileimg').attr('src' , '../'+data.url);
			}else{
				layer.alert(data.msg);
			}
		},
		error:function(data){
			layer.msg('服务器错误');
			return false;
		}
	})
}
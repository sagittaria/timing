//有的js必须放在 jQuery.js 引入之后
$(function(){
	//这是配合删除 block 时，控制【删除按钮】的可用或不用状态
	$("#confirmBlockDeleteModal #blockName").keyup(function(){
		a=$("#confirmBlockDeleteModal #blockName").val();
		b=$("#confirmBlockDeleteModal #nameOfTheBlockToBeDeleted").text();
		if(a==b){
			$('#btnDeleteBlock').removeAttr('disabled');
		}else{
			$('#btnDeleteBlock').attr('disabled','diabled');
		}
	});
	
})
$(function(){
	//因为不知道 $.post 如何传递作用域 因此 设置如下变量
    var new_i =0;
    var current_i = 0;
	var current_e_id = 0;
	var current_e_text = '';
    var padding = 0;
	
	// 新增分类回调函数
    function complete_a(data){
        if(data.status ==1){
            var vo = data.data;
            padding = (vo.path.split(',').length-2)*15; //根据path计算出层次从而得到缩进
            $('#new_tr_'+current_i).replaceWith("<tr><td><input type='checkbox' name='action_ids' value='"+vo.id+"' /></td><td>"+vo.id+"</td><td class='list_title' style='padding-left:"+padding+"px;'>"+vo.name+"</td><td><a id='"+vo.id+"' class='btn_a_cate' href='#' rel='"+vo.path+"'>增加子分类 </a> | <a href='#' class='btn_e_cate'>编辑</a> | <a rel='"+vo.id+"' class='btn_d_data' href='#'> 删除</a</td></tr>");
           //alert($('#new_tr_'+current_i).html());
    	}
    }
	
	// 编辑分类回调函数
	function complete_e(data){
        if(data.status ==1){
            //$('input[value="+current_e_id+"]').parents('td').html(current_e_text);
           $('.cate_e_sure').parents('td').html(current_e_text);
    	}
    }
    
    
	// 显示新增分类表单
    $('.btn_a_cate').live('click',function(){
       padding = ($(this).attr('rel').split(',').length-1)*15;
        $(this).parents("tr").after("<tr id='new_tr_"+new_i+"' style='display:none;'><td></td><td></td><td class='list_title' style='padding-left:"+padding+"px;'><form method='post'><input type='text' name='name' class='cate_name_input' /><input type='hidden' name='parent_id' value='"+$(this).attr('id')+"' /><input type='hidden' name='path' value='"+$(this).attr('rel')+"' /><a href='#' class='cate_a_sure'>确定</a> | <a href='#' class='cate_a_cancle'>取消</a></form></td><td></td></tr>");
        $("#new_tr_"+new_i++).show(1000);
        return false;
    });
	
	// 新增分类表单提交
    $('.cate_a_sure').live('click',function(){
        //$.post($("#insert_url").attr('href'),$(this).parent('form').serialize(),function(data){
            //alert(data.info);
        //},'json');
		var options={
			url:$('#insert_url').val(),
			success:complete_a,
			dataType:'json'
		};
        $(this).parent('form').ajaxForm(options);
        var tr_id = $(this).parents('tr').attr('id');
        current_i = tr_id.lastIndexOf('_')+1;
        current_i = tr_id.substr(current_i);
        $(this).parent('form').submit();
    });
	
	 //新增分类表单取消
	 $('.cate_a_cancle').live('click',function(){
		$(this).parents('tr').remove();
	 });

	//显示编辑表单
	$('.btn_e_cate').live('click',function(){
		if($(this).parent('td').prev().children(':eq(0)').is('form')){
			return false;
		}else{
		var e_text = $(this).parent('td').prev().text();
		//var e_id = $(this).parent('td').prev().prev().text();
		var e_id = $(this).parents('tr').children(':eq(1)').text();
		//alert (e_id);
		$(this).parent('td').prev().html("<form method='post'><input name='name' value='"+e_text+"' class='cate_name_input' /><input type='hidden' name='id' value='"+e_id+"' /><a href='#' class='cate_e_sure'>确定</a> | <a href='#' class='cate_e_cancle'>取消</a></form>");
			return false;
		}
	});
									
	
	//编辑表单取消功能
	$('.cate_e_cancle').live('click',function(){
		var e_text = $(this).siblings('input[name=name]').val();
		$(this).parents('td').text(e_text);
	});
	
	//编辑表单提交
	$('.cate_e_sure').live('click',function(){
		var options={
			url:$('#edit_url').val(),
			success:complete_e,
			dataType:'json'
		};
        $(this).parent('form').ajaxForm(options);
		current_e_id = $(this).siblings('input[name=id]').val();
		current_e_text = $(this).siblings('input[name=name]').val();
        $(this).parent('form').submit();
	});
})
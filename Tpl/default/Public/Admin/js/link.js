$(function(){


	
	
	//根据分类显示内容
	$('#cate_tree a[href!=#]').click(function(){
		//alert($(this).attr('href'));
		if(!$('#cate_id_get').val()){
			$("#current_cate").val($(this).attr('rel'));
			$.get($("#main_url").val(),{'ajax':true,'p':1,'id':$(this).attr('rel')},return_info,'json');
			return false;
		}
	});

	
	function return_info(data){
		if(data.status == 1){
				$("#cate_path_string").text(data.data.cate_path_string);
				$('#tr_head').siblings('[id!=tr_page]').remove();
				var list = data.data.list;
				for(var i=0;i<list.length;i++){
					$('#tr_page').before("<tr><td><input type='checkbox' name='action_ids' value='"+list[i]['id']+"' /></td><td>"+list[i]['id']+"</td><td class='list_title'>"+list[i]['title']+"</td><td>"+list[i]['url']+"</td><td><a href='"+$('#edit_url').val()+"/id/"+list[i]['id']+"'>编辑</a> | <a href='#' rel='"+list[i]['id']+"' class='btn_d_data'>删除</a></td></tr>");
				}
				$('.page').html(data.data.page);
				
				//alert(list);
		}
	}
	
		
});
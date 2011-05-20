$(function(){
		   
	$('#cate_tree ul ul').hide();
	
	$('.close').live('click',function(){
		$(this).attr('class','open');
		$(this).siblings('ul').slideDown(200);
	});
	
	$('.open').live('click',function(){
		$(this).attr('class','close');
		$(this).siblings('ul').slideUp(200);
	});
	
	$('.attach_a').click(function(){
		$('#attach_list').prepend("<li><input type='file' name='attach[]' /></li>");
		return false;
	});
	
	//alert($('#cate_id_get').val());
	$('#cate_id option').each(function(){
		if($(this).val() == $('#cate_id_get').val()){
			$(this).attr('selected',true);
		}
	});
	
	
	if($('#is_pub_get').val() == 1){
		$('#is_pub').attr('checked',true);
	}
	
	$('span.page a').live('click',function(){
		
		var href = $(this).attr('href');
		var ajax_url = href.split('?');
		$.ajax({
			url: ajax_url[0],
			data: ajax_url[1],
			success:return_info,
			dataType:'json'	   
		});
		//alert($(this).text());
		return false;
	});
	
	$('#cate_tree span').click(function(){
		//alert($(this).attr('href'));
		$("#current_cate").val($(this).attr('href'));
		$.get($("#main_url").val(),{'ajax':true,'p':1,'id':$(this).attr('href')},return_info,'json');
		
		
	});

	function return_info(data){
		if(data.status == 1){
				$("#cate_path_string").text(data.data.cate_path_string);
				$('#tr_head').siblings('[id!=tr_page]').remove();
				var list = data.data.list;
				for(var i=0;i<list.length;i++){
					$('#tr_page').before("<tr><td><input type='checkbox' name='action_ids' value='"+list[i]['id']+"' /></td><td>"+list[i]['id']+"</td><td class='list_title'>"+list[i]['title']+"</td><td>"+list[i]['c_time']+"</td><td>"+list[i]['r_times']+"</td><td>编辑 | 删除</td></tr>");
				}
				$('.page').html(data.data.page);
				
				//alert(list);
		}
	}
	
		
});
$(function(){
	
	//分类导航处理
	$('#cate_tree ul ul').hide();
	$('.close').live('click',function(){
		$(this).attr('class','open');
		$(this).siblings('ul').slideDown(200);
		return false;
	});
	$('.open').live('click',function(e){
		
		$(this).attr('class','close');
		$(this).siblings('ul').slideUp(200);
		return false;
		
	});
	
	//定位分类
	if($('#cate_id_get').val()!=''){
		$('a[rel='+$('#cate_id_get').val()+']').parents('ul').show();
	}
	
	//选择分类
	$('#cate_id option').each(function(){
		if($(this).val() == $('#cate_id_get').val()){
			$(this).attr('selected',true);
		}
	});
	
	//AJAX分页
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
	
	
	//单独删除数据
	$('.btn_d_data').live('click',function(){
			$(this).attr('name','processing');
			$.post($('#del_url').val(),{'id':$(this).attr('rel')},function(data){
				alert(data.info);
				if(data.status == 1){
					$('.btn_d_data[name=processing]').parents('tr').remove();
				}else{
					$('.btn_d_data[name=processing]').attr('name','');
				}
			},'json');
			
			return false;
		});
	
	//删除选中数据
	$('#delete_ids').click(function(){
		var c_str="";
		$(':checkbox:checked[name=action_ids]').each(function(){		
			c_str+=$(this).val()+",";
		});
		c_str+="-1" //不然会把 0 传过去
		//alert(c_str);
		
		$.post($("#del_url").val(),{'id':c_str},function(data){
			alert(data.info);
			if(data.status == 1){
				$(':checkbox:checked[name=action_ids]').each(function(){		
					$(this).parents('tr').remove();
				});
			}
			//alert(data.status);
		},'json');
		
		return false;
	});
	
	
	// 全选功能
	$('#select_all_cb').click(function(){
		if(this.checked){
			$(':checkbox[name=action_ids]').attr('checked',true);
		}else{
			$(':checkbox[name=action_ids]').attr('checked',false);
		}
	});
});
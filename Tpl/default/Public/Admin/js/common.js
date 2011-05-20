﻿$(function(){
		   
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
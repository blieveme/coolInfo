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
		$('#attach_list').append("<li><input type='file' name='attach[]' /></li>");
		return false;
	});
	
	//alert($('#cate_id_get').val());
	$('#cate_id').val($('#cate_id_get').val());
		if($('#is_pub_get').val() == 1){
			$('#is_pub').attr('checked',true);
		}
});
$(function(){
	// 全选功能
	$('#select_all_cb').click(function(){
		if(this.checked){
			$(':checkbox[name=action_ids]').attr('checked',true);
		}else{
			$(':checkbox[name=action_ids]').attr('checked',false);
		}
	});
});
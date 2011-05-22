<?php
class ShowCateWidget extends Widget{
	function render($data){
		$Cate = M("Category");
		$cate = $Cate->where('parent_id=0')->order('id asc')->select();
		$menu = "<div id='cate'><div id='cate_top'></div><ul>";
		$Info = M('Info');
		foreach($cate as $menu_li){
			$map['cate_path'] = array('like',$menu_li['path'].'%');
			$map['is_pub'] = 1;
			$count = $Info->where($map)->count();
			$menu.="<li><a href='__URL__/index/cate_id/".$menu_li['id']."'><span>".$count."</span>".$menu_li['name']."</a></li>";
		}
		$menu.="</ul><div id='cate_footer'></div></div>";
		return $menu;
	}
}
?>
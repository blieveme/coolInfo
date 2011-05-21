<?php
class ShowHomeMenuWidget extends Widget{
	function render($data){
		$Cate = M("Category");
		$cate = $Cate->where('parent_id=0')->select();
		$menu = "<div id='menu'><ul><li><a href='__APP__'>首 页</a></li>";
		foreach($cate as $menu_li){
			
			$menu.="<li><a href='__GROUP__/Index/index/cate_id/".$menu_li['id']."'>".$menu_li['name']."</a></li>";
		}
		$menu.="</ul></div>";
		return $menu;
	}
}
?>
<?php
class ShowFavWidget extends Widget{
	function render($data){
		$Cate = M("Link");
		$cate = $Cate->order('id asc')->select();
		$menu = "<div class='sidepanel'><h4 class='Ptitle'>My Favorite</h4><div class='Pcontent'>";
		foreach($cate as $menu_li){
			$menu.="<a href='".$menu_li['url']."' class='sideA' target='_blank'>".$menu_li['title']."</a>";
		}
		$menu.="</div><div class='Pfoot'></div></div>";
		return $menu;
	}
} 
?>
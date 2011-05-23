<?php
class LinkAction extends CommonAction{
    
	public function main(){
		$Info =  M("Link");
		$cate_path = isset($_GET['id'])?$this->getCatePath($_GET['id']):',0,';
		$map['cate_path'] = array('like',$cate_path.'%');
		import('ORG.Util.Page');
		$count = $Info->where($map)->count();
		$p = new Page ( $count, 10 );
		$list=$Info->where($map)->limit($p->firstRow.','.$p->listRows)->order('id desc')->findAll();
		if($_GET['ajax']){
			$page = $p->show ();
			$data['cate_path_string'] = $this->catePathString($_GET['id']);
			$data['list'] = $list;
			$data['page'] = $page;
			$this->ajaxReturn($data,$cate_path,1);
		}else{
			$p->parameter.='ajax=true';
			$page = $p->show ();
			$this->assign( "page", $page );
			$this->assign( "list", $list );
			//dump($info);
			//exit;
			$this->assign('tree',$this->getTree());
			$this->display();
		}
    }
	
	public function add(){
		$this->assign('tree',$this->getTree(0,1));
        $this->display();
    }	
	
	
	// style ：显示形式，0 以ul形式， 1以 select 形式
   protected function getTree($p_id=0,$style=0){
       $Category = M("Type");
       $cate = $Category->where('parent_id='.$p_id)->order('id')->select();
	   switch($style){
		   case 1:
			   foreach ($cate as $data){
				   $padding = (count(explode(',', $data['path']))-4)*10;
				   $content.="<option value='".$data['id']."' style='padding-left:".$padding."px'>".$data['name']."</option>";
				   $content.=$this->getTree($data['id'],1);
			   }
			   break;
		   default:
		   	   $content.="<ul>";
			   foreach ($cate as $data){
				   if($this->haveSon($data['id'])){
					   $cls = 'close';
				   }else{
					   $cls = 'leaf';
				   }
				   $content.="<li><a href='#' class='".$cls."'></a><a href='__URL__/main/id/".$data['id']."' rel='".$data['id']."'>".$data['name']."</a>";
				   $content.=$this->getTree($data['id']);
				   $content.="</li>";
			   }
			   $content.="</ul>";
			   break;
	   }
       return $content;
   }
   
   protected function haveSon($id){
	   $Category = M('Type');
	   if($Category->where('parent_id='.$id)->find()){
		   return true;
	   }else{
		   return false;
	   }
   }
   
   public function insert(){
		$Info = D("Link");
		if($Info->create()){
			$Info->cate_path = $this->getCatePath($_POST['cate_id']);
			if($info_id = $Info->add()){
				$this->redirect('Link/main/msg/添加成功!');
			}else{
				$this->error('新增失败');
			}
		}else{
			$this->error($Info->getError());
		}
   }
   
   public function edit(){
	   $Info = M("Link");
	   $info = $Info->find($_GET['id']);
	   $Attach = M("Attach");
	   $this->assign('vo',$info);
	   $this->assign('tree',$this->getTree(0,1));
	   $this->assign('tree_nav',$this->getTree());
	   $this->display();
   }
   
   public function update(){
	   $Info = M("Link");
	   //dump($_POST['is_pub']);
	   //exit;
		if($Info->create()){
			$Info->cate_path = $this->getCatePath($_POST['cate_id']);
			if($Info->save()){
				$this->redirect('Link/edit/id/'.$Info->id.'/msg/编辑成功!');
			}else{
				$this->error('编辑失败!');
			}
		}else{
			$this->error($Info->getError());
		}
   }
   
   public function del(){
		
		if($_POST['id']){
			
			$Info = M("Link");
			$map['id'] = array('in',$_POST['id']);
			if($Info->where($map)->delete()){
				$this->success('删除成功');
			}else{
				$this->error('删除信息数据失败');
			}
		}else{
			$this->error('没 ID');
		}
   }
   
   protected function getCatePath($id){
	   $Category = M("Type");
	   $cate = $Category->find($id);
	   $cate_path = $cate['path'];
	   return $cate_path;
   }
   
   protected function catePathString($id){
	   $Category = M("Type");
	   
	   if($id != 0){
		   
		  $cate = $Category->find($id);
		  $content.=$this->catePathString($cate['parent_id']).' > '.$cate['name'];
		  
	   }else{
		   $content = '根目录';
	   }
	   return $content;
   }
   
}
?>
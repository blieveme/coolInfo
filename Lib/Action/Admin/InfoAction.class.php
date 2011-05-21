<?php
class InfoAction extends CommonAction{
    
	public function main(){
		$Info =  M("Info");
		$cate_path = isset($_GET['id'])?$this->getCatePath($_GET['id']):',0,';
		$map['cate_path'] = array('like',$cate_path.'%');
		import('ORG.Util.Page');
		$count = $Info->where($map)->count();
		$p = new Page ( $count, 15 );
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
       $Category = M("Category");
       $cate = $Category->where('parent_id='.$p_id)->select();
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
	   $Category = M('Category');
	   if($Category->where('parent_id='.$id)->find()){
		   return true;
	   }else{
		   return false;
	   }
   }
   
   public function insert(){
		$Info = D("Info");
		if($Info->create()){
			$Info->cate_path = $this->getCatePath($_POST['cate_id']);
			if($info_id = $Info->add()){
				if(!empty($_FILES['attach']['name'][0])){
					$this->uploadFile($info_id);
				}
				$this->redirect('Info/edit/id/'.$info_id.'/msg/添加成功!');
			}else{
				$this->error('新增失败');
			}
		}else{
			$this->error($Info->getError());
		}
   }
   
   public function edit(){
	   $Info = M("Info");
	   $info = $Info->find($_GET['id']);
	   $Attach = M("Attach");
	   $att = $Attach->where('info_id='.$_GET['id'])->select();
	   $this->assign('att',$att);
	   $this->assign('vo',$info);
	   $this->assign('tree',$this->getTree(0,1));
	   $this->assign('tree_nav',$this->getTree());
	   $this->display();
   }
   
   public function update(){
	   $Info = D("Info");
	   //dump($Info->create());
	   //exit;
		if($Info->create()){
			$Info->cate_path = $this->getCatePath($_POST['cate_id']);
			$Info->save();
				if(!empty($_FILES['attach']['name'][0])){
					$this->uploadFile($Info->id);
				}
				if(!empty($_POST['ids_d_att'])){
					$Att = M('Attach');
					$map['id'] = array('in',$_POST['ids_d_att']);
					$att = $Att->where($map)->select();
					foreach($att as $file){
						if(!unlink(C('uploads_path').$file['f_name'])){
							$this->error('删除附件文件失败');
						}elseif(!$Att->delete($file['id'])){
							$this->error('删除附件数据失败');
						}
					}
				}
						
				$this->redirect('Info/edit/id/'.$Info->id.'/msg/编辑成功!');
		}else{
			$this->error($Info->getError());
		}
   }
   
   public function del(){
		
		if($_POST['id']){
			
			$Attach = M("Attach");
			$att_map['info_id'] = array('in',$_POST['id']);
			$att = $Attach->where($att_map)->select();
			foreach($att as $file){
				if(!unlink(C('uploads_path').$file['f_name'])){
					$this->error('删除附件文件失败');
				}
			}
			if(!$Attach->where($att_map)->delete()){
				$this->error('删除附件数据失败');
			}
			$Info = M("Info");
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
	   $Category = M("Category");
	   $cate = $Category->find($id);
	   $cate_path = $cate['path'];
	   return $cate_path;
   }
   
   protected function catePathString($id){
	   $Category = M("Category");
	   
	   if($id != 0){
		   
		  $cate = $Category->find($id);
		  $content.=$this->catePathString($cate['parent_id']).' > '.$cate['name'];
		  
	   }else{
		   $content = '根目录';
	   }
	   return $content;
   }
   
   protected function uploadFile($info_id){
	    import('ORG.Net.UploadFile');
		$upload = new UploadFile();
		$upload->savePath = './Public/uploads/';
		if(!$upload->upload()){
			$this->error($upload->getErrorMsg());
		}else{
			$upload_info = $upload->getUploadFileInfo();
			$Attach = M('Attach');
			foreach($upload_info as $upload_file){
				$data['info_id'] = $info_id;
				$data['f_name'] = $upload_file['savename'];
				if(!$Attach->add($data)){
					$this->error('附件录入出错');
				}
			}
		}
   }
   
}
?>
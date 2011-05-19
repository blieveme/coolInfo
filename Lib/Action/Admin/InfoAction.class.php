<?php
class InfoAction extends CommonAction{
    
	public function main(){
		$this->assign('tree',$this->getTree());
        $this->display();
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
				   $content.="<li><a href='#' class='".$cls."'></a><span>".$data['name']."</span>";
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
				if(isset($_FILES['attach'])){
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
	   $this->display();
   }
   
   protected function getCatePath($id){
	   $Category = M("Category");
	   $cate = $Category->find($id);
	   $cate_path = $cate['path'];
	   return $cate_path;
   }
}
?>
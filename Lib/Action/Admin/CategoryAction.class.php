<?php
class CategoryAction extends CommonAction{
    
    
    public function main(){
        $Category= M("Category");
        $this->assign('tree',  $this->getTree());
        $this->display();
    }
     
    
   protected function getTree($p_id=0){
       $Category = M("Category");
       $cate = $Category->where('parent_id='.$p_id)->select();
	   $padding = (count(explode(',', $cate[0]['path']))-2)*15;
       foreach ($cate as $data){
       $content .="<tr><td><input type='checkbox' name='action_ids' value='".$data['id']."' /></td><td>".$data['id']."</td><td class='list_title' style='padding-left:".$padding."px;'>".$data['name']."</td><td><a id='".$data['id']."' class='btn_a_cate' href='#' rel='".$data['path']."'>增加子分类 </a>| <a href='#' class='btn_e_cate'>编辑</a> |<a rel='".$data['id']."' class='btn_d_data' href='#'> 删除</a></td></tr>";
       $content.=$this->getTree($data['id']);
       }
       return $content;
   }


   public function insert(){
        $Category = D('Category');
        if($vo=$Category->create()){
            if($id=$Category->add()){
                $vo['id'] = $id;
                $vo['path'] = $vo['path'].$id.",";
                if($Category->save($vo)){
                    $this->ajaxReturn($vo,'新增成功',1);
                }else{
                    $this->error('新增后更新失败');
                }  
            }else{
                $this->error('新增失败');
            }
        }else{
            $this->error($Category->getError());
        }
    }
    public function del(){
        $Category = M('Category');
		$map_parent['parent_id'] = array('in',$_POST['id']);
		if($Category->where($map_parent)->find()){
			$this->error('包含子目录，请先删除子目录');
			//$this->error($_POST['id']);
		}else{
			$Info = M('Info');
			$map_info['cate_id'] = array('in',$_POST['id']);
			if($Info->where($map_info)->find()){
				$this->error('包含信息，请先删除信息');
			}else{
				$map['id'] = array('in',$_POST['id']);
				if($Category->where($map)->delete()){
					$this->success('删除成功');
				}else{
					$this->error('删除失败');
				}
			}
		}
		
    }
	
	public function edit(){
		$Category = D('Category');
		if($Category->create()){
			$Category->save();
			$this->success('更新成功');
		}else{
			$this->error($Category->getError());
		}
			
	}
	
}
?>

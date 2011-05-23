<?php
// 本文档自动生成，仅供测试运行
class IndexAction extends Action
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
        $Info = M('Info');
		
		$cate_path = $_GET['cate_id'] ? $this->getCatePath($_GET['cate_id']) : ',0,';
		$map['cate_path'] = array('like',$cate_path.'%');
		$map['is_pub'] = 1;
		import('ORG.Util.Page');
		$count = $Info->where($map)->count();
		$p = new Page($count,10);
		$info = $Info->where($map)->limit($p->firstRow.','.$p->listRows)->order('id desc')->select();
		$this->assign('info',$info);
		$this->assign('page',$p->show());
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
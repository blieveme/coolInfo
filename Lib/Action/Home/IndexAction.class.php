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
		$A_info = A('Admin.Info');
		
		$cate_path = $_GET['cate_id'] ? $A_info->getCatePath($_GET['cate_id']) : ',0,';
		$map['cate_path'] = array('like',$cate_path.'%');
		$map['is_pub'] = 1;
		import('ORG.Util.Page');
		$count = $Info->where($map)->count();
		$p = new Page($count,10);
		$info = $Info->where($map)->limit($p->firstRow.','.$p->listRows)->select();
		$this->assign('info',$info);
		$this->assign('page',$p->show());
		$this->display();
    }


}
?>
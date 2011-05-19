<?php
class InfoModel extends Model{
    protected $_validate = array(
        array('title','require','请输入标题',1),
        array('content','require','请输入内容',1),
        array('cate_id','require','请选择分类',1),
    );
    
    protected $_auto = array(
        array('c_time','sql_date',1,'function'),
    );
	
	
	
}
?>

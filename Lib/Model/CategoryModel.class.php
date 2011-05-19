<?php
class CategoryModel extends Model{
    protected $_validate = array(
        array('name','require','请输入名称',1)
    );
    
    protected $_auto = array(
        //array('parent_id','0',1),

    );
}
?>

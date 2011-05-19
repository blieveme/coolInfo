<?php
class CommonAction extends Action{
    public function _initialize(){
        if(!isset ($_SESSION['power'])){
            $this->redirect('Admin-Index/index');
        }
    }
}
?>

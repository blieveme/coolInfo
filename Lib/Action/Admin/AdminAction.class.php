<?php
class AdminAction extends CommonAction{

    public function logout(){
        session_destroy();
        $this->redirect("Index/index");
    }
}
?>
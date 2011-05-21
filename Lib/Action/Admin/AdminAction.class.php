<?php
class AdminAction extends CommonAction{

    public function logout(){
        session_destroy();
        $this->redirect("Index/index");
    }
	
	public function updateAccount(){
		if($_POST['passwd'] && $_POST['old_pwd']){
			$Power = M('Power');
			$po = $Power->find();
			$data['id'] = 1;
		}else{
			$this->redirect('Admin/account/msg/请输入密码！');
		}
		
    }
}
?>
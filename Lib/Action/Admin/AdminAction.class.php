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
			if($po['passwd'] != md5($_POST['old_pwd'])){
				$this->redirect('Admin/account/msg/密码错无！');
			}else{
				if($_POST['passwd'] != $_POST['con_passwd']){
					$this->redirect('Admin/account/msg/两次密码不相同！');
				}else{
					$data['id'] = 1;
					$data['passwd'] = md5($_POST['passwd']);
					$Power->save($data);
					$this->redirect('Admin/account/msg/修改成功！');
				}
			}
		}else{
			$this->redirect('Admin/account/msg/请输入密码！');
		}
		
    }
}
?>
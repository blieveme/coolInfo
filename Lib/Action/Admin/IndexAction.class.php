<?php
class IndexAction extends Action{
    public function checkLogin(){
        $Power = M("Power");
        $map['username'] = $_POST['username'];
        $map['passwd'] = md5($_POST['userpwd']);
        $resault = $Power->where($map)->find();
        if($resault){
            $_SESSION['power'] = true;
            $data['l_login_ip'] = get_client_ip();
            $data['l_login_time'] =date('Y-m-d');
            $Power->where('id=1')->save($data);
            $this->redirect('Admin/main');
        }else{
            $this->error('登录失败');
        }
    }

}
?>

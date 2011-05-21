<?php if (!defined('THINK_PATH')) exit();?><!-- layout::Admin:top::0 -->
<!-- layout::Admin:first_side::0 -->
    <div id="content">
    	<div id="account_form" class="form_main">
            <form action="__URL__/updateAccount" method="post">
            <h3>账号信息维护<?php if($_GET['msg'] != ''): ?><div class="msg"><?php echo ($_GET['msg']); ?></div><?php endif; ?></h3>
            <p>
            <label for="username">账号：</label>
            <span>管理员</span>
            </p>
            <p>
            <label for="old_pwd">原密码：</label>
            <input type="password" name="old_pwd" />
            </p>
            <p>
            <label for="passwd">新密码：</label>
            <input type="password" name="passwd" />
            </p>
            <p>
            <label for="con_passwd">确认新密码：</label>
            <input type="password" name="con_passwd" />
            </p>
            <p class="p_bottom">
            <input type="submit" value="保存" class="btn_main" />
            <input type="reset" value="重设" class="btn_main" />
            </p>
            </form>
        </div>
    </div>
<!-- layout::Admin:footer::0 -->
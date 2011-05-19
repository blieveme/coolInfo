<?php if (!defined('THINK_PATH')) exit();?><!-- layout::Admin:top::0 -->
<!-- layout::Admin:first_side::0 -->
    <div id="content">
    	<div id="account_form" class="form_main">
            <form action="__URL__/update" method="post">
            <h3>账号维护</h3>
            <p>
            <label for="username">账号：</label>
            <span>管理员</span>
            </p>
            <p>
            <label for="old_pwd">原密码：</label>
            <input type="password" name="old_pwd" />
            </p>
            <p>
            <label for="new_psd">新密码：</label>
            <input type="password" name="new_pwd" />
            </p>
            <p class="p_bottom">
            <input type="button" value="登录" class="btn_main" />
            <input type="button" value="注册" class="btn_main" />
            </p>
            </form>
        </div>
    </div>
<!-- layout::Admin:footer::0 -->
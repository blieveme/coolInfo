<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../Public/Admin/css/admin.css" />
<title>管理员登录</title>
</head>

<body>
<div id="login_form" class="d_center">
<form action="__URL__/checkLogin" method="post">
<h3>管理员登录</h3>
<p>
<label for="username">账号：</label>
<input type="text" name="username" />
</p>
<p>
<label for="userpwd">密码：</label>
<input type="password" name="userpwd" />
</p>
<p>
<input type="submit" value="登录" />
<input type="button" value="注册" />
</p>
</form>
</div>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!-- layout::Admin:top::0 -->
<!-- layout::Admin:first_side::0 -->
    <div id="content">
    	<div id="form_info" class="form_main">
        	<h3>添加信息</h3>
        	<form method="post" action="__URL__/insert" enctype="multipart/form-data">
            	<p>
                	<label for="cate_id">分类：</label>
                    <select name="cate_id">
                    	<option value="0" selected="selected">----请选择----</option>
                        <option value="1">心情点滴</option>
                        <option value="2">心情点滴</option>
                        <option value="3">心情点滴</option>
                        <option value="4">心情点滴</option>
                        <option value="5">心情点滴</option>
                        <option value="6">心情点滴</option>
                    </select>
                </p>
                <p>
                	<label for="title">标题：</label>
                    <input type="text" name="title" />
                    <label for="is_pub" class="label_p_left"> 是否公开：</label>
                    <input type="checkbox" name="is_pub" class="c_box" />
                </p>
                <p>
                	<label for="content" class="t_top">内容：</label>
                    <textarea name="content" rows="10" cols="70"></textarea>
                </p>
                <p>
                	<label for="content">附件：</label>
                    <input type="file" name="attach" />
                    <ul id="attach_list">
                    	<li><a href="#">上传附件一.rar</a> <a href="#">删除</a></li>
                        <li><a href="#">上传附件二.rar</a> <a href="#">删除</a></li>
                    </ul>
                </p>
                <p class="p_bottom">
                	<input type="submit" value="提交" class="btn_main" /><input type="reset" value="重设" class="btn_main" />
                </p>
            </form>
        </div>
    </div>
<!-- layout::Admin:footer::0 -->
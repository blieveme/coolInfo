<?php if (!defined('THINK_PATH')) exit();?><!-- layout::Admin:top::0 -->
<!-- layout::Admin:first_side::0 -->
<script type="text/javascript" src="../Public/Admin/js/info.js"></script>
    <div id="content">
    	<div id="form_info" class="form_main">
        	<h3>添加信息</h3>
        	<form method="post" action="__URL__/insert" enctype="multipart/form-data">
            	<p>
                	<label for="cate_id">分类：</label>
                    <select name='cate_id'>
                    <?php echo ($tree); ?>
                    </select>
                </p>
                <p>
                	<label for="title">标题：</label>
                    <input type="text" name="title" />
                    <label for="is_pub" class="label_p_left"> 是否公开：</label>
                    <input name="is_pub" type="checkbox" class="c_box" value="1" checked="checked" />
                </p>
                <p>
                	<label for="content" class="t_top">内容：</label>
                    <textarea name="content" rows="10" cols="70"></textarea>
                </p>
                <p>
                	<label for="attach">附件：</label>
                    <input type="file" name="attach[]" /><a href="#" class="attach_a">增加</a>
                    <ul id="attach_list">
                    	
                    </ul>
                </p>
                <p class="p_bottom">
                	<input type="submit" value="提交" class="btn_main" /><input type="reset" value="重设" class="btn_main" />
                </p>
            </form>
        </div>
    </div>
<!-- layout::Admin:footer::0 -->
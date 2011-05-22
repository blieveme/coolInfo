<?php if (!defined('THINK_PATH')) exit();?><!-- layout::Admin:top::0 -->
<script type="text/javascript" src="../Public/Admin/js/common.js"></script>
<script type="text/javascript" src="../Public/Admin/js/info.js"></script>
<script type="text/javascript" src="../Public/js/kindsoft/kindeditor.js"></script>
<script type="text/javascript" src="../Public/js/kindsoft/plugins/highlighter/highlighter.js"></script>
<link rel="stylesheet" type="text/css" href="../Public/js/kindsoft/plugins/highlighter/highlighter.css" />
<script>
        KE.show({
                id : 'info_content'
        });
</script>
	<div id="first_side">
    	<div id="cate_tree">
        	<h3>分类导航</h3>
        	<?php echo ($tree_nav); ?>
        </div>
    </div>
    <div id="content">
    	<div id="form_info" class="form_main">
        	<h3>编辑信息<?php if($_GET['msg'] != ''): ?><div class="msg"><?php echo ($_GET['msg']); ?></div><?php endif; ?></h3>
        	<form method="post" action="__URL__/update" enctype="multipart/form-data">
            	<p>
                	<label for="cate_id">分类：</label>
                    <input type="hidden" id="cate_id_get" value="<?php echo ($vo["cate_id"]); ?>" />
                    <select id="cate_id" name='cate_id'>
                    <?php echo ($tree); ?>
                    </select>
                </p>
                <p>
                	<label for="title">标题：</label>
                    <input type="text" name="title" value="<?php echo ($vo["title"]); ?>" />
                    <label for="is_pub" class="label_p_left"> 是否公开：</label>
                    <input type="hidden" id='is_pub_get' value="<?php echo ($vo["is_pub"]); ?>" />
                    <input id="is_pub" name="is_pub" type="checkbox" class="c_box" value="1" />
                </p>
                <p>
                	<label for="content" class="t_top">内容：</label>
                    <div class="info_c_div"><textarea id="info_content" name="content" rows="15" cols="80"><?php echo ($vo["content"]); ?></textarea></div>
                </p>
                <p>
                	<label for="attach">附件：</label>
                    <input type="file" name="attach[]" /><a href="#" class="attach_a">增加</a>
                    <ul id="attach_list">
                    	<?php if(is_array($att)): $i = 0; $__LIST__ = $att;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$att): ++$i;$mod = ($i % 2 )?><li><a href="__APP__/Public/uploads/<?php echo ($att["f_name"]); ?>" target="_blank"><?php echo ($att["f_name"]); ?></a> <input type="checkbox" name="ids_d_att[]" value="<?php echo ($att["id"]); ?>" /> 删除</li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </p>
                <p class="p_bottom">
                	<input type="submit" value="保存" class="btn_main" /><input type="reset" value="重设" class="btn_main" /><input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />
                </p>
            </form>
        </div>
    </div>
<!-- layout::Admin:footer::0 -->
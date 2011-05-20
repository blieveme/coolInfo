<?php if (!defined('THINK_PATH')) exit();?><!-- layout::Admin:top::0 -->
<!-- layout::Admin:first_side::0 -->
<script type="text/javascript" src="../Public/js/jquery.form.js"></script>
<script type="text/javascript" src="../Public/Admin/js/common.js"></script>
<script type="text/javascript" src="../Public/Admin/js/category.js"></script>
    <div id="content">
    	<div id="cate_list">
                    <input type="hidden" id="insert_url" value="__URL__/insert" />
                    <input type="hidden" id="del_url" value="__URL__/del" />
                    <input type="hidden" id="edit_url" value="__URL__/edit" />
        	<table class="list">
            	<tr>
                	<th></th><th>ID</th><th width="250">名称</th><th>操作</th>
                </tr>
                <tr>
                    <td></td><td>0</td><td class="list_title">根目录</td><td><a id="0" class="btn_a_cate" href="#" rel=',0,'>增加子分类</a></td>
                </tr>
                <?php echo ($tree); ?>
                <tr>
                	<td><input id="select_all_cb" type="checkbox" /></td><td colspan="3"><span class="table_action">批量操作：<a href="#" id="delete_ids">删除</a></span></td>
                </tr>
            </table>
        </div>
    </div>
<!-- layout::Admin:footer::0 -->
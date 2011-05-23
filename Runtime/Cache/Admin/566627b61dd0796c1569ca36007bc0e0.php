<?php if (!defined('THINK_PATH')) exit();?><!-- layout::Admin:top::0 -->
<script type="text/javascript" src="../Public/Admin/js/common.js"></script>
<script type="text/javascript" src="../Public/Admin/js/info.js"></script>
    <div id="first_side">
    	<div id="cate_tree">
        	<h3>分类导航</h3>
        	<?php echo ($tree); ?>
        </div>
    </div>
    <div id="content">
    	<div id="info_list">
        	<input type="hidden" id="main_url" value="__URL__/main" />
            <input type="hidden" id="del_url" value="__URL__/del" />
            <input type="hidden" id="edit_url" value="__URL__/edit" />
            
            <input type="hidden" id="current_cate" value=",0," />
            <div class="list_path">当前分类：<span id="cate_path_string"></span> <a href="__URL__/add" class="list_add">新增信息</a></div>
        	<table class="list">
            	<tr id="tr_head">
                	<th></th><th>ID</th><th>标题</th><th>创建时间</th><th>阅读次数</th><th>操作</th>
                </tr>
                
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr>
                	<td><input type="checkbox" name="action_ids" value="<?php echo ($vo["id"]); ?>" /></td><td><?php echo ($vo["id"]); ?></td><td class="list_title"><?php echo ($vo["title"]); ?></td><td><?php echo ($vo["c_time"]); ?></td><td><?php echo ($vo["r_times"]); ?></td><td><a href="__URL__/edit/id/<?php echo ($vo["id"]); ?>">编辑</a> | <a href="#" rel="<?php echo ($vo["id"]); ?>" class="btn_d_data">删除</a></td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <tr id="tr_page">
                	<td><input id="select_all_cb" type="checkbox" /></td><td colspan="5"><span class="table_action">批量操作：<a href="#" id="delete_ids">删除</a></span><span class="page"><?php echo ($page); ?></span></td>
                </tr>
            </table>
        </div>
    </div>
<!-- layout::Admin:footer::0 -->
<?php if (!defined('THINK_PATH')) exit();?><!-- layout::Public:top::0 -->
<!-- layout::Public:first_side::0 -->
    <div id="content">
    	<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="info_detail">
            	<h3><?php echo ($vo["title"]); ?></h3>
                <span>创建时间：<?php echo ($vo["c_time"]); ?></span>
                <p><?php echo ($vo["content"]); ?></p>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        <div id="page"><?php echo ($page); ?></div>
    </div>
<!-- layout::Public:footer::0 -->
<?php if (!defined('THINK_PATH')) exit();?><!-- layout::Public:top::0 -->
<div class="wrap">
<!-- layout::Public:first_side::0 -->
    <div id="content">
    	<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="info_detail">
            	<h3><?php echo ($vo["title"]); ?></h3>
                <span class="c_time"><?php echo (getN($vo["c_time"])); ?></span>
                <div class="info_content"><?php echo ($vo["content"]); ?></div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="page_nav">
        <span class="page_nav_l"></span>
        <span class="page_nav_c"><?php echo ($page); ?></span>
        <span class="page_nav_r"></span>
        </div>
    </div>
    <br class="clear" />
</div>
<script type="text/javascript">
     SyntaxHighlighter.all();
</script>
<!-- layout::Public:footer::0 -->
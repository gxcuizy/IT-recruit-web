<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/ITrecruit/Admin/Apply/index" method="post">
	<input type="hidden" name="pageNum" value="<?php echo ((isset($currentPage) && ($currentPage !== ""))?($currentPage):'1'); ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" /><!--每页显示多少条-->
	<input type="hidden" name="_order" value="<?php echo ($_REQUEST['_order']); ?>"/>
	<input type="hidden" name="_sort" value="<?php echo ($_REQUEST['_sort']); ?>"/>
</form>
<div class="pageHeader">
	<form rel="pagerForm" onsubmit="return navTabSearch(this);" method="post">
		<input type="hidden" name="numPerPage" value="<?php echo ($numPerPage); ?>" /><!--每页显示多少条-->
	<div class="searchBar">
		<table class="searchContent">
			<tr>
				<td>
					请输入职位名称进行搜索：<input type="text" name="job_name" value="<?php echo ($_POST['job_name']); ?>" /> 
				</td>
				<td>
					<div class="buttonActive"><div class="buttonContent"><button type="submit">搜索</button></div></div>
				</td>
			</tr>
		</table>
	</div>
	</form>
</div>
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="delete" href="/ITrecruit/Admin/Apply/del/id/{item_id}/navTabId/listApply" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			<li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
		</ul>
	</div>
	<table class="table" width="100%" layoutH="110">
		<thead>
			<tr>
				<th width="30">序号</th>
				<th>职位名称</th>
				<th>招聘企业</th>
				<th>招聘类型</th>
				<th>工作地点</th>
				<th>月薪</th>
				<th>学历要求</th>
				<th>企业邮箱</th>
				<th>浏览次数</th>
				<th>应聘次数</th>
				<th>招聘状态</th>
				<th  orderField="publish_time" <?php if($_REQUEST['_order']== 'publish_time'): ?>class="<?php echo ($_REQUEST['_sort']); ?>"<?php endif; ?>>发布招聘时间</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
					<td><?php echo ($numPerPage*$currentPage-$numPerPage+$key+1); ?></td>
					<td><?php echo ($vo["job_name"]); ?></td>
					<td><?php echo ($vo["en_name"]); ?></td>
					<!-- <td><?php echo ($vo["apply_type"]); ?></td> -->
					<td>
						<?php if($vo["apply_type"] == 1): ?>产品类
						<?php elseif($vo["apply_type"] == 2): ?>
							设计类
						<?php elseif($vo["apply_type"] == 3): ?>
							运营类
						<?php else: ?>
							技术类<?php endif; ?>
					</td>
					<td><?php echo ($vo["work_province"]); ?></td>
					<td><?php echo ($vo["salary"]); ?></td>
					<td><?php echo ($vo["education_claim"]); ?></td>
					<td><?php echo ($vo["en_email"]); ?></td>
					<td><?php echo ($vo["browse_times"]); ?></td>
					<td><?php echo ($vo["apply_times"]); ?></td>
					<td>
						<?php if($vo["apply_status"] == 1): ?>正在招聘
						<?php else: ?>
							招聘结束<?php endif; ?>
					</td>
					<td><?php echo (date("Y-m-d H:i:s",$vo["publish_time"])); ?></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	<div class="panelBar">
		<div class="pages">
			<span>显示</span>
			<select class="combox" name="numPerPage" onchange="navTabPageBreak(<?php echo (C("TMPL_L_DELIM")); ?>numPerPage:this.value<?php echo (C("TMPL_R_DELIM")); ?>)">
				<option value="5" <?php if($numPerPage == 5): ?>selected<?php endif; ?>>5</option>
				<option value="10" <?php if($numPerPage == 10): ?>selected<?php endif; ?>>10</option>
				<option value="15" <?php if($numPerPage == 15): ?>selected<?php endif; ?>>15</option>
				<option value="20" <?php if($numPerPage == 20): ?>selected<?php endif; ?>>20</option>
				<option value="25" <?php if($numPerPage == 25): ?>selected<?php endif; ?>>25</option>
				<option value="30" <?php if($numPerPage == 30): ?>selected<?php endif; ?>>30</option>
			</select>
			<span>共<?php echo ($totalCount); ?>条</span>
		</div>
		<div class="pagination" targetType="navTab" totalCount="<?php echo ($totalCount); ?>" numPerPage="<?php echo ($numPerPage); ?>" pageNumShown="<?php echo ($pageNumShown); ?>" currentPage="<?php echo ($currentPage); ?>"></div>

	</div>
</div>
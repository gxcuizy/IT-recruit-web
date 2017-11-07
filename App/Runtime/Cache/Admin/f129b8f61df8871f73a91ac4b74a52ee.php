<?php if (!defined('THINK_PATH')) exit();?><form id="pagerForm" action="/ITrecruit/Admin/Resume/index" method="post">
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
                        请输入用户名称进行搜索：<input type="text" name="name" value="<?php echo ($_POST['name']); ?>" /> 
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
            <li><a class="delete" href="/ITrecruit/Admin/Resume/del/id/{item_id}/navTabId/listResume" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
            <li><a class="edit" href="/ITrecruit/Admin/Resume/edit/id/{item_id}" target="dialog" title="修改简历信息"><span>设置推荐</span></a></li>
            <li><a class="icon"  href="javascript:navTabPageBreak()"><span>刷新</span></a></li>
        </ul>
    </div>
    <table class="table" width="100%" layoutH="110">
        <thead>
            <tr>
                <th align="center" width="50">简历id</th>
                <th>姓名</th>
                <th>电话</th>                
                <th>邮箱</th>
                <th>年龄</th>
                <th>性别</th>
                <th>婚姻状况</th>
                <th>学历</th>
                <th>毕业学校</th>
                <th>投递状态</th>
                <th>籍贯</th>
                <th>是否公开</th>
                <th>是否推荐</th>
            </tr>
        </thead>
        <tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr target="item_id" rel="<?php echo ($vo["id"]); ?>">
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><?php echo ($vo["name"]); ?></td>
                    <td><?php echo ($vo["phone"]); ?></td>
                    <td><?php echo ($vo["email"]); ?></td> 
                    <td><?php echo ($vo["age"]); ?></td>
                    <td><?php if($vo["sex"] == 1): ?>男<?php else: ?>女<?php endif; ?></td>
                    <td><?php if($vo["is_marry"] == 0): ?>保密<?php elseif($vo["is_marry"] == 1): ?>未婚<?php else: ?>已婚<?php endif; ?></td>
                    <td><?php echo ($vo["education"]); ?></td>
                    <td><?php echo ($vo["school"]); ?></td>
                    <td><?php if($vo["work_status"] == 0): ?>在职，看看新机会<?php elseif($vo["work_status"] == 1): ?>在职，急寻新工作<?php elseif($vo["work_status"] == 2): ?>在职，暂无跳槽打算<?php else: ?>离职，正在找工作<?php endif; ?></td>
                    <td><?php echo ($vo["province"]); ?>-<?php echo ($vo["city"]); ?></td>
                    <td>
                        <?php if($vo["is_show"] == 0): ?>不公开<?php else: ?>公开<?php endif; ?>
                    </td>
                    <td>
                        <?php if($vo["is_recommend"] == 0): ?>不推荐<?php else: ?>推荐<?php endif; ?>
                    </td>
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
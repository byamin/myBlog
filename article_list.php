<?php
	include('nav.php');
?>
<!DOCTYPE html>
<style type="text/css">
	.table-striped img{
		max-height: 30px;
	}
	#add{
		margin-bottom: 10px;
	}
</style>
<div class="container article_content">
	<input type="button" name="add" id="add" value="添加文章" class="btn btn-success" />
	<table class="table table-striped">
		<thead>
			<tr>
				<th>文章ID</th>
				<th>文章分类</th>
				<th>文章图片</th>
				<th>文章标题</th>
				<th>添加时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>1</td>
				<td>前端</td>
				<td><img src="img/1131981.gif"/></td>
				<td>jquery</td>
				<td>2017-05-20 17:00:01</td>
				<td>
					<a href="" class="btn btn-primary btn-xs">
						<span class="glyphicon glyphicon-pencil"></span>
					</a>
					<a href="" class="btn btn-danger btn-xs">
						<span class="glyphicon glyphicon-trash"></span>
					</a>
				</td>
			</tr>
			<tr>
				<td>2</td>
				<td>后端</td>
				<td><img src="img/1131981.gif"/></td>
				<td>php</td>
				<td>2017-05-20 17:00:01</td>
				<td></td>
			</tr>
		</tbody>
	</table>
</div>
<?php
	include ('nav.html');
?>
<!DOCTYPE >
<div id="" class="container">
	<form action="" method="post">
		<div class="form-group">
			<label for="article_name">文章标题</label>
	    	<input type="text" class="form-control" id="article_name" placeholder="请输入文章标题">
	  	</div>
		<div class="form-group">
			<label for="">文章分类</label>
			<select class="form-control">
			  <option>前端技术</option>
			  <option>程序设计</option>
			</select>
	  	</div>
		<input type="submit" class="btn btn-success" value="保存"/>
	</form>
</div>
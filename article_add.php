<?php
	include ('nav.html');
	require ('vendor/autoload.php');
?>
<!DOCTYPE >
<div id="" class="container">
	<form action="article.php" method="post"  enctype="multipart/form-data">
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
	  	<div class="form-group">
	  		<label for="">封面图</label>
	  		<input type="file" name="cover_img" id="" value="" />
	  	</div>
	  	<div class="form-group">
	  		<label for="">文章内容</label>
	  		 <script id="editor" name="content" type="text/plain">
    		</script>
	  	</div>
	  	 <!-- 配置文件 -->
	    <script type="text/javascript" src="ueditor/ueditor.config.js"></script>
	    <!-- 编辑器源码文件 -->
	    <script type="text/javascript" src="ueditor/ueditor.all.js"></script>
	    	<!-- 实例化编辑器 -->
		<script type="text/javascript">
				var ue = UE.getEditor('editor',{
				        	 autoHeight: false,
							autoClearinitialContent:true,
							initialContent:'请输入文章内容',
							
							
				        });
		</script>
        <input type="hidden" name="action" value="add">
		<input type="submit" class="btn btn-success" value="添加"/>
	</form>
</div>
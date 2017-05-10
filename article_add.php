<?php
    include ('function.php');
	include ('nav.php');
	include ('upload.php');
	$categorys = db_find('category',['status'=>0]);	//获取分类
    define('TABLE','article');
	//如果提交为post
	if($method == 'POST')
	{
		$data = $_POST;
		$data['cover_img'] = upload($_FILES['cover_img']);
		$data['content']   = trim($data['content']);
		$data['add_time']  = date('Y-m-d H:i:s',time());
 		$insert_r = db_insert(TABLE,$data);
 		if($insert_r == false)
        {
            error('添加文章失败');
        }
        else
        {
            success('','添加文章成功');
        }
	}

    /**
     * 上传封面图 获取图片路径
     * @param $file
     * @return bool|mixed 图片路径
     */
	function upload($file)
	{
		if(empty($file))
		{
			error('请上传文章封面图');
		}
		//上传文章图片
		$upload_obj = new Upload;
        $upload_path = $upload_obj->uploadFile($file,'5000','img/article/cover');
		if($upload_path == FALSE)
		{
			error($upload_obj::$error);
		}
		return $upload_path;
	}
?>
<!DOCTYPE >
<div id="" class="container">
	<form action="" method="post"  enctype="multipart/form-data" id="upfile">
		<div class="form-group">
			<label for="article_name">文章标题</label>
	    	<input type="text" class="form-control" id="article_name" name="title" placeholder="请输入文章标题">
	  	</div>
		<div class="form-group">
			<label for="">文章分类</label>
			<select class="form-control" name="category_id">
				<?php foreach($categorys as $category): ?>
			  	<option value="<?php echo $category['id'] ?>"><?php echo $category['category_name'] ?></option>
			  	<?php endforeach;?>
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
		<input type="submit" class="btn btn-success" value="添加"/>
	</form>
</div>
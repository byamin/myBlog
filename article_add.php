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
		$is_add = (int) $data['is_add'];
		$id = (int) $data['id'];
        $data['content']   = trim($data['content']);
        $data['add_time']  = date('Y-m-d H:i:s',time());
        unset($data['is_add']);
        unset($data['id']);
        //判断是添加还是编辑
        if($is_add == 1)
        {
            $alert_info = '添加';
            $upload_data = upload($_FILES['cover_img']);
            //图片上传未成功
            if($upload_data['status'] == 0)
            {
                error($upload_data['msg']);
            }
            $data['cover_img'] = $upload_data['msg'];
            $result = db_insert(TABLE,$data);
        }
        else if($is_add ==2)
        {
            $alert_info = '编辑';
            //有图片去上传图片
            if($_FILES['cover_img']['size'] != 0)
            {
                $upload_data = upload($_FILES['cover_img']);
                //图片上传未成功
                if($upload_data['status'] == 0)
                {
                    error($upload_data['msg']);
                }
                $data['cover_img'] = $upload_data['msg'];
            }
            else
            {
                unset($data['cover_img']);  //删除这个字段
            }
            $result = db_update(TABLE,['id'=>$id],$data);
        }
		if($result == false)
        {
           error($alert_info."文章失败");
        }
        else
        {
           success($alert_info . "文章成功", 'article_list.php');
        }
	}
	//如果提交为get
	if($method == 'GET')
    {
        if($_GET['action'] = 'edit' && isset($_GET['id']))
        {
            $id = (int) $_GET['id'];
            $article_r = db_sql_find("SELECT a.*,c.category_name from article as a LEFT JOIN category as c on a.category_id = c.id where a.id=$id AND a.status = 0");
            if($article_r == false)
            {
                error('该文章不存在');
            }
            $article = $article_r[0];
        }
    }

    /**
     * 上传封面图 获取图片路径
     * @param $file
     * @return bool|mixed 图片路径
     */
	function upload($file)
	{
		if($file['size'] == 0)
		{
		    return ['msg'=>'请上传图片','status'=>0];
		}
		//上传文章图片
		$upload_obj = new Upload;
        return $upload_obj->uploadFile($file,'50000','img/article/cover');
	}
?>
<!DOCTYPE >
<div id="" class="container">
    <?php
    if(isset($alert) && !empty($alert))
    {
        ?>
        <div class="alert alert-block alert-<?=$alert['class']?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
                <span aria-hidden="true">×</span>
            </button>
            <?=$alert['msg']?>
        </div>
        <?php
    }
    ?>
	<form action="" method="post"  enctype="multipart/form-data" id="upfile">
		<div class="form-group">
			<label for="article_name">文章标题</label>
	    	<input type="text" class="form-control" id="article_name" name="title" placeholder="请输入文章标题" value="<?php echo isset($article['title'])?$article['title']:'';?>">
	  	</div>
		<div class="form-group">
			<label for="">文章分类</label>
			<select class="form-control" name="category_id">
				<?php foreach($categorys as $category): ?>
			  	<option value="<?php echo $category['id'] ?>" <?php if(isset($article)){echo ($category['id']==$article['category_id']?'selected="selected"':'');}?> ><?php echo $category['category_name'] ?></option>
			  	<?php endforeach;?>
			</select>
	  	</div>
	  	<div class="form-group">
	  		<label for="">封面图</label>
	  		<input type="file" name="cover_img" id="" value="" />
            <?php if(isset($article) && !empty($article['cover_img'])): ?>
            <img class="img-rounded img-responsive" style="margin: 10px 0px" src="<?php echo $article['cover_img'];?>" alt="">
            <?php endif;?>
	  	</div>
	  	<div class="form-group">
	  		<label for="">文章内容</label>
	  		 <script id="editor" name="content"  type="text/plain">
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
                        ue.ready(function() {
                            //设置编辑器的内容
                            ue.setContent('<?php if(isset($article) && !empty($article['content'])){echo $article['content'];}else{echo '';} ?>');
                        });
		</script>
        <input type="hidden" name="is_add" value="<?php echo isset($article)?2:1; ?>">
        <input type="hidden" name="id" value="<?php echo isset($_GET['id'])?$_GET['id']:'';?>">
		<input type="submit" class="btn btn-success" value="<?php if(isset($article)){echo '编辑';}else{echo '添加';} ?>"/>
	</form>
</div>
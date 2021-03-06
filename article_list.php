<?php
	include('function.php');

	$page = isset($_GET['page'])?$_GET['page']:1;
    $page_size = 5;
    $offset = $page_size*($page-1);

    $page_count = db_sql_find('SELECT count(*) as page_count from article as a LEFT JOIN category as c on a.category_id = c.id where a.status = 0')[0]['page_count'];
	$articles = db_sql_find("SELECT a.*,c.category_name from article as a LEFT JOIN category as c on a.category_id = c.id where a.status = 0 LIMIT $offset,$page_size");

	$page_html = multipage($page_count,$page,$page_size);
	//有post请求时
	if($method == 'POST')
    {
        if(isset($_POST['action']) && $_POST['action'] == 'delete')
        {
            $id = (int) $_POST['id'];
            $update_r = db_update('article',['id'=>$id],['status'=>1]);
            if($update_r == false)
            {
                xn_message(2,'删除文章失败');
            }
            else
            {
                xn_message(1,'删除文章成功');
            }
        }
    }
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
	<input type="button" name="add" id="add" value="添加文章" class="btn btn-success" onclick="window.location.href='article_add.php'" />
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
			<?php foreach($articles as $article): ?>
				<tr>
					<td><?php echo $article['id'];?></td>
					<td><?php echo $article['category_name'];?></td>
					<td><img src="<?php echo $article['cover_img'];?>"/></td>
					<td><?php echo $article['title'];?></td>
					<td><?php echo $article['add_time'];?></td>
					<td>
						<a href="article_add.php?action=edit&id=<?php echo $article['id'];?>" class="btn btn-primary btn-xs edit" data-id="<?php echo $article['id'];?>">
							<span class="glyphicon glyphicon-pencil"></span>
						</a>
						<a href="javascript:void(0);" class="btn btn-danger btn-xs delete" data-id="<?php echo $article['id'];?>">
							<span class="glyphicon glyphicon-trash"></span>
						</a>
					</td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>

    <div class="page text-center">
        <?php echo $page_html;?>
    </div>
</div>
<script>
    $(function () {
        $('.delete').on('click',function () {
            var id = $(this).attr('data-id');
            layer.confirm('你确定要删除该文章?', {
                btn: ['确定', '取消']
                ,btn1: function(index){
                    layer.close(index);
                    $.ajax({
                        type:'POST',
                        url:'',
                        data:{'action':'delete','id':id},
                        dataType:'json',
                        success : function (data) {
                            layer.msg(data.message,{icon: data.code,time:1000});
                            window.location.reload();
                        }
                    });
                }
            });
        })
    })
</script>
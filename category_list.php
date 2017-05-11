<?php
/**
 * Created by PhpStorm.
 * User: symphp
 * Date: 2017/5/11
 * Time: 21:58
 */
include('function.php');

$page = isset($_GET['page'])?$_GET['page']:1;
$page_size = 5;
$offset = $page_size*($page-1);

$page_count = db_sql_find('SELECT count(id) as page_count from category  where status = 0')[0]['page_count'];
$categorys   = db_sql_find("SELECT * from `category` where status = 0 LIMIT $offset,$page_size");

//有post请求时
if($method == 'POST')
{
    if(isset($_POST['action']) && $_POST['action'] == 'delete')
    {
        $id = (int) $_POST['id'];
        $update_r = db_update('category',['id'=>$id],['status'=>1]);
        if($update_r == false)
        {
            xn_message(2,'删除分类失败');
        }
        else
        {
            xn_message(1,'删除分类成功');
        }
    }
}

include('nav.php');
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
    <div class="container article_content">
        <input type="button" name="add" id="add" value="添加分类" class="btn btn-success" onclick="window.location.href='category_add.php'" />
        <table class="table table-striped">
            <thead>
            <tr>
                <th>分类ID</th>
                <th>分类名称</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($categorys as $category): ?>
                <tr>
                    <td><?php echo $category['id'];?></td>
                    <td><?php echo $category['category_name'];?></td>
                    <td>
                        <a href="category_add.php?action=edit&id=<?php echo $category['id'];?>" class="btn btn-primary btn-xs edit" data-id="<?php echo $category['id'];?>">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a href="javascript:void(0);" class="btn btn-danger btn-xs delete" data-id="<?php echo $category['id'];?>">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>

        <div class="page text-center">
            <?php
                if(isset($page_html) && !empty($page_html))
                {
                    echo $page_html;
                }
            ?>
        </div>
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
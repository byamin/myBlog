<?php
/**
 * Created by PhpStorm.
 * User: symphp
 * Date: 2017/5/11
 * Time: 22:16
 */
include ('function.php');
include ('nav.php');
define('TABLE','category');
if($method == 'POST')
{
    $is_add = (int)$_POST['is_add'];    //1添加 2编辑
    $data['category_name'] = trim($_POST['category_name']); //分类名称
    if($is_add == 1)    //添加
    {
        $alert_info = '添加';
        $result = db_insert(TABLE,$data);
    }
    elseif($is_add == 2)    //编辑
    {
        $alert_info = '编辑';
        $id = (int)$_POST['id'];
        $result = db_update(TABLE,['id'=>$id],$data);
    }
    if($result == false)    //sql执行失败
    {
        error($alert_info."分类失败");
    }
    else
    {
        success($alert_info."分类成功",'category_list.php');
    }
}
elseif($method == 'GET')    //get提交
{
    if(isset($_GET['action']) && $_GET['action'] = 'edit')
    {
        $id = (int)$_GET['id'];
        $category = db_sql_find("SELECT * from `category` where id=$id AND status = 0");
        if($category == false)
        {
            error('该分类不存在');
        }
        $category = $category[0];
    }
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
    <form action="" method="post"  enctype="multipart/form-data">
        <div class="form-group">
            <label for="article_name">分类名称</label>
            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="请输入分类名称" value="<?php echo isset($category['category_name'])?$category['category_name']:'';?>">
        </div>
        <input type="hidden" name="is_add" value="<?php echo isset($category)?2:1; ?>">
        <input type="hidden" name="id" value="<?php echo isset($_GET['id'])?$_GET['id']:'';?>">
        <input type="submit" class="btn btn-success" value="<?php if(isset($category)){echo '编辑';}else{echo '添加';} ?>"/>
    </form>
</div>

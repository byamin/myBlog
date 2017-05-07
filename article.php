<?php
/**
 * Created by PhpStorm.
 * User: symphp
 * Date: 2017/5/7
 * Time: 0:14
 */

require ('vendor/autoload.php');
require ('xiunophp/xiunophp.php');
//添加文章
if(isset($_POST['action']) && $_POST['action'] == 'add')
{
    $data = $_POST;
}
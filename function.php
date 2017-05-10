<?php
/**
 * Created by PhpStorm.
 * User: symphp
 * Date: 2017/5/11
 * Time: 0:14
 */

$conf = include 'xiunophp/conf.php';
include 'xiunophp/xiunophp.php';

/**
 * 成功函数
 * @param $url
 * @param $msg
 */
function success($url,$msg){
    header('content-type:text/html;charset=utf-8');
    if(strpos($url,'http')){
        echo "<script>alert('$msg');window.location.href = '$url'</script>";
    }
    echo "<script>alert('$msg');window.location.href = '$url'</script>";
    die;
}

/**
 * 失败函数
 * @param $msg
 */
function error($msg){
    header('content-type:text/html;charset=utf-8');
    echo "<script>alert('$msg');history.go(-1);</script>";
    die;
}
?>
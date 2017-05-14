<?php
/**
 * Created by PhpStorm.
 * User: symphp
 * Date: 2017/5/11
 * Time: 0:14
 */
$conf = include 'xiunophp/conf.php';
include 'xiunophp/xiunophp.php';

//不验证登录文件列表
$not_verifys = ['login.php','index.php','header.php','footer.php','article.php?id'];

$verifys_flag = 0;  //是否需要验证  0不需要 1需要
foreach ($not_verifys as $item)
{
    if(strstr($_SERVER['REQUEST_URI'],$item))  //是否有不验证的文件
    {
        $verifys_flag = 1;
    }
}
if($verifys_flag != 1 && !isset($_COOKIE['login_flag']))
{
   success('请登录','login.php');
}

/**
 * 成功函数
 * @param $msg
 * @param $url
 */
function success($msg, $url = ''){
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

/**
 * @param $count  总条数
 * @param $page    当前页
 * @param $pagesize 每页多少条数据
 * @param string $para  翻页参数(不需要写$page),如http://www.example.com/article.php?page=3&id=1，$para参数就应该设为'&id=1'
 * @return string  返回的输出分页html内容
 */
function multipage($count, $page, $pagsize = 10, $para = '') {
    $multipage = '';  //输出的分页内容
    $listnum = $pagsize;     //同时显示的最多可点击页面

    $maxpage = ceil($count/$pagsize);
    if ($maxpage < 2) {
        return '';
    }else{
        $offset = 2;
        if ($maxpage <= $listnum) {
            $from = 1;
            $to = $maxpage;
        } else {
            $from = $page - $offset; //起始页
            $to = $from + $listnum - 1;  //终止页
            if($from < 1) {
                $to = $page + 1 - $from;
                $from = 1;
                if($to - $from < $listnum) {
                    $to = $listnum;
                }
            } elseif($to > $maxpage) {
                $from = $maxpage - $listnum + 1;
                $to = $maxpage;
            }
        }

        $multipage .= ($page - $offset > 1 && $maxpage >= $page ? '<li><a href="?page=1'.$para.'" >1...</a></li>' : '').
            ($page > 1 ? '<li><a href="?page='.($page - 1).$para.'" >&laquo;</a></li>' : '');

        for($i = $from; $i <= $to; $i++) {
            $multipage .= $i == $page ? '<li class="active"><a href="?page='.$i.$para.'" >'.$i.'</a></li>' : '<li><a href="?page='.$i.$para.'" >'.$i.'</a></li>';
        }

        $multipage .= ($page < $maxpage ? '<li><a href="?page='.($page + 1).$para.'" >&raquo;</a></li>' : '').
            ($to < $maxpage ? '<li><a href="?page='.$maxpage.$para.'" class="last" >...'.$maxpage.'</a></li>' : '');

        $multipage = $multipage ? '<ul class="pagination" style="display: block;">'.$multipage.'</ul>' : '';
    }

    return $multipage;
}

?>
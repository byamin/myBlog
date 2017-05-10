<?php
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
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>测试</title>
		<script src="//cdn.bootcss.com/jquery/3.2.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/bootstrap.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" href="css/bootstrop.min.css"/>
	</head>
	<body>
		<nav class="navbar navbar-inverse">
			 <div class="container-fluid">
			 	<div class="navbar-header">
				      <a class="navbar-brand" href="javascript:void(0)">
				        <img alt="Brand" style="max-height: 30px;margin-top: -5px;" src="img/1131981.gif"class="img-circle">
				      </a>
			 	</div>
			 	<ul class="nav navbar-nav navbar-right">
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown">阿明 <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="#">退出</a></li>
			          </ul>
			        </li>
		      	</ul>
			  </div>
		</nav>
	</body>
</html>

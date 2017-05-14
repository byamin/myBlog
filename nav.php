<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>blog</title>
		<script src="//cdn.bootcss.com/jquery/3.2.1/jquery.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="js/bootstrap.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<!--        layer-->
        <script src="https://cdn.bootcss.com/layer/3.0.1/layer.js"></script>
        <link href="https://cdn.bootcss.com/layer/3.0.1/skin/default/layer.css" rel="stylesheet">
        <link href="https://cdn.bootcss.com/layer/3.0.1/skin/moon/style.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-inverse">
			 <div class="container-fluid">
			 	<div class="navbar-header">
				      <a class="navbar-brand" href="javascript:void(0)">
				        <img alt="Brand"src="img/logo.png?v=1" style="max-height: 30px;margin-top: -5px;" src=""class="img-circle">
				      </a>
			 	</div>

                 <ul class="nav navbar-nav">
                     <li><a href="article_list.php">文章</a></li>
                     <li><a href="category_list.php">文章分类</a></li>
                 </ul>

			 	<ul class="nav navbar-nav navbar-right">
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php  echo isset($_COOKIE['user_name'])?$_COOKIE['user_name']:'';?> <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="#" onclick="exitLogin()">退出</a></li>
			          </ul>
			        </li>
		      	</ul>
             </div>
		</nav>
	</body>
</html>
<script>
    //退出登录操作
    function exitLogin () {
        //删除cookie
        delCookie('user_name');
        delCookie('login_flag');
        window.location.href = 'login.php';
    }

    //删除cookie
    function delCookie(name)
    {
        var exp = new Date();
        exp.setTime(exp.getTime() - 1);
        var cval=getCookie(name);
        if(cval!=null)
            document.cookie= name + "="+cval+";expires="+exp.toGMTString();
    }

    //读取cookies
    function getCookie(name)
    {
        var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");

        if(arr=document.cookie.match(reg))

            return unescape(arr[2]);
        else
            return null;
    }
</script>

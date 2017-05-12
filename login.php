<?php
	include('function.php');
	define('TABLE', 'admin_login');
	if($method == 'POST')	//post请求执行
	{
		//判断是否是注册
		if(isset($_POST['action']) && $_POST['action'] == 'register')
		{
			$data['salt'] = base64_encode(md5(time(),mt_rand(1, 10000000)));	//生成一个不重复的随机数 base64_encode 解码				
			$data['user_name'] = trim($_POST['user_name']);
			$data['password']  = md5(md5(trim($_POST['password'])).$data['salt']);
			if(db_insert(TABLE, $data) == FALSE)	//执行失败
			{
				xn_message(2,'注册失败');	
			}			
			else
			{
				xn_message(1,'注册成功');	
			}
		} 
		else	//登录操作
		{
			
		}
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
<!--        layer-->
        <script src="https://cdn.bootcss.com/layer/3.0.1/layer.js"></script>
        <link href="https://cdn.bootcss.com/layer/3.0.1/skin/default/layer.css" rel="stylesheet">
        <link href="https://cdn.bootcss.com/layer/3.0.1/skin/moon/style.css" rel="stylesheet">
	</head>
<style type="text/css">
	form{
		position: absolute;
		top: 30%;
		left: 50%;
		transform: translate(-50%,-50%);
		width: 15%;
	}
	.login{
		margin: 15px;
	}
	.register{
		margin: 15px;
		float: right;
	}
</style>
<div class="container">
	<form action="">
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
				<input type="text" class="form-control" id="user_name" placeholder="请输入用户名">
			</div>
		</div>
		<div class="from-group">
			<div class="input-group">
				<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
				<input type="password" class="form-control" id="password" placeholder="请输入密码">
			</div>
		</div>
			<input type="submit" class="btn btn-primary btn-sm login" name="" id="" value="登录"/>
			<input type="button" class="btn btn-primary btn-sm register" value="注册" " />
	</form>
</div>
<script type="text/javascript">
	$(function(){
		$('.register').on('click',function(){
		var user_name = $('#user_name').val();
		var password  = $('#password').val();
		if(user_name.length < 1 || password.length < 1)
		{
			alert('用户名或密码长度不正确');
			return false;
		}
		$.ajax({
			type:"POST",
			url:"",
			async:true,
			dataType:'JSON',
			data:{'user_name':user_name,'password':password,'action':'register'},
			success:function (data) {
	                    layer.msg(data.message,{icon: data.code,time:1000});
	                    <!--window.location.reload();-->      
                    }
		});
	})
	})
</script>
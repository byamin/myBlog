<?php
	include('function.php');
	define('TABLE', 'admin_login');
	if($method == 'POST')	//post请求执行
	{
		function get_userinfo($user_name)
		{
			return db_find(TABLE,['user_name'=>$user_name]);
		}	
		//判断是否是注册
		if(isset($_POST['action']) && $_POST['action'] == 'register')
		{
			$data['salt'] = base64_encode(md5(time(),mt_rand(1, 10000000)));	//生成一个不重复的随机数 base64_encode 解码				
			$data['user_name'] = trim($_POST['user_name']);
			$data['password']  = md5(md5(trim($_POST['password'])).$data['salt']);
			if(get_userinfo($data['user_name']) != false)	//判断是否注册
			{
				xn_message(2, '该用户名已注册');
			}
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
			$user_name = isset($_POST['user_name'])?$_POST['user_name']:'';
			//查询是否存在用户信息
			$user_info = get_userinfo($user_name);
			if($user_info == false)	//判断是否注册
			{
				error('用户名不存在');
			}
			$password = md5(md5($_POST['password']).$user_info[0]['salt']);	//加盐加密后的md5值
			if($password != $user_info[0]['password'] || $user_name != $user_info[0]['user_name'])	//不匹配
			{
				error('登录失败，密码错误！');
			}
			else
			{
				//登陆成功，保存登录信息
				setcookie('login_flag',1,time()+3600);
				setcookie('user_name',$user_info[0]['user_name'],time()+3600);
				success('登录成功','article_list.php');
			}
		}
		
	}
?>
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
	<form action="" method="post">
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
				<input type="text" class="form-control" name="user_name" id="user_name" placeholder="请输入用户名">
			</div>
		</div>
		<div class="from-group">
			<div class="input-group">
				<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
				<input type="password" class="form-control" name="password" id="password" placeholder="请输入密码">
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
	                    layer.msg(data.message,{icon: data.code,time:1000},function(){
	                    	window.location.reload();      
	                    });
                    }
		});
	})
	})
</script>
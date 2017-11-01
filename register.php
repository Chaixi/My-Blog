<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>用户注册</title>
	<link rel="icon" href="img/guoqing.ico" type="image/x-icon"/>

	<!-- 引入 Bootstrap -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
	<script src="https://code.jquery.com/jquery.js"></script>
	<!-- 包括所有已编译的插件 -->
	<!-- <script src="js/bootstrap.min.js"></script> -->
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<?php 
	//数据库连接
	include 'mysqlconnect.php';

	//登录
	// if (!isset($_POST['submit']))
	// {
	// 	exit('非法访问！');
	// }

	$regusername = $_POST['regusername'];
	$regpwd = $_POST['regpwd1'];
	$regemail = $_POST['regemail'];
	$regtime = date("y-m-d h:i:sa");
	// echo '$username' . '$pwd';

	//查找用户名
	$sql = "SELECT * FROM user WHERE username = '$regusername'";
	$result=mysql_num_rows(mysql_query($sql));

	//查找邮箱
	// $sql_login = "SELECT * FROM user WHERE username = '$username' AND pwd = '$pwd'";
	// $result_login=mysql_num_rows(mysql_query($sql_login));

	if ($result != 0)
	{
		echo "<script>alert('用户名已存在，请重新注册！');window.location= 'index.php';</script>" . mysql_error();
		redirect('index.php');
	} 
	else
	{
		$sql = "INSERT INTO user(username, pwd, email, phone, role, regtime) VALUES('$regusername', '$regpwd', '$regemail', '', 'visitor', '$regtime')";
		if (mysql_query($sql))
		{
			echo "<script>alert('注册成功，请登录！');window.location= 'index.php';</script>";
			redirect('index.php');
		}
	}

	closeMysql();

	?>
</body>
</html>
<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>用户登录</title>
	<link rel="icon" href="img/guoqing.ico" type="image/x-icon"/>
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

	$username = $_POST['inputusername'];
	$pwd = $_POST['inputpwd'];
	// $_SESSION=array('crt_username' => $username, 'crt_pwd' => $pwd );

	// echo '$username' . '$pwd';

	$sql = "SELECT * FROM user WHERE username = '$username'";
	$result=mysql_num_rows(mysql_query($sql));

	$sql_login = "SELECT * FROM user WHERE username = '$username' AND pwd = '$pwd'";
	$result1=mysql_query($sql_login);
	$result_login=mysql_num_rows($result1);
	$row=mysql_fetch_array($result1);

	if ($result==0)
	{
		echo "<script>alert('用户不存在，请先注册！');window.location= 'index.php';</script>" . mysql_error();
		redirect('index.php');
	} 
	else
	{
		if ($result_login == 0)
		{
			echo "<script>alert('密码错误，请重试！');window.location= 'index.php';</script>" . mysql_error();
			redirect('index.php');
		}
		else
		{
			//echo "<script>alert('登录成功！');window.location= 'index.php';</script>" . mysql_error();
			$_SESSION['username'] = $username;
			$_SESSION['pwd'] = $pwd;
			$_SESSION['role'] = $row['role'];

			redirect('index.php');
		}
	}

	closeMysql();

	?>
</body>
</html>
<?php
header("Content-type: text/html; charset=utf-8");

include 'mysqlconnect.php';

$username = $_GET['username'];
if ($username == "alex")
{
	echo "<script>alert('管理员账户不可删除！');widow.location='administrator.php';</script>";
}
else
{
	$sql = "DELETE FROM user WHERE username='$username'";
	mysql_query($sql);
	echo "<script>alert('成功删除用户：".$username."');widow.location='administrator.php';</script>";
}

redirect('administrator.php');
?>
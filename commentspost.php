<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>发表评论</title>
	<link rel="icon" href="img/guoqing.ico" type="image/x-icon"/>

	<!-- 引入 Bootstrap -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
	<script src="https://code.jquery.com/jquery.js"></script>
	<!-- 包括所有已编译的插件 -->
	<!-- <script src="js/bootstrap.min.js"></script> -->
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/alexblog.js"></script>
</head>
<body>
<?php
	include 'mysqlconnect.php';

	$crtpostid = $_POST['postid'];
	$comment = $_POST['comment'];
	$crtusername = $_POST['ip_username'];
	$datetime = date("Y-m-d H:i:s");

	$sql = "INSERT INTO comments(commentator, comment, postid, commenttime) VALUES('$crtusername', '$comment', '$crtpostid', '$datetime')";
	$result = mysql_query($sql);

	$url = "readingblog.php?id=".$crtpostid;
	redirect($url);
?>
</body>
</html>
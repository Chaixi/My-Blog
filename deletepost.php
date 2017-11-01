<?php
header("Content-type: text/html; charset=utf-8");

include 'mysqlconnect.php';

$postid = $_GET['id'];

$sql = "DELETE FROM post WHERE postId='$postid'";
mysql_query($sql);
echo "<script>alert('成功删除博文!');widow.location='administrator.php';</script>";

redirect('administrator.php');
?>
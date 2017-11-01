<?php include 'header.php'; ?>
<body>
<?php
	$crtid = $_GET['id'];
	$dt = $_GET['dt'];
	// echo($dt);
	// echo $dt;
	
	$sql = "SELECT * FROM post WHERE unix_timestamp(releasetime) < unix_timestamp('$dt') ORDER BY releasetime DESC LIMIT 1";
    $result = mysql_query($sql);
    $counts = mysql_num_rows($result);
    if ($counts == 0)
    {
    	echo "<script type=text/javascript>alert('已经是最后一篇了！'); window.location.href='readingblog.php?id=".$crtid."'; noneNext();</script>";

    	// echo "<script>noneNext();</script>";
    	// echo "<script>alert('已经是最后一篇了！');window.location= 'readingblog.php';</script>" . mysql_error();
    }
    else
    {
    	$row = mysql_fetch_array($result);
    	// echo $row['postId'];
    	echo "<script type=text/javascript> window.location.href='readingblog.php?id=".$row['postId']."';</script>";
		// redirect('readingblog.php?id=$row['postId']');
    }    
?>
</body>
</html>
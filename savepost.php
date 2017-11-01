<?php
	header("Content-type: text/html; charset=utf-8");

	include 'mysqlconnect.php';

	$editid = $_POST['editid'];
	$title = addslashes($_POST['inputtitle']);
	$abstract = addslashes($_POST['inputabstract']);
	$r_datetime = $_POST['inputreleasetime'];
	$e_datetime = $_POST['inputedittime'];
	$post = addslashes($_POST['inputpost']);

	if ($abstract == "")
	{
		$abstract = mb_substr($post, 0, 30, 'utf-8');
	}

	if ($editid == 0)
	{
		$sql = "INSERT INTO post(authorid, title, abstract, content, releasetime, edittime, edits, likes, readings) VALUES('1', '$title', '$abstract', '$post', '$r_datetime', '$e_datetime', '1', '0', '0')";
		mysql_query($sql);

		$url = "readingblog.php?id=".mysql_insert_id();
	}
	else
	{
		$sql = "UPDATE post SET title='$title', abstract='$abstract', content='$post', edittime='$e_datetime', edits=edits+1 WHERE postId='$editid'";
		mysql_query($sql);

		$url = "readingblog.php?id=".$editid;
	}

	redirect($url);
?>
<?php
	include 'mysqlconnect.php';

	$type = $_POST['type'];
	$postid = $_POST['id'];

	switch ($type)
	{
		case 'like':
			$sql = "UPDATE post SET likes=likes+1 WHERE postId=$postid";
			$v = 'like+1';
			break;
		case 'read':
			$sql = "UPDATE post SET readings=readings+1 WHERE postId=$postid";
			$v='read+1';
			break;
	}
	mysql_query($sql);
	$su='success';
	$data['v'] = $v;
	$data['su'] = $su;
	echo json_encode($data);
	// $data='{v:"'.$v.'", su:"'.$su.'"}';
	// echo json_encode(array('v' => $v,'su' => $su));	
 ?>
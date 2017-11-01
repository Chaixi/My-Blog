<?php
session_start();
include 'mysqlconnect.php';

if (isset($_SESSION['username']))
{
	destroySession();
}

redirect('index.php');

?>
<?php
$dbhost = 'localhost';
$dbname = 'alexblog';
$dbuser = "root";
$dbpwd = "root";

//创建连接
$conn = mysql_connect($dbhost, $dbuser, $dbpwd);

//检测连接
if (!$conn) {
	die("连接失败:" . mysql_error());
}
// echo "连接成功！";

//选择数据库
mysql_select_db($dbname, $conn);
//字符转换，读库  
mysql_query("set character set 'utf8'");  
//写库  
mysql_query("set names 'utf8'");

function createTable($tablename, $sqlquery)
{
    queryMysql("CREATE TABLE IF NOT EXISTS $tablename($sqlquery)");
    echo "Table '$tablename' created or already exists.<br />";
}

function queryMysql($sqlquery)
{
    $result = mysql_query($sqlquery) or die(mysql_error());
	return $result;
}

//关闭数据库
function closeMysql()
{
	mysql_close($conn);
}

//用户注销
function destroySession()
{
    $_SESSION=array();
    
    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
}

function sanitizeString($var)
{
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return mysql_real_escape_string($var);
}

function redirect($url)
{
	echo "<script type=text/javascript>window.location.href='$url';</script>";
}

//输出一篇博文的评论量
function getComments($postid)
{
    $sql = "SELECT * FROM comments WHERE postid = '$postid'";
    $result = mysql_query($sql);
    $counts = mysql_num_rows($result);

    echo $counts;
}

//获取最新博客的id
function getLatestPostid()
{
    $sql = "SELECT * FROM post ORDER BY releasetime DESC LIMIT 1";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);

    return $row['postId'];
}

//获取最老博客的id
function getOldestPostid()
{
    $sql = "SELECT * FROM post ORDER BY releasetime ASC LIMIT 1";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);

    return $row['postId'];
}

?>
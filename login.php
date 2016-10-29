<?php
header("content-type:text/html;charset=utf8");

$username = $_POST['username'];
$password = md5($_POST['password']);

$link=mysql_connect('localhost','root','123');

mysql_set_charset("utf8");

mysql_select_db('pra');

$sql = "select * from admin where username='{$username}' and password='{$password}'";

// echo $sql;
// exit();
$re = mysql_query($sql);
if(!$re){
	die(mysql_errno());
}
$arr = mysql_fetch_assoc($re);

if(!empty($arr)){
	header("location:index.php");
}else{
	header("location:login.html");
}
var_dump($arr);
exit();

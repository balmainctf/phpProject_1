<?php
header("content-type:text/html;charset=utf8");
require_once '../public/isLogin.php';
//接收数据
$title = $_POST['title'];
$author = $_POST['author'];
$content = $_POST['content'];
$type = $_POST['type'];
//保存当前时间戳，→ 时间日期
$pubTime = date('Y-m-d H:i:s',time());

//获取act  注意点
$act = $_GET['act'];



//连接数据库
mysql_connect('localhost','root','123') or die("连接数据库失败 ERROR:".mysql_errno().mysql_error());
mysql_set_charset('utf8');
mysql_select_db("pra");

if($act === 'add' ){
	$sql = "insert news(title,author,content,type,pubTime) values('{$title}','{$author}','{$content}','{$type}','{$pubTime}') ";
	$re = mysql_query($sql);
	if($re){
		echo "发布成功，回到管理页继续<a href='add.php'>发布。</a>";
	}else{
		echo "发布失败，重新<a href='add.php'>发布。</a>";
	}
}else if($act === 'update'){
	$id = $_POST['id'];
	
	$sql = "update news set title='{$title}',author='{$author}',content='{$content}',type='{$type}' where id={$id}";
	$re = mysql_query($sql);
	
	if($re){
		echo "修改成功，回到文章管理<a href='manageNews.php'>列表。</a>";
	}else{
		echo "失败，回到文章管理<a href='manageNews.php'>列表。</a>";
	}
}else if($act === 'del'){
	//id值时传过来的，所以时get
	$id = $_GET['id'];
	// var_dump($id);
	// exit();
	$sql = "delete from news where id={$id}";
	$re = mysql_query($sql);
	if($re){
		echo "删除成功，回到文章管理<a href='manageNews.php'>列表。</a>";
	}else{
		echo "删除失败，回到文章管理<a href='manageNews.php'>列表。</a>";
	}
}





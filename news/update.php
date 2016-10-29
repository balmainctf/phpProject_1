<?php
header("content-type:text/html;charset=utf8");
mysql_connect('localhost','root','123');
mysql_set_charset('utf8');
mysql_select_db("pra");
$keyword = isset($_GET['keyword'] ) ? $_GET['keyword'] : "";



//获取id值
$id = $_GET['id'];

//根据id,查询语句
$sql = "select * from news where id='{$id}'";
$re = mysql_query($sql);
$arr = mysql_fetch_assoc($re);
$type = $arr['type'];
// var_dump($type);
// exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="content-type" content="text/html">
	<title>修改操作</title>
	<style type="text/css">
		*{
			margin:0;
			padding:0;

		}
		form{
			margin:10%;
		}
		form input,textarea,select{
			display: block;
			margin-bottom:20px;
		}
		.desc{
			margin-bottom:10px;
		}
	</style>
</head>
<body>

<form action="doAction.php?act=update" method="post">	
	<div class="desc">当前操作：修改文章</div>
	标题：<input type="text" name="title" value="<?php echo $arr['title'] ?>">
	<!-- 通过隐藏域告诉doAction.php 具体要修改的id值时哪个 -->
	<input type="hidden" name="id" value="<?php echo $id;?>">
	作者：<input type="text" name="author" value="<?php echo $arr['author'] ?>">
	内容：<textarea name="content" cols="30" rows="10"><?php echo $arr['content'] ?></textarea>
	类型：<select name="type">
			<option value="国内" <?php if($type === '国内') echo "selected='selected'"?>>国内</option>
			<option value="国际" <?php if($type === '国际') echo "selected='selected'"?>>国际</option>
			<option value="体育" <?php if($type === '体育') echo "selected='selected'"?>>体育</option>
		  </select>
	<input type="submit" name="修改文章">		  
</form>
</body>
</html>
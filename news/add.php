<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="content-type" content="text/html">
	<title>添加操作</title>
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

<form action="doAction.php?act=add" method="post">	
	<div class="desc">当前操作：添加文章</div>
	标题：<input type="text" name="title">
	作者：<input type="text" name="author">
	内容：<textarea name="content" cols="30" rows="10"></textarea>
	类型：<select name="type">
			<option value="国内">国内</option>
			<option value="国际">国际</option>
			<option value="体育">体育</option>
		  </select>
	<input type="submit" name="发布文章">		  
</form>
</body>
</html>
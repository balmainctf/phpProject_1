<?php
header("content-type:text/html;charset=utf8");

//连接数据库，查询数据
mysql_connect('localhost','root','123') or die("链接数据库失败");
mysql_set_charset('utf8');
mysql_select_db('pra');

$keyword = isset($_GET['keyword'] ) ? $_GET['keyword'] : "";

//每页条数
$pageSize = 5;
//接收页码值
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
//控制page值>=1
if($page < 1){
	$page = 1;
}

//计算$pageTotal
$sqlNum = "select count(*) as num from news where title like '%$keyword%'";
$reNum = mysql_query($sqlNum);
$arr = mysql_fetch_assoc($reNum);
$recordTotal = $arr['num'];
$pageTotal = ceil($recordTotal/$pageSize);
//控制page值<= 总页数
if($page > $pageTotal){
	$page = $pageTotal;
}
// var_dump($pageTotal);
// exit();
//算出开始位置
$start = ($page-1)*$pageSize;
$sql = "select * from news where title like '%$keyword%' limit {$start},{$pageSize}";
//资源类型
$re = mysql_query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="content-type" content-type="text/html" >
	<title>文章管理</title>
	<style type="text/css">
		*{
			margin:0;
			padding:0;

		}
		a{
			text-decoration:none;
			font-size: 16px;

		}
		.container{
			margin:5%;
		}
		
		.desc{
			margin-bottom:10px;
		}
		.update,.prev,.current{
			padding-right: 20px;
			
		}
		.lastBar{
			text-align:center;
			padding:5px;
		}
		.search{
			margin-bottom: 10px;
		}
		form input[type='submit']{
			margin-left: 10px;
		}
		.mark{
			color:red;
		}
		

		
	</style>
</head>
<body>
	<div class="container">
		<div class="desc">当前操作：文章管理</div>
		<form action="manageNews.php" method="get">
			<div class="search">搜索：<input type="text" name="keyword"><input type="submit" value="开始查询"></div>
		</form>
		<table width="50%" border="1" cellspacing=0 cellpadding=0 bgcolor="#ccc">
		<tr>
			<td>id</td>
			<td>标题</td>
			<td>类型</td>
			<td>管理</td>
		</tr>
		<!-- 注意点 -->
		<?php
		while($arr = mysql_fetch_assoc($re)){
		?>
		<tr>
			<td><?php echo $arr['id'];?></td>
			<td><?php echo str_replace($keyword,'<span class="mark">'.$keyword.'</span>',$arr['title']);?></td>
			<td><?php echo $arr['type'];?></td>
			<!-- 从这里发出id -->
			<td><a class="update" href="update.php?id=<?php echo $arr['id']?>">修改</a><a class="del" href="doAction.php?act=del&id=<?php echo $arr['id']?>">删除</a></td>
		</tr>
		<?php
		 }
		?>
		<tr>
			<!-- 注意点：传值给$page -->
			<td class="lastBar" colspan="4">
			<span class="current">共<?php echo $recordTotal;?>条，分成<?php echo $pageTotal;?>页,当前<?php echo $page;?>页</span><a class="prev" href="manageNews.php?page=<?php echo $page-1;?>&keyword=<?php echo $keyword;?>">prev</a><a class="next" href="manageNews.php?page=<?php echo $page+1;?>&keyword=<?php echo $keyword;?>">next</a></td>
		</tr>
	</table>
	</div>
<script type="text/javascript">
	//onload 类似属性，后面是funcRef
	window.onload=function(){
		
		var del = document.querySelectorAll('.del');
		console.log(del);
		for(var i=0;i<del.length;i++){
			del[i].onclick=function(){
			console.log("test1");
			return window.confirm('是否删除');
		}	
		}
		
	}
</script>	
</body>
</html>
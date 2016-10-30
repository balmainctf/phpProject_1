<?php
header("content-type:text/html;charset=utf8");
session_start();

$id = isset($_GET['id']) ? $_GET['id'] : "";
mysql_connect('localhost','root','123');
mysql_set_charset('utf8');
mysql_select_db("pra");

$sql = "select * from news where id={$id}";
$re = mysql_query($sql);
// var_dump($re);
// exit();
$arr = mysql_fetch_assoc($re);

$res = mysql_query("select * from news order by id desc limit 0,5");

//将要产生的cookie和原来的cookie做拼接
// $viewed = $_COOKIE['viewed'];
// if(!empty($viewed)){
// 	$viewed_arr = unserialize($viewed);
// 	$viewed_arr[$id] = $arr['title'];
// 	$viewed = serialize($viewed_arr); 
// }else{
// 	$viewed = serialize(array($id=>$arr['title']));
// }
//查看过的文章 生成cookie 难点
// setcookie('viewed',$viewed);

//用session实现
$viewedList = $_SESSION['viewed'];//拿原来的
$viewedList[$id] = $arr['title'];//拼接


$_SESSION['viewed'] = $viewedList;

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="content-type" content="text/html">
	<title>文章详情</title>
	<style type="text/css">
		*{
			margin:0;
			padding:0;
		}
		body{
			padding:30px;
		}
		h1{
			font-size: 22px;
			/*margin-top: 10px;*/
			margin-bottom: 10px;
			background-color:green;
		}
		ul{
			margin:10px 0;
		}
		.content{
			overflow: auto;
			width:900px;
			margin:10px auto;
			border:1px solid black;
			padding:10px;
		}
		.left{
			float:left;
			clear:both;
			background-color:#ccc;
			width:30%;
			height: 100%;
			
		}
		.saw{
			margin-top: 10px;
			border:1px solid #555;
			width:100%;
			overflow: auto;
			word-break: break-all;
		}
		.last{
			border:1px solid #555;
		}
		.right{
			float:right;
			background-color:#ccc;
			width:70%;
			
		}
		.current{
			font-weight: bold;
			font-size:20px;
		}
		h2{
			margin:10px 0;
		}
	</style>
</head>
<body>
	<div class="content">
		<div class="left">
			<div class="last">
				<h1>最新文章</h1>
				<ul>
					<?php
						while($array = mysql_fetch_assoc($res)){
							echo "<li>{$array['id']}--{$array['title']}</li>";
						}
					?>
				</ul>
			</div>

			<div class="saw">
				<h1>已阅文章</h1>
				<ul>
				<?php
				
				// if(!empty($_COOKIE['viewed'])){
				// 	//返回值时数组
				// 	$viewed_list = unserialize($_COOKIE['viewed']);
				// 	foreach ($viewed_list as $k => $v) {
				// 	echo "<li>{$v}</li>";					
				// 	}
				// }
				//session_start();
				//var_dump($_SESSION['viewed']);
				foreach($viewedList as $k => $v){
					echo "<li>{$v}</li>";
				}

				?>
				</ul>
			</div>
		</div>
		<div class="right">
			<div class="current">
				当前位置：文章详情页

			</div>
			<div class="news">
				<h2>标题：<?php echo $arr['title']?></h2>
				<div>作者<?php echo $arr['author']?>&nbsp;发布时间<?php echo $arr['pubTime']?></div>
				<p>内容：<?php echo $arr['content']?></p>
			</div>
		</div>
	</div>
</body>
</html>
<?php
header("content-type:text/html;charset=utf8");

//连接数据库
mysql_connect('localhost','root','123');
mysql_set_charset('utf8');
mysql_select_db('pra');
$pageValue = isset($_GET['page']) ? $_GET['page'] : 1;

$pageSize = 5;
$recordTotalSql = "select count(*) as num from news";

$re = mysql_query($recordTotalSql);
$arr = mysql_fetch_assoc($re);
$recordTotal = $arr['num'];
$pageNum = ceil($recordTotal / $pageSize);
//判读接收的页码值的合法性
if($pageValue < 1){
	$pageValue = 1;
}
if($pageValue > $pageNum){
	$pageValue = $pageNum;
	// var_dump($pageNum);
	// exit();
}
//算法(页码值-1)*$pageSize;
$start = ($pageValue - 1) * $pageSize;
$sql = "select * from news limit {$start},{$pageSize}";

$res = mysql_query($sql);



?>
<ul>
<?php
while($array = mysql_fetch_assoc($res)){
	$id = $array['id'];
	echo "<li>{$array['id']}---<a target='_blank' href='detail.php?id={$id}'>{$array['title']}</a></li>";
}
echo '</ul>';

?>
<hr>
共<?php echo $recordTotal; ?>条,共<?php echo $pageNum; ?>页。当前<?php echo $pageValue; ?>页.<a href="?page=<?php echo $pageValue - 1;?>">prev</a>&nbsp;&nbsp;<a href="?page=<?php echo $pageValue + 1;?>">next</a>

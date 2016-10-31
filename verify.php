<?php
header("content-type:image/PNG");
session_start();
$re=imagecreatetruecolor(120,30);
$w=imagecolorallocate($re,255,255,255);
imagefill($re,0,0,$w);


$strLib=join("",array_merge(range(0,9),range('a','z'),range('A','Z')));
$strLi=substr(str_shuffle($strLib),0,4);

$_SESSION['verify'] = strtolower($strLi);


for($i=0;$i<4;$i++){ 
	$char = substr($strLi,$i,1);
	//var_dump($char); 害惨了

	$x = $i*25+10; // 10 35 60 85
	$y = 25;
	$color=imagecolorallocate($re,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
	// $font = "";
	//var_dump($font);
	imagefttext($re,25,mt_rand(-15,15),$x,$y,$color,"FZLongZhaoJW.ttf",$char);
}
for($i;$i<150;$i++){
	$color=imagecolorallocate($re,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
	imagesetpixel($re,mt_rand(0,120),mt_rand(0,30),$color);
}

for($i=0;$i<4;$i++){
	$x1=0;
	$y1=mt_rand(0,30);
	$x2=120;
	$y2=mt_rand(0,30);
	$color=imagecolorallocate($re,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
	imageline($re,$x1,$y1,$x2,$y2,$color);
}

imagepng($re);
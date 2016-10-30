<?php
// echo md5("123456");

// var_dump(explode("|",$_COOKIE['username']));

// var_dump(unserialize($_COOKIE['username']));
session_start();
$userid = $_SESSION['userid'];
var_dump($userid);
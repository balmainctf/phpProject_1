<?php

// if(!isset($_COOKIE['adminid'])){
// 	echo "<script text/javascript>top.location.replace('http://localhost/htdocs/php0901/phpProject_1/login.html')</script>";
// }
session_start();
if(!isset($_SESSION['adminid'])){
	echo "<script text/javascript>top.location.replace('http://localhost/htdocs/php0901/phpProject_1/login.html')</script>";
	exit();
}
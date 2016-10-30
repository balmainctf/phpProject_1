<?php
// setcookie('username',join("|",array('sh'=>2,'uai'=>3,'123'=>4)));

// setcookie('username',serialize(array('sh'=>2,'uai'=>3,'123'=>4)));
session_start();
$_SESSION['userid'] = 123;
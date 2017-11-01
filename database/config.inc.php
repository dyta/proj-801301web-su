<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "finalproject_030";

// เชื่อต่อฐานข้อมูล
$DBConnect = mysqli_connect($host, $username, $password, $dbname) or die ("Connect Error");

mysqli_set_charset($DBConnect, 'utf8');
date_default_timezone_set("Asia/Bangkok");

include 'functions.php';
?>

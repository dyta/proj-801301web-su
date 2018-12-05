<?php

$host = "anm-db-asia.cxfcplsls1ts.ap-southeast-1.rds.amazonaws.com";
$username = "anm_client";
$password = "CfTyPG#rQB_U5rb3E.}q";
$dbname = "finalproject_030";

// เชื่อต่อฐานข้อมูล
$DBConnect = mysqli_connect($host, $username, $password, $dbname) or die ("Connect Error");

mysqli_set_charset($DBConnect, 'utf8');
date_default_timezone_set("Asia/Bangkok");

include 'functions.php';
?>

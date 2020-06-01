<?php

if(!isset($_GET['mode']))exit;
session_name();
session_start();
$nick = $_SESSION['nickName'];
$mode = "s_" . $_GET['mode'];
$level = $_GET['level'] . '_statistic';
$right = (int)$_GET['right'];
$all = (int)$_GET['all'];

include ("DB_connect.php");

$result = mysqli_query($db, "SELECT * FROM $level WHERE nick = '$nick'");
$table_row = mysqli_fetch_array($result);
$list  = explode("/",$table_row[$mode]);
settype($list[0],'integer');
settype($list[1],'integer');
$list[0]+=$right;
$list[1]+=$all;

$str_res = "$list[0]" . "/" . "$list[1]";
$r = mysqli_query($db, "UPDATE $level SET $mode='$str_res' WHERE nick='$nick' ");
echo mysqli_error($db);


header("Location: ../pages/user_home_page/user_home.php");
exit;
<?php
session_name();
session_start();

if(!isset($_SESSION['nickName'])) {
    session_destroy();
    exit;
}

$nick = $_SESSION['nickName'];
include ("DB_connect.php");
mysqli_query($db, "UPDATE statistic SET s_add='0/0',s_sub='0/0',s_mult='0/0',s_div='0/0',s_sqr='0/0' WHERE nick='$nick'");
header("Location: ../pages/user_state/user_state.php");
exit;
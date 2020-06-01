<?php
session_name();
session_start();

if(!isset($_SESSION['nickName'])) {
    session_destroy();
    exit;
}
$nick = $_SESSION['nickName'];
$level = $_GET['level'] . "_statistic";
include("DB_connect.php");
if ($_GET['level'] == "all") {
    mysqli_query($db, "UPDATE easy_statistic SET s_add='0/0',s_sub='0/0',s_mult='0/0',s_div='0/0',s_sqr='0/0' WHERE nick='$nick'");
    mysqli_query($db, "UPDATE mid_statistic SET s_add='0/0',s_sub='0/0',s_mult='0/0',s_div='0/0',s_sqr='0/0' WHERE nick='$nick'");
    mysqli_query($db, "UPDATE hard_statistic SET s_add='0/0',s_sub='0/0',s_mult='0/0',s_div='0/0',s_sqr='0/0' WHERE nick='$nick'");
} else {
    mysqli_query($db, "UPDATE $level SET s_add='0/0',s_sub='0/0',s_mult='0/0',s_div='0/0',s_sqr='0/0' WHERE nick='$nick'");
}
header("Location: ../pages/user_state/user_state.php");
exit;
<?php
session_name();
session_start();
if (!isset($_SESSION['nickName'])) {
    header("Location:../pages/settings_page/settings_page.php");
    exit;
}

$nick = $_SESSION['nickName'];
include("DB_connect.php");
mysqli_query($db, "DELETE FROM users WHERE login = '$nick'");
mysqli_query($db, "DELETE FROM easy_statistic WHERE nick = '$nick'");
mysqli_query($db, "DELETE FROM mid_statistic WHERE nick = '$nick'");
mysqli_query($db, "DELETE FROM hard_statistic WHERE nick = '$nick'");
$_SESSION['login_mess'] = "Профиль \"$nick\" удалён!";
unset($_SESSION['nickName']);
header("Location:../pages/start_page/start_page.php")
?>

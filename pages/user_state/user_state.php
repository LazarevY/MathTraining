<?php
session_name();
session_start();
if (!isset($_SESSION['nickName'])) {
    session_destroy();
    header('Location:../start_page/start_page.php');
    exit();
}

$nick = $_SESSION['nickName'];
include("../../php_scripts/DB_connect.php");
$result = mysqli_query($db, "SELECT * FROM easy_statistic WHERE nick = '$nick'");
$easy = getArrayStateLevel($result);

$result = mysqli_query($db, "SELECT * FROM mid_statistic WHERE nick = '$nick'");
$mid = getArrayStateLevel($result);

$result = mysqli_query($db, "SELECT * FROM hard_statistic WHERE nick = '$nick'");
$hard = getArrayStateLevel($result);


echo <<< HERE

<html lang="ru">
<head>
    <meta charset = "utf-8">
    <link rel = "stylesheet" type = "text/css"  href = "../general/template.css">
    <link rel = "stylesheet" type = "text/css"  href = "user_state.css">
    <link rel = "stylesheet" type = "text/css"  href = "../general/buttons.css">
    <title>Statistic</title>
</head>
<body>
<div class="main">
    <div class ="user_bar">
        <div class="user_info"><div style="width: 65%; float: left; height: 100%;
        line-height: 100%;"><h2>User : $nick</h2></div>
        <input class="exit_button" type="button" onclick="document.location.replace('../../php_scripts/exit.php');" value="Выйти"></div>
    </div>
    <div class="left_panel">
    <input class = "temp" type="button" onclick="document.location.replace('../user_home_page/user_home.php')" value="Главная">
    <input class = "current" type="button" class = "temp" value="Статистика">
    <input class = "temp" type="button" onclick="document.location.replace('../info_page/info_page.php');" class = "temp" value="Информация">
    <input class = "temp" type="button" onclick="document.location.replace('../settings_page/settings_page.php');" class = "temp" value="Настройки">
</div>
    <div class = "content">
    <table class="state_table">
        <tbody>
            <tr>
                <th></th>
                <th colspan="2">Простой</th>
                <th colspan="2">Средний</th>
                <th colspan="2">Сложный</th>
            </tr>
            
            <tr>
                <th>Режим</th>
                <th>Решено правильно</th>
                <th>Решено всего</th>
                <th>Решено правильно</th>
                <th>Решено всего</th>
                <th>Решено правильно</th>
                <th>Решено всего</th>
            </tr>
            <tr> 
                <th>Сложение</th>
                <td>$easy[r_add]</td>
                <td>$easy[all_add]</td>
                <td>$mid[r_add]</td>
                <td>$mid[all_add]</td>
                <td>$hard[r_add]</td>
                <td>$hard[all_add]</td>
            </tr>
            <tr> 
                <th>Вычитание</th>
                <td>$easy[r_sub]</td>
                <td>$easy[all_sub]</td>
                <td>$mid[r_sub]</td>
                <td>$mid[all_sub]</td>
                <td>$hard[r_sub]</td>
                <td>$hard[all_sub]</td>
            </tr>            
            <tr> 
                <th>Умножение</th>
                <td>$easy[r_mult]</td>
                <td>$easy[all_mult]</td>
                <td>$mid[r_mult]</td>
                <td>$mid[all_mult]</td>
                <td>$hard[r_mult]</td>
                <td>$hard[all_mult]</td>
            </tr>            
            <tr> 
                <th>Деление</th>
                <td>$easy[r_div]</td>
                <td>$easy[all_div]</td>
                <td>$mid[r_div]</td>
                <td>$mid[all_div]</td>
                <td>$hard[r_div]</td>
                <td>$hard[all_div]</td>
            </tr>            
            <tr> 
                <th>Квадраты</th>
                <td>$easy[r_sqr]</td>
                <td>$easy[all_sqr]</td>
                <td>$mid[r_sqr]</td>
                <td>$mid[all_sqr]</td>
                <td>$hard[r_sqr]</td>
                <td>$hard[all_sqr]</td>
            </tr>           
        </tbody>
    </table>
    <button class="clear_button" onclick="document.location.replace('../../php_scripts/clear_state.php?level=all')" type="button">Сбросить всё</button><!--
 --><button class="clear_button" onclick="document.location.replace('../../php_scripts/clear_state.php?level=easy')" type="button">Сбросить Простой</button><!--
 --><button class="clear_button" onclick="document.location.replace('../../php_scripts/clear_state.php?level=mid')" type="button">Сбросить Средний</button><!--
 --><button class="clear_button" onclick="document.location.replace('../../php_scripts/clear_state.php?level=hard')" type="button">Сбросить Сложный</button>
</div>
    <div class ="clear"></div>
    <div class="bottom"></div>
</div>
<script type="text/javascript" src = "../../javascripts/jquery-3.4.0.js"></script>
<script type="text/javascript" src = "../../javascripts/size_control.js"></script>
<script>set_sizes('main')</script>
</body>
</html>
HERE;

function getArrayStateLevel($query)
{
    $table_row = mysqli_fetch_array($query);
    $s_add = explode("/", $table_row['s_add']);
    $s_sub = explode("/", $table_row['s_sub']);
    $s_mult = explode("/", $table_row['s_mult']);
    $s_div = explode("/", $table_row['s_div']);
    $s_sqr = explode("/", $table_row['s_sqr']);
    $array = ["r_add" => $s_add[0], "all_add" => $s_add[1],
        "r_sub" => $s_sub[0], "all_sub" => $s_sub[1],
        "r_mult" => $s_mult[0], "all_mult" => $s_mult[1],
        "r_div" => $s_div[0], "all_div" => $s_div[1],
        "r_sqr" => $s_sqr[0], "all_sqr" => $s_sqr[1]];
    return $array;
}
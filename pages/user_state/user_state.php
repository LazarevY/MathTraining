<?php
session_name();
session_start();
if(!isset($_SESSION['nickName']))exit;

$nick = $_SESSION['nickName'];
include ("../../php_scripts/DB_connect.php");
$result = mysqli_query($db, "SELECT * FROM statistic WHERE nick = '$nick'");
$table_row = mysqli_fetch_array($result);
$s_add = explode("/", $table_row['s_add']);
$s_sub = explode("/", $table_row['s_sub']);
$s_mult = explode("/", $table_row['s_mult']);
$s_div = explode("/", $table_row['s_div']);
$s_sqr = explode("/", $table_row['s_sqr']);


echo <<< HERE

<html lang="ru">
<head>
    <meta charset = "utf-8">
    <link rel = "stylesheet" type = "text/css"  href = "user_state.css">
    <title>Statistic</title>
</head>
<body>
<div class="main">
    <div class ="user_bar">
        <div class="user_info"><div style="width: 65%; float: left; height: 100%;
        line-height: 100%;">User : $nick</div>
        <input class="exit_button" type="button" onclick="document.location.replace('../../php_scripts/exit.php');" value="Выйти"></div>
    </div>
    <div class="left_panel">
    <input class = "temp" type="button" onclick="document.location.replace('../user_home_page/user_home.php')" value="Главная">
    <input class = "current" type="button" class = "temp" value="Статистика">
    <br>
    <input class = "temp" type="button" onclick="alert('Пошёл нахуй пидарас');" class = "temp" value="Настройки">
</div>
    <div class = "content">
    <table class="state_table">
        <tbody>
            <tr>
                <th>Режим</th>
                <th>Решено правильно</th>
                <th>Решено всего</th>
            </tr>
            <tr> 
                <td>Сложение</td>
                <td>$s_add[0]</td>
                <td>$s_add[1]</td>
            </tr>            
            <tr> 
                <td>Вычитание</td>
                <td>$s_sub[0]</td>
                <td>$s_sub[1]</td>
            </tr>           
             <tr> 
                <td>Умножение</td>
                <td>$s_mult[0]</td>
                <td>$s_mult[1]</td>
            </tr>             
            <tr> 
                <td>Деление</td>
                <td>$s_div[0]</td>
                <td>$s_div[1]</td>
            </tr>            
            <tr> 
                <td>Возведение в квадрат</td>
                <td>$s_sqr[0]</td>
                <td>$s_sqr[1]</td>
            </tr>
        </tbody>
    </table>
    <input onclick="document.location.replace('../../php_scripts/clear_state.php')" type="button" value="Сбросить">
</div>
    <div class ="clear"></div>
    <div class="bottom"></div>
</div>
<script type="text/javascript" src = "../../javascripts/jquery-3.4.0.js"></script>
<script type="text/javascript" src = "../../javascripts/size_control.js"></script>
<script >set_sizes('main')</script>
</body>
</html>
HERE;
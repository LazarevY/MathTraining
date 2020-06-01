<?php
session_name();
session_start();
if (!isset($_SESSION['nickName'])) {
    session_destroy();
    header('Location:../start_page/start_page.php');
    exit();
}
$nick = $_SESSION['nickName'];

echo <<< HERE
<!DOCTYPE html>

<html lang="ru">
<head>
    <meta charset = "utf-8">
    <link rel = "stylesheet" type = "text/css"  href = "../general/template.css">
    <link rel = "stylesheet" type = "text/css"  href = "../general/buttons.css">
    <title>Start page</title>
</head>
<body>
<div class="main">
<div class="select_level" id="choose_level">
<h2>Выберите уровень:</h2>
    <form style="height: 80%" method="post" action="../action_page/action.php">
    <input type="hidden" name = mode value="">
    <input type="hidden" name = level value="">
    <button type = "submit" class="level" onclick="select_level('easy','level','help');" id = simple>Простой</button><!--
 --><button type = "submit" class="level" onclick="select_level('mid','level','help');" id = middle>Средний</button><!--
 --><button type = "submit" class="level" onclick="select_level('hard','level','help');" id = hard>Посложнее</button>
    </form>
<button onclick="cancel('mode','choose_level');" style="width: 20%;">Отмена</button>
</div>
    <div class ="user_bar">
        <div class="user_info"><div style="width: 65%; float: left; height: 100%;
        line-height: 100%;"><h2>User : $nick</h2></div>
        <input class="exit_button" type="button" onclick="document.location.replace('../../php_scripts/exit.php');" value="Выйти"></div>
    </div>
    <div class="left_panel">
    <input class = "current" type="button" value="Главная">
    <input class = "temp" type="button" onclick="document.location.replace('../user_state/user_state.php');" class = "temp" value="Статистика">
    <input class = "temp" type="button" onclick="document.location.replace('../info_page/info_page.php');" class = "temp" value="Информация">
    <input class = "temp" type="button" onclick="document.location.replace('../settings_page/settings_page.php');" class = "temp" value="Настройки">
</div>
    <div class = "content">
        <h2 style="text-align: center;">Выберите режим</h2>
       <button class="mode" id = "mode_add" onclick="set_mode('mode','add','choose_level');" type="button">Сложение</button><!--
    --><button class="mode" id = "mode_sub" onclick="set_mode('mode','sub','choose_level');" type="button">Вычитание</button><!--
    --><button class="mode" id = "mode_mult" onclick="set_mode('mode','mult','choose_level');" type="button">Умножение</button><!--
    --><button class="mode" id = "mode_div" onclick="set_mode('mode','div','choose_level');" type="button">Деление</button><!--
    --><button class="mode" id = "mode_sqr" onclick="set_mode('mode','sqr','choose_level');" type="button">Квадраты</button>
</div>
    <div class ="clear"></div>
    <div class="bottom"></div>
</div>
<script type="text/javascript" src = "../../javascripts/jquery-3.4.0.js"></script>
<script type="text/javascript" src = "../../javascripts/size_control.js"></script>
<script >set_sizes('main')</script>
<script type="text/javascript" src = "../../javascripts/utils_script.js"></script>
<script type="text/javascript" src = "../../javascripts/select_level.js"></script>
</body>
</html>
HERE;
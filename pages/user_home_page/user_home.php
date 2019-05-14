<?php
session_name();
session_start();
if(!isset($_SESSION['nickName'])){
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
    <link rel = "stylesheet" type = "text/css"  href = "user_home.css">
    <title>Start page</title>
</head>
<body>
<div class="main">
    <div class ="user_bar">
        <div class="user_info"><div style="width: 65%; float: left; height: 100%;
        line-height: 100%;">User : $nick</div>
        <input class="exit_button" type="button" onclick="document.location.replace('../../php_scripts/exit.php');" value="Выйти"></div>
    </div>
    <div class="left_panel">
    <input class = "current" type="button" value="Главная">
    <input class = "temp" type="button" onclick="document.location.replace('../user_state/user_state.php');" class = "temp" value="Статистика">
    <input class = "temp" type="button" onclick="alert('Пошёл нахуй пидарас');" class = "temp" value="Настройки">
</div>
    <div class = "content">
    <form class = "simple_form" method = "post" action = "../action_page/action.php">
			<fieldset class = "mode">
			<label>
				<div class = "element"><label for = "add"><input type = "radio" name = "mode" value = "add" id = "add" checked />Сложение</label></div><br>
				<div class = "element"><label for = "sub"><input type = "radio" name = "mode" value = "sub" id = "sub"/>Вычитание</label></div><br>
				<div class = "element"><label for = "mult"><input type = "radio" name = "mode" value = "mult" id = "mult"/>Умножение</label></div><br>
				<div class = "element"><label for = "sqr"><input type = "radio" name = "mode" value = "sqr" id = "sqr"/>Возведение в квадрат</label></div><br>
				<div class = "element"><label for = "div"><input type = "radio" name = "mode" value = "div" id = "div"/>Деление</label></div><br>
			</label>
			<input class = "button" type = "submit" value = "Начать">
			</fieldset>
		</form>
</div>
    <div class ="clear"></div>
    <div class="bottom"></div>
</div>
<script type="text/javascript" src = "../../javascripts/jquery-3.4.0.js"></script>
<script type="text/javascript" src = "../../javascripts/size_control.js"></script>
<script >set_sizes('main')</script>
<script type="text/javascript" src = "../../javascripts/utils_script.js"></script>
</body>
</html>
HERE;
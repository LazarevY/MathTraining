<?php
session_name();
session_start();
if (!isset($_SESSION['nickName'])) {
    session_destroy();
    header('Location:../start_page/start_page.php');
    exit();
}

echo <<< HERE
<!DOCTYPE html>

<html lang="ru">
<head>
    <meta charset = "utf-8">
    <link rel = "stylesheet" type = "text/css"  href = "../general/template.css">
    <link rel = "stylesheet" type = "text/css"  href = "../general/buttons.css">
    <title>Information</title>
</head>
<body>
<div class="main">
    <div class ="user_bar">
        <div class="user_info"><div style="width: 65%; float: left; height: 100%;
        line-height: 100%;"><h2>User : $_SESSION[nickName]</h2></div>
        <input class="exit_button" type="button" onclick="redirect('../../php_scripts/exit.php');" value="Выйти"></div>
    </div>
    <div class="left_panel">
    <input class = "temp" type="button" onclick="redirect('../start_page/start_page.php');" value="Главная">
    <input class = "temp" type="button" onclick="redirect('../user_state/user_state.php');" value="Статистика">
    <input class = "current" type="button"  value="Информация">
    <input class = "temp" type="button" onclick="document.location.replace('../settings_page/settings_page.php');"  value="Настройки">
</div>
    <div style="overflow-y: auto" class = "content">
        <h1>Все о проекте</h1>
        <h2 id = "header">Оглавление</h2>
        <ul> 
            <li><a href="#description"><h3>Описание проекта</h3></a></li>
            <li><a href="#modes"><h3>Режимы</h3></a></li>
            <li><h3>Уровни сложности</h3></li>
            <li><h3>Статистика</h3></li>
            <li><h3></h3></li>
        </ul>
        <br><br><br>
        <h3 id = "description">Описание проекта</h3>
        <p>Проект MathTraining создан для того, чтобы каждый желающий мог проверить свои способности в 
        решении обычных примеров.</p>
        
        <h3 id = "modes">Режимы</h3>
        <p>Предусмотрено несколько режимов, в которых Вы можете потренироваться: Сложение, Вычитание, Умножение, Деление, и Квадраты.
        Название каждого режима отражает его суть.</p>
</div>
    <div class ="clear"></div>
    <div class="bottom"></div>
</div>
<script type="text/javascript" src = "../../javascripts/jquery-3.4.0.js"></script>
<script type="text/javascript" src = "../../javascripts/size_control.js"></script>
<script >set_sizes('main');
function redirect(url) {
  document.location.replace(url);
}
</script>
<script type="text/javascript" src = "../../javascripts/utils_script.js"></script>
</body>
</html>
HERE;
?>
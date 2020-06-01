<?php
session_name();
session_start();
if (!isset($_SESSION['nickName'])) {
    session_destroy();
    header('Location:../start_page/start_page.php');
    exit();
}
$mess_1 = "После смены ника необходимо войти заново";
if (isset($_SESSION['n_nick_mess'])) {
    $mess_1 = $_SESSION['n_nick_mess'];
    unset($_SESSION['n_nick_mess']);
}

echo <<< HERE
<!DOCTYPE html>

<html lang="ru">
<head>
    <meta charset = "utf-8">
    <link rel = "stylesheet" type = "text/css"  href = "../general/template.css">
    <link rel = "stylesheet" type = "text/css"  href = "../general/buttons.css">
    <link rel = "stylesheet" type = "text/css"  href = "settings.css">
    <title>Settings</title>
</head>
<body>
<div class="main">
    <div class ="user_bar">
        <div class="user_info"><div style="width: 65%; float: left; height: 100%;
        line-height: 100%;"><h2>User : $_SESSION[nickName]</h2></div>
        <input class="exit_button" type="button" onclick="document.location.replace('../../php_scripts/exit.php');" value="Выйти"></div>
    </div>
    <div class="left_panel">
    <input class = "temp" type="button" onclick="document.location.replace('../user_home_page/user_home.php');" value="Главная">
    <input class = "temp" type="button" onclick="document.location.replace('../user_state/user_state.php');" class = "temp" value="Статистика">
    <input class = "temp" type="button" onclick="document.location.replace('../info_page/info_page.php');" class = "temp" value="Информация">
    <input class = "current" type="button" class = "temp" value="Настройки">
</div>
    <div class = "content">
    <h2>Смена ника</h2>
    <form class = "forms" method="post" action="../../php_scripts/rename.php">
    <p>$mess_1</p>
    <table>  
        <tr> 
            <td><label for="rename">Новый ник:</label></td>
            <td><input class = "fields" type="text" name = "new_nick" id = "rename"></td>
        </tr>
        <tr>
            <td><label for="pass">Текущий пароль</label></td> 
            <td><input class="fields" type="password" name = "pass_control" id = "pass"></td> 
        </tr>
        <tr> 
            <td colspan="2"><input style="width: 100%" type="submit" value="Сменить ник"></td>
        </tr>
    </table>
</form>

<button onclick="document.location.replace('../../php_scripts/user_delete.php')">Удалить профиль</button>
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
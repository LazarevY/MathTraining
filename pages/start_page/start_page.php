
<?php
session_name();
session_start();
if(isset($_SESSION['nickName'])){
    header("Location:../user_home_page/user_home.php");
    exit;
}else{
    session_destroy();
}
?>

<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>
        Math Training
    </title>

    <link rel="stylesheet" type="text/css" href="start_page.css">
</head>

<body onload ="update_page();">
    <div class = "main_container">
        <div class="header" id="bl_1">
            <h1>Math Training</h1>
        </div>
        <div class="login_form">
            <span class = "form_word">Вход</span>
            <hr>
            <form autocomplete="on" method="post" action="../../php_scripts/login.php" name="login" class="log_form"
                  id="login_form_">
                <label for="nickName_field">
                    <span class="white_text">Ваш никнейм:</span><br>
                    <input class="raz" type="text" name="login_nickName" id="login_nickName_field">
                </label>
                <br>

                <label for="password_field">
                    <span class="white_text">Пароль:</span><br>
                    <input class = "raz" type="password" name="login_password" id="login_password_field">
                </label>
                <br>
                <input class="button" type="submit" name="input" id="login_input_button" value="Войти" onclick="setCookie('login_nickName',login_nickName.value)">

            </form>
            <hr>
            <span class="form_word">Регистрация</span>
            <hr>
            <form autocomplete="off" method="post" action="../../php_scripts/register.php" name="registration" class="regs_form"
                  id="register_form_1">
                <label for="nickName_field">
                    <span class="white_text">Придумайте ник:</span><br>
                    <input class="raz" placeholder="Не менее 3-х символов" type="text" name="nickName" id="nickName_field"
                    onkeyup="registration_form_control('nickName_field','password_field','double_password_field','reg_input_button')">
                </label>
                <br>

                <label for="password_field">
                    <span class="white_text">Придумайте пароль:</span><br>
                    <input class = "raz" type="password" name="password" id="password_field" placeholder="Не менее 8-ми символов"
                           onkeyup="registration_form_control('nickName_field','password_field','double_password_field','reg_input_button')">
                </label>

                <label for="double_password_field">
                    <span class="white_text">Повторите пароль:</span><br>
                    <input class = "raz" type="password" name="double_password" id="double_password_field" disabled
                    onkeyup="registration_form_control('nickName_field','password_field','double_password_field','reg_input_button')">
                </label>
                <br>
                <input class="button" disabled type="submit" name="input" id="reg_input_button" value="Регистрация">

            </form>
        </div>

        <div class ="clear"></div>

        <div class="bottom">
            <a class="register_ref" href="">Об авторе проекта</a>
        </div>

        <script type="text/javascript" src = "../../javascripts/jquery-3.4.0.js"></script>
        <script type="text/javascript" src="../../javascripts/cookies.js"></script>
</div>

<!--<h1 class = "title">-->
<!--    Добро пожаловать-->
<!--</h1>-->

    <script type="text/javascript" src="../../javascripts/size_control.js"></script>
    <script type="text/javascript" src = "../../javascripts/utils_script.js"></script>
    <script >set_sizes('main_container')</script>
</body>
</html>
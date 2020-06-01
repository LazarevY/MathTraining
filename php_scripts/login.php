<?php

//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
if (isset($_POST['login_nickName'])) {
    $login = $_POST['login_nickName'];
    if ($login == '') {
        unset($login);
    }
} //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST['login_password'])) {
    $password = $_POST['login_password'];
    if ($password == '') {
        unset($password);
    }
}
//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
{
    session_start();
    $_SESSION['login_mess'] = "Заполните все поля";
    exit("<script>
document.location.replace('../pages/start_page/start_page.php');
</script>");
}
//если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
$login = stripslashes($login);
$login = htmlspecialchars($login);
$password = stripslashes($password);
$password = htmlspecialchars($password);
//удаляем лишние пробелы
$login = trim($login);
$password = trim($password);
// подключаемся к базе
include("DB_connect.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь

$result = mysqli_query($db, "SELECT * FROM users WHERE login='$login'"); //извлекаем из базы все данные о пользователе с введенным логином
$myrow = mysqli_fetch_array($result);
if (empty($myrow['password_hash'])) {
    session_start();
    $_SESSION['login_mess'] = "Неправильный логин или пароль!";
    exit("<script>
document.location.replace('../pages/start_page/start_page.php');
</script>");
    exit;
} else {
    //если существует, то сверяем пароли
    require_once('PasswordStorage.php');
    $correct_hash = $myrow['password_hash'];
    $salt = $myrow['salt'];

    $result_compare = compare_pass($password, $salt, $correct_hash);
    if ($result_compare) {
        session_name($myrow['id']);
        session_start();
        //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
        $_SESSION['nickName'] = $myrow['login'];
        $_SESSION['id'] = $myrow['id'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
        $r = $_SESSION['nickName'];
        header('Location: ../pages/user_home_page/user_home.php');
        exit;
    } else {
        session_start();
        $_SESSION['login_mess'] = "Неправильный логин или пароль!";
        exit("<script>
document.location.replace('../pages/start_page/start_page.php');
</script>");
    }
}


function compare_pass($pass, $salt, $hash_code)
{

    require_once('PasswordStorage.php');

    $calc_hash = PasswordStorage::pbkdf2("sha256", $pass, $salt, 1000, 30);
    if ($calc_hash == $hash_code) {
        return true;
    } else {
        return false;
    }

}

function sessionGet($name){
    return $_SESSION[$name];
}


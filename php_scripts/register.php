<?php
$salt_size = 20;
$data_base_name = "users_base";

if (isset($_POST['nickName'])) {
    $login = $_POST['nickName'];
    if ($login == '') {
        unset($login);
    }
} //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    if ($password == '') {
        unset($password);
    }
}
//заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
{
    session_start();
    $_SESSION['login_mess'] = "Заполните все поля!";
    header("Location:../pages/start_page/start_page.php");
    exit;
}
//если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
$login = stripslashes($login);
$login = htmlspecialchars($login);
$password = stripslashes($password);
$password = htmlspecialchars($password);
//удаляем лишние пробелы
$login = trim($login);
$password = trim($password);
// подключаемся к базе
include("DB_connect.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь
// проверка на существование пользователя с таким же логином
$result = mysqli_query($db, "SELECT id FROM users WHERE login='$login'");
$res = "";
$myrow = mysqli_fetch_array($result);
if (empty($myrow['id'])) {


// если такого нет, то сохраняем данные
    require_once('PasswordStorage.php');
    $salt_1 = openssl_random_pseudo_bytes($salt_size);
    $salt = bin2hex($salt_1);
    $hash_1 = PasswordStorage::pbkdf2("sha256", $password, $salt, 1000, 30);
    $hash = strval($hash_1);
    $result2 = mysqli_query($db, "INSERT INTO users (login,password_hash, salt) VALUES('$login','$hash','$salt')") or die(mysqli_error($db));
//    $result2 = mysqli_query($db, "INSERT INTO easy_statistic (nick) VALUES('$login')") or die(mysqli_error($db));
//    $result2 = mysqli_query($db, "INSERT INTO mid_statistic (nick) VALUES('$login')") or die(mysqli_error($db));
//    $result2 = mysqli_query($db, "INSERT INTO hard_statistic (nick) VALUES('$login')") or die(mysqli_error($db));
// Проверяем, есть ли ошибки
    $res = $result2 ? "Регистрация прошла успешно!" : "Произошла ошибка!";
} else {
    session_start();
    $_SESSION['login_mess'] = "Ник уже используется!";
    header("Location:../pages/start_page/start_page.php");
    exit;
}
session_start();
$_SESSION['login_mess'] = $res;
header("Location:../pages/start_page/start_page.php");
exit;

function connect_toBase()
{
    $conn = new mysqli(HOST, DB_USER, DB_PASSWORD);
    // mysql_select_db (DB,$conn);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}

?>
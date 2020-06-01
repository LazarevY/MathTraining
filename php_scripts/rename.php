<?php
session_name();
session_start();
if (empty($_POST['new_nick']) || empty($_POST['pass_control'])) {
    $_SESSION['n_nick_mess'] = 'Заполнены не все поля!';
    header("Location:../pages/settings_page/settings_page.php");
    exit;
} else {
    $new_nick = $_POST['new_nick'];
    if (strlen($new_nick) < 3) {
        $_SESSION['n_nick_mess'] = 'Слишком короткий ник!';
        header("Location:../pages/settings_page/settings_page.php");
        exit;
    }
    include("DB_connect.php");
    $query = mysqli_query($db, "SELECT * FROM users WHERE nick='$new_nick'");
    //$array = mysqli_fetch_array($query);

    if ($query) {
        $_SESSION['n_nick_mess'] = 'Ник уже используется!';
        header("Location:../pages/settings_page/settings_page.php");
        exit;
    }
    $current_nick = $_SESSION['nickName'];
    $query = mysqli_query($db, "SELECT * FROM users WHERE login = '$current_nick'");
    $array = mysqli_fetch_array($query);
    if ($array['login'] == $new_nick) {
        $_SESSION['n_nick_mess'] = 'Придумайте новый ник!';
        header("Location:../pages/settings_page/settings_page.php");
        exit;
    }
    if (!compare_pass($_POST['pass_control'], $array['salt'], $array['password_hash'])) {
        $_SESSION['n_nick_mess'] = 'Неверный пароль!';
        header("Location:../pages/settings_page/settings_page.php");
        exit;
    }
    mysqli_query($db, "UPDATE users SET login = '$new_nick' WHERE login = '$_SESSION[nickName]'");
    mysqli_query($db, "UPDATE easy_statistic SET nick = '$new_nick' WHERE nick = '$_SESSION[nickName]'");
    mysqli_query($db, "UPDATE mid_statistic SET nick = '$new_nick' WHERE nick = '$_SESSION[nickName]'");
    mysqli_query($db, "UPDATE hard_statistic SET nick = '$new_nick' WHERE nick = '$_SESSION[nickName]'");
//    session_unset();
//    session_destroy();
//    setcookie(session_name(), '', time() - 60*60*24*32, '/');
//    session_start();
    unset($_SESSION['nickName']);
    unset($_SESSION['id']);
    $_SESSION['login_mess'] = "Ник успешно изменен на \"$new_nick\"!";
    header('Location: ../pages/start_page/start_page.php');
    exit;
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
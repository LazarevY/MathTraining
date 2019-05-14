<?php
echo "<script>console.log('Close session')</script>";
session_start();
session_unset();
session_destroy();
setcookie(session_name(), '', time() - 60*60*24*32, '/');
header('Location: ../pages/start_page/start_page.php');
exit;
?>
<?php
setcookie('erabiltzailea', '', time() - 3600);
setcookie('erabiltzailea', '', time() - 3600, '/');

if (isset($_COOKIE['erabiltzailea'])) {
    unset($_COOKIE['erabiltzailea']);
}

header('Location: index.php');
exit;
?>

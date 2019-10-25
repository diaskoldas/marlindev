<?php
session_start();

require 'myFunc/myFunc.php';

if ($_GET['logout'] == true)
{
    unset($_SESSION['user_data']);
    delCookie('email');
    delCookie('password');
    if (delCookie('remember') != true)
    {
        echo 'Ошибка выхода пользователя';
        die;
    }
}

header('Location: index.php');

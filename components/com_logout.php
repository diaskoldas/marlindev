<?php
session_start();

require '../myFunc/myFunc.php';

if ($_GET['logout'] == true)
{
    unset($_SESSION['user_data']);
    delCookie('remember');
}

header('Location: ../index.php');

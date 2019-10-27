<?php
session_start();

require '../myFunc/myFunc.php';
require '../db/QueryBilder.php';

$queryBilder = new QueryBilder();

$name = addcslashes(trim($_POST['name']), "'");
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$password_confirmation = trim($_POST['password_confirmation']);

$warning = [];

if (empty($name) ||
    strlen($name) == 0)
{
    $warning['name']['message'] = 'Заполните обязательное поле';
}
if (empty($email) ||
    strlen($email) == 0)
{
    $warning['email']['message'] = 'Заполните обязательное поле';
}
if (empty($password) ||
    strlen($password) == 0)
{
    $warning['password']['message'] = 'Заполните обязательное поле';
}
if (empty($password_confirmation) ||
    strlen($password_confirmation) == 0)
{
    $warning['password_confirmation']['message'] = 'Заполните обязательное поле';
}
if (count($warning) > 0)
{
    $warning['name']['data'] = $name;
    $warning['email']['data'] = $email;
    $warning['password']['data'] = $password;
    $warning['password_confirmation']['data'] = $password_confirmation;

    $_SESSION['warning'] = $warning;
    header('Location: ../register.php');
    die;
}
if (!filter_var($name,FILTER_SANITIZE_STRING))
{
    $warning['name']['message'] = 'Некорректные данные';
    $warning['name']['data'] = $name;
}
if (!filter_var($email,FILTER_VALIDATE_EMAIL))
{
    $warning['email']['message'] = 'Некорректные данные';
    $warning['email']['data'] = $email;
}
if (count($warning) > 0)
{
    $warning['name']['data'] = $name;
    $warning['email']['data'] = $email;
    $warning['password']['data'] = $password;
    $warning['password_confirmation']['data'] = $password_confirmation;

    $_SESSION['warning'] = $warning;
    header('Location: ../register.php');
    die;
}
$result = $queryBilder->checkDublicateEmail($email);
if ($result != false ||
    strlen($result) > 0)
{
    $warning['email']['message'] = 'Данный email занят другим пользователем';
    $warning['email']['data'] = $_POST['email'];
}
if ($password != $password_confirmation ||
    strlen($password) != strlen($password_confirmation))
{
    $warning['password']['message'] = 'Пароли не совпадают';
    $warning['password_confirmation']['message'] = 'Пароли не совпадают';
}
if (strlen($password) < 3)
{
    $warning['password']['message'] = 'Пароль должен содержать не меньше 3-х символов';
}
if (strlen($password_confirmation) < 3)
{
    $warning['password_confirmation']['message'] = 'Пароль должен содержать не меньше 3-х символов';
}
if (count($warning) > 0)
{
    $warning['name']['data'] = $name;
    $warning['email']['data'] = $email;
    $warning['password']['data'] = $password;
    $warning['password_confirmation']['data'] = $password_confirmation;

    $_SESSION['warning'] = $warning;
    header('Location: ../register.php');
    die;
}

$password = password_hash($password, PASSWORD_DEFAULT);
$queryBilder->addUser($name, $email, $password);

$_SESSION['new_user'] = true;
header('Location: ../register.php');
die;
?>


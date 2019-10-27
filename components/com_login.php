<?php
session_start();

include '../myFunc/myFunc.php';
include '../db/QueryBilder.php';

$queryBilder = new QueryBilder();

$email = $_POST['email'];
$password = $_POST['password'];
$remember = !empty($_POST['remember']) ? $_POST['remember'] : 0;

$warning = [];

if (strlen($email) == 0)
{
    $warning['email']['message'] = 'Заполните обязательное поле';
}
if (!filter_var($email,FILTER_VALIDATE_EMAIL))
{
    $warning['name']['message'] = 'Некорректные данные';
    $warning['name']['data'] = $name;
}
if (strlen($password) == 0)
{
    $warning['password']['message'] = 'Заполните обязательное поле';
}
if (count($warning) > 0)
{
    $warning['email']['data'] = $email;
    $warning['password']['data'] = $password;
    $_SESSION['warning'] = $warning;
    header('Location: ../login.php');
    die;
}
$result = $queryBilder->findUserByEmail($email);
if ($result == false)
{
    $warning['email']['message'] = 'Возможно неверно указана почта...';
    $warning['password']['message'] = '...или неверное указан пароль';
}
if (count($warning) > 0)
{
    $warning['email']['data'] = $email;
    $warning['password']['data'] = $password;
    $_SESSION['warning'] = $warning;
    header('Location: ../login.php');
    die;
}
if (!password_verify($password, $result['password']))
{
    $warning['email']['message'] = 'Возможно неверно указана почта...';
    $warning['password']['message'] = '...или неверное указан пароль';
}
if (count($warning) > 0)
{
    $warning['email']['data'] = $email;
    $warning['password']['data'] = $password;
    $_SESSION['warning'] = $warning;
    header('Location: ../login.php');
    die;
}
$user_data = [];
$user_data['id'] = $result['id'];
$user_data['name'] = $result['name'];
$user_data['email'] = $email;
$user_data['password'] = $password;
$image = $queryBilder->giveUserData($user_data['id'], 'image');
$user_data['image'] = $image['image'];

$_SESSION['user_data'] = $user_data;

setcookie('remember', $remember, time()+60*60*24*30, '/');

header('Location: ../index.php');
die;


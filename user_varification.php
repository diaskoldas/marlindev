<?php
session_start();

include 'myFunc/myFunc.php';
include 'db/QueryBilder.php';

$email = addcslashes($_POST['email'], "'");
$password = $_POST['password'];

$arr_valid_field = [];
$arr_valid_field['email'] = emailValid($email);
$arr_valid_field['password'] = userNameValid($password, 3, 15);

if ($arr_valid_field['email']['is_valid'] != true ||
    $arr_valid_field['password']['is_valid'] != true)
{
    $arr_valid_field['email']['data'] = $email;
    $_SESSION['user_login_form'] = $arr_valid_field;
    header('Location: login.php');
    die;
}

$queryBilder = new QueryBilder();
$data = $queryBilder->userVerification($email);
$hash = $data['password'];
if (!password_verify($password, $hash))
{
    $arr_valid_field['email']['is_valid'] = false;
    $arr_valid_field['email']['data'] = $email;
    $arr_valid_field['email']['message'] = 'Возможно неверно указана почта...';
    $arr_valid_field['password']['is_valid'] = false;
    $arr_valid_field['password']['data'] = $password;
    $arr_valid_field['password']['message'] = '...или неверное указан пароль';
    $_SESSION['user_login_form'] = $arr_valid_field;
    header('Location: login.php');
    die;
}

$user_data = [];
$user_data['id'] = $data['id'];
$user_data['name'] = $data['name'];
$user_data['email'] = $email;
$user_data['password'] = $password;
$data = $queryBilder->giveUserData($data['id'], 'image');
if (!$data)
{
    echo 'Ошибка получения картинки';
    die;
}
if (!empty($data['image']) ||
    strlen($data['image']) > 0)
{
    $user_data['image'] = $data['image'];
}
$_SESSION['user_data'] = $user_data;
if (!empty($_POST['remember']) && $_POST['remember'] == 1)
{
    setcookie('remember', $_POST['remember']);
    header('Location: index.php');
    die;
}
if (empty($_POST['remember']) || $_POST['remember'] != 1)
{
    setcookie('remember', 0);
    header('Location: index.php');
    die;
}

header('Location: index.php');
die;

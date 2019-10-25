<?php
session_start();

require 'myFunc/myFunc.php';
require 'db/QueryBilder.php';

$arr_valid_field = [];
$name = '';
$email = '';
$password = '';
$password_confirmation = '';

$name = addcslashes($_POST['name'], "'");
$email = addcslashes($_POST['email'], "'");
$password = $_POST['password'];
$password_confirmation = addcslashes($_POST['password_confirmation'], "'");

$arr_valid_field['name'] = userNameValid($name, 3,50);
$arr_valid_field['email'] = emailValid($email);
$arr_valid_field['password'] = passwordValid($password, $password_confirmation);

if ($arr_valid_field['name']['is_valid'] != true ||
    $arr_valid_field['email']['is_valid'] != true ||
    $arr_valid_field['password']['is_valid'] != true)
{
    $_SESSION['add_user_form'] = $arr_valid_field;
    header('Location: register.php');
    die;
}

$queryBilder = new QueryBilder();
$check_email = $queryBilder->checkDublicateEmail($email);
if (!empty($check_email))
{
    $arr_valid_field['email']['is_valid'] = false;
    $arr_valid_field['email']['message'] = "Пользователь с почтой $email уже существует";
    $_SESSION['add_user_form'] = $arr_valid_field;
    header('Location: register.php');
    die;
}

$password = password_hash($password, PASSWORD_DEFAULT);
$queryBilder = new QueryBilder();
$queryBilder->addUser($name, $email, $password);

$_SESSION['new_user'] = true;
header('Location: register.php');
die;
?>

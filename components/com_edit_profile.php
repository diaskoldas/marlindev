<?php
session_start();

require '../myFunc/myFunc.php';
require '../db/QueryBilder.php';

$queryBilder = new QueryBilder();

$id = $_SESSION['user_data']['id'];
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$file = $_FILES['image'];

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
if (count($warning) > 0)
{
    $warning['name']['data'] = $name;
    $warning['email']['data'] = $email;
    $_SESSION['warning'] = $warning;
    header('Location: ../profile.php');
    die;
}

$name = filter_var($name,FILTER_SANITIZE_STRING);
$email = filter_var($email,FILTER_VALIDATE_EMAIL);
if (!$name)
{
    $warning['name']['message'] = 'Некорректные данные';
    $warning['name']['data'] = $_POST['name'];
}
if (!$email)
{
    $warning['email']['message'] = 'Некорректные данные';
    $warning['email']['data'] = $_POST['email'];
}
$result = $queryBilder->checkDublicateEmail($email);
if ($result != false ||
    strlen($result) > 0)
{
    $warning['email']['message'] = 'Данный email занят другим пользователем';
    $warning['email']['data'] = $_POST['email'];
}
if ($result == $_SESSION['user_data']['email'])
{
    unset($warning['email']);
}
if (count($warning) > 0)
{
    $_SESSION['warning'] = $warning;
    header('Location: ../profile.php');
    die;
}

$upload_dir = '';
if ($file['size'] > 0)
{
    $file_name = basename($file['name']);
    $upload_dir = '../img/'.$file_name;
    $tmp_name = $file['tmp_name'];
    $upload_result = move_uploaded_file($tmp_name, $upload_dir);
    if (!$upload_result)
    {
        echo 'Ошибка загрузки файла';
        die;
    }
    if (file_exists($_SESSION['user_data']['image']) &&
        $_SESSION['user_data']['image'] != $upload_dir)
    {
        unlink($_SESSION['user_data']['image']);
    }
    $_SESSION['user_data']['image'] = $upload_dir;
}
if (strlen($upload_dir) == 0)
{
    unset($_SESSION['user_data']['image']);
}
$result = $queryBilder->editProfile($id, $name, $email, $upload_dir);

if (!$result)
{
    echo 'Ошибка редактирования';
    die;
}

$_SESSION['user_data']['name'] = $name;
$_SESSION['user_data']['email'] = $email;

$_SESSION['user_data']['edit_profile'] = true;

header('Location: ../profile.php');

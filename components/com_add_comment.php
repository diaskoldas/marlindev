<?php
session_start();

require '../myFunc/myFunc.php';
require '../db/QueryBilder.php';

$quertyBilder = new QueryBilder();

$name = $_SESSION['user_data']['name'];
$image = $_SESSION['user_data']['image'] ? $_SESSION['user_data']['image'] : '';
$date = date('Y-m-d');
$message = $_POST['message'];

$warning = [];

if (strlen($message) == 0)
{
    $warning['message']['message'] = 'Заполните обязательное поле';
}
if (count($warning) > 0)
{
    $_SESSION['warning'] = $warning;
    header('Location: ../index.php');
    die;
}
if (!filter_var($message, FILTER_SANITIZE_STRING))
{
    $warning['message']['message'] = 'Ошибка фильтрации';
}
if (count($warning) > 0)
{
    $warning['message']['data'] = $message;
    $_SESSION['warning'] = $warning;
    header('Location: ../index.php');
    die;
}
$result = $quertyBilder->addComment($name, $image, $date, $message);
if (!$result)
{
    $warning['page']['message'] = 'Ошибка добавления коментария';
}
if (count($warning) > 0)
{
    $_SESSION['warning'] = $warning;
    header('Location: ../index.php');
    die;
}

$_SESSION['new_comment'] = true;
header('Location: ../index.php');

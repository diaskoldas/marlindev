<?php
session_start();

require '../myFunc/myFunc.php';
require '../db/QueryBilder.php';

$quertyBilder = new QueryBilder();

$data = [];

$message = $_POST['message'];

if (!filter_var($message, FILTER_SANITIZE_STRING))
{
    echo 'Ошибка фильтрации';
    die;
}

$data['name'] = $_SESSION['user_data']['name'];
$data['avatar'] = $_SESSION['user_data']['image'] ? $_SESSION['user_data']['image'] : '';
$data['date'] = date('Y-m-d');
$data['message'] = $message;

$result = $quertyBilder->addComment($data['name'], $data['avatar'], $data['date'], $data['message']);

if (!$result)
{
    echo 'Ошибка добаления';
    die;
}

$_SESSION['new_comment'] = true;
header('Location: ../index.php');

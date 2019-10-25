<?php
session_start();

require 'db/QueryBilder.php';
require 'myFunc/myFunc.php';

$arr_valid_field = [];
$user_name = '';
$message = '';
$avatar = '';

$user_name = addcslashes($_POST['user_name'], "'");
$message = addcslashes($_POST['message'], "'");
$date = date('Y-m-d');

$arr_valid_field['user_name'] = userNameValid($user_name, 3,15);
$arr_valid_field['message'] = messageValid($message, 3,300);

if ($arr_valid_field['user_name']['is_valid'] != true ||
    $arr_valid_field['message']['is_valid'] != true)
{
    $_SESSION['add_form'] = $arr_valid_field;
    header('Location: index.php');
    die;
}

if ($_FILES['avatar']['size'] > 0)
{
    $folder = "img/";
    $tmp_name = $_FILES['avatar']['tmp_name'];
    $path = $folder . basename($_FILES['avatar']['name']);
    move_uploaded_file($tmp_name,$path) ? $avatar = $path : $avatar = '';
}

$queryBilder = new QueryBilder();
$queryBilder->addComment($user_name, $avatar, $date, $message);

$_SESSION['new_comment'] = true;
header('Location: index.php');
die;

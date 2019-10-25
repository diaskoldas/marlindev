<?php

require '../myFunc/myFunc.php';
require '../db/QueryBilder.php';

$quertyBilder = new QueryBilder();

$id = $_GET['id'];
$state = $_GET['state'];
$delete = $_GET['delete'];

if (!empty($delete) &&
    $delete == 1)
{
    $result = $quertyBilder->deleteComment($id);
}
if (!empty($result) ||
    $result != false)
{
    header('Location: ../admin.php');
    die;
}

$queryBilder = new QueryBilder();
$result = $queryBilder->editState($id, $state);

header('Location: ../admin.php');
die;

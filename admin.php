<?php
session_start();

require 'myFunc/myFunc.php';
require 'db/QueryBilder.php';

$queryBilder = new QueryBilder();
$comments = $queryBilder->getComments();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Comments</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <?php require 'main_nav.php'; ?>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"><h3>Админ панель</h3></div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Аватар</th>
                                            <th>Имя</th>
                                            <th>Дата</th>
                                            <th>Комментарий</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($comments as $key => $item) : ?>
                                        <tr>
                                            <td>
                                                <img src="<?= $item['avatar'] ? $item['avatar'] : 'img/no-user.jpg'; ?>" alt="" class="img-fluid" width="64" height="64">
                                            </td>
                                            <td><?= $item['user_name']; ?></td>
                                            <td><?= $item['date']; ?></td>
                                            <td><?= $item['message']; ?></td>
                                            <td>
                                                <?= $item['state'] == false ? '<a href="components/com_edit_comment.php?id='.$item['id'].'&state=1" class="btn btn-success">Разрешить</a>' : ''; ?>
                                                <?= $item['state'] == true ? '<a href="components/com_edit_comment.php?id='.$item['id'].'&state=0" class="btn btn-warning">Запретить</a>' : ''; ?>
                                                <a href="components/com_edit_comment.php?id=<?= $item['id']; ?>&delete=1" onclick="return confirm('are you sure?')" class="btn btn-danger">Удалить</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

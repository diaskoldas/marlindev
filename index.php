<?php
session_start();

require 'db/QueryBilder.php';
require 'myFunc/myFunc.php';

$queryBilder = new QueryBilder;
$arrComments = $queryBilder->getComments(false);
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
                            <div class="card-header">
                                <h3>Комментарии</h3>
                            </div>
                            <div class="card-body">
                                <?php
                                if ($_SESSION['new_comment'] == true) : ?>
                                <div class="alert alert-success" role="alert">Комментарий успешно добавлен</div>
                                <?php endif; ?>
                                <?php foreach ($arrComments as $key => $item) : ?>
                                <div class="media">
                                    <img src="<?= $item['image'] != '' ? $item['image'] : 'img/no-user.jpg' ?>" class="mr-3" alt="..." width="64" height="64">
                                    <div class="media-body">
                                        <h5 class="mt-0"><?= $item['user_name']; ?></h5>
                                        <span><small><?= $item['date']; ?></small></span>
                                        <p><?= $item['message']; ?></p>
                                    </div>
                                </div>
                                <?php endforeach;  ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 20px;">
                        <?php if (empty($_SESSION['user_data'])) : ?>
                        <div class="alert alert-warning shadow" role="alert">
                            Что бы оставить комментарий, <a href="login.php">авторизуйтесь.</a>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($_SESSION['user_data'])) : ?>
                        <div class="card">
                            <div class="card-header"><h3>Оставить комментарий</h3></div>
                            <div class="card-body">
                                <form enctype="multipart/form-data" action="components/com_add_comment.php" method="post">
                                    <div class="form-group">
                                        <label>Сообщение</label>
                                        <?php
                                        $is_invalid = '';
                                        $message = '';
                                        $warning = $_SESSION['warning']['message'];
                                        $data = $warning['data'] ? $warning['data'] : '';
                                        if (!empty($warning['message']))
                                        {
                                            $is_invalid = 'is-invalid';
                                            $message = $warning['message'];
                                        }
                                        ?>
                                        <textarea name="message" class="form-control <?= $is_invalid; ?>"  value="<?= $data; ?>"></textarea>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?= $message; ?></strong>
                                        </span>
                                    </div>
                                    <button type="submit" class="btn btn-success">Отправить</button>
                                </form>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

<?php
unset($_SESSION['warning']);
unset($_SESSION['new_comment']);
?>

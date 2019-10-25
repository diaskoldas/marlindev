<?php
session_start();

require 'myFunc/myFunc.php';

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
        <?php require 'main_nav.php';?>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"><h3>Профиль пользователя</h3></div>
                            <div class="card-body">
                                <?php if (!empty($_SESSION['user_data']['edit_profile']) && $_SESSION['user_data']['edit_profile'] == true) : ?>
                                <div class="alert alert-success" role="alert">Профиль успешно обновлен</div>
                                <?php endif; ?>
                                <form action="components/com_edit_profile.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Имя</label>
                                                <?php
                                                $is_invalid = '';
                                                $warning = $_SESSION['warning']['name'];
                                                $data = $warning['data'] ? $warning['data'] : '';
                                                if (!empty($warning['message']))
                                                {
                                                    $is_invalid = 'is-invalid';
                                                    $message = $warning['message'];
                                                }
                                                ?>
                                                <input name="name" type="text" class="form-control <?= $is_invalid; ?>" value="<?= !empty($warning) ? $data : $_SESSION['user_data']['name']; ?>">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?= $message; ?></strong>
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <?php
                                                $is_invalid = '';
                                                $warning = $_SESSION['warning']['email'];
                                                $data = $warning['data'] ? $warning['data'] : '';
                                                if (!empty($warning['message']))
                                                {
                                                    $is_invalid = 'is-invalid';
                                                    $message = $warning['message'];
                                                }
                                                ?>
                                                <input name="email" type="email" class="form-control <?= $is_invalid; ?>" value="<?= !empty($warning) ? $data : $_SESSION['user_data']['email']; ?>">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?= $message; ?></strong>
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label>Аватар</label>
                                                <input name="image" type="file" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="<?= !empty($_SESSION['user_data']['image']) ? $_SESSION['user_data']['image'] : 'img/no-user.jpg'; ?>" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-warning">Редактировать профиль</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 20px;">
                        <div class="card">
                            <div class="card-header"><h3>Безопасность</h3></div>
                            <div class="card-body">
                                <?php if (!empty($_SESSION['new_password']) && $_SESSION['new_password'] == true) : ?>
                                <div class="alert alert-success" role="alert">Пароль успешно обновлен</div>
                                <?php endif; ?>
                                <form action="components/com_edit_password.php" method="post">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Старый пароль</label>
                                                <?php
                                                $is_invalid = '';
                                                $warning = $_SESSION['warning']['old_password'];
                                                $data = $warning['data'] ? $warning['data'] : '';
                                                if (!empty($warning['message']))
                                                {
                                                    $is_invalid = 'is-invalid';
                                                    $message = $warning['message'];
                                                }
                                                ?>
                                                <input name="old_password" type="password" class="form-control <?= $is_invalid; ?>" value="<?= $data; ?>">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?= $message; ?></strong>
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label>Новый пароль</label>
                                                <?php
                                                $is_invalid = '';
                                                $warning = $_SESSION['warning']['password'];
                                                $data = $warning['data'] ? $warning['data'] : '';
                                                if (!empty($warning['message']))
                                                {
                                                    $is_invalid = 'is-invalid';
                                                    $message = $warning['message'];
                                                }
                                                ?>
                                                <input name="password" type="password" class="form-control <?= $is_invalid; ?>" value="<?= $data; ?>">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?= $message; ?></strong>
                                                </span>
                                            </div>
                                            <div class="form-group">
                                                <label>Повторите новый пароль</label>
                                                <?php
                                                $is_invalid = '';
                                                $warning = $_SESSION['warning']['password_confirmation'];
                                                $data = $warning['data'] ? $warning['data'] : '';
                                                if (!empty($warning['message']))
                                                {
                                                    $is_invalid = 'is-invalid';
                                                    $message = $warning['message'];
                                                }
                                                ?>
                                                <input name="password_confirmation" type="password" class="form-control <?= $is_invalid; ?>" value="<?= $data; ?>">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?= $message; ?></strong>
                                                </span>
                                            </div>
                                            <button class="btn btn-success">Изменить</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
unset($_SESSION['user_data']['edit_profile']);
unset($_SESSION['new_password']);
?>

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
    <?php require 'main_nav.php'; ?>

    <?php if ($_SESSION['new_user'] == true) : ?>
        <div class="alert alert-success text-center" role="alert">Пользователь успешно добавлен</div>
    <?php endif; ?>

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Регистрация</div>
                        <div class="card-body">
                            <form method="POST" action="addUser.php">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Имя</label>
                                    <div class="col-md-6">
                                        <?php
                                        $invalid_class = '';
                                        $err_mess = '';
                                        $data = '';
                                        $form = $_SESSION['add_user_form']['name'];
                                        if (!empty($form))
                                        {
                                            if ($form['is_valid'] == false)
                                            {
                                                $invalid_class = 'is-invalid';
                                                $data = $form['data'];
                                                $err_mess = $form['message'];
                                            }
                                            if ($form['is_valid'] == true)
                                            {
                                                $data = $form['data'];
                                            }
                                        }
                                        ?>
                                        <input name="name" type="text" class="form-control <?= $invalid_class; ?>"  value="<?= $data; ?>">
                                        <span class="invalid-feedback" role="alert">
                                                <strong><?= $err_mess; ?></strong>
                                            </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">E-Mail почта</label>
                                    <div class="col-md-6">
                                        <?php
                                        $invalid_class = '';
                                        $err_mess = '';
                                        $data = '';
                                        $form = $_SESSION['add_user_form']['email'];
                                        if (!empty($form))
                                        {
                                            if ($form['is_valid'] == false)
                                            {
                                                $invalid_class = 'is-invalid';
                                                $data = $form['data'];
                                                $err_mess = $form['message'];
                                            }
                                            if ($form['is_valid'] == true)
                                            {
                                                $data = $form['data'];
                                            }
                                        }
                                        ?>
                                        <input name="email" type="email" class="form-control <?= $invalid_class; ?>"  value="<?= $data; ?>" autocomplete="email">
                                        <span class="invalid-feedback" role="alert">
                                                <strong><?= $err_mess; ?></strong>
                                            </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Пароль</label>
                                    <div class="col-md-6">
                                        <?php
                                        $invalid_class = '';
                                        $err_mess = '';
                                        $data = '';
                                        $form = $_SESSION['add_user_form']['password'];
                                        if (!empty($form))
                                        {
                                            if ($form['is_valid'] == false)
                                            {
                                                $invalid_class = 'is-invalid';
                                                $err_mess = $form['message'];
                                            }
                                            if ($form['is_valid'] == true)
                                            {
                                                $data = $form['data'];
                                            }
                                        }
                                        ?>
                                        <input name="password" type="password" class="form-control <?= $invalid_class; ?>"  autocomplete="new-password">
                                        <span class="invalid-feedback" role="alert">
                                                <strong><?= $err_mess; ?></strong>
                                            </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Повторите пароль</label>
                                    <div class="col-md-6">
                                        <input name="password_confirmation" type="password" class="form-control <?= $invalid_class; ?>" autocomplete="new-password">
                                        <span class="invalid-feedback" role="alert">
                                                <strong><?= $err_mess; ?></strong>
                                            </span>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Регистрация
                                        </button>
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
</body>
</html>

<?php
unset($_SESSION['add_user_form']);
unset($_SESSION['new_user']);
?>

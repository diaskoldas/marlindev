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
                            <form method="POST" action="components/com_add_user.php">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Имя</label>
                                    <div class="col-md-6">
                                        <?php
                                        $is_invalid = '';
                                        $message = '';
                                        $warning = $_SESSION['warning']['name'];
                                        $data = $warning['data'] ? $warning['data'] : '';
                                        if (!empty($warning['message']))
                                        {
                                            $is_invalid = 'is-invalid';
                                            $message = $warning['message'];
                                        }
                                        ?>
                                        <input name="name" type="text" class="form-control <?= $is_invalid; ?>"  value="<?= $data; ?>">
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?= $message; ?></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">E-Mail почта</label>
                                    <div class="col-md-6">
                                        <?php
                                        $is_invalid = '';
                                        $message = '';
                                        $warning = $_SESSION['warning']['email'];
                                        $data = $warning['data'] ? $warning['data'] : '';
                                        if (!empty($warning['message']))
                                        {
                                            $is_invalid = 'is-invalid';
                                            $message = $warning['message'];
                                        }
                                        ?>
                                        <input name="email" type="email" class="form-control <?= $is_invalid; ?>"  value="<?= $data; ?>">
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?= $message; ?></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Пароль</label>
                                    <div class="col-md-6">
                                        <?php
                                        $is_invalid = '';
                                        $message = '';
                                        $warning = $_SESSION['warning']['password'];
                                        $data = $warning['data'] ? $warning['data'] : '';
                                        if (!empty($warning['message']))
                                        {
                                            $is_invalid = 'is-invalid';
                                            $message = $warning['message'];
                                        }
                                        ?>
                                        <input name="password" type="password" class="form-control <?= $is_invalid; ?>"  value="<?= $data; ?>">
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?= $message; ?></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right">Повторите пароль</label>
                                    <div class="col-md-6">
                                        <?php
                                        $is_invalid = '';
                                        $message = '';
                                        $warning = $_SESSION['warning']['password_confirmation'];
                                        $data = $warning['data'] ? $warning['data'] : '';
                                        if (!empty($warning['message']))
                                        {
                                            $is_invalid = 'is-invalid';
                                            $message = $warning['message'];
                                        }
                                        ?>
                                        <input name="password_confirmation" type="password" class="form-control <?= $is_invalid; ?>"  value="<?= $data; ?>">
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?= $message; ?></strong>
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
unset($_SESSION['warning']);
unset($_SESSION['new_user']);
?>

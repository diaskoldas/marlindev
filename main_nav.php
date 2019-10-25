<?php
session_start();
?>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="https://www.pinclipart.com/picdir/big/196-1967315_android-jetpack-for-developers-android-jetpack-logo-clipart.png" width="30" height="30" class="d-inline-block align-top mr-2" alt="">
            My-Spase
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <?php if (empty($_SESSION['user_data'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">
                            <img class="mr-1" src="https://img.icons8.com/windows/25/000000/import.png" alt="">
<!--                            <img class="mr-1" src="https://img.icons8.com/windows/25/000000/password.png" alt="">-->
                            Войти
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">
                            <img class="mr-1" src="https://img.icons8.com/windows/25/000000/pencil.png" alt="">
                            Регистрация
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (!empty($_SESSION['user_data'])) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-success" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="mr-1" src="https://img.icons8.com/windows/25/000000/user-male-circle.png" alt="">
                            <?= $_SESSION['user_data']['name']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="profile.php">
                                <img class="mr-1" src="https://img.icons8.com/windows/25/000000/user-male-circle.png" alt="">
                                Профиль
                            </a>
                            <a class="dropdown-item" href="admin.php">
                                <img class="mr-1" src="https://img.icons8.com/windows/25/000000/settings.png" alt="">
                                Администратор
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="user_logout.php?logout=true">
                                <img class="mr-1" src="https://img.icons8.com/windows/25/000000/exit.png" alt="">
                                Выйти
                            </a>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

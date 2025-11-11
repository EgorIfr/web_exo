<?php
include 'db.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE login = '$login'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($password == $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['login'] = $user['login'];
            header('Location: index.php');
            exit();
        } else {
            $error = 'Неверный пароль';
        }
    } else {
        $error = 'Пользователь не найден';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Вход</title>
</head>
<body class="register">
<header class="header">
    <img src="./assets/logo-name.svg" alt="logo" class="logo" />
    <nav class="navigation">
        <ul class="list_navigation">
            <li class="item_navigation">
                <a href="index.php" class="link_navigation">Главная</a>
            </li>
            <li class="item_navigation">
                <a href="request.php" class="link_navigation">Создать заявку</a>
            </li>
            <li class="item_navigation">
                <a href="list.php" class="link_navigation">Список заявок</a>
            </li>
        </ul>
    </nav>
    <div class="form__auth">
        <span class="form__auth_login"><a href="login.php" class="form__auth_login">Вход</a></span>
        <span class="form__auth_register"
        ><a href="register.php"
            >Регистрация</a
            ></span
        >
    </div>
</header>

<main class="main">
    <div class="card card-xl">
        <h2>Вход</h2>
        <form action="" method="post" class="form__login">
            <div class="form__block">
                <label for="">
                    <span class="form-text">Логин</span>
                    <input name="login" type="text" placeholder="Введите логин" required class="form__input">
                </label>
            </div>
            <div class="form__block">
                <label for="">
                    <span class="form-text">Пароль</span>
                    <input name="password" type="password" placeholder="Введите пароль" required class="form__input">
                </label>
            </div>
            <button type="submit" class="btn-register">Войти</button>
        </form>
        <!-- Добавлены блоки для вывода сообщений -->
        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if (!empty($message)): ?>
            <p style="color: green;"><?php echo $message; ?></p>
        <?php endif; ?>
    </div>
</main>
</body>
</html>

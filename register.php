<?php
include 'db.php';

$error = '';
$message = '';

// Добавляем проверку на конкретную отправку формы регистрации
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $fullname = trim($_POST['fullname']);
    $phone = trim($_POST['phone']);
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Проверка существования пользователя
    $sql = "SELECT id FROM users WHERE login='$login' OR email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $error = 'Пользователь с таким логином или email уже существует!';
    } else {
        // Регистрация нового пользователя
        $sql = "INSERT INTO users (fullname, login, phone, email, password) 
                VALUES ('$fullname', '$login', '$phone', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            $message = 'Регистрация успешна!';
        } else {
            $error = 'Ошибка: ' . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Регистрация</title>
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
                <a href="index.php" class="link_navigation">Создать заявку</a>
            </li>
            <li class="item_navigation">
                <a href="index.php" class="link_navigation">Список заявок</a>
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
        <h2>Регистрация</h2>

        <form action="" method="post" class="form__register">
            <div class="form__block">
                <label for="">
                    <span class="form-text">ФИО</span>
                    <input name="fullname" type="text" placeholder="Введите ФИО" required class="form__input">
                </label>
            </div>
            <div class="form__block">
                <label for="">
                    <span class="form-text">Логин</span>
                    <input name="login" type="text" placeholder="Введите логин" required class="form__input">
                </label>
            </div>
            <div class="form__block">
                <label for="">
                    <span class="form-text">Почта</span>
                    <input name="email" type="email" placeholder="Введите почту" required class="form__input">
                </label>
            </div>
            <div class="form__block">
                <label for="">
                    <span class="form-text">Номер телефона</span>
                    <input name="phone" type="tel" placeholder="Введите телефон" required class="form__input">
                </label>
            </div>
            <div class="form__block">
                <label for="">
                    <span class="form-text">Пароль</span>
                    <input name="password" type="password" placeholder="Введите пароль" required class="form__input">
                </label>
            </div>
            <button type="submit" class="btn-register" name="register">Зарегистрироваться</button>
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
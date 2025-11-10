<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Главная</title>
</head>
<body>
<header class="header">
    <img src="./assets/logo-name.svg" alt="logo" class="logo">
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
        <span>Добро пожаловать, <?php echo $_SESSION['user_login']; ?>!</span>
        <a href="logout.php">Выйти</a>
    </div>
</header>

<main class="main">
    <h1>Добро пожаловать в систему!</h1>
    <!-- Ваш основной контент здесь -->
</main>
</body>
</html>
<?php
require "db.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_SESSION["user_id"];

    $sql = "INSERT INTO requests (title, description, user_id) 
                VALUES ('$title', '$description', '$user_id')";

    if ($conn->query($sql) === TRUE) {
        $message = 'Заявка успешно добавлена!';
    } else {
        $error = 'Ошибка: ' . $conn->error;
    }
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body class="request">

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
                <a href="list.php" class="link_navigation">Список заявок</a>
            </li>
        </ul>
    </nav>
    <div class="form__auth">
        <span>Добро пожаловать, <?php echo $_SESSION['login']; ?>!</span>
        <a href="logout.php">Выйти</a>
    </div>
</header>

<main class="main">
    <div class="card card-xl">
    <h2>Добавить заявку</h2>

    <?php if (!empty($message)): ?>

    <div class="message <?php echo strpos($message, 'успешно') !== false ? 'success-message' : 'error-message' ?>">
        <?php echo $message ?>
    </div>

    <?php endif; ?>

    <form action="" method="post">
        <div class="form__group">
            <label for="" class="form__group_label">Название заявки:</label>
            <input type="text" name="title" required class="form__group_input">
        </div>

        <div class="form__group">
            <label for="" class="form__group_label">Описание:</label>
            <textarea rows="5" name="description" required class="form__group_textarea"></textarea>
        </div>

        <button type="submit" class="btn-request">Добавить заявку</button>

    </form>
    </div>
</main>

</body>
</html>
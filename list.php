<?php
    include 'db.php';
    session_start();

    if (!isset($_SESSION['user_id'])){
        header('Location: login.php');
        exit();
    }

    // Получаем заявки
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM requests WHERE user_id = $user_id ORDER BY created_at DESC";

    // Результат
    $result = $conn->query($sql);
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
<body class="list">
<header class="header">
    <img src="./assets/logo-name.svg" alt="logo" class="logo">
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
        <span>Добро пожаловать, <?php echo $_SESSION['login']; ?>!</span>
        <a href="logout.php">Выйти</a>
    </div>
</header>

<main class="main">
    <div class="card card-xl">
    <h2>Мои заявки</h2>

    <?php if ($result -> num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Статус</th>
                    <th>Дата создания</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result -> fetch_assoc()): ?>

                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo htmlspecialchars($row['title']) ?></td>
                    <td><?php echo htmlspecialchars($row['description']) ?></td>
                    <td class="status-<?php echo $row['status']; ?>">
                        <?php
                        $statuses = [
                            'добавлен' => 'Добавлен',
                            'отклонен' => 'Отклонен',
                            'ожидание' => 'Ожидание'
                        ];
                        echo $statuses [$row['status']];
                        ?>
                    </td>
                    <td><?php echo date('d.m.Y H:i', strtotime($row['created_at'])); ?></td>
                    <?php endwhile; ?>
                </tr>
            </tbody>
        </table>

    <?php else: ?>
        <p>У вас пока нету заявок.</p>
    <?php endif; ?>
    </div>
</main>
</body>
</html>
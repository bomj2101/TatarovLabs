<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root"; // По умолчанию для XAMPP
$password = ""; // По умолчанию для XAMPP
$dbname = "hotel_management";

// Создаем соединение
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Проверяем соединение
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Устанавливаем кодировку
mysqli_set_charset($conn, "utf8mb4");

// SQL-запрос для получения всех номеров (предполагается, что есть таблица rooms)
$sql = "SELECT * FROM rooms"; // Замените на актуальную таблицу
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Список Номеров Гостиницы</title>
</head>
<body>

<header>
    <h1 class="text-center">Список Номеров Гостиницы</h1>
</header>

<main class="container mt-4">
    <form method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="room_number" class="form-control" placeholder="Номер комнаты">
            </div>
            <div class="col-md-4">
                <input type="text" name="guest_name" class="form-control" placeholder="Имя гостя">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Фильтровать</button>
            </div>
        </div>
    </form>

    <div class="row">
        <?php
        if (mysqli_num_rows($result) > 0) {
            // Выводим данные каждого номера в карточке
            while ($row = mysqli_fetch_array($result)) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">Комната ' . $row['room_id'] . '</h5>';
                echo '<p class="card-text">Описание: ' . $row['description'] . '</p>'; // Предполагается наличие поля description
                echo '<p class="card-text">Цена: ' . $row['price_per_night'] . ' руб.</p>'; // Предполагается наличие поля price
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>Нет доступных номеров.</p>';
        }

        // Закрываем соединение
        mysqli_close($conn);
        ?>
    </div>
</main>

<footer class="text-center mt-4">
    <p>&copy; 2025 Гостиница</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
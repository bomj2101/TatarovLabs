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

// Инициализация переменных для фильтрации
$room_number = isset($_GET['room_number']) ? trim($_GET['room_number']) : '';
$guest_id = isset($_GET['guest_id']) ? trim($_GET['guest_id']) : '';

// Сообщение об ошибках
$error_message = '';
$has_filter = !empty($room_number) || !empty($guest_id);

if ($has_filter) {
    // Проверяем корректность введенных значений
    if (!empty($room_number) && !is_numeric($room_number)) {
        $error_message .= "Номер комнаты должен быть числом.<br>";
    }
    if (!empty($guest_id) && !is_numeric($guest_id)) {
        $error_message .= "ID гостя должен быть числом.<br>";
    }
}

if (empty($error_message)) {
    // SQL-запрос для получения всех номеров с учетом фильтров
    $sql = "SELECT rooms.*, guests.name AS guest_name FROM rooms 
            LEFT JOIN bookings ON rooms.room_id = bookings.room_id 
            LEFT JOIN guests ON bookings.guest_id = guests.guest_id 
            WHERE 1=1"; // Начинаем с условия, которое всегда истинно

    if (!empty($room_number)) {
        $sql .= " AND rooms.room_id = '" . mysqli_real_escape_string($conn, $room_number) . "'"; // Фильтрация по номеру комнаты
    }

    if (!empty($guest_id)) {
        $sql .= " AND guests.guest_id = '" . mysqli_real_escape_string($conn, $guest_id) . "'"; // Фильтрация по ID гостя
    }

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        $error_message .= "Нет доступных номеров по заданным критериям.<br>";
    }
} else {
    $result = null; // Сбрасываем результат, если есть ошибка
}

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
                <input type="text" name="room_number" value="<?php echo htmlspecialchars($room_number); ?>" class="form-control" placeholder="Номер комнаты">
            </div>
            <div class="col-md-4">
                <input type="text" name="guest_id" value="<?php echo htmlspecialchars($guest_id); ?>" class="form-control" placeholder="ID гостя">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Фильтровать</button>
            </div>
        </div>
    </form>

    <div class="row">
        <?php
        if (!empty($error_message)) {
            echo '<div class="alert alert-danger">' . $error_message . '</div>';
        } elseif ($result && mysqli_num_rows($result) > 0) {
            // Выводим данные каждого номера в карточке
            while ($row = mysqli_fetch_array($result)) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">Комната ' . htmlspecialchars($row['room_id']) . '</h5>';
                echo '<p class="card-text">Гость: ' . htmlspecialchars($row['guest_name']) . '</p>'; // Имя гостя
echo '<p class="card-text">Описание: ' . htmlspecialchars($row['description']) . '</p>'; // Предполагается наличие поля description
                echo '<p class="card-text">Цена: ' . htmlspecialchars($row['price_per_night']) . ' руб.</p>'; // Предполагается наличие поля price
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
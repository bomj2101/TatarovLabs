<?php
session_start();

// Функция для валидации пароля
function passwordValidation($password) {
    // Проверка на длину и наличие всех необходимых символов
    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*d)(?=.*[!@#$%^&*(),.?":{}|<> _-])[A-Za-zd!@#$%^&*(),.?":{}|<> _-]{7,}$/';
    return preg_match($regex, $password);
}

// Временные данные для демонстрации (в реальном приложении используйте базу данных)
$users = [
    'test@example.com' => password_hash('Password123!', PASSWORD_DEFAULT) // Пример пользователя
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['registerSubmit'])) {
        // Регистрация
        $email = $_POST['registerEmail'];
        $fullName = $_POST['fullName'];
        $dob = $_POST['dob'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $interests = $_POST['interests'];
        $vkProfile = $_POST['vkProfile'];
        $bloodType = $_POST['bloodType'];
        $rhFactor = $_POST['rhFactor'];
        $password = $_POST['registerPassword'];

        // Проверка пароля
        if (!passwordValidation($password)) {
            $_SESSION['error_message'] = 'Пароль должен содержать минимум 7 символов, включая заглавные и строчные буквы, цифры, специальные символы, пробел, дефис, подчеркивание и не содержать русских букв.';
            header('Location: index.php');
            exit();
        }

        // Сохранение данных в куки (в реальном приложении используйте более безопасный подход)
        setcookie('user', json_encode([
            'email' => $email,
            'fullName' => $fullName,
            'dob' => $dob,
            'address' => $address,
            'gender' => $gender,
            'interests' => $interests,
            'vkProfile' => $vkProfile,
            'bloodType' => $bloodType,
            'rhFactor' => $rhFactor
        ]), time() + (86400 * 30), "/"); // 30 дней
        
        echo "Регистрация прошла успешно!";
    }

    if (isset($_POST['loginSubmit'])) {
        // Авторизация
        $email = $_POST['loginEmail'];
        $password = $_POST['loginPassword'];

        // Проверка существования пользователя и пароля
        if (array_key_exists($email, $users) && password_verify($password, $users[$email])) {
            echo "Вы успешно вошли!";
            // Здесь можно установить сессию или куки для авторизованного пользователя
            $_SESSION['user_email'] = $email; // Сохранение email в сессии
            header('Location: index.html'); // Переход на страницу после успешного входа
            exit();
        } else {
            echo "Неверные учетные данные.";
        }
    }
}
?>

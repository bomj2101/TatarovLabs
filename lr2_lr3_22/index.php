<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Авторизация / Регистрация</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <header class="bg-light py-3 border-bottom">
    <div class="container">
      <h1 class="text-center">Авторизация / Регистрация</h1>
    </div>
  </header>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <ul class="nav nav-tabs" id="authTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">Вход</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">Регистрация</button>
          </li>
        </ul>

        <div class="tab-content p-4 border border-top-0" id="authTabsContent">
          <!-- Login Tab -->
          <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
            <form action="process.php" method="POST">
              <div class="mb-3">
                <label for="loginEmail" class="form-label">Email</label>
                <input type="email" class="form-control" name="loginEmail" required>
              </div>
              <div class="mb-3">
                <label for="loginPassword" class="form-label">Пароль</label>
                <input type="password" class="form-control" name="loginPassword" required>
              </div>
              <button type="submit" name="loginSubmit" class="btn btn-primary">Войти</button>
            </form>
          </div>

          <!-- Register Tab -->
          <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
            <form action="process.php" method="POST">
              <div class="mb-3">
                <label for="registerEmail" class="form-label">Email</label>
                <input type="email" class="form-control" name="registerEmail" required>
              </div>
              <div class="mb-3">
                <label for="fullName" class="form-label">ФИО</label>
                <input type="text" class="form-control" name="fullName" required>
              </div>
              <div class="mb-3">
                <label for="dob" class="form-label">Дата рождения</label>
                <input type="date" class="form-control" name="dob" required>
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Адрес</label>
                <input type="text" class="form-control" name="address" required>
              </div>
              <div class="mb-3">
                <label for="gender" class="form-label">Пол</label>
                <select class="form-select" name="gender" required>
                  <option value="">Выберите пол</option>
                  <option value="male">Мужской</option>
                  <option value="female">Женский</option>
                  <option value="other">Другой</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="interests" class="form-label">Интересы</label>
                <textarea class="form-control" name="interests"></textarea>
              </div>
              <div class="mb-3">
                <label for="vkProfile" class="form-label">Ссылка на профиль ВК</label>
                <input type="url" class="form-control" name="vkProfile">
              </div>
              <div class="mb-3">
                <label for="bloodType" class="form-label">Группа крови</label>
                <input type="text" class="form-control" name="bloodType">
              </div>
              <div class="mb-3">
                <label for="rhFactor" class="form-label">Резус-фактор</label>
                <select class="form-select" name="rhFactor">
                  <option value="">Выберите резус-фактор</option>
                  <option value="+">+</option>
                  <option value="-">-</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="registerPassword" class="form-label">Пароль</label>
                <input type="password" class="form-control" name="registerPassword" required>
                <?php if (isset($_SESSION['error_message'])): ?>
                  <div class='text-danger'><?= $_SESSION['error_message'] ?></div>
                  <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>
              </div>
              <button type="submit" name="registerSubmit" class="btn btn-primary">Зарегистрироваться</button>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>



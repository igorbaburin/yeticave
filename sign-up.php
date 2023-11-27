<?php
require_once('function.php');
require_once('data.php');
require_once('userdata.php');
require_once('basic.php');

$user_avatar = 'img/user.jpg';

$result = [
    'email' => '',
    'password' => '',
    'name' => '',
];

$email = $_POST["email"];
$password = $_POST["password"];
$name = $_POST["name"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Массив для хранения ошибок
    $errors = [];

    if (empty($email)) {
        $errors["email"] = "Это поле обязательно для заполнения:";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Введите электронную почту вида: example@mail.com";
    }

    if (empty($password)) {
        $errors["password"] = "Это поле обязательно для заполнения:";
    } elseif (strlen($password) < 5) {
        $errors["password"] = "В пароле должно быть более 5 символов:";
    }

    if (empty($name)) {
        $errors["name"] = "Это поле обязательно для заполнения:";
    } elseif (strlen($name) < 2) {
        $errors["name"] = "В имени должно быть более 1 символа:";
    }

    // Сохраняем введеные поля, в случае ошибки
    if (!empty($errors)) {
        $result['email'] = $_POST['email'] ?? '';
        $result['name'] = $_POST['name'] ?? '';
    } else {
        // Передаем данные в БД
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Хэшируем пароль
        $sqlAddUser = "INSERT INTO users (id, user_email, user_name, user_password) VALUES (null, ?, ?, ?)";

        // Используем подготовленный запрос
        $stmt = mysqli_prepare($con, $sqlAddUser);

        // Передаем параметры и выполняем запрос
        mysqli_stmt_bind_param($stmt, "sss", $email, $name, $hashed_password);
        $addData = mysqli_stmt_execute($stmt);

        // Закрываем подготовленный запрос
        mysqli_stmt_close($stmt);

        header('Location: /index.php');
    }
}

$content = getTemplate('sign-up.php', ['result' => $result, 'errors' => $errors]);
$page = getTemplate(
    'layout.php',
    [
        'title' => 'Регистрация',
        'user_avatar' => $user_avatar,
        'content' => $content,
        'categories' => $categories,
    ]
);

print($page);

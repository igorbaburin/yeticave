<?php
require_once('function.php');
require_once('data.php');
require_once('userdata.php');
require_once ('basic.php');

$user_avatar = 'img/user.jpg';

$result = [
    'email' => '',
    'password' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Массив для хранения ошибок
    $errors = [];

    if (empty($_POST["email"])) {
        $errors["email"] = "Введите почту для входа";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Введите электронную почту вида: example@mail.com";
    }

    if (!count($errors) and $user = searchUserByEmail($_POST['email'], $users)) {
        if (password_verify($_POST['password'], $user['user_password'])) {
            $_SESSION['user'] = $user;
        } else {
            $errors['password'] = "Неправильный пароль!";
        }
    } else {
        $errors['email'] = "Пользователь не найден.";
    }

    // Сохраняем введеные поля, в случае ошибки
    if (!empty($errors)) {
        $result['email'] = $_POST['email'] ?? '';
        $result['password'] = $_POST['password'] ?? '';
    } else {
        header("Location: /index.php");
        exit();
    }
}

$content = getTemplate('login.php', ['result' => $result, 'errors' => $errors]);
$page = getTemplate(
    'layout.php',
    [
        'title' => 'Войти',
        'user_avatar' => $user_avatar,
        'content' => $content,
        'categories' => $categories,
    ]
);

print($page);

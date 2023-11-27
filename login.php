<?php
require_once('function.php');
require_once('data.php');
require_once('userdata.php');
require_once('basic.php');

$user_avatar = 'img/user.jpg';

$result = [
    'email' => '',
    'password' => '',
];

$entered_email = mysqli_real_escape_string($con, $_POST['email']);
$entered_password = $_POST["password"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Массив для хранения ошибок
    $errors = [];

    if (empty($entered_email)) {
        $errors["email"] = "Введите почту для входа";
    } elseif (!filter_var($entered_email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Введите электронную почту вида: example@mail.com";
    }

    $sqlGetUser = "SELECT * FROM users WHERE user_email = '$entered_email'";
    $sqlResult = mysqli_query($con, $sqlGetUser);

    if (!count($errors) and $sqlResult == true) {
        $user = mysqli_fetch_assoc($sqlResult);

        if ($user) {
            $hashed_password = $user['user_password'];

            if (password_verify($entered_password, $hashed_password)) {
                $_SESSION['user'] = $user;
            } else {
                $errors['password'] = "Неправильный пароль!";
            }
        } else {
            $errors['email'] = "Пользователь не найден.";
        }
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
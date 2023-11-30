<?php
require_once('basic.php');
require_once('function.php');
require_once('data.php');
require_once ('basic.php');

$user_avatar = 'img/user.jpg';

$result = [
    'lot-name' => '',
    'category' => '',
    'lot-message' => '',
    'lot-rate' => '',
    'lot-step' => '',
    'lot-date' => ''
];

$lot_name = $_POST["lot-name"];
$category = $_POST["category"];
$lot_message = $_POST["lot-message"];
$lot_rate = $_POST["lot-rate"];
$lot_step = $_POST["lot-step"];
$lot_date = $_POST["lot-date"];
$lot_image = $_POST["lot-image"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Массив для хранения ошибок
    $errors = [];

    if (empty($lot_name)) {
        $errors["lot-name"] = "Введите наименование лота";
    } elseif (strlen($lot_name) <= 3 || !preg_match("/^[a-zA-Zа-яА-Я\s]+$/u", $lot_name)) {
        $errors["lot-name"] = "Имя лота не может содержать цифры и должно быть не менее трех символов";
    }

    if (empty($category)) {
        $errors["category"] = "Выберите категорию";
    }

    if (empty($lot_message)) {
        $errors["lot-message"] = "Введите описание лота";
    }

    if (empty($lot_rate)) {
        $errors["lot-rate"] = "Введите начальную цену";
    } elseif (!ctype_digit($lot_rate)) {
        $errors["lot-rate"] = "Начальная цена должна быть целым числом";
    }

    if (empty($lot_step)) {
        $errors["lot-step"] = "Введите шаг ставки";
    } elseif (!ctype_digit($lot_step)) {
        $errors["lot-step"] = "Шаг ставки должен быть целым числом";
    }

    if (empty($lot_date)) {
        $errors["lot-date"] = "Введите дату завершения торгов";
    } else {
        $today = date("Y-m-d");
        if ($_POST["lot-date"] < $today) {
            $errors["lot-date"] = "Выберите дату, которая еще не прошла";
        }
    }

    // Валидация изображения
    if (!empty($_FILES['lot-image']['name'])) {
        $allowedFormats = ['jpg', 'jpeg', 'png'];
        $fileExtension = strtolower(pathinfo($_FILES['lot-image']['name'], PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedFormats)) {
            $errors['lot-image'] = 'Разрешены только изображения в формате .jpg, .jpeg, .png';
        } else {
            
            $uploadDirectory = 'upload/user_lots/';

            // Генерация уникального имени для избежания конфликтов
            $uploadedFileName = uniqid('user_lot_') . '.' . $fileExtension;

            $uploadFilePath = $uploadDirectory . $uploadedFileName;

            // Сохранение файла в папку загрузки
            move_uploaded_file($_FILES['lot-image']['tmp_name'], $uploadFilePath);

            // Сохранение пути к файлу в отдельной переменной
            $uploadedFilePath = $uploadFilePath;

            // Сохранение пути к файлу в массив результатов
            $result['lot-image'] = $uploadedFilePath;
        }
    }


    // Если есть ошибки, выводим их
    if (!empty($errors)) {
        $errors['form-invalid'] = true;
    } else {
        // Если ошибок нет, продолжаем обработку данных
        $sqlAddLot= "INSERT INTO goods (id, lot_name, create_date, final_date, category, category_code, lot_rate, lot_step, lot_image, lot_message) VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Используем подготовленный запрос
        $stmt = mysqli_prepare($con, $sqlAddLot);
        $catcode = rand(1,5);
        // Передаем параметры и выполняем запрос
        mysqli_stmt_bind_param($stmt, "sssssssss", $lot_name, date('Y-m-d H:i:s'), $lot_date, $category, $catcode, $lot_rate, $lot_step, $uploadedFilePath, $lot_message);
        $addData = mysqli_stmt_execute($stmt);

        // Закрываем подготовленный запрос
        mysqli_stmt_close($stmt);

        header('Location: /index.php');
    }

    // Сохраняем введеные поля, в случае ошибки
    if (!empty($errors)) {
        $result['lot-name'] = $_POST['lot-name'] ?? '';
        $result['category'] = $_POST['category'] ?? '';
        $result['lot-message'] = $_POST['lot-message'] ?? '';
        $result['lot-rate'] = $_POST['lot-rate'] ?? '';
        $result['lot-step'] = $_POST['lot-step'] ?? '';
        $result['lot-date'] = $_POST['lot-date'] ?? '';
        $result['lot-image'] = $_POST['lot-image'] ?? '';
    }
}


$content = getTemplate('add.php', ['goods' => $lot, 'timeLeft' => $timeLeft, 'categories' => $categories, 'result' => $result, 'errors' => $errors],);
$page = getTemplate(
    'layout.php',
    [
        'title' => 'Добавить лот',
        'user_avatar' => $user_avatar,
        'content' => $content,
        'categories' => $categories,
    ]
);

print($page);

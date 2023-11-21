<?php
require_once('basic.php');
require_once('function.php');
require_once('data.php');
require_once ('basic.php');

$user_avatar = 'img/user.jpg';

$result = [
    'lot-name' => '',
    'category' => '',
    'message' => '',
    'lot-rate' => '',
    'lot-step' => '',
    'lot-date' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Массив для хранения ошибок
    $errors = [];

    if (empty($_POST["lot-name"])) {
        $errors["lot-name"] = "Введите наименование лота";
    } elseif (strlen($_POST["lot-name"]) <= 3 || !preg_match("/^[a-zA-Zа-яА-Я\s]+$/u", $_POST["lot-name"])) {
        $errors["lot-name"] = "Имя лота не может содержать цифры и должно быть не менее трех символов";
    }

    if (empty($_POST["category"])) {
        $errors["category"] = "Выберите категорию";
    }

    if (empty($_POST["message"])) {
        $errors["message"] = "Введите описание лота";
    }

    if (empty($_POST["lot-rate"])) {
        $errors["lot-rate"] = "Введите начальную цену";
    } elseif (!ctype_digit($_POST["lot-rate"])) {
        $errors["lot-rate"] = "Начальная цена должна быть целым числом";
    }

    if (empty($_POST["lot-step"])) {
        $errors["lot-step"] = "Введите шаг ставки";
    } elseif (!ctype_digit($_POST["lot-step"])) {
        $errors["lot-step"] = "Шаг ставки должен быть целым числом";
    }

    if (empty($_POST["lot-date"])) {
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

            // Сохранение пути к файлу в массив результатов
            $result['lot-image'] = $uploadFilePath;
        }
    }


    // Если есть ошибки, выводим их
    if (!empty($errors)) {
        $errors['form-invalid'] = true;
    } else {
        // Если ошибок нет, продолжаем обработку данных
        echo "Данные успешно отправлены!";
    }

    // Сохраняем введеные поля, в случае ошибки
    if (!empty($errors)) {
        $result['lot-name'] = $_POST['lot-name'] ?? '';
        $result['category'] = $_POST['category'] ?? '';
        $result['message'] = $_POST['message'] ?? '';
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

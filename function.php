<?php

// Шаблонизатор

function getTemplate(string $template, array $data)
{
    $pathTemplate = __DIR__ . '../templates/' . $template;
    if (empty($template || !file_exists($pathTemplate))) {
        return '';
    }

    extract($data, EXTR_OVERWRITE);

    ob_start();
    include $pathTemplate;

    return ob_get_clean();
}

// Вывод таймера для товаров

function timeUntilMidnight()
{

    // Получаем текущую дату и время
    $currentTime = time();

    // Получаем дату и время полуночи
    $midnight = strtotime('tomorrow');

    $timeUntilMidnight = $midnight - $currentTime;

    // Разбиваем разницу на часы и минуты
    $hours = floor($timeUntilMidnight / 3600);
    $minutes = floor(($timeUntilMidnight % 3600) / 60);

    // Форматируем вывод в виде "ЧЧ:MM"
    $formattedTime = sprintf("%02d:%02d", $hours, $minutes);

    return $formattedTime;
}

$timeLeft = timeUntilMidnight();

// Проверяет email среди users

function searchUserByEmail($email, $users) {
    $result = null;
    foreach($users as $user) {
        if($user['email'] == $email) {
            $result = $user;
            break;
        }
    }
    return $result;
}
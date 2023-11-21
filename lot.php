<?php
require_once('function.php');
require_once('data.php');
require_once ('basic.php');

$user_avatar = 'img/user.jpg';


// передан ли параметр lot_id через GET запрос
if (isset($_GET['lot_id'])) {
  // получаем идентификатор лота из GET запроса
  $lotId = $_GET['lot_id'];

  // проверяем, существует ли лот с таким идентификатором в массиве
  if (isset($goods[$lotId])) {
    // получаем информацию о лоте
    $lot = $goods[$lotId];
    // $lot содержит информацию о выбранном лоте

  } else {
    // если лот не найден, редиректим на 404
    header("HTTP/1.0 404 Not Found");
    echo "Page not found";
    exit();
  }
} else {

  echo "Идентификатор лота не передан в параметрах.";
}


// инициализация массива данных или загрузка из существующего cookie
if (isset($_COOKIE['viewed'])) {
  $history = json_decode($_COOKIE['viewed'], true);
} else {
  $history = [];
}
// можно сократить с помощью тернарных операторов >> $history = isset($_COOKIE['viewed']) ? json_decode($_COOKIE['viewed'], true) : [];  >> пора практиковать

// получение значения get параметра
if (isset($_GET['lot_id'])) {
  $lotId = $_GET['lot_id'];
} else {
  $lotId = null;
}

// проверка на уникальность и добавление в массив
if ($lotId !== null && !in_array($lotId, $history)) {
  $history[] = $lotId;
}

// передаем cookie
setcookie('viewed', json_encode($history), time() + (3600 * 24 * 30), '/');

$content = getTemplate('lot.php', ['goods' => $lot, 'timeLeft' => $timeLeft],);
$page = getTemplate(
  'layout.php',
  [
    'title' => $lot['lot-name'],
    'user_avatar' => $user_avatar,
    'content' => $content,
    'categories' => $categories,
  ]
);

print($page);

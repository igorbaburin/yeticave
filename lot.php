<?php
require_once('function.php');
require_once('data.php');

$is_auth = (bool) rand(0, 1);
$user_name = 'Константин';
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


$lot_content = getTemplate('lot.php', ['goods' => $lot, 'timeLeft' => $timeLeft],);
$page = getTemplate(
  'layout.php',
  [
    'title' => $lot['lot-name'],
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar,
    'content' => $lot_content,
    'categories' => $categories,
  ]
);

print($page);

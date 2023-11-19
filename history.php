<?php
require_once ('function.php');
require_once ('data.php');

$is_auth = (bool) rand(0, 1);
$user_name= 'Константин';
$user_avatar = 'img/user.jpg';

// инициализация массива данных из cookie

if (isset($_COOKIE['viewed'])) {
    $history = json_decode($_COOKIE['viewed'], true);
  } else {
    $history = [];
  }

$page_content = getTemplate('history.php', ['goods' => $goods, 'timeLeft' => $timeLeft, 'history' => $history],);
$page = getTemplate(
    'layout.php', [
    'title' => 'История просмотров',
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar,
    'content' => $page_content,
    'categories' => $categories,
]);

print($page);
?>
<?php
require_once ('function.php');
require_once ('data.php');
require_once ('basic.php');

$user_avatar = 'img/user.jpg';

// инициализация массива данных из cookie

if (isset($_COOKIE['viewed'])) {
    $history = json_decode($_COOKIE['viewed'], true);
  } else {
    $history = [];
  }

$content = getTemplate('history.php', ['goods' => $goods, 'timeLeft' => $timeLeft, 'history' => $history],);
$page = getTemplate(
    'layout.php', [
    'title' => 'История просмотров',
    'user_avatar' => $user_avatar,
    'content' => $content,
    'categories' => $categories,
]);

print($page);
?>
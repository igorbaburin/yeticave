<?php
require_once ('function.php');
require_once ('data.php');
require_once ('basic.php');

$user_avatar = 'img/user.jpg';

$content = getTemplate('index.php', ['goods' => $goods, 'timeLeft' => $timeLeft],);
$page = getTemplate(
    'layout.php', [
    'title' => 'Главная',
    'user_avatar' => $user_avatar,
    'content' => $content,
    'categories' => $categories,
]);

print($page);
?>
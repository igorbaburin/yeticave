<?php
require_once ('function.php');
require_once ('data.php');

$is_auth = (bool) rand(0, 1);
$user_name= 'Константин';
$user_avatar = 'img/user.jpg';

$page_content = getTemplate('index.php', ['goods' => $goods, 'timeLeft' => $timeLeft],);
$page = getTemplate(
    'layout.php', [
    'title' => 'Главная',
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar,
    'content' => $page_content,
    'category' => $category,
]);

print($page);
?>
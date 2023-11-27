<?php
require_once ('function.php');
require_once ('data.php');
require_once ('basic.php');

$user_avatar = 'img/user.jpg';

$sqlGetLots = "SELECT * FROM goods";
$resultGetLots = mysqli_query($con, $sqlGetLots);

// mysqli_fetch_all используется для извлечения всех строк из результата в виде ассоциативного массива
$rows = mysqli_fetch_all($resultGetLots, MYSQLI_ASSOC);

$content = getTemplate('index.php', ['goods' => $goods, 'timeLeft' => $timeLeft, 'rows' => $rows],);
$page = getTemplate(
    'layout.php', [
    'title' => 'Главная',
    'user_avatar' => $user_avatar,
    'content' => $content,
    'categories' => $categories,
]);

print($page);
?>
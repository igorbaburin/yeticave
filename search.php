<?php
require_once('function.php');
require_once('data.php');
require_once('userdata.php');
require_once('basic.php');

$user_avatar = 'img/user.jpg';

$lots = [];

// mysqli_query($con, 'CREATE FULLTEXT INDEX lot_ft_search on goods(lot_name, lot_message, category)');
// создание индекса выполняется только один раз, то есть если нужно добавить новое поле, не получится его просто вписать,
// нужно будет проводить проверку на его существование, присваивая новые поля

$search = $_GET['search'] ?? '';

if ($search) {
    $sql = "SELECT * FROM goods "
      . "WHERE MATCH(lot_name, lot_message, category) AGAINST(?)";

    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $search);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo "Ошибка выполнения запроса: " . mysqli_error($con);
    }
}


$content = getTemplate('search.php', ['lots' => $lots, 'timeLeft' => $timeLeft, 'search' => $search]);
$page = getTemplate(
    'layout.php',
    [
        'title' => 'Войти',
        'user_avatar' => $user_avatar,
        'content' => $content,
        'categories' => $categories,
    ]
);

print($page);
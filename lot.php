<?php
require_once('function.php');
require_once('data.php');
require_once('basic.php');

$user_avatar = 'img/user.jpg';



$result = [
  'cost' => '',
];

$b_username = $_SESSION['user']['user_name'];
$lot_id =  intval($_GET['lot_id']);
$cost = $_POST["cost"];

// обработка ставки

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $errors = [];

  if (empty($cost)) {
    $errors["lot-step"] = "Введите ставку";
  } elseif (!ctype_digit($cost)) {
    $errors["cost"] = "Ставка должна быть целым числом";
  }

  // Если есть ошибки, выводим их
  if (!empty($errors)) {
    $errors['form-invalid'] = true;
} else {

    // Если ошибок нет, продолжаем обработку данных
    $sqlAddBet= "INSERT INTO bets (id, lot_id, b_username, b_price, b_date) VALUES (null, ?, ?, ?, ?)";

    // Используем подготовленный запрос
    $stmt = mysqli_prepare($con, $sqlAddBet);
    
    // Передаем параметры и выполняем запрос
    mysqli_stmt_bind_param($stmt, "ssss", $lot_id, $b_username, $cost, date('Y-m-d H:i:s'));
    $addData = mysqli_stmt_execute($stmt);

    // Закрываем подготовленный запрос
    mysqli_stmt_close($stmt);

    if ($addData) {
      header("Refresh:0");
  } else {
      echo "Ошибка при добавлении данных: " . mysqli_error($con);
  }
}
}

// вывод ставок из БД по ID
$sqlGetBets = "SELECT * FROM bets WHERE lot_id = '$lot_id'";
$resultGetBets = mysqli_query($con, $sqlGetBets);
$rows = mysqli_fetch_all($resultGetBets, MYSQLI_ASSOC);

// !!! - mysqli_fetch_all - возвращает массив, значит данные в нем индексируется так же с 0 [запомнить]

// передан ли параметр lot_id через GET запрос
if (isset($_GET['lot_id'])) {

  // получаем идентификатор лота из GET запроса
  $lotId = $_GET['lot_id'];

  // параметризированный запрос чтобы избежать SQL-инъекций
  $sqlGetLot = "SELECT * FROM goods WHERE id = ?";
  $stmt = mysqli_prepare($con, $sqlGetLot);
  mysqli_stmt_bind_param($stmt, "i", $lotId);
  mysqli_stmt_execute($stmt);

  $resultGetLot = mysqli_stmt_get_result($stmt);

  // проверяем, существует ли лот с таким идентификатором в массиве
  if ($resultGetLot) {
    // получаем информацию о лоте
    $lot = mysqli_fetch_assoc($resultGetLot);
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
// можно сократить с помощью тернарных операторов >> $history = isset($_COOKIE['viewed']) ? json_decode($_COOKIE['viewed'], true) : [];  >> пора практиковать
if (isset($_COOKIE['viewed'])) {
  $history = json_decode($_COOKIE['viewed'], true);
} else {
  $history = [];
}

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

$content = getTemplate('lot.php', ['lot' => $lot, 'timeLeft' => $timeLeft, 'rows' => $rows],);
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

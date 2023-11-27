<?php

$con = mysqli_connect("127.0.0.1", "root", "", "yeticave");
mysqli_set_charset($con, "utf8");

// корень сайта
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
// путь до каталога шаблонов
define('TEMPLATE_PATH', ROOT. '/templates/');
// путь до каталога изображений
define('IMG_PATH', ROOT. '/img/');
// каталог загрузки
define('USER_UPLOAD_DIR', '/upload/user_lots/');


// работа с сессиями
session_start();
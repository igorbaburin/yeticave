<?php
require_once ('basic.php');

unset($_SESSION['user']);
header('Location: /index.php');
<?php

require 'goods.php';

// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['b_username' => 'Иван', 'b_price' => 11500, 'b_date' => strtotime('-' . rand(1, 50) .' minute')],
    ['b_username' => 'Константин', 'b_price' => 11000, 'b_date' => strtotime('-' . rand(1, 18) .' hour')],
    ['b_username' => 'Евгений', 'b_price' => 10500, 'b_date' => strtotime('-' . rand(25, 50) .' hour')],
    ['b_username' => 'Семён', 'b_price' => 10000, 'b_date' => strtotime('last week')]
];


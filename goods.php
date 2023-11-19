<?php 

$categories = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];

$goods = [
    [
        'lot-name' => '2014 Rossignol District Snowboard',
        'category' => 'Доски и лыжи',
        'lot-rate' => 10999,
        'lot-image' => 'img/lot-1.jpg',
        'message' => 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчком и четкими дугами. 
        Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд
        отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер
        позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется,
        просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла
        равнодушным.',
    ],
    [
        'lot-name' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => 'Доски и лыжи',
        'lot-rate' => 159999,
        'lot-image' => 'img/lot-2.jpg',
        'message' => null,
    ],
    [
        'lot-name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления',
        'lot-rate' => 8000,
        'lot-image' => 'img/lot-3.jpg',
        'message' => null,
    ],
    [
        'lot-name' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'Ботинки',
        'lot-rate' => 10999,
        'lot-image' => 'img/lot-4.jpg',
        'message' => null,
    ],
    [
        'lot-name' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'Одежда',
        'lot-rate' => 7500,
        'lot-image' => 'img/lot-5.jpg',
        'message' => null,
    ],
    [
        'lot-name' => 'Маска Oakley Canopy',
        'category' => 'Разное',
        'lot-rate' => 7500,
        'lot-image' => 'img/lot-6.jpg',
        'message' => null,
    ],

];

foreach ($goods as $index => $lot) {
    $lotId = $index; // Идентификатор лота равен его индексу в массиве
}


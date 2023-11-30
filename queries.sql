-- Категории
INSERT INTO categories (id, code, category)
    VALUES (null, 1, 'Доски и лыжи');
INSERT INTO categories (id, code, category)
    VALUES (null, 2, 'Крепления');
INSERT INTO categories (id, code, category)
    VALUES (null, 3, 'Ботинки');
INSERT INTO categories (id, code, category)
    VALUES (null, 4, 'Одежда');
INSERT INTO categories (id, code, category)
    VALUES (null, 5, 'Инструменты');
INSERT INTO categories (id, code, category)
    VALUES (null, 6, 'Разное');

-- Пользователи
INSERT INTO users (id, user_email, user_name, user_password)
    VALUES (null, 'ignat.v@gmail.com', 'Игнат', '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka');
INSERT INTO users (id, user_email, user_name, user_password)
    VALUES (null, 'kitty_93@li.ru', 'Леночка', '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa');
INSERT INTO users (id, user_email, user_name, user_password)
    VALUES (null, 'warrior07@mail.ru', 'Руслан', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW');

-- Лоты
INSERT INTO goods (id, lot_name, create_date, final_date, category, category_code, lot_rate, lot_step, lot_image, lot_message)
    VALUES (null, '2014 Rossignol District Snowboard', '2023-11-23', '2023-11-29', 'Доски и лыжи', 1, '10999', '290', 'img/lot-1.jpg', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчком и четкими дугами.');
INSERT INTO goods (id, lot_name, create_date, final_date, category, category_code, lot_rate, lot_step, lot_image, lot_message)
    VALUES (null, 'DC Ply Mens 2016/2017 Snowboard', '2023-11-23', '2023-11-29', 'Доски и лыжи', 1, '159999', '500', 'img/lot-2.jpg', 'Держи лыжню!');
INSERT INTO goods (id, lot_name, create_date, final_date, category, category_code, lot_rate, lot_step, lot_image, lot_message)
    VALUES (null, 'Крепления Union Contact Pro 2015 года размер L/XL', '2023-11-23', '2023-11-29', 'Крепления', 2, '8000', '190', 'img/lot-3.jpg', 'Надежные!');
INSERT INTO goods (id, lot_name, create_date, final_date, category, category_code, lot_rate, lot_step, lot_image, lot_message)
    VALUES (null, 'Ботинки для сноуборда DC Mutiny Charocal', '2023-11-23', '2023-11-29', 'Ботинки', 3, '10999', '590', 'img/lot-4.jpg', 'Ботинки самый раз!');
INSERT INTO goods (id, lot_name, create_date, final_date, category, category_code, lot_rate, lot_step, lot_image, lot_message)
    VALUES (null, 'Куртка для сноуборда DC Mutiny Charocal', '2023-11-23', '2023-11-29', 'Одежда', 4, '7500', '150', 'img/lot-5.jpg', 'Куртка для сноуборда!');
INSERT INTO goods (id, lot_name, create_date, final_date, category, category_code, lot_rate, lot_step, lot_image, lot_message)
    VALUES (null, 'Маска Oakley Canopy', '2023-11-23', '2023-11-29', 'Разное', 6, '7500', '290', 'img/lot-6.jpg', 'Отличная защита лица!');

-- Ставки
INSERT INTO bets (id, lot_id, b_username, b_price, b_date)
    VALUES (null, 5, 'Иван', '11500', '2023-11-23');
INSERT INTO bets (id, lot_id, b_username, b_price, b_date)
    VALUES (null, 5, 'Константин', '11000', '2023-11-23');
INSERT INTO bets (id, lot_id, b_username, b_price, b_date)
    VALUES (null, 6, 'Евгений', '10500', '2023-11-23');
INSERT INTO bets (id, lot_id, b_username, b_price, b_date)
    VALUES (null, 6, 'Семён', '10000', '2023-11-23');


-- Запросы

-- Выбрать все категории
SELECT category FROM categories;


-- Получить самые новые открыте лоты
SELECT lot_name, lot_image, lot_rate, lot_step, category
  FROM goods
       LEFT JOIN
         (SELECT lot_id, b_date, MAX(b_price) AS b_price
            FROM bets
           GROUP BY lot_id) goods
              ON goods.id = goods.lot_id

       LEFT JOIN categories
              ON goods.category_code = categories.id

 ORDER BY b_date DESC;


-- Показать лот по ID + название категории
SELECT lot_name, lot_image, lot_message, category
  FROM goods
       INNER JOIN categories
               ON goods.category_code = categories.id
 WHERE goods.id = 5;


-- Обновить название лота по ID 
UPDATE goods
   SET lot_name = 'Куртка киберпунк DC Mutiny Charocal'
 WHERE id = 5;

-- Получить список ставок для лота по ID + сорт. по дате
SELECT lot_name, rate
  FROM goods
       INNER JOIN bets
               ON goods.id = bets.lot_id
 WHERE goods.id = 5
 ORDER BY b_date DESC;
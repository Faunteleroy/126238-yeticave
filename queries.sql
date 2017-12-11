USE yeticave;

INSERT INTO categories (name) VALUES
  ('Доски и лыжи'),
  ('Крепления'),
  ('Ботинки'),
  ('Одежда'),
  ('Инструменты'),
  ('Разное');

INSERT INTO users (date_register, email, name, password, avatar, contacts) VALUES
  ('2017-12-11 04:15:48', 'ignat.v@gmail.com', 'Игнат',
   '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka',
   '', ''),
  ('2017-11-11 04:15:48', 'kitty_93@li.ru', 'Леночка',
   '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa',
   '', ''),
  ('2017-10-11 04:15:48', 'warrior07@mail.ru', 'Руслан',
   '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW',
   '', '');

INSERT INTO lots (date_creation, name, description, image, date_end, price,
                  rate_step, id_creator, id_winner, id_category) VALUES
  ('2017-11-13 04:15:48', '2014 Rossignol District Snowboard',
   'Легкий маневренный сноуборд, готовый дать жару в любом парке,
   растопив снег мощным щелчком и четкими дугами. Стекловолокно Bi-Ax,
   уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и
   отзывчивостью, а симметричная геометрия в сочетании с классическим
    прогибом кэмбер позволит уверенно держать высокие скорости. А если
    к концу катального дня сил совсем не останется, просто посмотрите
    на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще
    никого не оставляла равнодушным.', 'img/lot-1.jpg', '2017-09-11 04:15:48', 10999, NULL, NULL, NULL, 1),
  ('2017-09-11 04:15:48', 'DC Ply Mens 2016/2017 Snowboard', 'Старый сноуборд, зато красивый',
   'img/lot-2.jpg', '2017-09-13 04:15:48', 159999, 1000, NULL, NULL, 1),
  ('2017-12-11 04:15:48', 'Крепления Union Contact Pro 2015 года размер L/XL',
   'Даже в постель вы пойдете с этими креплениями, настолько они надежны.',
   'img/lot-3.jpg', '2017-12-15 04:15:48', 8000, 10000, NULL, NULL, 2),
  ('2017-12-10 04:15:48', 'Ботинки для сноуборда DC Mutiny Charocal',
   'Классные ботинки, я 2 года не снимал.',
   'img/lot-4.jpg', NULL, 10999, 700, NULL, NULL, 3),
  ('2017-12-07 04:15:48', 'Куртка для сноуборда DC Mutiny Charocal',
   'Видел как-то раз в этой куртке йети.',
   'img/lot-5.jpg', '2017-12-17 04:15:48', 7500, 100, NULL, NULL, 4),
  ('2017-12-07 04:15:48', 'Маска Oakley Canopy',
   'Грабил в ней банк, избавляюсь от улик.',
   'img/lot-6.jpg', NULL, 5400, 500, NULL, NULL, 6);

INSERT INTO bets (date, price, id_user, id_lot) VALUES
  ('2017-12-11 04:15:48', 12000, 1, 7),
  ('2017-12-11 04:15:48', 16000, 2, 9),
  ('2017-12-11 04:15:48', 17000, 2, 10);

-- Получить список всех категорий
SELECT * FROM categories;

/*Получить самые новые, открытые лоты. Каждый лот должен включать название,
стартовую цену, ссылку на изображение, цену, количество ставок, название категории */
SELECT l.name, l.price, l.image, MAX(b.price) as price, COUNT(b.id) as bets, l.id_category FROM lots l
  LEFT JOIN bets b ON l.id = b.id
WHERE l.date_end >= CURDATE()
GROUP BY l.id
ORDER BY l.date_creation DESC;


-- Найти лот по его названию или описанию
SELECT * FROM lots WHERE name LIKE 'Ботинки' OR description LIKE 'йети';

-- Обновить название лота по его идентификатору
UPDATE lots SET name = 'DC Ply Mens 2016/2017 Beauty Snowboard' WHERE id = 2;

-- Получить список самых свежих ставок для лота по его идентификатору
SELECT * FROM bets WHERE id_lot = 1 ORDER BY date DESC;




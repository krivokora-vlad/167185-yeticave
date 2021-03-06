-- Добавление данных --

-- Категории
INSERT INTO `yeticave`.`category` (`name`) VALUES
('Доски и лыжи'),
('Крепления'),
('Ботинки'),
('Одежда'),
('Инструменты'),
('Разное');

-- Пользователи
INSERT INTO `yeticave`.`user` (`reg_date`, `email`, `name`, `password`, `avatar`, `contacts`) VALUES
('2017-12-10 10:00:32', 'ignat.v@gmail.com', 'Игнат', '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka', 'img/user.jpg', 'Скайп: ignat.v'),
('2017-12-10 12:15:43', 'kitty_93@li.ru', 'Леночка', '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa', 'img/user.jpg', 'Скайп: lenochka'),
('2017-12-10 13:45:02', 'warrior07@mail.ru', 'Руслан', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW', 'img/user.jpg', 'Скайп: ruslan');

-- Объявления
INSERT INTO `yeticave`.`lot` (`date_publish`, `name`, `description`, `image`, `price_start`, `date_expire`, `bet_step`, `user_id`, `winner_id`, `category_id`) VALUES
('2017-07-10 17:14:08', '2014 Rossignol District Snowboard', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.', 'img/lot-1.jpg', '10999', '2017-08-10 23:50:00', '100', '1', '2', '1'),
('2017-12-10 17:18:49', 'DC Ply Mens 2016/2017 Snowboard', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.', 'img/lot-2.jpg', '159999', '2017-12-10 20:00:00', '150', '2', NULL, '1'),
('2017-12-10 17:18:49', 'Крепления Union Contact Pro 2015 года размер L/XL', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.', 'img/lot-3.jpg', '8000', '2017-12-10 20:00:00', '80', '3', NULL, '2'),
('2017-12-10 17:18:49', 'Ботинки для сноуборда DC Mutiny Charocal', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.', 'img/lot-4.jpg', '10999', '2017-12-10 20:00:00', '110', '2', NULL, '3'),
('2017-12-10 17:18:49', 'Куртка для сноуборда DC Mutiny Charocal', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.', 'img/lot-5.jpg', '7500', '2017-12-10 20:00:00', '75', '1', NULL, '4'),
('2017-12-10 17:18:49', 'Маска Oakley Canopy', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.', 'img/lot-6.jpg', '5400', '2017-12-10 20:00:00', '2000', '2', NULL, '6');

-- Ставки
INSERT INTO `yeticave`.`bet` (`date`, `cost`, `user_id`, `lot_id`) VALUES
('2017-12-10 17:42:09', '11299', '1', '1'),
('2017-12-10 17:52:34', '11699', '3', '1'),
('2017-12-10 17:52:34', '11999', '2', '1');


-- Запросы --

-- Получить список из всех категорий
SELECT * FROM `yeticave`.`category`;

-- Получить самые новые, открытые лоты.
-- Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, количество ставок, название категории
SELECT `lot`.`name`, `lot`.`price_start`, `lot`.`image`, COUNT(DISTINCT `bet`.`id`) as `bets`, MAX(`bet`.`cost`) as `price`, `category`.`name`
FROM `lot`
LEFT JOIN `bet` ON `lot`.`id` = `bet`.`lot_id`
LEFT JOIN `category` ON `lot`.`category_id` = `category`.`id`
WHERE `lot`.`date_expire` >= CURDATE()
GROUP BY `lot`.`id`
ORDER BY `lot`.`date_expire` DESC;

-- Найти лот по его названию или описанию
SELECT * FROM `yeticave`.`lot` WHERE `name` like '%pro%' OR `description` like '%pro%';

-- Обновить название лота по его идентификатору;
UPDATE `yeticave`.`lot` SET `name` = '2014 Rossignol District Snowboard (sale)' WHERE `id` = 1;

-- Получить список самых свежих ставок для лота по его идентификатору
SELECT * FROM `bet` WHERE `lot_id` = 1 ORDER BY `date` DESC LIMIT 4;
<?php

$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : false;

$categories = query($db_connect,'SELECT `id`, `name` FROM category');

$announcements = query(
    $db_connect,
    'SELECT `lot`.`id`, `lot`.`name`, `lot`.`price_start`, `lot`.`image`, COUNT(DISTINCT `bet`.`id`) as `bets`, MAX(`bet`.`cost`) as `price`, `category`.`name` as `category`
    FROM `lot`
    LEFT JOIN `bet` ON `lot`.`id` = `bet`.`lot_id`
    LEFT JOIN `category` ON `lot`.`category_id` = `category`.`id`
    WHERE `lot`.`date_expire` >= CURDATE()
    GROUP BY `lot`.`id`
    ORDER BY `lot`.`date_expire` DESC;');

?>
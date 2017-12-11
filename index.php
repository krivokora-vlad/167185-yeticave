<?php

require_once('init.php');


$announcements = query(
    $db_connect,
    'SELECT `lot`.`id`, `lot`.`name`, `lot`.`price_start`, `lot`.`date_expire`, `lot`.`image`, COUNT(DISTINCT `bet`.`id`) as `bets`, MAX(`bet`.`cost`) as `price`, `category`.`name` as `category`
    FROM `lot`
    LEFT JOIN `bet` ON `lot`.`id` = `bet`.`lot_id`
    LEFT JOIN `category` ON `lot`.`category_id` = `category`.`id`
    WHERE `lot`.`date_expire` >= CURDATE()
    GROUP BY `lot`.`id`
    ORDER BY `lot`.`date_expire` DESC;');

$page_data = [
    'categories' => $categories,
    'announcements' => $announcements
];


$page_content = include_template('index', $page_data);
$layout_content = include_template('layout', [
    'content'       => $page_content,
    'title'         => 'Главная',
    'categories'    => $categories,
    'user'          => $user
]);

print($layout_content);
?>
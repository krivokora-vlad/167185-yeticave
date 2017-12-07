<?php
require_once('functions.php');
require_once('data.php');

// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

function time_of_betting($ts) {
    $now = strtotime('now');
    $diff = $now - $ts;
    if ($diff > 86400) {
        return gmdate("d.m.y в H:i", $ts);
    } else if ($diff > 3600){
        return gmdate("H часов назад", $diff);
    } else {
        return gmdate("i минут назад", $diff);
    }
}

$lot_id = (isset($_GET['id'])) ? $_GET['id'] : -1;


$page_found = isset($announcements[$lot_id]);
if (!$page_found) {
    http_response_code(404);
}



$categories = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];



$page_data = [
    'categories' => $categories,
    'lot_id' => $lot_id,
    'announcements' => $announcements,
    'bets' => $bets
];
$page_content = include_template('lot', $page_data);
$layout_content = include_template('layout', [
    'content' => $page_content,
    'title' => (isset($announcements[$lot_id]['name'])) ? $announcements[$lot_id]['name'] : '',
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar
]);

print($layout_content);


?>
<?php

session_start();

require_once('userdata.php');
require_once('functions.php');
require_once('data.php');

$my_lots = [];

$cookie_value = [];

if (isset($_COOKIE['bets'])) {
  $cookie_value = json_decode($_COOKIE['bets'], true);
}

foreach($cookie_value as $key => $value) {
  $lot = $announcements[$key];
  $lot['cost'] = $value['cost'];
  $lot['time'] = $value['time'];
  $lot['lot_id'] = $key;
  $my_lots[] = $lot;
}

$page_content = include_template('mylots', [
  'categories' => $categories,
  'my_lots' => $my_lots
]);

$layout_content = include_template('layout', [
    'content' => $page_content,
    'title' => 'Мои ставки',
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar
]);

print($layout_content);

?>
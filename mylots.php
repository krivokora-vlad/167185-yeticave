<?php

session_start();

require_once('functions.php');
require_once('data.php');

require_once('mysql_helper.php');
require_once('init.php');


if ($user) {
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
  
  $page_title = 'Мои ставки';
  $page_content = include_template('mylots', [
    'categories' => $categories,
    'my_lots' => $my_lots
  ]);
} else {
  http_response_code(403);
  $page_title = 'Недостаточно прав для просмотра своих ставок';
  $page_data = [
      'categories' => $categories,
      'title' => $page_title
  ];
  $page_content = include_template('error', $page_data);
}

$layout_content = include_template('layout', [
    'content' => $page_content,
    'title' => $page_title,
    'user' => $user,
    'user_avatar' => $user_avatar
]);

print($layout_content);

?>
<?php

require_once('init.php');

$user_id = (isset($user['id'])) ? $user['id'] : -1;

if ($user) {
  $my_lots = [];
  
  $cookie_value = [];
  
  if (isset($_COOKIE['bets'])) {
    $cookie_value = json_decode($_COOKIE['bets'], true);
  }
  
  if ($user) {
    $my_lots = query(
      $db_connect,
      'SELECT `bet`.`lot_id`, `lot`.`name`, `lot`.`image`, `category`.`name` as `category`, `bet`.`cost`, `bet`.`id` as `bet_id`, `bet`.`date`, `lot`.`date_expire`
      FROM bet
      LEFT JOIN lot ON `bet`.`lot_id` = `lot`.`id`
      LEFT JOIN category ON `lot`.`category_id` = `category`.`id`
      WHERE `bet`.`user_id`='.$user_id
    );
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
    'categories'  => $categories,
    'user' => $user,
    'user_avatar' => $user_avatar
]);

print($layout_content);

?>
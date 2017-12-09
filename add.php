<?php

session_start();

require_once('functions.php');
require_once('data.php');

$errors = [];

if ($user) {

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
      $lot = $_POST; 
    
      $required = [
        'lot-name',
        'category',
        'message',
        'lot-rate',
        'lot-step',
        'lot-date'
      ];
    
      $dict = [
        'lot-name' => 'Наименование',
        'category' => 'Категория',
        'message' => 'Описание',
        'lot-rate' => 'Начальная цена',
        'lot-step' => 'Шаг ставки',
        'lot-date' => 'Дата окончания торгов',
      ];
    
      $errors = [];
      
      foreach ($lot as $key => $value) {
    
        if (in_array($key, $required)) {
          if (!$value) {
            $errors[$dict[$key]] = 'Это поле надо заполнить';
          }
        }
    
        if ($key == 'lot-rate' && ($value < 0 || !filter_var($value, FILTER_VALIDATE_FLOAT))) {
          $errors[$dict[$key]] = 'Должно быть числом больше нуля';
        }
    
        if ($key == 'lot-step' && ($value < 0 || !filter_var($value, FILTER_VALIDATE_INT))) {
          $errors[$dict[$key]] = 'Должно быть целое число больше нуля';
        }
    
        if ($key == 'lot-date') {
    
          $lot_date = strtotime($value);
          $current_date = time();
    
          if ( $lot_date < $current_date ) {
            $errors[$dict[$key]] = 'Указанная дата должна быть больше текущей даты хотя бы на один день.';
          }
        }
      }
    
      if ($_FILES['photo2']['error'] == 0) {
        $tmp_name = $_FILES['photo2']['tmp_name'];
        $path = $_FILES['photo2']['name'];
    
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);
        
        if ($file_type !== "image/png" && $file_type !== "image/jpeg") {
          $errors['Файл'] = 'Загрузите картинку в формате PNG или JPG';
        } else {
          move_uploaded_file($tmp_name, 'img/' . $path);
          $lot['path'] = $path;
        }
      } else {
        $errors['Файл'] = 'Вы не загрузили файл';
      }
    
      if (count($errors)) {
        $page_content = include_template('add', [
          'categories' => $categories,
          'errors'  => $errors
        ]);
      } else {
    
        $new_lot = [
          'name' => $lot['lot-name'],
          'category' => $lot['category'],
          'price' => $lot['lot-rate'],
          'url_img' => 'img/'.$lot['path']
        ];
    
        $page_content = include_template('lot', [
          'categories' => $categories,
          'lot'   => $new_lot,
          'bets'  => $bets,
          'user'  => $user,
        ]);
      } 
    
    } else {
      $page_content = include_template('add', [
        'categories' => $categories,
        'errors'  => $errors
      ]);
    }
} else {
  http_response_code(403);
  $page_title = 'Недостаточно прав для добавления лота';
  $page_data = [
      'categories' => $categories,
      'title' => $page_title
  ];
  $page_content = include_template('error', $page_data);
}

$layout_content = include_template('layout', [
	'content'     => $page_content,
  'title'       => 'Добавление лота',
  'user'        => $user,
  'user_avatar' => $user_avatar,
]);

print($layout_content);

?>
<?php
require_once('data.php');
require_once('functions.php');

$errors = [];

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
      $errors['Начальная цена'] = 'Должно быть числом больше нуля';
    }

    if ($key == 'lot-step' && ($value < 0 || !filter_var($value, FILTER_VALIDATE_INT))) {
      $errors['Шаг ставки'] = 'Должно быть целое число больше нуля';
    }

    if ($key == 'lot-date') {

      $lot_date = strtotime($value);
      $current_date = time();

      if ( $lot_date < $current_date ) {
        $errors['Дата окончания торгов'] = 'Указанная дата должна быть больше текущей даты хотя бы на один день.';
      }
    }
  }

  if (isset($_FILES['photo2']['name']) && $_FILES['photo2']['name'] != '') {
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
      'lot' => $new_lot,
      'bets' => $bets
    ]);
  } 

} else {
  $page_content = include_template('add', [
    'categories' => $categories,
    'errors'  => $errors
  ]);
}

$layout_content = include_template('layout', [
	'content'     => $page_content,
  'title'       => 'Добавление лота',
  'is_auth'     => $is_auth,
  'user_name'   => $user_name,
  'user_avatar' => $user_avatar
]);

print($layout_content);

?>
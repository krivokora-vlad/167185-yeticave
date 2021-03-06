<?

require_once('init.php');

if ($user) {
  header("Location: /index.php");
  exit();
} else {
  $errors = [];

  $form = [];

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;

    $required = [
      'email',
      'password',
      'name',
      'message'
    ];

    foreach ($form as $key => $value) {
      if (in_array($key, $required)) {
        if (!$value) {
          $errors[$key] = 'Это поле надо заполнить';
        }
      }
    }

    $email = $form['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'Пожалуйста, укажите корректный';
    } else {
      $exist_account = query(
        $db_connect,
        (sprintf("SELECT `id` FROM user WHERE email='%s'", $email))
      );
      if(count($exist_account)) {
        $errors['email'] = 'Данный E-mail адрес уже используется.';
      };
    }

    $avatar = '';
    $file = $_FILES['photo2'];
    if (file_is_uploaded($file)) {
      $tmp_name = $file['tmp_name'];
      $path = $file['name'];
      if (file_is_image($file)) {
        move_uploaded_file($tmp_name, 'img/' . $path);
        $avatar = 'img/' . $path;
      } else {
        $errors['photo2'] = 'Загрузите картинку в формате PNG или JPG';
      }
    }

    $password = password_hash($form['password'], PASSWORD_BCRYPT);

    if (!count($errors)) {

      $query = sprintf(
        "INSERT INTO `yeticave`.`user` (`name`,`email`,`password`,`avatar`,`contacts`,`reg_date`)
        VALUES ('%s','%s','%s','%s','%s', CURTIME());",
        mysqli_real_escape_string($db_connect, $form['name']),
        $form['email'],
        $password,
        $avatar,
        mysqli_real_escape_string($db_connect, $form['message'])
      );

      $add_user = query($db_connect, $query);
      header("Location: /login.php");
      exit();
    }
   
  }

  $page_content = include_template('sign-up', [
    'categories'    => $categories,
    'errors'        => $errors,
    'form'          => $form
  ]);
  
  $layout_content = include_template('layout', [
      'content'     => $page_content,
      'categories'  => $categories,
      'title'       => 'Регистрация',
      'user'        => $user
  ]);
  
  print($layout_content);



}
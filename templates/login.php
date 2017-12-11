<?php
  $email   = $_POST['email'] ?? '';
  $password   = $_POST['password'] ?? '';
?>

  <nav class="nav">
    <ul class="nav__list container">
      <? foreach ($data['categories'] as $category): ?>
          <li class="nav__item">
              <a href="#"><?=$category['name'];?></a>
          </li>
      <? endforeach; ?>
    </ul>
  </nav>
  <form class="form container <?=(count($data['errors']) ? 'form--invalid' : '');?>" action="login.php" method="post">
    <h2>Вход</h2>
    <div class="form__item <?=(isset($data['errors']['E-mail']) ? 'form__item--invalid' : '');?>">
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=$email;?>" required>
      <?=isset($data['errors']['E-mail']) ? '<span class="form__error">'.$data['errors']['E-mail'].'</span>' : ''; ?>
    </div>
    <div class="form__item form__item--last <?=(isset($data['errors']['Пароль']) ? 'form__item--invalid' : '');?>">
      <label for="password">Пароль*</label>
      <input id="password" type="text" name="password" placeholder="Введите пароль" value="<?=$password;?>" required>
      <?=isset($data['errors']['Пароль']) ? '<span class="form__error">'.$data['errors']['Пароль'].'</span>' : ''; ?>      
    </div>
    <button type="submit" class="button">Войти</button>
  </form>
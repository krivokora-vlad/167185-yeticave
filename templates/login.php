<?php
  $email   = $_POST['email'] ?? '';
  $password   = $_POST['password'] ?? '';
?>

  <nav class="nav">
    <ul class="nav__list container">
      <? foreach ($data['categories'] as $key => $value): ?>
        <li class="nav__item">
          <a href="#"><?=$value;?></a>
        </li>
      <? endforeach; ?> 
    </ul>
  </nav>
  <form class="form container <?=(count($data['errors']) ? 'form--invalid' : '');?>" action="login.php" method="post"> <!-- form--invalid -->
    <h2>Вход</h2>
    <div class="form__item <?=(isset($data['errors']['E-mail']) ? 'form__item--invalid' : '');?>"> <!-- form__item--invalid -->
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=$email;?>" required>
      <!-- <span class="form__error">Введите e-mail</span> -->
      <?=isset($data['errors']['E-mail']) ? '<span class="form__error">'.$data['errors']['E-mail'].'</span>' : ''; ?>
    </div>
    <div class="form__item form__item--last <?=(isset($data['errors']['Пароль']) ? 'form__item--invalid' : '');?>">
      <label for="password">Пароль*</label>
      <input id="password" type="text" name="password" placeholder="Введите пароль" value="<?=$password;?>" required>
      <!-- <span class="form__error">Введите пароль</span> -->
      <?=isset($data['errors']['Пароль']) ? '<span class="form__error">'.$data['errors']['Пароль'].'</span>' : ''; ?>      
    </div>
    <button type="submit" class="button">Войти</button>
  </form>
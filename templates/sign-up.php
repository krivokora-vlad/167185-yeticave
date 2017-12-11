  <nav class="nav">
    <ul class="nav__list container">
      <? foreach ($data['categories'] as $category): ?>
        <li class="nav__item">
          <a href="#"><?=$category['name'];?></a>
        </li>
      <? endforeach; ?>
    </ul>
  </nav>
  <form class="form container <?=(count($data['errors'])) ? 'form--invalid' : '' ;?>" action="/sign-up.php" enctype="multipart/form-data" method="post">
    <h2>Регистрация нового аккаунта</h2>
    <div class="form__item <?=(isset($data['errors']['email'])) ? 'form__item--invalid' : '';?>">
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=($data['form']['email']) ?? '';?>" required->
      <? if (isset($data['errors']['email'])): ?>
        <span class="form__error"><?=$data['errors']['email'];?></span>
      <? endif; ?>
    </div>
    <div class="form__item <?=(isset($data['errors']['password'])) ? 'form__item--invalid' : '';?>">
      <label for="password">Пароль*</label>
      <input id="password" type="text" name="password" placeholder="Введите пароль" value="<?=($data['form']['password']) ?? '';?>" required->
      <? if (isset($data['errors']['password'])): ?>
        <span class="form__error"><?=$data['errors']['password'];?></span>
      <? endif; ?>
    </div>
    <div class="form__item <?=(isset($data['errors']['name'])) ? 'form__item--invalid' : '';?>">
      <label for="name">Имя*</label>
      <input id="name" type="text" name="name" placeholder="Введите имя" value="<?=($data['form']['name']) ?? '';?>" required->
      <? if (isset($data['errors']['name'])): ?>
        <span class="form__error"><?=$data['errors']['name'];?></span>
      <? endif; ?>
    </div>
    <div class="form__item <?=(isset($data['errors']['message'])) ? 'form__item--invalid' : '';?>">
      <label for="message">Контактные данные*</label>
      <textarea id="message" name="message" placeholder="Напишите как с вами связаться" required-><?=($data['form']['message']) ?? '';?></textarea>
      <? if (isset($data['errors']['message'])): ?>
        <span class="form__error"><?=$data['errors']['message'];?></span>
      <? endif; ?>
    </div>
    <div class="form__item form__item--file form__item--last <?=(isset($data['errors']['photo2'])) ? 'form__item--invalid' : '';?>">
      <label>Аватар</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="img/avatar.jpg" width="113" height="113" alt="Ваш аватар">
        </div>
      </div>
      <? if (isset($data['errors']['photo2'])): ?>
        <span class="form__error"><?=$data['errors']['photo2'];?></span>
      <? endif; ?>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" id="photo2" name="photo2" value="">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
    </div>
    <? if (count($data['errors'])): ?>
      <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <? endif; ?>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="/login.php">Уже есть аккаунт</a>
  </form>
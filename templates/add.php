<?
  $lot_name   = $_POST['lot-name'] ?? '';
  $category   = $_POST['category'] ?? '';
  $message    = $_POST['message'] ?? '';
  $lot_rate   = $_POST['lot-rate'] ?? '';
  $lot_step   = $_POST['lot-step'] ?? '';
  $lot_date   = $_POST['lot-date'] ?? '';

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
  <form class="form form--add-lot container <?=(count($data['errors']) ? 'form--invalid' : '');?> " action="add.php" enctype="multipart/form-data" method="post"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
      <div class="form__item <?=isset($data['errors']['Наименование']) ? 'form__item--invalid' : '';?>"> <!-- form__item--invalid -->
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=$lot_name;?>" required>
        <?=isset($data['errors']['Наименование']) ? '<span class="form__error">'.$data['errors']['Наименование'].'</span>' : ''; ?>
      </div>
      <div class="form__item <?=isset($data['errors']['Категория']) ? 'form__item--invalid' : '';?>">
        <label for="category">Категория</label>
        <select id="category" name="category" required>
          <option <?= ($category == 'Выберите категорию') ? 'selected' : ''; ?>>Выберите категорию</option>
          <option <?= ($category == 'Доски и лыжи') ? 'selected' : ''; ?>>Доски и лыжи</option>
          <option <?= ($category == 'Крепления') ? 'selected' : ''; ?>>Крепления</option>
          <option <?= ($category == 'Ботинки') ? 'selected' : ''; ?>>Ботинки</option>
          <option <?= ($category == 'Одежда') ? 'selected' : ''; ?>>Одежда</option>
          <option <?= ($category == 'Инструменты') ? 'selected' : ''; ?>>Инструменты</option>
          <option <?= ($category == 'Разное') ? 'selected' : ''; ?>>Разное</option>
        </select>
        <?=isset($data['errors']['Категория']) ? '<span class="form__error">'.$data['errors']['Категория'].'</span>' : ''; ?>
      </div>
    </div>
    <div class="form__item form__item--wide <?=isset($data['errors']['Описание']) ? 'form__item--invalid' : '';?>">
      <label for="message">Описание</label>
      <textarea id="message" name="message" placeholder="Напишите описание лота" required><?=$message;?></textarea>
      <?=isset($data['errors']['Описание']) ? '<span class="form__error">'.$data['errors']['Описание'].'</span>' : ''; ?>
    </div>
    <div class="form__item form__item--file <?=isset($data['errors']['Файл']) ? 'form__item--invalid' : '';?>"> <!-- form__item--uploaded -->
      <label>Изображение</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" id="photo2" name="photo2" value="">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
      <?=isset($data['errors']['Файл']) ? '<span class="form__error">'.$data['errors']['Файл'].'</span>' : ''; ?>
    </div>
    <div class="form__container-three">
      <div class="form__item form__item--small <?=isset($data['errors']['Начальная цена']) ? 'form__item--invalid' : '';?>">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?=$lot_rate;?>" required>
        <?=isset($data['errors']['Начальная цена']) ? '<span class="form__error">'.$data['errors']['Начальная цена'].'</span>' : ''; ?>
      </div>
      <div class="form__item form__item--small <?=isset($data['errors']['Шаг ставки']) ? 'form__item--invalid' : '';?>">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?=$lot_step;?>" required>
        <?=isset($data['errors']['Шаг ставки']) ? '<span class="form__error">'.$data['errors']['Шаг ставки'].'</span>' : ''; ?>
      </div>
      <div class="form__item <?=isset($data['errors']['Дата окончания торгов']) ? 'form__item--invalid' : '';?>">
        <label for="lot-date">Дата окончания торгов</label>
        <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?=$lot_date;?>" required>
        <?=isset($data['errors']['Дата окончания торгов']) ? '<span class="form__error">'.$data['errors']['Дата окончания торгов'].'</span>' : ''; ?>
      </div>
    </div>

    <?=(count($data['errors']) ? '<span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>' : '');?>
    
    <button type="submit" class="button">Добавить лот</button>
  </form>


  <nav class="nav">
    <ul class="nav__list container">
      <? foreach ($data['categories'] as $category): ?>
        <li class="nav__item">
          <a href="#"><?=$category['name'];?></a>
        </li>
      <? endforeach; ?>
    </ul>
  </nav>
  <section class="rates container">
    <h2>Мои ставки</h2>
    <table class="rates__list">
      <? foreach ($data['my_lots'] as $key => $value): ?>
        <tr class="rates__item">
          <td class="rates__info">
            <div class="rates__img">
              <img src="<?=$value['image'];?>" width="54" height="40" alt="Сноуборд">
            </div>
            <h3 class="rates__title">
              <a href="lot.php?id=<?=$value['lot_id'];?>">
                <?=htmlspecialchars($value['name']);?>
              </a>
            </h3>
          </td>
          <td class="rates__category">
            <?=$value['category'];?>
          </td>
          <td class="rates__timer">
            <div class="timer timer--finishing">
              <?=lot_expire_timer(strtotime($value['date_expire']));?>
            </div>
          </td>
          <td class="rates__price">
            <?=$value['cost'];?> р
          </td>
          <td class="rates__time">
            <?=time_of_betting(strtotime($value['date']));?>
          </td>
        </tr>
      <? endforeach; ?> 
    </table>
  </section>
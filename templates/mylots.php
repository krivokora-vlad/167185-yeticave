<nav class="nav">
    <ul class="nav__list container">
      <? foreach ($data['categories'] as $key => $value): ?>
        <li class="nav__item">
          <a href="#"><?=$value;?></a>
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
              <img src="<?=$value['url_img'];?>" width="54" height="40" alt="Сноуборд">
            </div>
            <h3 class="rates__title"><a href="lot.php?id=<?=$value['lot_id'];?>"><?=$value['name'];?></a></h3>
          </td>
          <td class="rates__category">
            <?=$value['category'];?>
          </td>
          <td class="rates__timer">
            <div class="timer timer--finishing">07:13:34</div>
          </td>
          <td class="rates__price">
            <?=$value['cost'];?> р
          </td>
          <td class="rates__time">
            <?=time_of_betting($value['time']);?>
          </td>
        </tr>
      <? endforeach; ?> 
    </table>
  </section>
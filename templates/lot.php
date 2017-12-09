<?php
    $cost = $_POST['cost'] ?? '';
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
<section class="lot-item container">
<?php if (isset($data['lot'])): ?>
    <h2><?=$data['lot']['name']; ?></h2>
    <div class="lot-item__content">
        <div class="lot-item__left">
            <div class="lot-item__image">
                <img src="<?=$data['lot']['url_img']; ?>" width="730" height="548" alt="Сноуборд">
            </div>
            <p class="lot-item__category">Категория: <span><?=$data['lot']['category']; ?></span></p>
            <p class="lot-item__description">Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив
                снег
                мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот
                снаряд
                отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом
                кэмбер
                позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется,
                просто
                посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла
                равнодушным.</p>
        </div>
        <div class="lot-item__right">
            <? if($data['is_auth']): ;?>
            <div class="lot-item__state">
                <div class="lot-item__timer timer">
                    10:54:12
                </div>
                <div class="lot-item__cost-state">
                    <div class="lot-item__rate">
                        <span class="lot-item__amount">Текущая цена</span>
                        <span class="lot-item__cost"><?=$data['lot']['price']; ?></span>
                    </div>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span>12 000 р</span>
                    </div>
                </div>
                <? if(!$data['is_bet']): ;?>
                <form class="lot-item__form" action="lot.php?id=<?=$data['lot_id'];?>" method="post">
                    <p class="lot-item__form-item">
                        <label for="cost">Ваша ставка</label>
                        <input id="cost" type="number" name="cost" placeholder="<?=$data['lot']['price']; ?>" value="<?=$cost;?>">
                    </p>
                    <button type="submit" class="button">Сделать ставку</button>
                </form>
                <?=(isset($data['errors']['cost'])) ? '<p class="form__error" style="display: block;">'.$data['errors']['cost'].'</p>' : ''; ?>
                <? endif; ?>
            </div>
            <? endif; ?>
            <div class="history">
                <h3>История ставок (<span>4</span>)</h3>
                <!-- заполните эту таблицу данными из массива $bets-->
                <table class="history__list">
                <? foreach ($data['bets'] as $key => $value): ?>
                    <tr class="history__item">
                        <td class="history__name"><?=$value['name']; ?></td>
                        <td class="history__price"><?=$value['price']; ?> р</td>
                        <td class="history__time"><?=time_of_betting($value['ts']); ?></td>
                    </tr>
                <? endforeach; ?>
                </table>
            </div>
        </div>
    </div>
    <?php else: ?>
    <h1>Лот с этим ID не найден</h1>
    <?php endif; ?>
</section>

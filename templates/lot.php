<?php
    $cost = $_POST['cost'] ?? '';
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
<section class="lot-item container">
<?php if (isset($data['lot'])): ?>
    <h2><?=strip_tags($data['lot']['name']); ?></h2>
    <div class="lot-item__content">
        <div class="lot-item__left">
            <div class="lot-item__image">
                <img src="<?=$data['lot']['image']; ?>" width="730" height="548" alt="Сноуборд">
            </div>
            <p class="lot-item__category">Категория: <span><?=$data['lot']['category']; ?></span></p>
            <p class="lot-item__description"><?=$data['lot']['description']; ?></p>
        </div>
        <div class="lot-item__right">
            
            <div class="lot-item__state">
                <? if (!$data['lot_expired']): ?>
                    <div class="lot-item__timer timer">
                        <?=lot_expire_timer(strtotime($data['lot']['date_expire']));?>
                    </div>
                <? endif; ?>
                <div class="lot-item__cost-state">
                    <div class="lot-item__rate">
                        <span class="lot-item__amount">Текущая цена</span>
                        <span class="lot-item__cost">
                            <?=$data['lot']['current_price']; ?>
                        </span>
                    </div>
                    <? if (!$data['lot_expired']): ?>
                        <div class="lot-item__min-cost">
                            Мин. ставка <span><?=$data['lot']['min_bet']; ?> р</span>
                        </div>
                    <? endif; ?>
                </div>
                <? if($data['user'] && !$data['is_my_lot'] && !$data['lot_expired'] && !$data['is_bet']): ;?>
                <form class="lot-item__form" action="lot.php?id=<?=$data['lot_id'];?>" method="post">
                    <p class="lot-item__form-item">
                        <label for="cost">Ваша ставка</label>
                        <input id="cost" type="number" name="cost" placeholder="<?=$data['lot']['min_bet']; ?>" value="<?=$cost;?>">
                    </p>
                    <button type="submit" class="button">Сделать ставку</button>
                </form>
                <?=(isset($data['errors']['cost'])) ? '<p class="form__error" style="display: block;">'.$data['errors']['cost'].'</p>' : ''; ?>
                <? endif; ?>
            </div>
            <div class="history">
                <h3>История ставок (<span><?=$data['bets_count'];?></span>)</h3>
                <table class="history__list">
                    <? foreach ($data['bets'] as $key => $value): ?>
                        <tr class="history__item">
                            <td class="history__name"><?=$value['name']; ?></td>
                            <td class="history__price"><?=$value['cost']; ?> р</td>
                            <td class="history__time"><?=time_of_betting(strtotime($value['date'])); ?></td>
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

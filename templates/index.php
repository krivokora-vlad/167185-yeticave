<section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <? foreach ($data['categories'] as $category): ?>
                <li class="promo__item promo__item--boards">
                    <a class="promo__link" href="all-lots.html"><?=$category['name']; ?></a>
                </li>
            <? endforeach; ?>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <? foreach ($data['announcements'] as $key => $item): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?=$item['image']; ?>" width="350" height="260" alt="<?=strip_tags($item['name']); ?>">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=$item['category']; ?></span>
                    <h3 class="lot__title">
                        <a class="text-link" href="lot.php?id=<?=$item['id']; ?>">
                            <?=strip_tags($item['name']); ?>
                        </a>
                    </h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?=(isset($item['price'])) ? $item['price'] : $item['price_start'] ; ?><b class="rub">р</b></span>
                        </div>
                        <div class="lot__timer timer">
                            <?=lot_expire_timer(strtotime($item['date_expire']));?>
                        </div>
                    </div>
                </div>
            </li>
            <? endforeach; ?>
        </ul>
    </section>
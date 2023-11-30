<section class="lots">
    <?php if (!empty($lots)) :?>
    <h2>Результаты поиска по запросу «<span><?= $search; ?></span>»</h2>
    <ul class="lots__list">
    <?php foreach ($lots as $item) : ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?= $item['lot_image'] ?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?= $item['category'] ?></span>
                    <h3 class="lot__title"><a class="text-link" href="lot.php?lot_id=<?= $item['id'] ?>"><?= $item['lot_name'] ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?= number_format($item['lot_rate'], 0, '', '&nbsp;') . '<b class="rub">р</b></span>'; ?>
                        </div>
                        <div class="lot__timer timer">
                            <?= $timeLeft; ?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php else : ?>
    <h2>В строке поиска не было обнаружено запроса</h2>
    <?php endif; ?>
</section>
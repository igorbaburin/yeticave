<div class="container">
    <section class="lots">
        <h2>История просмотров</h2>
        <ul class="lots__list">
            <?php if (!empty($history)) : ?>
                    <?php foreach ($history as $key) : ?>
                        <li class="lots__item lot">
                            <div class="lot__image">
                                <!-- сначала индекс массива к которому обращемся, затем ключ -->
                                <img src="<?= $goods[$key]['lot-image'] ?>" width="350" height="260" alt="">
                            </div>
                            <div class="lot__info">
                                <span class="lot__category"><?= $goods[$key]['category']  ?></span>
                                <h3 class="lot__title"><a class="text-link" href="/lot.php?lot_id=<?= $key ?>"><?= $goods[$key]['lot-name'] ?></a></h3>
                                <div class="lot__state">
                                    <div class="lot__rate">
                                        <span class="lot__amount">Стартовая цена</span>
                                        <span class="lot__cost"><?= $goods[$key]['lot-rate'] ?><b class="rub">р</b></span>
                                    </div>
                                    <div class="lot__timer timer">
                                        <?= $timeLeft; ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
            <?php else : ?>
                <h4>Ваша история пуста, вы еще ничего не просмотрели...</h4>
            <?php endif; ?>
        </ul>
    </section>
    <!-- <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
        <li class="pagination-item pagination-item-active"><a>1</a></li>
        <li class="pagination-item"><a href="#">2</a></li>
        <li class="pagination-item"><a href="#">3</a></li>
        <li class="pagination-item"><a href="#">4</a></li>
        <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
    </ul> -->
</div>
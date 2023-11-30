<section class="lot-item container">
  <h2><?= $lot['lot_name'] ?></h2>
  <div class="lot-item__content">
    <div class="lot-item__left">
      <div class="lot-item__image">
        <img src="<?= $lot['lot_image'] ?>" width="730" height="548" alt="Сноуборд">
      </div>
      <p class="lot-item__category">Категория: <span><?= $lot['category'] ?></span></p>
      <p class="lot-item__description"><?= $lot['lot_message'] ?></p>
    </div>
    <div class="lot-item__right">
      <div class="lot-item__state">
        <div class="lot-item__timer timer">
          <?= $timeLeft; ?>
        </div>
        <div class="lot-item__cost-state">
          <div class="lot-item__rate">
            <span class="lot-item__amount">Текущая цена</span>
            <span class="lot-item__cost"><?= $lot['lot_rate'] ?></span>
          </div>
          <div class="lot-item__min-cost">
            Мин. ставка <span>12 000 р</span>
          </div>
        </div>
        <form class="lot-item__form" action="" method="post">
          <p class="lot-item__form-item">
            <label for="cost">Ваша ставка</label>
            <input id="cost" type="number" name="cost" placeholder="<?= $result['cost'] ?>">
            <span class="form__error"><?= $errors['cost'] ?? ''; ?></span>
          </p>
          <button type="submit" class="button">Сделать ставку</button>
        </form>
      </div>
      <div class="history">
        <h3>История ставок (<span><?= count($rows)?></span>)</h3>
        <table class="history__list">
          <?php foreach ($rows as $item) :?>
          <tr class="history__item">
            <td class="history__name"><?= $item['b_username']?></td>
            <td class="history__price"><?= $item['b_price']?></td>
            <td class="history__time"><?= $item['b_date']?></td>
          </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>
  </div>
</section>
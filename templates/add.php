<form class="form form--add-lot container <?= isset($errors['form-invalid']) ? 'form--invalid' : ''; ?>" action="/add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
  <h2>Добавление лота</h2>
  <div class="form__container-two">
    <div class="form__item <?= isset($errors['lot-name']) ? 'form__item--invalid' : ''; ?>">
      <label for="lot-name">Наименование</label>
      <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?= $result['lot-name'] ?>">
      <span class="form__error"><?= $errors['lot-name'] ?? ''; ?></span>
    </div>
    <div class="form__item <?=isset($errors['category']) ? 'form__item--invalid' : ''; ?>">
      <label for="category">Категория</label>
      <select id="category" name="category">
        <option selected="" disabled>...</option>
        <?php foreach ($categories as $name) {
          $select = ($result['category'] === $name) ? 'selected' : '';
          echo "<option {$select}>{$name}</option>";
        } ?>
      </select>
      <span class="form__error"><?= $errors['category'] ?? ''; ?></span>
    </div>
  </div>
  <div class="form__item form__item--wide <?= isset($errors['message']) ? 'form__item--invalid' : ''; ?>">
    <label for="message">Описание</label>
    <textarea id="message" name="message" placeholder="Напишите описание лота"><?= $result['message'] ?></textarea>
    <span class="form__error"><?= $errors['message'] ?? ''; ?></span>
  </div>
  <div class="form__item form__item--file"> <!-- form__item--uploaded -->
    <label>Изображение (макс. 2Мб)</label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <img src="<?= $result['lot-image'] ?>" width="113" height="113" alt="Изображение лота">
      </div>
    </div>
    <div class="form__input-file">
      <input class="visually-hidden" type="file" name="lot-image" id="photo2" value="">
      <label for="photo2">
        <span>+ Добавить</span>
      </label>
    </div>
    <span class="form__error"><?= $errors['lot-image'] ?? ''; ?></span>
  </div>
  <div class="form__container-three">
    <div class="form__item form__item--small <?= isset($errors['lot-rate']) ? 'form__item--invalid' : ''; ?>">
      <label for="lot-rate">Начальная цена</label>
      <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?= $result['lot-rate'] ?>">
      <span class="form__error"><?= $errors['lot-rate'] ?? ''; ?></span>
    </div>
    <div class="form__item form__item--small <?= isset($errors['lot-step']) ? 'form__item--invalid' : ''; ?>">
      <label for="lot-step">Шаг ставки</label>
      <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?= $result['lot-step'] ?>">
      <span class="form__error"><?= $errors['lot-step'] ?? ''; ?></span>
    </div>
    <div class="form__item <?= isset($errors['lot-date']) ? 'form__item--invalid' : ''; ?>">
      <label for="lot-date">Дата окончания торгов</label>
      <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?= $result['lot-date'] ?>">
      <span class="form__error"><?= $errors['lot-date'] ?? ''; ?></span>
    </div>
  </div>
  <span class="form__error">Пожалуйста, исправьте ошибки в форме.</span>  
  <button type="submit" class="button">Добавить лот</button>
</form>
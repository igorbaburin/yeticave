<form class="form container" action="" method="post"> <!-- form--invalid -->
    <h2>Регистрация нового аккаунта</h2>
    <div class="form__item <?= isset($errors['email']) ? 'form__item--invalid' : ''; ?>"> <!-- form__item--invalid -->
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" placeholder="<?= $result['email'] ?>" >
      <span class="form__error"><?= $errors['email'] ?? ''; ?></span>
    </div>
    <div class="form__item <?= isset($errors['password']) ? 'form__item--invalid' : ''; ?>">
      <label for="password">Пароль*</label>
      <input id="password" type="password" name="password" placeholder="<?= $result['password'] ?>" >
      <span class="form__error"><?= $errors['password'] ?? ''; ?></span>
    </div>
    <div class="form__item <?= isset($errors['name']) ? 'form__item--invalid' : ''; ?>">
      <label for="name">Имя*</label>
      <input id="name" type="text" name="name" placeholder="<?= $result['name'] ?>">
      <span class="form__error"><?= $errors['name'] ?? ''; ?></span>
    </div>
    <div class="form__item form__item--file form__item--last">
      <label>Аватар</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="img/avatar.jpg" width="113" height="113" alt="Ваш аватар">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" id="photo2" value="">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
    </div>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="/login.php">Уже есть аккаунт</a>
  </form>
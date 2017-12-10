<?=$main_nav;?>
<?php $class_error = ((!empty($errors)) ? 'form--invalid' : ''); ?>
<form class="form container <?=$class_error;?>" method="post"> <!-- form--invalid -->
    <h2>Вход</h2>
    <?php $class_error = (isset($errors['email']) ? 'form__item--invalid' : ''); ?>
    <div class="form__item <?=$class_error;?>"> <!-- form__item--invalid -->
        <label for="email">E-mail*</label>
        <?php $value = (!empty($email) ? $email : ''); ?>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=htmlspecialchars($value);?>" required>
        <?php $span_error = (isset($errors['email']) ? $errors['email'] : ''); ?>
        <span class="form__error"><?=$span_error;?></span>
    </div>
    <?php $class_error = (isset($errors['password']) ? 'form__item--invalid' : ''); ?>
    <div class="form__item form__item--last <?=$class_error;?>">
        <label for="password">Пароль*</label>
        <input id="password" type="text" name="password" placeholder="Введите пароль" required>
        <?php $span_error = (isset($errors['password']) ? $errors['password'] : ''); ?>
        <span class="form__error"><?=$span_error;?></span>
    </div>
    <button type="submit" class="button">Войти</button>
</form>
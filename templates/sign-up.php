<?=$main_nav;?>
<?php $class_error = ((!empty($errors)) ? 'form--invalid' : ''); ?>
<form class="form container <?=$class_error;?>" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Регистрация нового аккаунта</h2>
    <?php $class_error = (isset($errors['email']) ? 'form__item--invalid' : ''); ?>
    <div class="form__item <?=$class_error;?>"> <!-- form__item--invalid -->
        <label for="email">E-mail*</label>
        <?php $value = (isset($value_field['email']) ? $value_field['email'] : ''); ?>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=htmlspecialchars($value);?>" required>
        <?php $span_error = (isset($errors['email']) ? $errors['email'] : ''); ?>
        <span class="form__error"><?=$span_error;?></span>
    </div>
    <?php $class_error = (isset($errors['password']) ? 'form__item--invalid' : ''); ?>
    <div class="form__item <?=$class_error;?>">
        <label for="password">Пароль*</label>
        <?php $value = (isset($value_field['password']) ? $value_field['password'] : ''); ?>
        <input id="password" type="text" name="password" placeholder="Введите пароль" value="<?=htmlspecialchars($value);?>" required>
        <?php $span_error = (isset($errors['password']) ? $errors['password'] : ''); ?>
        <span class="form__error"><?=$span_error;?></span>
    </div>
    <?php $class_error = (isset($errors['name']) ? 'form__item--invalid' : ''); ?>
    <div class="form__item <?=$class_error;?>">
        <label for="name">Имя*</label>
        <?php $value = (isset($value_field['name']) ? $value_field['name'] : ''); ?>
        <input id="name" type="text" name="name" placeholder="Введите имя" value="<?=htmlspecialchars($value);?>" required>
        <?php $span_error = (isset($errors['name']) ? $errors['name'] : ''); ?>
        <span class="form__error"><?=$span_error;?></span>
    </div>
    <?php $class_error = (isset($errors['message']) ? 'form__item--invalid' : ''); ?>
    <div class="form__item <?=$class_error;?>">
        <label for="message">Контактные данные*</label>
        <?php $value = (isset($value_field['message']) ? $value_field['message'] : ''); ?>
        <textarea id="message" name="message" placeholder="Напишите как с вами связаться" required><?=htmlspecialchars($value);?></textarea>
        <?php $span_error = (isset($errors['message']) ? $errors['message'] : ''); ?>
        <span class="form__error"><?=$span_error;?></span>
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
        <?php $span_error = (isset($errors['file']) ? $errors['file'] : ''); ?>
        <span class="form__error"><?=$span_error;?></span>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="../login.php">Уже есть аккаунт</a>
</form>

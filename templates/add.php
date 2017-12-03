<?=$main_nav;?>
<?php $class_error = ((!empty($errors)) ? 'form--invalid' : ''); ?>
<form class="form form--add-lot container <?=$class_error;?>" action="../add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
        <?php $class_error = (isset($errors['lot-name']) ? 'form__item--invalid' : ''); ?>
        <div class="form__item <?=$class_error;?>"> <!-- form__item--invalid -->
            <label for="lot-name">Наименование</label>
            <?php $value = (isset($value_field['lot-name']) ? $value_field['lot-name'] : ''); ?>
            <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=htmlspecialchars($value);?>" required>
            <?php $span_error = (isset($errors['lot-name']) ? $errors['lot-name'] : ''); ?>
            <span class="form__error"><?=$span_error;?></span>
        </div>
        <?php $class_error = (isset($errors['category']) ? 'form__item--invalid' : ''); ?>
        <div class="form__item <?=$class_error;?>">
            <label for="category">Категория</label>
            <select id="category" name="category" required>
                <option value="">Выберите категорию</option>
                <?php foreach ($category_list as $key => $val): ?>
                    <?php $value_category = ((isset($value_field['category'])&&($value_field['category']==$val)) ? 'selected' : ''); ?>
                    <option <?=$value_category;?>> <?=$val; ?></option>
                <?php endforeach; ?>
            </select>
            <?php $span_error = (isset($errors['category']) ? $errors['category'] : ''); ?>
            <span class="form__error"><?=$span_error;?></span>
        </div>
    </div>
    <?php $class_error = (isset($errors['message']) ? 'form__item--invalid' : ''); ?>
    <div class="form__item form__item--wide <?=$class_error;?>">
        <label for="message">Описание</label>
        <?php $value = (isset($value_field['message']) ? $value_field['message'] : ''); ?>
        <textarea id="message" name="message" placeholder="Напишите описание лота" required><?=htmlspecialchars($value);?></textarea>
        <?php $span_error = (isset($errors['message']) ? $errors['message'] : ''); ?>
        <span class="form__error"><?=$span_error;?></span>
    </div>
    <?php $class_error = (isset($errors['file']) ? 'form__item--invalid' : ''); ?>
    <div class="form__item form__item--file <?=$class_error;?>"> <!-- form__item--uploaded -->
        <label>Изображение</label>
        <div class="preview">
            <button class="preview__remove" type="button">x</button>
            <div class="preview__img">
                <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
            </div>
        </div>
        <div class="form__input-file">
            <input class="visually-hidden" name="file" type="file" id="photo2" value="" required>
            <label for="photo2">
                <span>+ Добавить</span>
            </label>
        </div>
        <?php $span_error = (isset($errors['file']) ? $errors['file'] : ''); ?>
        <span class="form__error"><?=$span_error;?></span>
    </div>
    <div class="form__container-three">
        <?php $class_error = (isset($errors['lot-rate']) ? 'form__item--invalid' : ''); ?>
        <div class="form__item form__item--small <?=$class_error;?>">
            <label for="lot-rate">Начальная цена</label>
            <?php $value = (isset($value_field['lot-rate']) ? $value_field['lot-rate'] : ''); ?>
            <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?=htmlspecialchars($value);?>" required>
            <?php $span_error = (isset($errors['lot-rate']) ? $errors['lot-rate'] : ''); ?>
            <span class="form__error"><?=$span_error;?></span>
        </div>
        <?php $class_error = (isset($errors['lot-step']) ? 'form__item--invalid' : ''); ?>
        <div class="form__item form__item--small <?=$class_error;?>">
            <label for="lot-step">Шаг ставки</label>
            <?php $value = (isset($value_field['lot-step']) ? $value_field['lot-step'] : ''); ?>
            <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?=htmlspecialchars($value);?>" required>
            <?php $span_error = (isset($errors['lot-step']) ? $errors['lot-step'] : ''); ?>
            <span class="form__error"><?=$span_error;?></span>
        </div>
        <?php $class_error = (isset($errors['lot-date']) ? 'form__item--invalid' : ''); ?>
        <div class="form__item <?=$class_error;?>">
            <label for="lot-date">Дата окончания торгов</label>
            <?php $value = (isset($value_field['lot-date']) ? $value_field['lot-date'] : ''); ?>
            <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?=htmlspecialchars($value);?>" required>
            <?php $span_error = (isset($errors['lot-date']) ? $errors['lot-date'] : ''); ?>
            <span class="form__error"><?=$span_error;?></span>
        </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
</form>
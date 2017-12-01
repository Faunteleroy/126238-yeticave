<?php
require_once('functions.php');
require_once('data.php');

$layout_index = false;

$main_nav_content = renderTemplate('templates/main-nav.php', []);

$required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
$errors =[];
$dict = [
    'message' =>  "Напишите описание лота",
    'lot-rate' => "Введите начальную цену, используя только цифры",
    'lot-step' => "Введите шаг ставки, используя только цифры",
    'lot-date' => "Введите дату завершения торгов",
    'category' => "Выберите категорию",
    'lot-name' => "Введите наименование лота"
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_lot = $_POST;

    foreach ($_POST as $key => $value) {
        if (in_array($key, $required)) {
            if (!$value) {
                $errors[$key] = $dict[$key];
            }
        }
    }

    if (isset($_FILES['file']['name'])) {
        $tmp_name = $_FILES['file']['tmp_name'];
        $path = $_FILES['file']['name'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);
        if ($file_type !== "image/img" or $file_type !== "image/png") {
            $errors['file'] = 'Загрузите файл в формате img/png';
        }
        else {
            move_uploaded_file($tmp_name, 'img/' . $path);
            $new_lot['img'] = $path;
        }
    } else {
        $errors['file'] = 'Вы не загрузили файл';
    }


    if (count($errors)) {

        $page_content = renderTemplate('templates/add.php', [
            'ads_list' => $ads_list,
            'category_list' => $category_list,
            'main_nav' => $main_nav_content,
            'errors' => $errors,
            'value_field' => $new_lot]);
    }
    else {
        $new_lot['price'] = $_POST['lot-rate'];
        $page_content = renderTemplate('templates/lot.php', [
            'ads_list' => $ads_list,
            'category_list' => $category_list,
            'main_nav' => $main_nav_content,
            'new_lot' => $lot
        ]);
    }
}
else {
    $page_content = renderTemplate('templates/add.php', [
        'ads_list' => $ads_list,
        'category_list' => $category_list,
        'main_nav' => $main_nav_content,
        'errors' => $errors,
        'new_lot' => $value_field
    ]);
}


$layout_content  = renderTemplate('templates/layout.php', [
    'content' => $page_content,
    'title' => 'Добавление лота',
    'user_name' => $user_name,
    'user_avatar' => $user_avatar,
    'is_auth' => $is_auth,
    'layout_index' => $layout_index
]);

print($layout_content);



<?php
require_once('functions.php');
require_once('data.php');

$layout_index = false;

$name_field = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
$errors =[];
$errors_templates = [
    'message' =>  "Напишите описание лота",
    'lot-rate' => "Введите начальную цену, используя только цифры",
    'lot-step' => "Введите шаг ставки, используя только цифры",
    'lot-date' => "Введите дату завершения торгов",
    'category' => "Выберите категорию",
    'lot-name' => "Введите наименование лота",
    'file' => "Загрузите картинку товара"
];
$value_field =[];

$main_nav_content = renderTemplate('templates/main-nav.php', []);

if (isset($_POST)) {
    foreach ($name_field as $value) {
        $error = null;
        if (isset($_POST[$value])) {
            if (($value == 'lot-rate') or ($value == 'lot-step')) {
                $error = (ctype_digit($_POST[$value])? null : $errors_templates[$value]);
            }
            if ($error == null) {
                $value_field[$value] = $_POST[$value];
            }
        } else {
            $error = $errors_templates[$value];
        }
        if (isset($error)) {
            $errors[$value] = $error;
        }
    };
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        move_uploaded_file ( $file,'/img' );
    } else {
        $errors['file'] = $errors_templates['file'];
    }
    if (isset($errors)) {
        $page_content = renderTemplate('templates/add.php', ['ads_list' => $ads_list, 'category_list' => $category_list, 'main_nav' => $main_nav_content, 'errors' => $errors, '$value_field' => $value_field]);
    } else {
        $bets =[];
        $file_name = '/img'.$file['name'];
        $lot = [
            'name' => $_POST['name'],
            'category' => $_POST['category'],
            'price' => $_POST['lot-rate'],
            'img' => $file_name
        ];
        $page_content = renderTemplate('templates/lot.php', ['ads_list' => $ads_list, 'category_list' => $category_list, 'main_nav' => $main_nav_content, 'lot' => $lot, 'bets' => $bets]);
    }
} else {
    $page_content = renderTemplate('templates/add.php', ['ads_list' => $ads_list, 'category_list' => $category_list, 'main_nav' => $main_nav_content, 'errors' => $errors, 'value_field' => $value_field]);
}


$layout_content  = renderTemplate('templates/layout.php', ['content' => $page_content, 'title' => 'Добавление лота', 'user_name' => $user_name, 'user_avatar' => $user_avatar, 'is_auth' => $is_auth, 'layout_index' => $layout_index]);

print($layout_content);



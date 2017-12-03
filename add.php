<?php
require_once('functions.php');
require_once('data.php');

$layout_index = false;

$main_nav_content = renderTemplate('templates/main-nav.php', []);

$required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
$dict = [
    'message' =>  "Напишите описание лота",
    'lot-rate' => "Введите начальную цену, используя только цифры",
    'lot-step' => "Введите шаг ставки, используя только цифры",
    'lot-date' => "Введите дату завершения торгов",
    'category' => "Выберите категорию",
    'lot-name' => "Введите наименование лота"
];
$number_field = ['lot-rate','lot-step'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_lot = $_POST;
    $errors =[];

    foreach ($_POST as $key => $value) {
        if (in_array($key, $required)) {
            if (!$value) {
                $errors[$key] = $dict[$key];
            }
        }
        if (in_array($key, $number_field)) {
            if (!is_numeric($value)) {
                $errors[$key] = $dict[$key];
            }
        }
    }

    if (!empty($_FILES['file']['name'])) {
        $tmp_name = $_FILES['file']['tmp_name'];
        $path = $_FILES['file']['name'];
        $supported_types = ['image/png', 'image/jpeg', 'image/jpg'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);

        if (!in_array($file_type, $supported_types)) {
            $errors['file'] = 'Загрузите файл в формате png, jpg или jpeg';
        }
        else {
            move_uploaded_file($tmp_name, 'img/' . $path);
            $new_lot['img'] = 'img/' . $path;
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
            'value_field' => $new_lot
        ]);
    }
    else {
        $lot = [
            'name' => $new_lot['lot-name'],
            'category' => $new_lot['category'],
            'price' => $_POST['lot-rate'],
            'img' => $new_lot['img']
        ];
        $page_content = renderTemplate('templates/lot.php', [
            'ads_list' => $ads_list,
            'category_list' => $category_list,
            'main_nav' => $main_nav_content,
            'lot' => $lot,
            'bets' => []
        ]);
    }
}
else {
    $page_content = renderTemplate('templates/add.php', [
        'ads_list' => $ads_list,
        'category_list' => $category_list,
        'main_nav' => $main_nav_content,
        'errors' => [],
        'value_field' => []
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



<?php
require_once('data.php');
require_once('functions.php');
require_once('mysql_helper.php');
require_once ('init.php');

$layout_index = false;

$main_nav_content = renderTemplate('templates/main-nav.php', ['category_list' => $category_list]);

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;

    $required = ['email', 'password'];
    $dict = [
        'email' =>  "Введите e-mail",
        'password' => "Введите пароль"
    ];
    $errors = [];

    foreach ($_POST as $key => $value) {
        if (in_array($key, $required)) {
            if (!$value) {
                $errors[$key] = $dict[$key];
            }
        }
    }

    if ($user = searchUserByEmail($form['email'], $users)) {
        if (password_verify($form['password'], $user['password'])) {
            $_SESSION['user'] = $user;
        }
        else {
            $errors['password'] = 'Неверный пароль';
        }
    }
    else {
        $errors['email'] = 'Такой пользователь не найден';
    }

    $email = isset($_POST['email']) ? $_POST['email'] : null;

    if (count($errors)) {
        $page_content = renderTemplate('templates/login.php', [
            'ads_list' => $ads_list,
            'category_list' => $category_list,
            'main_nav' => $main_nav_content,
            'errors' => $errors,
            'email' => $email
        ]);
    }
    else {
        header("Location: /index.php");
        exit();
    }
}
else {
    $page_content = renderTemplate('templates/login.php', [
        'ads_list' => $ads_list,
        'category_list' => $category_list,
        'main_nav' => $main_nav_content
    ]);
}

$layout_content  = renderTemplate('templates/layout.php', [
    'content' => $page_content,
    'title' => 'Вход',
    'user_name' => $user_name,
    'user_avatar' => $user_avatar,
    'is_auth' => $is_auth,
    'layout_index' => $layout_index,
    'main_nav' => $main_nav_content
]);

print($layout_content);


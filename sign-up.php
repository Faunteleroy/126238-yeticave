<?php
require_once('data.php');
require_once('functions.php');
require_once('mysql_helper.php');
require_once ('init.php');

$layout_index = false;

session_start();

$main_nav_content = renderTemplate('templates/main-nav.php', ['category_list' => $category_list]);

if (isset($_SESSION['user'])) {
    $error = 'Вы уже вошли';

    $page_content = renderTemplate('templates/error.php', [
        'category_list' => $category_list,
        'main_nav' => $main_nav_content,
        'error' => $error
    ]);

    $layout_content  = renderTemplate('templates/layout.php', [
        'content' => $page_content,
        'title' => 'Ошибка',
        'user_name' => $user_name,
        'user_avatar' => $user_avatar,
        'is_auth' => $is_auth,
        'layout_index' => $layout_index,
        'main_nav' => $main_nav_content
    ]);
    print ($layout_content);
    exit();
}

$required = ['email', 'password', 'name', 'message'];
$dict = [
    'email' =>  "Введите e-mail",
    'password' => "Введите пароль",
    'name' => "Введите имя",
    'message' => "Напишите как с вами связатьсяв",
    'email-registered' => "Пользователь с таким e-mail уже существует",
    'email-invalid' => "Такой e-mail не существует"
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_account = $_POST;
    $errors =[];

    foreach ($_POST as $key => $value) {
        if (in_array($key, $required)) {
            if (!$value) {
                $errors[$key] = $dict[$key];
            }
        }
        if ($key == 'email') {
            $sql_user = "SELECT id FROM users WHERE email = '$value'";
            $user_registered = mysqli_query($con, $sql_user);

            if ($user_registered) {
                $errors['email'] = $dict['email-registered'];
            }
            $email_real = filter_var($value, FILTER_VALIDATE_EMAIL);
            if (!$email_real) {
                $errors['email'] = $dict['email-invalid'];
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
            $new_account['img'] = 'img/' . $path;
        }
    }

    if (count($errors)) {

        $page_content = renderTemplate('templates/sign-up.php', [
            'ads_list' => $ads_list,
            'category_list' => $category_list,
            'main_nav' => $main_nav_content,
            'errors' => $errors,
            'value_field' => $new_account
        ]);
    }
    else {
        $safe_email = mysqli_real_escape_string($con, $_POST['email']);
        $safe_name = mysqli_real_escape_string($con, $_POST['name']);
        $safe_password = mysqli_real_escape_string($con, password_hash($_POST['password']));
        $safe_contacts = mysqli_real_escape_string($con, $_POST['message']);
        $avatar = isset($new_account['img']);
        $sql = "INSERT INTO users (email, name, password, avatar, contacts)
                VALUES ('$safe_email', '$safe_name', '$safe_password', $avatar ,$safe_contacts)";
}


}
else {
    $page_content = renderTemplate('templates/sign-up.php', [
        'ads_list' => $ads_list,
        'category_list' => $category_list,
        'main_nav' => $main_nav_content,
        'errors' => [],
        'value_field' => []
    ]);
}


$layout_content  = renderTemplate('templates/layout.php', [
    'content' => $page_content,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar,
    'title' => 'Регистрация',
    'is_auth' => $is_auth,
    'layout_index' => $layout_index,
    'main_nav' => $main_nav_content
]);

print($layout_content);
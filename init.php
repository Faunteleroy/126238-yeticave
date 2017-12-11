<?php

require_once('functions.php');
require_once('data.php');
require_once('mysql_helper.php');

error_reporting(0);

$con = mysqli_connect("localhost", "root", "", "yeticave");
mysqli_set_charset($con, 'utf8');

if (!$con) {
    $error = mysqli_connect_error();

    $main_nav_content = renderTemplate('templates/main-nav.php', [
        'category_list' => $category_list]);

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
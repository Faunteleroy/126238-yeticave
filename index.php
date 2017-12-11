<?php
session_start();

require_once('functions.php');
require_once('data.php');
require_once('mysql_helper.php');
require_once ('init.php');

// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');

// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = "00:00";

// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');

// временная метка для настоящего времени
$now = strtotime('now');

define("SECONDS_IN_H", 3600);
define("SECONDS_IN_M", 60);

$count_hour = floor(($tomorrow - $now) / SECONDS_IN_H);
$count_hour = str_pad($count_hour, 2, "0", STR_PAD_LEFT);
$count_min = floor((($tomorrow - $now) % SECONDS_IN_H) / SECONDS_IN_M);
$count_min = str_pad($count_min, 2, "0", STR_PAD_LEFT);
$lot_time_remaining = $count_hour . ":" . $count_min;
// далее нужно вычислить оставшееся время до начала следующих суток и записать его в переменную $lot_time_remaining

$layout_index = true;

$main_nav_content = renderTemplate('templates/main-nav.php', ['category_list' => $category_list]);
$page_content = renderTemplate('templates/index.php', [
    'ads_list' => $ads_list,
    'category_list' => $category_list,
    'lot_time_remaining' => $lot_time_remaining
]);
$layout_content  = renderTemplate('templates/layout.php', [
    'content' => $page_content,
    'title' => 'Главная',
    'user_name' => $user_name,
    'user_avatar' => $user_avatar,
    'is_auth' => $is_auth,
    'layout_index' => $layout_index,
    'main_nav' => $main_nav_content
]);

print($layout_content);


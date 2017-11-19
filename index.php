<?php
// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');

// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = "00:00";

// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');

// временная метка для настоящего времени
$now = strtotime('now');

define("SECONDS_IN_HOUR", 3600);
define("SECONDS_IN_MIN", 60);

$count_hour = floor(($tomorrow - $now) / SECONDS_IN_HOUR);
$count_hour = str_pad($count_hour, 2, "0", STR_PAD_LEFT);
$count_min = floor((($tomorrow - $now) % SECONDS_IN_HOUR) / SECONDS_IN_MIN);
$count_min = str_pad($count_min, 2, "0", STR_PAD_LEFT);
$lot_time_remaining = $count_hour . ":" . $count_min;
// далее нужно вычислить оставшееся время до начала следующих суток и записать его в переменную $lot_time_remaining

require_once('functions.php');
require_once('data.php');

$page_content = renderTemplate('templates/index.php', ['ads_list' => $ads_list, 'category_list' => $category_list, 'lot_time_remaining' => $lot_time_remaining]);
$layout_content  = renderTemplate('templates/layout.php', ['content' => $page_content, 'title' => 'Главная', 'user_name' => $user_name, 'user_avatar' => $user_avatar, 'is_auth' => $is_auth]);
print($layout_content);


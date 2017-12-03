<?php
require_once('data.php');

// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

define("SECONDS_IN_MIN", 60);
define("SECONDS_IN_HOUR", 3600);
define("SECONDS_IN_DAY", 86400);

function bets_time($time_label) {
    $now = strtotime('now');

    $count_time = $now - $time_label;

    if ($count_time > SECONDS_IN_DAY) {
        $bet_time = date("d.m.y \в H:i", $time_label);
    }
    else if ($count_time >= SECONDS_IN_HOUR) {
        $count_hour = floor(($now - $time_label) / SECONDS_IN_HOUR);
        $bet_time = $count_hour . " часов назад";
    }
    else {
        $count_min = floor((($now - $time_label) % SECONDS_IN_HOUR) / SECONDS_IN_MIN);
        $bet_time = $count_min . " минут назад";
    }

    return $bet_time;
}

$lot = null;

if (isset($_GET['id'])) {
    $lot_id = $_GET['id'];

    if (isset($ads_list[$lot_id])) {
        $lot = $ads_list[$lot_id];
    } else {
        http_response_code(404);
    }
}

$layout_index = false;

require_once('functions.php');

$main_nav_content = renderTemplate('templates/main-nav.php', []);
$page_content = renderTemplate('templates/lot.php', [
    'ads_list' => $ads_list,
    'category_list' => $category_list,
    'main_nav' => $main_nav_content,
    'lot' => $lot,
    'bets' => $bets
]);
$layout_content  = renderTemplate('templates/layout.php', [
    'content' => $page_content,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar,
    'title' => $lot['name'],
    'is_auth' => $is_auth,
    'layout_index' => $layout_index
]);

print($layout_content);


<?php
require_once('data.php');
require_once('functions.php');
require_once('mysql_helper.php');
require_once ('init.php');

$layout_index = false;

session_start();

// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

$lot = null;
$lot_id = null;

if (isset($_GET['id'])) {
    $lot_id = $_GET['id'];
    if (isset($ads_list[$lot_id])) {
        $lot = $ads_list[$lot_id];
    } else {
        http_response_code(404);
    }
}

$bet_lot = isset($_COOKIE['bet-' . $lot_id]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (($_POST['cost'] > 0)&&(is_numeric($_POST['cost']))) {
        $bet = [
            'id' => $lot_id,
            'price' => $_POST['cost'],
            'time' => $_SERVER['REQUEST_TIME']
        ];
        setcookie('bet-' . $lot_id, json_encode($bet), strtotime("+30 days"));
        header('Location: mylots.php');
        exit();
    }
}

$main_nav_content = renderTemplate('templates/main-nav.php', ['category_list' => $category_list]);
$page_content = renderTemplate('templates/lot.php', [
    'ads_list' => $ads_list,
    'category_list' => $category_list,
    'main_nav' => $main_nav_content,
    'lot' => $lot,
    'bets' => $bets,
    'bet_lot' => $bet_lot
]);
$layout_content  = renderTemplate('templates/layout.php', [
    'content' => $page_content,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar,
    'title' => $lot['name'],
    'is_auth' => $is_auth,
    'layout_index' => $layout_index,
    'main_nav' => $main_nav_content
]);

print($layout_content);


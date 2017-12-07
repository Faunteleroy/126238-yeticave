<?php
require_once('data.php');
require_once('functions.php');

$layout_index = false;

$my_bets =[];
$lots_count = count($ads_list);
for ($id = 0; $id < $lots_count; $id ++) {
    if (isset($_COOKIE['bet-' . $id])) {
        $bet = json_decode($_COOKIE['bet-' . $id], true);
        $bet['name'] = $ads_list[$val['name']];
        $bet['category'] = $ads_list[$val['category']];
        $bet['img'] = $ads_list[$val['img']];
        $my_bets[$key] = $bet;
    }
}

$main_nav_content = renderTemplate('templates/main-nav.php', ['category_list' => $category_list]);

$page_content = renderTemplate('templates/mylots.php', [
    'ads_list' => $ads_list,
    'category_list' => $category_list,
    'main_nav' => $main_nav_content,
    'my_bets' => $my_bets
]);

$layout_content  = renderTemplate('templates/layout.php', [
    'content' => $page_content,
    'user_name' => $user_name,
    'user_avatar' => $user_avatar,
    'title' => 'Мои ставки',
    'is_auth' => $is_auth,
    'layout_index' => $layout_index,
    'main_nav' => $main_nav_content
]);

print($layout_content);
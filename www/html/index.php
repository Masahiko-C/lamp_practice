<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$sort = get_get('sort');

$items = get_open_items($db, $sort);
$items_num = count($items);
$max_page = get_max_page($items);

$now_page = get_page_id();

$start = ($now_page - 1) * PAGE_MAX + 1;

$end = min($now_page * PAGE_MAX, $items_num);

$disp_data = get_disp_data($items, $now_page);

$ranks = get_ranking($db);

$token = get_csrf_token();

include_once VIEW_PATH . 'index_view.php';
<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'purchases.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

if($user['type'] === USER_TYPE_ADMIN){
  $purchases = get_purchases_all($db);
} else {
  $purchases = get_purchases($db, $user['user_id']);
}

$token = get_csrf_token();

include_once VIEW_PATH . 'purchases_view.php';
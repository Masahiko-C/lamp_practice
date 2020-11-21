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
$token = get_post('token');

if(is_valid_csrf_token($token)){
$order_number = get_post('order_number');

$purchases = get_purchases_by_number($db, $order_number);

$details = array();
$details = get_purchase_details($db, $order_number);

} else {
    set_error('不正な操作が行われました。');
    redirect_to('purchases.php');
}

include_once VIEW_PATH . 'purchase_details_view.php';
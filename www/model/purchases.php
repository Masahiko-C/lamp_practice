<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function get_purchases_all($db) {
    $sql = "
        SELECT
            purchases.order_number,
            purchases.purchase_date,
            sum(purchase_details.price * purchase_details.quantity) as amount
        FROM
            purchases
        JOIN
            purchase_details
        ON
            purchases.order_number = purchase_details.order_number
        GROUP BY
            order_number
        ORDER BY order_number DESC;
        ";
        return fetch_all_query($db, $sql);
}

function get_purchases($db, $user_id){
    $sql = "
    SELECT
        purchases.order_number,
        purchases.purchase_date,
        sum(purchase_details.price * purchase_details.quantity) as amount
    FROM
        purchases
    JOIN
        purchase_details
    ON
        purchases.order_number = purchase_details.order_number
    WHERE
        purchases.user_id = ?
    GROUP BY
        order_number
    ORDER BY order_number DESC;
        ";
    return fetch_all_query($db, $sql, [$user_id]);
  }

function get_purchases_by_number($db, $order_number){
    $sql = "
        SELECT
            purchases.order_number,
            purchases.purchase_date,
            sum(purchase_details.price * purchase_details.quantity) as amount
        FROM
            purchases
        JOIN
            purchase_details
        ON
            purchases.order_number = purchase_details.order_number
        WHERE
            purchases.order_number = ?
        GROUP BY
            order_number;
        ";
    return fetch_query($db, $sql, [$order_number]);
}

function get_purchase_details($db, $order_number){
    $sql = "
        SELECT
            items.name,
            purchase_details.price,
            purchase_details.quantity
        FROM
            purchase_details
        JOIN
            items
        ON
            purchase_details.item_id = items.item_id
        WHERE
            order_number = ?
        ";
    return fetch_all_query($db, $sql, [$order_number]);
}
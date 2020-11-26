<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include VIEW_PATH. 'templates/head.php'; ?>
    <title>購入履歴</title>
    <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'purchases.css'); ?>">
</head>
<body>
  <?php 
  include VIEW_PATH . 'templates/header_logined.php'; 
  ?>
    <h1>購入明細</h1>
    <div class="container">

      <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <?php if(isset($purchases)) {?>
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>注文番号</th>
            <th>購入日時</th>
            <th>合計金額</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php print $purchases['order_number']; ?></td>
            <td><?php print $purchases['purchase_date']; ?></td>
            <td><?php print $purchases['amount']; ?></td>
          </tr>
        </tbody>
      </table>

      <table class="table table-bordered">
        <thead class="thead-light">
          <th>商品名</th>
          <th>購入時の商品価格</th>
          <th>購入数</th>
          <th>小計</th>
        </thead>
        <tbody>
          <?php foreach($details as $detail){ ?>
            <tr>
              <td><?php print $detail['name']; ?></td>
              <td><?php print $detail['price']; ?></td>
              <td><?php print $detail['quantity']; ?></td>
              <td><?php print $detail['price'] * $detail['quantity']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <?php } else {
      set_error('購入履歴がないため、明細を表示できません');
      redirect_to('purchases.php');
    }?>

</body>
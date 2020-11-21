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
  <h1>購入履歴</h1>
  <div class="container">

    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <?php if(count($purchases) > 0){ ?>  
        <table class="table table-bordered">
            <thead class="thead-light">
            <tr>
                <th>注文番号</th>
                <th>購入日時</th>
                <th>該当の注文の合計金額</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($purchases as $purchase){ ?>
                <tr>
                    <td><?print $purchase['order_number']; ?></td>
                    <td><?print $purchase['purchase_date']; ?></td>
                    <td><?print number_format($purchase['amount']); ?>円</td>
                    <td>

                    <form method="post" action="purchase_details.php">
                        <input type="submit" value="購入明細表示" class="btn btn-secondary">
                        <input type="hidden" name="order_number" value="<?php print $purchase['order_number']; ?>">
                        <input type="hidden" name="token" value="<?php print $token; ?>">
                    </form>

                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
    <p>購入履歴はありません。</p>
    <?php } ?>
</div> 

</body>
</html>
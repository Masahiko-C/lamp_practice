<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>商品一覧</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'index.css'); ?>">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  
  <div class="container">
    <h1>商品一覧</h1>

    <div class="text-right">
    <form method="get">
      <select name="sort" id="sort">
        <option value="new_arrive" selected>新着順</option>
        <option value="high_price">価格が高い順</option>
        <option value="low_price">価格が安い順</option>
      </select>
      <input type="hidden" name="page_id" value="1">
    </form>
    </div>
    <script>

    function sort () {
      $.ajax({
        type: "get",
        url: "index.php",
        data: {sort:$("#sort").val()},
        datatype: "HTML",
        success : function(data, dataType) {
        //HTMLファイル内の該当箇所にレスポンスデータを追加する場合
        document.write(data);
        },
        //処理がエラーであれば
        error : function() {
        alert('通信エラー');
      }
      });
    }
    $(function(){
      $('#sort').change(sort);
    });
    </script>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <div class="card-deck">
      <div class="row">
      <?php foreach($disp_data as $item){ ?>
        <div class="col-6 item">
          <div class="card h-100 text-center">
            <div class="card-header">
              <?php print(h($item['name'])); ?>
            </div>
            <figure class="card-body">
              <img class="card-img" src="<?php print(IMAGE_PATH . $item['image']); ?>">
              <figcaption>
                <?php print(number_format($item['price'])); ?>円
                <?php if($item['stock'] > 0){ ?>
                  <form action="index_add_cart.php" method="post">
                    <input type="submit" value="カートに追加" class="btn btn-primary btn-block">
                    <input type="hidden" name="item_id" value="<?php print($item['item_id']); ?>">
                    <input type="hidden" name="token" value="<?php print($token); ?>">
                  </form>
                <?php } else { ?>
                  <p class="text-danger">現在売り切れです。</p>
                <?php } ?>
              </figcaption>
            </figure>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>
    <div>
      <span><?php print $items_num; ?>件中
      <?php print $start; ?> -
      <?php print $end; ?>件目の商品</span>
      <?php if ($now_page > 1) { ?>
        <span><a href="?sort=<?php print $sort; ?>&page_id=<?php print ($now_page - 1); ?>">前へ</a>
      <?php } else { ?>
        <span>前へ</span>
      <?php } ?>
      
      <?php for($i = 1; $i <= $max_page; $i++){
        if($i == $now_page) { ?>
        <span><?php print $now_page. ' ';?></span>
        <?php } else { ?>
        <a href="?sort=<?php print $sort; ?>&page_id=<?php print $i ; ?>"><?php print $i ; ?></a>
        <?php }
      } ?>

      <?php if($now_page < $max_page) { ?>
        <span><a href="?sort=<?php print $sort; ?>&page_id=<?php print ($now_page + 1); ?>">次へ</a></span>
      <?php } else { ?>
        <span>次へ</span>
      <?php } ?>
    </div>
    <div>
        <h3>人気ランキング</h3>
        <ol>
        <?php foreach($ranks as $rank) { ?>
          <li><?php print $rank['name']; ?></li>
        <?php } ?>
        </ol>
      </div>
  </div>
</body>
</html>
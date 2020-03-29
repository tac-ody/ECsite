<?php
session_start();
$pdo = new PDO("mysql:host=127.0.0.1;dbname=ecsite;charset=utf8","root","");

// 今の日時を取得
$today = date('Y-m-d H:i:s');

// 現在の売価変更取得するsqlかく
$sql = "SELECT * FROM selling_price JOIN item ON selling_price.foreign_item_id = item.item_id
                                    JOIN genre ON item.genre_id = genre.id
                                    JOIN maker ON item.maker_id = maker.id
                                    JOIN brand ON item.brand_id = brand.id
                                    WHERE start_datetime < '$today' AND end_datetime > '$today'";
$item_data_present = $pdo->query($sql);
$item_all_present = $item_data_present->fetchAll();

// 未来の売価変更取得するsqlかく
$sql = "SELECT * FROM selling_price JOIN item ON selling_price.foreign_item_id = item.item_id
                                    JOIN genre ON item.genre_id = genre.id
                                    JOIN maker ON item.maker_id = maker.id
                                    JOIN brand ON item.brand_id = brand.id
                                    WHERE start_datetime NOT BETWEEN '2020-02-01 00:00:00' AND '$today'";
$item_data_future = $pdo->query($sql);
$item_all_future = $item_data_future->fetchAll();
// 過去の売価変更取得するsqlかく
$sql = "SELECT * FROM selling_price JOIN item ON selling_price.foreign_item_id = item.item_id
                                    JOIN genre ON item.genre_id = genre.id
                                    JOIN maker ON item.maker_id = maker.id
                                    JOIN brand ON item.brand_id = brand.id
                                    WHERE end_datetime BETWEEN '2020-02-01 00:00:00' AND '$today'";
$item_data_past = $pdo->query($sql);
$item_all_past = $item_data_past->fetchAll();

// 検索ボックスのジャンル名、メーカー名、ブランド名をSELECT取得
$sql = "SELECT * FROM genre";
$genre = $pdo->query($sql);
$genre_name = $genre->fetchAll();

$sql = "SELECT * FROM maker";
$maker = $pdo->query($sql);
$maker_name = $maker->fetchAll();

$sql = "SELECT * FROM brand";
$brand = $pdo->query($sql);
$brand_name = $brand->fetchAll();
 ?>

 <!DOCTYPE html>
 <html lang="ja" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="css/sidebar_selling_price_edit.css">
     <link rel="stylesheet" href="css/pagination_contents.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script type="text/javascript" src="js/jquery.pagination.js"></script>
     <script type="text/javascript" src="js/selling_price_edit_pagination.js"></script>
     <script type="text/javascript" src="js/sidebar_selling_price_edit.js"></script>
     <script type="text/javascript" src="js/sidebar_selling_price_edit_search.js"></script>
     <title>売価管理修正</title>
   </head>
   <body>
     <?php
     include ('header.php');
     include ('sidebar.php');
     ?>
    <div id="contents">
      <h1 id="title">売価管理修正</h1>
         <div id="item_search">
           <input type="text" id="item_name" name="item_name" value="" placeholder="商品名を入力してください">
           <select id="item_genre" name="item_genre">
               <option value="">ジャンル名を選択してください</option>
             <?php foreach($genre_name as $genre) { ?>
               <option value="<?php echo $genre['genre_name']?>" ><?php echo $genre['genre_name']?></option>
             <?php } ?>
           </select>
           <select id="item_maker" name="item_maker">
               <option value="">メーカー名を選択してください</option>
             <?php foreach($maker_name as $maker) { ?>
               <option value="<?php echo $maker['maker_name']?>" ><?php echo $maker['maker_name']?></option>
             <?php } ?>
           </select>
           <select id="item_brand" name="item_brand">
               <option value="">ブランド名を選択してください</option>
             <?php foreach($brand_name as $brand) { ?>
               <option value="<?php echo $brand['brand_name']?>" ><?php echo $brand['brand_name']?></option>
             <?php } ?>
           </select>
           <input type="text" id="item_price" name="item_price" value="" placeholder="価格を入力してください">円
           <br>
           <input type="button" id="button_search" name="button_search" value="検索">
         </div>
         <br>
<div class="items">
    <!-- 現在売価変更中の商品一覧 -->
    <div class="item-list present">
      <p class="subtitle">現在売価変更中の商品一覧</p>
      <div class="column-title">
        <div class="column-title_individual">
          <div class="space">
          <span>画像</span>
          </div>
          <div class="text-information">
            <span>商品名</span>
          </div>
          <div class="text-information">
            <span>ジャンル</span>
          </div>
          <div class="text-information">
            <span>メーカー</span>
          </div>
          <div class="text-information">
            <span>ブランド</span>
          </div>
          <div class="text-information">
              <span>金額</span>
          </div>
          <div class="text-information">
              <span>開始日</span>
          </div>
          <div class="text-information">
              <span>終了予定日</span>
          </div>
        </div>
      </div>
      <?php foreach ($item_all_present as $value): ?>
      <form class="item-list_line present_line" method="post">

        <input type="hidden" name="item_id" value="<?php echo $value["item_id"]; ?>">
        <input type="hidden" name="start_datetime" value="<?php echo $value["start_datetime"]; ?>">
        <input type="hidden" name="end_datetime" value="<?php echo $value["end_datetime"]; ?>">
        <input type="hidden" name="price" value="<?php echo $value["price"]; ?>">
        <input type="hidden" name="selling_price_id" value="<?php echo $value["selling_price_id"]; ?>">
        <input type="hidden" name="changed_selling_price" value="<?php echo $value["changed_selling_price"]; ?>">

        <img src=<?php echo $value["image_path"]; ?> alt="商品画像">
        <div class="text-information">
          <?php echo $value["item_name"]; ?>
        </div>
        <div class="text-information">
          <?php echo $value["genre_name"]; ?>
        </div>
        <div class="text-information">
          <?php echo $value["maker_name"]; ?>
        </div>
        <div class="text-information">
          <?php echo $value["brand_name"]; ?>
        </div>
        <div class="text-information">
          <?php echo $value["changed_selling_price"]; ?>円
        </div>

        <div class="text-information">
          <?php echo $value["start_datetime"]; ?>
        </div>～
        <div class="text-information">
          <?php echo $value["end_datetime"]; ?>
        </div>

        <div class="text-information item-edit-price-change">
          <input type="submit" class="item-edit-price-change_submit" formaction="selling_price_edit.php" value="売価管理修正">
          <input type="submit" class="item-edit-price-change_submit" formaction="selling_price_regist.php" value="売価管理登録">
        </div>
      </form>
      <?php endforeach; ?>
    </div>


    <!-- 将来売価変更予定の商品一覧 -->
    <div class="item-list future">
      <p class="subtitle">売価変更が予定されている商品一覧</p>
      <div class="column-title">
        <div class="column-title_individual">
          <div class="space">
          <span>画像</span>
          </div>
          <div class="text-information">
            <span>商品名</span>
          </div>
          <div class="text-information">
            <span>ジャンル</span>
          </div>
          <div class="text-information">
            <span>メーカー</span>
          </div>
          <div class="text-information">
            <span>ブランド</span>
          </div>
          <div class="text-information">
              <span>金額</span>
          </div>
          <div class="text-information">
              <span>開始予定日</span>
          </div>
          <div class="text-information">
              <span>終了予定日</span>
          </div>
        </div>
      </div>
      <?php foreach ($item_all_future as $value): ?>
      <form class="item-list_line future_line" action="selling_price_regist.php" method="post">

        <input type="hidden" name="item_id" value="<?php echo $value["item_id"]; ?>">
        <input type="hidden" name="start_datetime" value="<?php echo $value["start_datetime"]; ?>">
        <input type="hidden" name="end_datetime" value="<?php echo $value["end_datetime"]; ?>">
        <input type="hidden" name="price" value="<?php echo $value["price"]; ?>">
        <input type="hidden" name="selling_price_id" value="<?php echo $value["selling_price_id"]; ?>">
        <input type="hidden" name="changed_selling_price" value="<?php echo $value["changed_selling_price"]; ?>">

        <img src=<?php echo $value["image_path"]; ?> alt="商品画像">
        <div class="text-information">
          <?php echo $value["item_name"]; ?>
        </div>
        <div class="text-information">
          <?php echo $value["genre_name"]; ?>
        </div>
        <div class="text-information">
          <?php echo $value["maker_name"]; ?>
        </div>
        <div class="text-information">
          <?php echo $value["brand_name"]; ?>
        </div>
        <div class="text-information">
          <?php echo $value["changed_selling_price"]; ?>円
        </div>

        <div class="text-information">
          <?php echo $value["start_datetime"]; ?>
        </div>～
        <div class="text-information">
          <?php echo $value["end_datetime"]; ?>
        </div>

        <div class="text-information item-edit-price-change">
          <input type="submit" class="item-edit-price-change_submit" formaction="selling_price_edit.php" value="売価管理修正">
          <input type="submit" class="item-edit-price-change_submit" formaction="selling_price_regist.php" value="売価管理登録">
        </div>
      </form>
      <?php endforeach; ?>
    </div>

    <!-- 既に売価変更が終了した商品一覧 -->
    <div class="item-list past">
      <p class="subtitle">売価変更が終了した商品一覧</p>
      <div class="column-title">
        <div class="column-title_individual">
          <div class="space">
          <span>画像</span>
          </div>
          <div class="text-information">
            <span>商品名</span>
          </div>
          <div class="text-information">
            <span>ジャンル</span>
          </div>
          <div class="text-information">
            <span>メーカー</span>
          </div>
          <div class="text-information">
            <span>ブランド</span>
          </div>
          <div class="text-information">
              <span>金額</span>
          </div>
          <div class="text-information">
              <span>開始日</span>
          </div>
          <div class="text-information">
              <span>終了日</span>
          </div>
        </div>
      </div>
      <?php foreach ($item_all_past as $value): ?>
      <form class="item-list_line past_line" action="selling_price_regist.php" method="post">

        <input type="hidden" name="item_id" value="<?php echo $value["item_id"]; ?>">
        <input type="hidden" name="start_datetime" value="<?php echo $value["start_datetime"]; ?>">
        <input type="hidden" name="end_datetime" value="<?php echo $value["end_datetime"]; ?>">
        <input type="hidden" name="price" value="<?php echo $value["price"]; ?>">
        <input type="hidden" name="selling_price_id" value="<?php echo $value["selling_price_id"]; ?>">
        <input type="hidden" name="changed_selling_price" value="<?php echo $value["changed_selling_price"]; ?>">

        <img src=<?php echo $value["image_path"]; ?> alt="商品画像">
        <div class="text-information">
          <?php echo $value["item_name"]; ?>
        </div>
        <div class="text-information">
          <?php echo $value["genre_name"]; ?>
        </div>
        <div class="text-information">
          <?php echo $value["maker_name"]; ?>
        </div>
        <div class="text-information">
          <?php echo $value["brand_name"]; ?>
        </div>
        <div class="text-information">
          <?php echo $value["changed_selling_price"]; ?>円
        </div>

        <div class="text-information">
          <?php echo $value["start_datetime"]; ?>
        </div>～
        <div class="text-information">
          <?php echo $value["end_datetime"]; ?>
        </div>

        <div class="text-information item-edit-price-change">
          <input type="submit" class="item-edit-price-change_submit" formaction="selling_price_regist.php" value="売価管理登録">
        </div>
      </form>
      <?php endforeach; ?>
    </div>
   </div>
   </div>
  </body>
 </html>

<?php
$item_name = $_POST["item_name"];
$genre_name = $_POST["genre_name"];
$maker_name = $_POST["maker_name"];
$brand_name = $_POST["brand_name"];
$price = $_POST["price"];
// $search_start_datetime = $_POST['search_start_datetime'];
// $search_end_datetime = $_POST['search_end_datetime'];

// 今の日時を取得
$today = date('Y-m-d H:i:s');

$pdo = new PDO("mysql:host=127.0.0.1;dbname=ecsite;charset=utf8","root","");

// 現在の売価変更取得するsqlかく
$sql = "SELECT * FROM selling_price
          JOIN item ON selling_price.foreign_item_id = item.item_id
          JOIN genre ON item.genre_id = genre.id
          JOIN maker ON item.maker_id = maker.id
          JOIN brand ON item.brand_id = brand.id
          WHERE (item_name LIKE '%$item_name%')
          AND genre_name LIKE '%$genre_name%'
          AND maker_name LIKE'%$maker_name%'
          AND brand_name LIKE '%$brand_name%'
          AND changed_selling_price LIKE '%$price%'
          AND start_datetime < '$today' AND end_datetime > '$today' ";
$item_data_present = $pdo->query($sql);
$item_all_present = $item_data_present->fetchAll();

// 未来の売価変更取得するsqlかく
$sql = "SELECT * FROM selling_price
          JOIN item ON selling_price.foreign_item_id = item.item_id
          JOIN genre ON item.genre_id = genre.id
          JOIN maker ON item.maker_id = maker.id
          JOIN brand ON item.brand_id = brand.id
          WHERE (item_name LIKE '%$item_name%')
          AND genre_name LIKE '%$genre_name%'
          AND maker_name LIKE'%$maker_name%'
          AND brand_name LIKE '%$brand_name%'
          AND changed_selling_price LIKE '%$price%'
          AND start_datetime NOT BETWEEN '2020-02-01 00:00:00' AND '$today' ";
$item_data_future = $pdo->query($sql);
$item_all_future = $item_data_future->fetchAll();

// 過去の売価変更取得するsqlかく
$sql = "SELECT * FROM selling_price
          JOIN item ON selling_price.foreign_item_id = item.item_id
          JOIN genre ON item.genre_id = genre.id
          JOIN maker ON item.maker_id = maker.id
          JOIN brand ON item.brand_id = brand.id
          WHERE (item_name LIKE '%$item_name%')
          AND genre_name LIKE '%$genre_name%'
          AND maker_name LIKE'%$maker_name%'
          AND brand_name LIKE '%$brand_name%'
          AND changed_selling_price LIKE '%$price%'
          AND end_datetime BETWEEN '2020-02-01 00:00:00' AND '$today' ";
$item_data_past = $pdo->query($sql);
$item_all_past = $item_data_past->fetchAll();



// 現在売価変更中の商品一覧
if(!empty($item_all_present)) {
echo '<div class="item-list ">'
     .'<p class="subtitle">現在売価変更中の商品一覧</p>'
     .'<div class="column-title">'
      .'<div class="column-title_individual">'
       .'<div class="space">'
       .'<span>画像</span>'
        .'</div>'
        .'<div class="text-information">'
        .'<span>商品名</span>'
        .'</div>'
        .'<div class="text-information">'
        .'<span>ジャンル</span>'
        .'</div>'
        .'<div class="text-information">'
        .'<span>メーカー</span>'
        .'</div>'
        .'<div class="text-information">'
        .'<span>ブランド</span>'
        .'</div>'
        .'<div class="text-information">'
        .'<span>金額</span>'
        .'</div>'
        .'<div class="text-information">'
        .'<span>開始日</span>'
        .'</div>'
        .'<div class="text-information">'
        .'<span>終了予定日</span>'
        .'</div>'
        .'</div>'
        .'</div>';
    } else {
        echo '<p class="subtitle">現在売価変更中の商品一覧</p>';
        echo '<p>該当商品なし</p>';
    }
foreach($item_all_present as $value) {
  echo '<form class="item-list_line present_line" method="post">'
      .'<input type="hidden" name="item_id" value='.$value["item_id"].'>'
      .'<input type="hidden" name="item_id" value='.$value["start_datetime"].'>'
      .'<input type="hidden" name="item_id" value='.$value["end_datetime"].'>'
      .'<input type="hidden" name="item_id" value='.$value["price"].'>'
      .'<input type="hidden" name="item_id" value='.$value["selling_price_id"].'>'
      .'<img src='.$value["image_path"].' alt="商品画像">'
       .'<div class="text-information">'
        .$value["item_name"]
       .'</div>'
       .'<div class="text-information">'
        .$value["genre_name"]
       .'</div>'
       .'<div class="text-information">'
        .$value["maker_name"]
       .'</div>'
       .'<div class="text-information">'
        .$value["brand_name"]
       .'</div>'
       .'<div class="text-information">'
        .$value["changed_selling_price"].'円'
       .'</div>'
       .'<div class="text-information">'
        .$value["start_datetime"]
       .'</div>～'
       .'<div class="text-information">'
        .$value["end_datetime"]
       .'</div>'
       .'<div class="text-information item-edit-price-change">'
        .'<input type="submit" class="item-edit-price-change_submit" formaction="selling_price_edit.php" value="売価管理修正">'
        .'<input type="submit" class="item-edit-price-change_submit" formaction="selling_price_regist.php" value="売価管理登録">'
       .'</div>'
     .'</form>'
    .'</div>';
}


// 将来売価変更予定の商品一覧
if(!empty($item_all_future)) {
echo '<div class="item-list ">'
     .'<p class="subtitle">売価変更が予定されている商品一覧</p>'
     .'<div class="column-title">'
     .'<div class="column-title_individual">'
     .'<div class="space">'
     .'<span>画像</span>'
     .'</div>'
     .'<div class="text-information">'
     .'<span>商品名</span>'
     .'</div>'
     .'<div class="text-information">'
     .'<span>ジャンル</span>'
     .'</div>'
     .'<div class="text-information">'
     .'<span>メーカー</span>'
     .'</div>'
     .'<div class="text-information">'
     .'<span>ブランド</span>'
     .'</div>'
     .'<div class="text-information">'
     .'<span>金額</span>'
     .'</div>'
     .'<div class="text-information">'
     .'<span>開始予定日</span>'
     .'</div>'
     .'<div class="text-information">'
     .'<span>終了予定日</span>'
     .'</div>'
     .'</div>'
     .'</div>';
   } else {
     echo '<p class="subtitle">売価変更が予定されている商品一覧</p>';
     echo '<p>該当商品なし</p>';
   }
foreach($item_all_future as $value) {
  echo '<form class="item-list_line future_line" method="post">'
      .'<input type="hidden" name="item_id" value='.$value["item_id"].'>'
      .'<input type="hidden" name="item_id" value='.$value["start_datetime"].'>'
      .'<input type="hidden" name="item_id" value='.$value["end_datetime"].'>'
      .'<input type="hidden" name="item_id" value='.$value["price"].'>'
      .'<input type="hidden" name="item_id" value='.$value["selling_price_id"].'>'
      .'<img src='.$value["image_path"].' alt="商品画像">'
       .'<div class="text-information">'
        .$value["item_name"]
       .'</div>'
       .'<div class="text-information">'
        .$value["genre_name"]
       .'</div>'
       .'<div class="text-information">'
        .$value["maker_name"]
       .'</div>'
       .'<div class="text-information">'
        .$value["brand_name"]
       .'</div>'
       .'<div class="text-information">'
        .$value["changed_selling_price"].'円'
       .'</div>'
       .'<div class="text-information">'
        .$value["start_datetime"]
       .'</div>～'
       .'<div class="text-information">'
        .$value["end_datetime"]
       .'</div>'
       .'<div class="text-information item-edit-price-change">'
        .'<input type="submit" class="item-edit-price-change_submit" formaction="selling_price_edit.php" value="売価管理修正">'
        .'<input type="submit" class="item-edit-price-change_submit" formaction="selling_price_regist.php" value="売価管理登録">'
       .'</div>'
     .'</form>'
    .'</div>';
}


// 既に売価変更が終了した商品一覧
if(!empty($item_all_past)) {
echo '<div class="item-list ">'
     .'<p class="subtitle">売価変更が終了した商品一覧</p>'
     .'<div class="column-title">'
     .'<div class="column-title_individual">'
     .'<div class="space">'
     .'<span>画像</span>'
     .'</div>'
     .'<div class="text-information">'
     .'<span>商品名</span>'
     .'</div>'
     .'<div class="text-information">'
     .'<span>ジャンル</span>'
     .'</div>'
     .'<div class="text-information">'
     .'<span>メーカー</span>'
     .'</div>'
     .'<div class="text-information">'
     .'<span>ブランド</span>'
     .'</div>'
     .'<div class="text-information">'
     .'<span>金額</span>'
     .'</div>'
     .'<div class="text-information">'
     .'<span>開始日</span>'
     .'</div>'
     .'<div class="text-information">'
     .'<span>終了日</span>'
     .'</div>'
     .'</div>'
     .'</div>';
   } else {
       echo '<p class="subtitle">現在売価が終了した商品一覧</p>';
       echo '<p>該当商品なし</p>';
   }
foreach($item_all_past as $value) {
  echo '<form class="item-list_line past_line" method="post">'
      .'<input type="hidden" name="item_id" value='.$value["item_id"].'>'
      .'<input type="hidden" name="item_id" value='.$value["start_datetime"].'>'
      .'<input type="hidden" name="item_id" value='.$value["end_datetime"].'>'
      .'<input type="hidden" name="item_id" value='.$value["price"].'>'
      .'<input type="hidden" name="item_id" value='.$value["selling_price_id"].'>'
      .'<img src='.$value["image_path"].' alt="商品画像">'
       .'<div class="text-information">'
        .$value["item_name"]
       .'</div>'
       .'<div class="text-information">'
        .$value["genre_name"]
       .'</div>'
       .'<div class="text-information">'
        .$value["maker_name"]
       .'</div>'
       .'<div class="text-information">'
        .$value["brand_name"]
       .'</div>'
       .'<div class="text-information">'
        .$value["changed_selling_price"].'円'
       .'</div>'
       .'<div class="text-information">'
        .$value["start_datetime"]
       .'</div>～'
       .'<div class="text-information">'
        .$value["end_datetime"]
       .'</div>'
       .'<div class="text-information item-edit-price-change">'
        .'<input type="submit" class="item-edit-price-change_submit" formaction="selling_price_edit.php" value="売価管理修正">'
        .'<input type="submit" class="item-edit-price-change_submit" formaction="selling_price_regist.php" value="売価管理登録">'
       .'</div>'
     .'</form>'
    .'</div>';
}
?>

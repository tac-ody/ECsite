<?php
$item_name = $_POST["item_name"];
$genre_name = $_POST["genre_name"];
$maker_name = $_POST["maker_name"];
$brand_name = $_POST["brand_name"];
$price = $_POST["price"];

// 今の日時を取得
$today = date('Y-m-d H:i:s');

$pdo = new PDO("mysql:host=127.0.0.1;dbname=ecsite;charset=utf8","root","");

$sql = "SELECT * FROM item
          JOIN genre ON item.genre_id = genre.id
          JOIN maker ON item.maker_id = maker.id
          JOIN brand ON item.brand_id = brand.id
          WHERE (item_name LIKE '%$item_name%')
          AND genre_name LIKE '%$genre_name%'
          AND maker_name LIKE'%$maker_name%'
          AND brand_name LIKE '%$brand_name%'
          AND price LIKE '%$price%'
          ORDER BY item_id DESC";
$array = $pdo->query($sql);
$array_res = $array->fetchAll();

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
          AND start_datetime < '$today' AND end_datetime > '$today'
          ORDER BY item_id DESC";
$array_all = $pdo->query($sql);
$array_res_all = $array_all->fetchAll();

// foreach ($array_res as $value) {
//   foreach ($array_res_all as $value_all) {
//   if($value['item_id'] == $value_all['foreign_item_id']) {
//     $item_price = $value_all['changed_selling_price'];
//      break;
//   } elseif($value['item_id'] !== $value_all['foreign_item_id']) {
//     $item_price = $value['price'];
//      }
//   }
// }

if(empty($array_res) && empty($array_res_all)) {
  echo '<p>該当する商品がありません</p>';
  } else {
 foreach($array_res as $value) {
  echo '<form class="item-list" action="selling_price_regist.php" method="post">'
  // echo $value["item_name"];
     .'<div class="item-list_line">'
      .'<input type="hidden" name="item_id" value='.$value["item_id"].'>'
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
       .'<div class="text-information">';
       if(!empty($array_res_all)) {
        foreach ($array_res_all as $value_all) {
        if($value['item_id'] == $value_all['foreign_item_id']) {
          $item_price = $value_all['changed_selling_price'];
        } elseif ($value['item_name'] !== $value_all['item_name']) {
          $item_price = $value['price'];
        }
       }
      }
        if(empty($array_res_all)) {
            $item_price = $value['price'];
        }
        if(isset($item_price)) {
           echo $item_price.'円';
        }
  echo '</div>';
  echo '<a class="fas fa-shopping-cart"></a><input type="button" class="cart_item " value="商品をカゴに入れる">'
      .'</div>'
     .'</form>';
 }
}
?>

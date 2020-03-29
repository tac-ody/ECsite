<?php
$item_name = $_POST["item_name"];
$genre_name = $_POST["genre_name"];
$maker_name = $_POST["maker_name"];
$brand_name = $_POST["brand_name"];
$price = $_POST["price"];

$pdo = new PDO("mysql:host=127.0.0.1;dbname=ecsite;charset=utf8","root","");
$sql = "SELECT * FROM item
          JOIN genre ON item.genre_id = genre.id
          JOIN maker ON item.maker_id = maker.id
          JOIN brand ON item.brand_id = brand.id
          WHERE (item_name LIKE '%$item_name%')
          AND genre_name LIKE '%$genre_name%'
          AND maker_name LIKE'%$maker_name%'
          AND brand_name LIKE '%$brand_name%'
          AND price LIKE '%$price%'";
$array = $pdo->query($sql);
$array_res = $array->fetchAll();


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
       .'<div class="text-information">'
        .$value["price"].'円'
       .'</div>'
       .'<div class="text-information item-edit-price-change">'
        .'<input type="submit" class="item-edit-price-change_submit" formaction="selling_price_regist.php" value="売価管理登録">'
      . '</div>'
      .'</div>'
     .'</form>';
}

?>

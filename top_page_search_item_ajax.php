<?php
require("./common.php");
$item_name = $_POST["item_name"];
$genre_name = $_POST["genre_name"];
$maker_name = $_POST["maker_name"];
$brand_name = $_POST["brand_name"];
$price = $_POST["price"];

$array_res = item_search_all($item_name, $genre_name, $maker_name, $brand_name, $price);
foreach($array_res as $value) {
  // echo $value["item_name"];
  echo '<form class="item-list_line" action="item_edit_deletion.php" method="post">'
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
      .'<input type="submit" class="item-edit-price-change_submit" value="商品編集">'
      .'<input type="submit" class="item-edit-price-change_submit" formaction="" value="売価管理登録">'
      .'</div>'
      .'</div>'
      .'</form>';
}
?>



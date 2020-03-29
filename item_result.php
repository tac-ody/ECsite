<?php
session_start();
require("./common.php");
date_default_timezone_set('Asia/Tokyo');
$item_name = $_POST["item-name"];
$genre_id = $_POST["genre"];
$maker_id = $_POST["maker"];
$brand_id = $_POST["brand"];
$price = $_POST["price"];
$component = $_POST["component"];
$item_description = $_POST["description"];
//画像をリネームしてフォルダに保存
$date = date("YmdHis");
$image = $_FILES["image"]['tmp_name'];
$path = "./image/";
$image_path = $path."$date.jpg";
move_uploaded_file($image, $image_path);
$registration = item_registration($item_name, $genre_id, $maker_id, $brand_id, $price, $component, $item_description, $image_path);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/result.css">
  </head>
  <body>
    <?php include("./header.php") ?>
    <div class="risult">
      <?php include("./sidebar.php") ?>
      <div class="risult_contents">
        <?php echo $registration; ?>
      </div>
    </div>
  </body>
</html>

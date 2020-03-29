<?php
require("./common.php");
date_default_timezone_set('Asia/Tokyo');
if (empty($_FILES["image"]['tmp_name'])) {
  $image_path = $_POST["previous_image"];
} else {
  $image = $_FILES["image"]['tmp_name'];
  $path = "./image/";
  $date = date("YmdHis");
  $image_path = $path."$date.jpg";
  move_uploaded_file($image, $image_path);
  //元のファイルを削除
  unlink($_POST["previous_image"]);
}
$item_id = $_POST["item_id"];
$item_name = $_POST["item-name"];
$genre_id = $_POST["genre"];
$maker_id = $_POST["maker"];
$brand_id = $_POST["brand"];
$price = $_POST["price"];
$component = $_POST["component"];
$item_description = $_POST["description"];
$edit = item_edit($item_id, $item_name, $genre_id, $maker_id, $brand_id, $price, $component, $item_description, $image_path);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/maker_edit_result.css">
  </head>
  <body>
    <?php include("./header.php") ?>
    <div class="maker-edit-result">
      <?php include("./sidebar.php") ?>
      <div class="maker-edit-result_contents">
        <?php echo $edit; ?>
      </div>
    </div>
    <div id="button">
      <a href="top_page.php">
       <input type="button" id="top_page" name="top_page" value="トップページへ">
      </a>
    </div>
  </body>
</html>

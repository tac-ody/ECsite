<?php
session_start();
require("./common.php");
$maker_name = $_POST["maker-name"];
$brand_name = $_POST["brand-name"];
$previous_brand = $_POST["previous_brand"];
$edit = brand_name_edit($maker_name, $brand_name, $previous_brand);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/brand_edit_result.css">
  </head>
  <body>
    <?php include("./header.php") ?>
    <div class="brand-edit-result">
      <?php include("./sidebar.php") ?>
      <div class="brand-edit-result_contents">
        <?php echo $edit; ?>
      </div>
    </div>
    <div id="button">
      <a href="top_page.php">
       <input type="button" id="top_page" name="top_page" value="トップページへ">
      </a>
      <a href="brand_edit_deletion.php">
       <input type="button" id="regist_more" name="regist_more" value="前の画面に戻る">
     </a>
    </div>
  </body>
</html>

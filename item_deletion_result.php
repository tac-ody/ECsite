<?php
session_start();
require("./common.php");
$item_id = $_POST["item_id"];
$delete = item_delete($item_id);
// $delete = brand_name_delete($brand_name);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/brand_deletion_result.css">
  </head>
  <body>
    <?php include("./header.php") ?>
    <div class="brand-deletion-result">
      <?php include("./sidebar.php") ?>
      <div class="brand-deletion-result_contents">
        <?php echo $delete; ?>
      </div>
    </div>
    <div id="button">
      <a href="top_page.php">
       <input type="button" id="top_page" name="top_page" value="トップページへ">
      </a>
    </div>
  </body>
</html>

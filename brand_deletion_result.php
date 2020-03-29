<?php
session_start();
require("./common.php");
$brand_name = $_POST["brand-search"];
$delete = brand_name_delete($brand_name);
// foreach($delete as $a) {
//   echo $a["id"];
// }
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
      <div id="button">
        <a href="top_page.php">
         <input type="button" id="top_page" name="top_page" value="トップページへ">
        </a>
        <a href="brand_edit_deletion.php">
         <input type="button" id="regist_more" name="regist_more" value="前の画面に戻る">
       </a>
      </div>
    </div>
  </body>
</html>

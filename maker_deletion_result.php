<?php
session_start();
require("./common.php");
$makers = $_POST["maker-search"];
$makers_divide = explode(",", $makers);
$maker_id = $makers_divide[0];
$delete = maker_name_delete($maker_id);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/maker_deletion_result.css">
  </head>
  <body>
    <?php include("./header.php") ?>
    <div class="maker-deletion-result">
      <?php include("./sidebar.php") ?>
      <div class="maker-deletion-result_contents">
        <?php echo $delete; ?>
      </div>
    </div>
    <div id="button">
      <a href="top_page.php">
       <input type="button" id="top_page" name="top_page" value="トップページへ">
      </a>
      <a href="maker_edit_deletion.php">
       <input type="button" id="regist_more" name="regist_more" value="前の画面に戻る">
     </a>
    </div>
  </body>
</html>

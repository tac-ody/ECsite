<?php
session_start();
require("./common.php");
$maker_id = $_POST["id"];
$maker_name = $_POST["maker"];
$edit = maker_name_edit($maker_id, $maker_name);
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
      <a href="maker_edit_deletion.php">
       <input type="button" id="regist_more" name="regist_more" value="前の画面に戻る">
     </a>
    </div>
  </body>
</html>

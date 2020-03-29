<?php
session_start();
require("./common.php");
// $pdo = db_connect();
$array_res = maker_select_all();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/brand_edit_deletion.css">
    <script src="js/brand_edit.js"></script>
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script src="js/brabd_search_ajax.js"></script>
    <script src="js/brand_edit_deletion_check.js"></script>
  </head>
  <body>
    <?php include("./header.php") ?>
    <form class="brand-edit-deletion" action="brand_result.php" method="post" onsubmit="return brand_edit_deletion_check()">
      <?php include("./sidebar.php") ?>
      <div class="brand-edit-deletion_contents">
        <h1 class="brand-title">ブランドマスタ修正削除</h1>
        <div class="brand-search" id="brand-search">
          <select class="brand-search_registered" name="maker-search" id="registered">
            <option value="">---</option>
            <?php foreach($array_res as $value): ?>
              <option value=<?php echo $value["maker_name"] ?>><?php echo $value["maker_name"]?></option>
            <?php endforeach ?>
          </select>
          <select class="brand-search_registered" name="brand-search" id="brand-registered">
            <option value="">---</option>
          </select>
          <div class="to_result_screen" id="change_button">
            <input type="button" class="edit_deletion" id="edit_button" value="修正" onclick="change_input()">
            <input type="submit" class="edit_deletion" id="deletion_button" formaction="brand_deletion_result.php" value="削除">
          </div>
        </div>
      </div>
    </form>
  </body>
</html>

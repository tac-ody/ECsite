<?php
session_start();
require("./common.php");
$array_res = maker_select_all();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/maker_edit_deletion.css">
    <script src="js/maker_edit.js"></script>
    <script src="js/maker_edit_deletion_check.js"></script>
  </head>
  <body>
    <?php include("./header.php") ?>
    <form class="maker-edit-deletion" action="maker_result.php" method="post" onsubmit="return maker_edit_deletion_check()">
      <?php include("./sidebar.php") ?>
      <div class="maker-edit-deletion_contents">
        <h1 class="maker-title">メーカーマスタ修正削除</h1>
        <div class="maker-search" id="maker-search">
          <select class="maker-search_registered" id="registered" name="maker-search">
            <option value="">---</option>
            <?php foreach($array_res as $value): ?>
              <option value="<?php echo $value["id"] ?>,<?php echo $value["maker_name"]?>"><?php echo $value["maker_name"]?></option>
            <?php endforeach ?>
          </select>
          <div class="to_result_screen" id="change_button">
            <input type="button" class="edit_deletion" id="edit_button" value="修正" onclick="change_input()">
            <input type="submit" class="edit_deletion" id="deletion_button" formaction="maker_deletion_result.php" value="削除">
          </div>
        </div>
      </div>
    </form>
  </body>
</html>

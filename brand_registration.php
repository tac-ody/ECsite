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
    <link rel="stylesheet" href="css/brand_registration.css">
    <script src="js/brand_registration_check.js"></script>
  </head>
  <body>
    <?php include("./header.php") ?>
    <form class="brand-registration" action="brand_result.php" method="post" onsubmit="return brand_registration_check()">
      <?php include("./sidebar.php") ?>
      <div class="brand-registration_contents">
        <h1 class="brand-title">ブランドマスタ登録</h1>
        <div class="brand-input">
          <select class="brand-input_text" name="maker">
            <option value="">---</option>
            <?php foreach($array_res as $value): ?>
              <option value=<?php echo $value["id"] ?>><?php echo $value["maker_name"] ?></option>
            <?php endforeach ?>
          </select>
          <input class="brand-input_text" type="text" name="brand" placeholder="ブランド名を入力してください">
          <input class="brand-input_button" type="submit" value="登録">
        </div>
      </div>
    </form>
  </body>
</html>

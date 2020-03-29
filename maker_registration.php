<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/maker_registratio.css">
    <script src="js/maker_registration_check.js"></script>
  </head>
  <body>
    <?php include("./header.php") ?>
    <form class="maker-registration" action="maker_result.php" method="post" onsubmit="return maker_registration_check()">
      <?php include("./sidebar.php") ?>
      <div class="maker-registration_contents">
        <h1 class="maker-title">メーカーマスタ登録</h1>
        <div class="maker-input">
          <input class="maker-input_text" type="text" name="maker" placeholder="メーカー名を入力してください">
          <input class="maker-input_button" type="submit" value="登録">
        </div>
      </div>
    </form>
  </body>
</html>

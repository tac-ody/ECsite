<?php
require("./common.php");
$maker_name = $_POST["maker"];
$registration = maker_name_registration($maker_name);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/result.css">
  </head>
  <body>
    <?php include("./header.php") ?>
    <div class="risult">
      <?php include("./sidebar.php") ?>
      <div class="risult_contents">
        <?php echo $registration; ?>
      </div>
    </div>
    <div id="button">
      <a href="top_page.php">
       <input type="button" id="top_page" name="top_page" value="トップページへ">
      </a>
      <a href="maker_registration.php">
       <input type="button" id="regist_more" name="regist_more" value="前の画面に戻る">
     </a>
    </div>
  </body>
</html>

<?php
session_start();
require("./common.php");
 $maker = maker_select_all();
 $genre = genre_select_all();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/item_registration.css">
    <script src="js/file_after_upload.js"></script>
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script src="js/item_registration_brand_search_ajax.js"></script>
    <script src="js/item_registration_check.js"></script>
  </head>
  <body>
    <?php include("./header.php") ?>
    <form class="item-registration" action="item_result.php" method="post" accept="image/*" enctype="multipart/form-data" onsubmit="return item_registration_check()">
      <?php include("./sidebar.php") ?>
      <div class="item-registration_contents">
        <h1 class="contents-title">商品登録</h1>
        <div class="contents-input">
          <div class="contents-input_text">
            <label for="file_upload">
              <span id="file_selection">ファイルを選択して下さい</span>
              <input type="file" id="file_upload" name="image" onchange="file_after_upload()">
            </label>
            <input type="text" class="search-item" name="item-name" value="" placeholder="商品名">
            <select class="search-item" name="genre">
              <option value="">---</option>
              <?php foreach ($genre as $value): ?>
                <option value=<?php echo $value["id"]; ?>><?php echo $value["genre_name"]; ?></option>
              <?php endforeach; ?>
            </select>
            <select class="search-item" name="maker" id="maker_name">
              <option value="">---</option>
              <?php foreach ($maker as $value): ?>
                <option value=<?php echo $value["id"]; ?>><?php echo $value["maker_name"]; ?></option>
              <?php endforeach; ?>
            </select>
            <select class="search-item" name="brand" id="brand_name">
              <option value="---">---</option>
            </select>
            <input type="text" class="search-item" name="price" value="" placeholder="金額">
            <span>円</span>
          </div>
          <textarea name="component" rows="8" cols="80" maxlength="1024" placeholder="成分"></textarea>
          <textarea name="description" rows="8" cols="80" maxlength="1024" placeholder="売り文句"></textarea>
          <input class="contents-input_button" type="submit" value="登録">
        </div>
      </div>
    </form>
  </body>
</html>

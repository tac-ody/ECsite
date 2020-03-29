<?php
session_start();
  require("./common.php");
  $item_id = $_POST["item_id"];
  $maker_all = maker_select_all();
  $genre_all = genre_select_all();
  $item = item_id_search($item_id);
  foreach ($item as $value) {
    $item_name = $value["item_name"];
    $genre = $value["genre_name"];
    $genre_id = $value["genre_id"];
    $maker = $value["maker_name"];
    $maker_id = $value["maker_id"];
    $brand = $value["brand_name"];
    $brand_id = $value["brand_id"];
    $price = $value["price"];
    $component = $value["component"];
    $item_description = $value["item_description"];
    $image_path = $value["image_path"];
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/item_registration.css">
    <script src="js/file_after_upload.js"></script>
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script src="js/item_edit_deletion_brand_search_ajax.js"></script>
  </head>
  <body>
    <?php include("./header.php") ?>
    <form class="item-registration" action="item_edit_result.php" method="post" accept="image/*" enctype="multipart/form-data">
      <?php include("./sidebar.php") ?>
      <div class="item-registration_contents">
        <h1 class="contents-title">商品編集削除</h1>
        <div class="contents-input">
          <div class="contents-input_image_text">
            現在の画像
          </div>
          <img class="contents-input_image" src=<?php echo $image_path; ?> alt="商品画像">
          <input type="hidden" name="previous_image" value=<?php echo $image_path; ?>>
          <div class="contents-input_text">
            <input type="hidden" name="item_id" value=<?php echo $item_id; ?>>
            <label for="file_upload">
              <span id="file_selection">ファイルを選択して下さい</span>
              <input type="file" id="file_upload" name="image" onchange="file_after_upload()">
            </label>
            <input type="text" class="search-item" name="item-name" value=<?php echo $item_name ?> placeholder="商品名">
            <select class="search-item" name="genre">
              <option value=<?php echo $genre_id; ?>><?php echo $genre; ?></option>
                <option value="">---</option>
              <?php foreach ($genre_all as $value): ?>
                <option value=<?php echo $value["id"]; ?>><?php echo $value["genre_name"]; ?></option>
              <?php endforeach; ?>
            </select>
            <select class="search-item" name="maker" id="registered">
              <option value=<?php echo $maker_id; ?>><?php echo $maker; ?></option>
              <option value="">---</option>
              <?php foreach ($maker_all as $value): ?>
                <option value=<?php echo $value["id"]; ?>><?php echo $value["maker_name"]; ?></option>
              <?php endforeach; ?>
            </select>
            <select class="search-item" name="brand" id="brand-registered">
              <option value=<?php echo $brand_id ?>><?php echo $brand ?></option>
            </select>
            <input type="text" class="search-item" name="price" value=<?php echo $price ?> placeholder="金額">
            <span>円</span>
          </div>
          <textarea name="component" rows="8" cols="80" maxlength="1024" placeholder="成分"><?php echo $component ?></textarea>
          <textarea name="description" rows="8" cols="80" maxlength="1024" placeholder="売り文句"><?php echo $item_description; ?></textarea>
          <div class="to_result_screen">
            <input class="contents-input_button contents-input_submit" type="submit" value="修正">
            <input class="contents-input_button contents-input_submit" type="submit" formaction="item_deletion_result.php" value="削除">
          </div>
        </div>
      </div>
    </form>
  </body>
</html>

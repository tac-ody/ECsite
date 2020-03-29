<?php
session_start();
require("./common.php");


//ログインチェック
if (isset($_POST["user_id"]) && isset($_POST["password"])) {
    $_SESSION["user_id"] = $_POST["user_id"];
    $_SESSION["password"] = $_POST["password"];
    $_SESSION["login_check"] = fetch_user_data($_SESSION["user_id"], $_SESSION["password"]);
  }
if ($_SESSION["login_check"] != 1) {
  $_SESSION["login_error_message"] = "入力された値が一致しません";
  header("Location: ./login_page.php");
  exit;
}

$array_res = item_select_all();
$maker = maker_select_all();
$genre = genre_select_all();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/top_page.css">
    <link rel="stylesheet" href="css/pagination_contents.css">
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="js/jquery.pagination.js"></script>
    <script src="js/top_page_pagination.js"></script>
    <script src="js/item_top_page_brand_search_ajax.js"></script>
    <script src="js/top_page_search_item.js"></script>
  </head>
  <body>
    <?php include("./header.php") ?>
    <form class="top-page" action="" method="post">
      <?php include("./sidebar.php") ?>
      <div class="top-page_contents">
        <h1 class="contents-title">トップぺージ</h1>
        <div class="contents-input">
          <div class="contents-input_text">
            <input type="text" class="search_item" id="item_name" name="name" value="" placeholder="商品名を入力してください">
            <select class="search_item" id="genre_name" name="genre">
              <option value="">---</option>
              <?php foreach ($genre as $value) :?>
                <option value=<?php echo $value["genre_name"] ?>><?php echo $value["genre_name"]; ?></option>
              <?php endforeach; ?>
            </select>
            <select class="search_item" id="maker_name" name="maker">
              <option value="">---</option>
              <?php foreach ($maker as $value) :?>
                <option value=<?php echo $value["maker_name"] ?>><?php echo $value["maker_name"] ?></option>
              <?php endforeach; ?>
            </select>
            <select class="search_item" id="brand_name" name="brand">
              <option value="">---</option>
            </select>
            <input type="text" class="search_item" id="item_price" name="price" value="" placeholder="価格を入力してください">
            <span>円</span>
          </div>
          <input class="contents-input_button" id="search_item_button" type="button" value="検索">
        </div>
      </div>
    </form>
    <div class="column-title">
      <div class="column-title_individual">
        <div class="space">
        <span>画像</span>
        </div>
        <div class="text-information">
          <span>商品名</span>
        </div>
        <div class="text-information">
          <span>ジャンル</span>
        </div>
        <div class="text-information">
          <span>メーカー</span>
        </div>
        <div class="text-information">
          <span>ブランド</span>
        </div>
        <div class="text-information">
            <span>金額</span>
        </div>
        <div class="text-information">
        </div>
      </div>
    </div>
    <div class="item-list">
      <?php foreach ($array_res as $value): ?>
      <form class="item-list_line" action="item_edit_deletion.php" method="post">
        <input type="hidden" name="item_id" value=<?php echo $value["item_id"]; ?>>
        <img src=<?php echo $value["image_path"]; ?> alt="商品画像">
        <div class="text-information">
          <?php echo $value["item_name"]; ?>
        </div>
        <div class="text-information">
          <?php echo $value["genre_name"]; ?>
        </div>
        <div class="text-information">
          <?php echo $value["maker_name"]; ?>
        </div>
        <div class="text-information">
          <?php echo $value["brand_name"]; ?>
        </div>
        <div class="text-information">
          <?php echo $value["price"]; ?>円
        </div>
        <div class="text-information item-edit-price-change">
          <input type="submit" class="item-edit-price-change_submit" value="商品編集">
          <input type="submit" class="item-edit-price-change_submit" formaction="selling_price_regist.php" value="売価管理登録">
        </div>
      </form>
      <?php endforeach; ?>
    </div>
  </body>
</html>

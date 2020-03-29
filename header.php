<?php
if (isset($_SESSION["user_id"]) && isset($_SESSION["password"])) {
  $logout_or_guest_page = "ログアウト";
  $transition_page = "login_page.php";
  $to_logout_page = "top_page.php";
} else {
  $logout_or_guest_page = "お客様ページ";
  $transition_page = "customer_page.php";
  $to_logout_page = "#";
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/header.css">
    <title></title>
  </head>
  <body>
    <div class="header">
      <a class=“top_link” href='<?php echo $to_logout_page; ?>'>
        <h1 class="header_title">ゼネックドラッグストア</h1>
      </a>
      <div class="logout">
        <!-- hrefの中にログインのファイル名を入れてください  -->
        <a href="<?php echo $transition_page; ?>">
          <button type="button" class="logout_button" name="button"><?php echo $logout_or_guest_page; ?></button>
        </a>
      </div>
    </div>
  </body>
</html>

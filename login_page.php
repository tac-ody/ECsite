<?php
session_start();

unset($_SESSION["user_id"]);
unset($_SESSION["password"]);

if (isset($_SESSION["login_error_message"])) {
  $message = $_SESSION["login_error_message"];
} else {
  $message = "";
}
//セッションがある時に削除
if (isset($_COOKIE["PHPSESSID"])) {
  setcookie("PHPSESSID", '', time() - 1800, '/');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/login_page.css">
</head>
<body>
  <?php include("./header.php") ?>
  <div class="login-contents">
    <h1 class="login-contents_title">管理者ログイン</h1>
    <form action="top_page.php" method="post">
      <?php echo $message; ?>
      <div class="input-form">
        <span>ユーザーID</span>
        <input class="input-form_box" type="text" name="user_id">
      </div>
      <div class="input-form">
        <span>パスワード</span>
        <input class="input-form_box" type="password" name="password">
      </div>
      <input class="login-submit" type="submit" value="ログイン">
    </form>
  </div>
</body>
</html>

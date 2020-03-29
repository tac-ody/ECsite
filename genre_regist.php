<?php
session_start();
 ?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/genre_regist.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>ジャンル新規登録</title>
  </head>
  <body>
    <?php
    include ('header.php');
    include ('sidebar.php');
    ?>
    <div id="main_contents">
      <h1>ジャンルマスタ登録</h1>
       <form method="POST" action="genre_regist_done.php">
        <div>
          <input type="text" id="input_genre" name="genre_name" size="20" placeholder="ジャンル名を入力してください">
          <br>
          <input type="submit" id="register_genre" value="登録">
        </div>
       </form>
    </div>
   <script type="text/javascript" src="js/genre_regist.js"></script>
  </body>
</html>

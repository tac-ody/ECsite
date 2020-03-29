<?php
session_start();

$pdo = new PDO("mysql:host=127.0.0.1;dbname=ecsite;charset=utf8","root","");

if(isset($_POST['start_datetime'])) {
  $start_datetime = $_POST['start_datetime'];
}
if(isset($_POST['end_datetime'])) {
  $end_datetime = $_POST['end_datetime'];
}
if(isset($_POST['selling_price'])) {
  $selling_price = $_POST['selling_price'];
}
if(isset($_POST['item_id'])) {
  $item_id = $_POST['item_id'];
}
// 今の日時を取得
$today = date('Y-m-d H:i:s');


// 1種類の商品すべての登録されている売価を参照するため、selling_price_idではなくitem_idでOK
$sql = "SELECT count(*) FROM selling_price
        WHERE (foreign_item_id = $item_id) AND (start_datetime BETWEEN '$start_datetime' AND '$end_datetime')
                                         OR (end_datetime BETWEEN '$start_datetime' AND '$end_datetime')";
$stmt = $pdo->query($sql);
$duplication = $stmt->fetch();

if($duplication['count(*)'] > 0) {
  $message = "登録済の売価変更と重複しています";
} else if ($today > $start_datetime) {
  $message = "売価変更開始日は現時刻以降の日時を指定してください";
} else if ($start_datetime > $end_datetime) {
  $message = "売価変更終了日は開始日以降の日時を指定してください";
} else {
 $sql = "INSERT INTO selling_price(start_datetime, end_datetime, changed_selling_price, foreign_item_id)
         VALUES(:start_datetime, :end_datetime, :changed_selling_price ,:foreign_item_id)";
 $stmt = $pdo->prepare($sql); //挿入する値は空のまま、SQL実行の準備をする
 $stmt->bindParam(':start_datetime',$start_datetime ,PDO::PARAM_STR);  // 挿入する変数をパラメータにバインドする
 $stmt->bindParam(':end_datetime',$end_datetime ,PDO::PARAM_STR);  // 挿入する変数をパラメータにバインドする
 $stmt->bindParam(':changed_selling_price',$selling_price ,PDO::PARAM_STR);  // 挿入する変数をパラメータにバインドする
 $stmt->bindParam(':foreign_item_id',$item_id ,PDO::PARAM_STR);  // 挿入する変数をパラメータにバインドする
 $stmt -> execute(); //挿入する値が入った変数をexecuteにセットしてSQLを実行
 $message = "売価変更登録が完了しました";
 }
 ?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/genre_edit_delete_done.css">
    <title>売価管理登録結果</title>
  </head>
  <body>
    <?php
    include ('header.php');
    include ('sidebar.php');
    ?>
    <div id="genre_done_message">
      <h1><?php echo $message ?></h1>
    </div>
    <div id="button">
      <a href="top_page.php">
       <input type="button" id="top_page" name="top_page" value="トップページへ">
      </a>
      <a href="sidebar_selling_price_regist.php">
       <input type="button" id="regist_more" name="regist_more" value="前の画面に戻る">
     </a>
    </div>
  </body>
</html>

<?php
session_start();

$pdo = new PDO("mysql:host=127.0.0.1;dbname=ecsite;charset=utf8","root","");

// 商品IDと入力した開始日、終了日、価格、修正対象の主キーをPOSTで取得
if(isset($_POST['item_id'])){
  $item_id = $_POST['item_id'];
}
if(isset($_POST['start_datetime'])){
  $start_datetime = $_POST['start_datetime'];
}
if(isset($_POST['end_datetime'])){
  $end_datetime = $_POST['end_datetime'];
}
if(isset($_POST['price'])){
  $price = $_POST['price'];
}
if(isset($_POST['selling_price'])){
  $selling_price = $_POST['selling_price'];
}
if(isset($_POST['selling_price_id'])){
  $selling_price_id = $_POST['selling_price_id'];
}
// 今の日時を取得
$today = date('Y-m-d H:i:s');

// 削除ボタンがPOSTされた場合
if(isset($_POST['selling_price_delete'])) {
 $sql = "DELETE FROM selling_price WHERE selling_price_id = :id";
 $stmt = $pdo->prepare($sql); //削除するレコードのIDは空のまま、SQL実行の準備をする
 $params = array(':id'=>$selling_price_id); // 削除するレコードのIDを配列に格納する
 $stmt -> execute($params); //削除するレコードのIDが入った変数をexecuteにセットしてSQLを実行
 $message = "削除が完了しました";
}


// 修正ボタンがPOSTされた場合
if(isset($_POST['selling_price_edit'])) {
// 期間の重複がないか判定
// 1種類の商品すべての登録されている売価を参照するため、selling_price_idではなくitem_idでOK
  $sql = "SELECT count(*) FROM selling_price
          WHERE foreign_item_id = $item_id AND start_datetime BETWEEN '$start_datetime' AND '$end_datetime'
                                           OR end_datetime BETWEEN '$start_datetime' AND '$end_datetime'";
  $stmt = $pdo->query($sql);
  $duplication = $stmt->fetch();

  if($duplication['count(*)'] > 0) {
    $message = "登録済の売価変更と重複しています";
  } elseif ($today > $start_datetime) {
    $message = "売価変更開始日は現時刻以降の日時を指定してください";
  } elseif ($start_datetime > $end_datetime) {
    $message = "売価変更終了日は開始日以降の日時を指定してください";
  } else {
   $sql = "UPDATE selling_price SET start_datetime = :start_datetime,
                                    end_datetime = :end_datetime,
                                    changed_selling_price = :changed_selling_price
                                    WHERE selling_price_id = :selling_price_id";
   $stmt = $pdo->prepare($sql); //挿入する値は空のまま、SQL実行の準備をする
   $stmt->bindParam(':start_datetime',$start_datetime ,PDO::PARAM_STR);  // 挿入する変数（開始日）をパラメータにバインドする
   $stmt->bindParam(':end_datetime',$end_datetime ,PDO::PARAM_STR);  // 挿入する変数（終了日）をパラメータにバインドする
   $stmt->bindParam(':changed_selling_price',$selling_price ,PDO::PARAM_STR);  // 挿入する変数（売価変更価格）をパラメータにバインドする
   $stmt->bindParam(':selling_price_id',$selling_price_id ,PDO::PARAM_STR);  // 挿入する変数（売価変更価格）をパラメータにバインドする
   $stmt -> execute(); //挿入する値が入った変数をexecuteにセットしてSQLを実行
   $message = "売価変更修正が完了しました";
   }
}
 ?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/genre_edit_delete_done.css">
    <title>売価管理修正結果</title>
  </head>
  <body>
    <?php
    include ('header.php');
    include ('sidebar.php');
    ?>
    <div id="genre_done_message">
      <h1><?php echo $message ?></h1>
    </div>
  </body>
</html>

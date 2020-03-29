<?php
session_start();

if(isset($_POST['genre'])) {
 $test = $_POST['genre'][0];
}
if(isset($_POST['genre_name'])) {
 $test2 = $_POST['genre_name'];
}

$pdo = new PDO("mysql:host=127.0.0.1;dbname=ecsite;charset=utf8","root","");

// 削除ボタンがPOSTされた場合
if(isset($_POST['delete_genre'])) {
 $sql = "DELETE FROM genre WHERE genre_name = :genre";
 $stmt = $pdo->prepare($sql); //削除するレコードのIDは空のまま、SQL実行の準備をする
 $params = array(':genre'=>$test); // 削除するレコードのIDを配列に格納する
 $stmt -> execute($params); //削除するレコードのIDが入った変数をexecuteにセットしてSQLを実行
 $message = "削除が完了しました";
}

// 修正ボタンがPOSTされた場合
// limit1で修正するジャンル名と同じジャンル名のレコードを1件だけ取得
if(isset($_POST['edit_genre'])) {
$sql ="SELECT * FROM genre WHERE genre_name = :genre_name limit 1";
$stmt = $pdo->prepare($sql);
$stmt -> bindParam(':genre_name',$test ,PDO::PARAM_STR);
$stmt -> execute();
$result = $stmt->fetch();
// 1件以上同じジャンル名のレコードが存在する場合
if($result > 0) {
  $message = "このジャンル名は既に登録されています";
} else {
  // $sql = "SELECT id FROM genre WHERE genre_name = :genre";
  // $stmt = $pdo->prepare($sql);
  // $params = array(':genre'=>$test);
  // $stmt -> execute($params);
  // $genre_all = $stmt->fetch();
  // $test_id = $genre_all['id'];
 $sql ="UPDATE genre SET genre_name = :new_genre WHERE genre_name = :old_genre";
 $stmt = $pdo->prepare($sql); //修正するレコードのIDは空のまま、SQL実行の準備をする
 $params = array(':new_genre'=>$test ,':old_genre'=>$test2); // 更新する値と更新するIDを配列に格納
 $stmt -> execute($params); //修正するレコードのIDが入った変数をexecuteにセットしてSQLを実行
 $message = "修正が完了しました";
 }
}
?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/genre_edit_delete_done.css">
    <title>ジャンル修正削除完了</title>
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
      <a href="genre_edit_delete.php">
       <input type="button" id="regist_more" name="regist_more" value="前の画面に戻る">
     </a>
    </div>
  </body>
</html>

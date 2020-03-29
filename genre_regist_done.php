<?php
session_start();

if(isset($_POST['genre_name'])) {
  $genre_name = $_POST['genre_name'];
}

$pdo = new PDO("mysql:host=localhost;dbname=ecsite;charset=utf8","root" , "");

// limit1で登録するジャンル名と同じジャンル名のレコードを1件だけ取得
$sql ="SELECT * FROM genre WHERE genre_name = :genre_name limit 1";
$stmt = $pdo->prepare($sql);
$stmt -> bindParam(':genre_name',$genre_name ,PDO::PARAM_STR);
$stmt -> execute();
$result = $stmt->fetch();
// 1件以上同じジャンル名のレコードが存在する場合
if($result > 0) {
 $message = "このジャンル名は既に登録されています";
} else {
 $sql = "INSERT INTO genre(genre_name) VALUES(:genre_name)";
 $stmt = $pdo->prepare($sql); //挿入する値は空のまま、SQL実行の準備をする
 $stmt->bindParam(':genre_name',$genre_name ,PDO::PARAM_STR);
 // $params = array(':genre_name' => $genre_name); // 挿入する値を配列に格納する
 $stmt -> execute(); //挿入する値が入った変数をexecuteにセットしてSQLを実行
 $message = "登録が完了しました";
 }
?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/genre_regist_done.css">
    <title>ジャンル登録完了</title>
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
      <a href="genre_regist.php">
       <input type="button" id="regist_more" name="regist_more" value="前の画面に戻る">
     </a>
    </div>
  </body>
</html>

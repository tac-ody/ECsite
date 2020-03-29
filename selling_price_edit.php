<?php
session_start();

// 前画面の商品id、売価変更開始日、売価変更終了日、売価変更価格をPOSTで取得
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
if(isset($_POST['selling_price_id'])){
  $selling_price_id = $_POST['selling_price_id'];
}
if(isset($_POST['changed_selling_price'])){
  $changed_selling_price = $_POST['changed_selling_price'];
}
// 今の日時を取得
$today = date('Y-m-d H:i:s');

//$start_datetimeが今の日時を過ぎていた場合、開始日欄を非活性に
$readonly = "";
if($today > $start_datetime) {
  $readonly = "readonly";
}

$pdo = new PDO("mysql:host=127.0.0.1;dbname=ecsite;charset=utf8","root","");

$sql = "SELECT * FROM item JOIN genre ON item.genre_id = genre.id
                           JOIN maker ON item.maker_id = maker.id
                           JOIN brand ON item.brand_id = brand.id
                           WHERE item_id = $item_id";
$stmt = $pdo->query($sql);
$result = $stmt->fetchAll();



$sql = "SELECT * FROM selling_price WHERE foreign_item_id = $item_id
                                    AND end_datetime NOT BETWEEN '2020-03-01 00:00:00' AND '$today'
                                    ORDER BY start_datetime ASC";
$stmt = $pdo->query($sql);
$selling_price_all = $stmt->fetchAll();
 ?>

 <!DOCTYPE html>
 <html lang="ja" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="css/selling_price_edit.css">
     <link rel="stylesheet" href="css/pagination_contents.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script type="text/javascript" src="js/jquery.pagination.js"></script>
     <script type="text/javascript" src="js/selling_price.pagination.js"></script>
     <!-- bodyタグ最下部で１ファイル読み込み中 -->
     <title>売価管理修正</title>
   </head>
   <body>
     <?php
     include ('header.php');
     include ('sidebar.php');
     ?>
    <div id="contents">
       <h1 id="title">売価管理修正</h1>
         <div id="item_information">
           <input type="text" id="item_name" name="item_name" value="<?php echo $result[0]['item_name'] ?>" readonly>
           <input type="text" id="item_genre" name="item_genre" value="<?php echo $result[0]['genre_name'] ?>" readonly>
           <input type="text" id="item_maker" name="item_maker" value="<?php echo $result[0]['maker_name'] ?>" readonly>
           <input type="text" id="item_brand" name="item_brand" value="<?php echo $result[0]['brand_name'] ?>" readonly>
           <input type="text" id="item_price" name="item_price" value="<?php echo $result[0]['price'] ?>円" readonly>
         </div>
         <br>
         <br>
        <h2>この商品について現在登録中の売価一覧</h2>
         <div id="selling_price_all">
          <?php foreach($selling_price_all as $test1) { ?>
            <div class="selling_price">
              <input type="text" class="selling_price_all" value="<?php echo $test1['start_datetime']?>" readonly> 〜
              <input type="text" class="selling_price_all" value="<?php echo $test1['end_datetime']?>" readonly>
              <input type="text" class="selling_price_all" value="<?php echo $test1['changed_selling_price']?>円" readonly>
              <br>
            </div>
          <?php } ?>
        </div>
         <br>
         <br>
       <form method="POST" action="selling_price_edit_done.php">
         <div id="selling_price_infomation">
           開始日時<input type="datetime-local" id="start_datetime" name="start_datetime" value="<?php echo date('Y-m-d\TH:i:s', strtotime($start_datetime)) ?>" step="1" <?php echo $readonly ?>>
           終了日時<input type="datetime-local" id="end_datetime" name="end_datetime" value="<?php echo date('Y-m-d\TH:i:s', strtotime($end_datetime)) ?>" step="1">
           <br>
           <br>
           売価変更後の価格<input type="text" id="selling_price" name="selling_price" value="<?php echo $changed_selling_price ?>" <?php echo $readonly ?>>
         </div>
         <input type="hidden" name="item_id" value="<?php echo $item_id ?>">
         <input type="hidden" name="price" value="<?php echo $price ?>">
         <input type="hidden" name="selling_price_id" value="<?php echo $selling_price_id ?>">
         <div id="button">
           <input type="submit" id="selling_price_edit" name="selling_price_edit" value="修正">
           <input type="submit" id="selling_price_delete" name="selling_price_delete" value="削除">
         </div>
       </form>
     </div>
    <script type="text/javascript" src="js/selling_price_edit.js"></script>
   </body>
 </html>

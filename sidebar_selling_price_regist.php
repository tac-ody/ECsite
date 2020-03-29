<?php
session_start();
$pdo = new PDO("mysql:host=127.0.0.1;dbname=ecsite;charset=utf8","root","");

$sql = "SELECT * FROM item JOIN genre ON item.genre_id = genre.id
                           JOIN maker ON item.maker_id = maker.id
                           JOIN brand ON item.brand_id = brand.id
                           ORDER BY item_id DESC";
$item_data = $pdo->query($sql);
$item_all = $item_data->fetchAll();

$sql = "SELECT * FROM genre";
$genre = $pdo->query($sql);
$genre_name = $genre->fetchAll();

$sql = "SELECT * FROM maker";
$maker = $pdo->query($sql);
$maker_name = $maker->fetchAll();

$sql = "SELECT * FROM brand";
$brand = $pdo->query($sql);
$brand_name = $brand->fetchAll();

 ?>

 <!DOCTYPE html>
 <html lang="ja" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="css/sidebar_selling_price_regist.css">
     <link rel="stylesheet" href="css/pagination_contents.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script type="text/javascript" src="js/jquery.pagination.js"></script>
     <script type="text/javascript" src="js/selling_price.pagination.js"></script>
     <script type="text/javascript" src="js/sidebar_selling_price_regist.js"></script>
     <script type="text/javascript" src="js/sidebar_selling_price_regist_search.js"></script>
     <title>売価管理登録</title>
   </head>
   <body>
     <?php
     include ('header.php');
     include ('sidebar.php');
     ?>
    <div id="contents">
      <h1 id="title">売価管理登録</h1>
         <div id="item_search">
           <input type="text" id="item_name" name="item_name" value="" placeholder="商品名を入力してください">
           <select id="item_genre" name="item_genre">
               <option value="">ジャンル名を選択してください</option>
             <?php foreach($genre_name as $genre) { ?>
               <option value="<?php echo $genre['genre_name']?>" ><?php echo $genre['genre_name']?></option>
             <?php } ?>
           </select>
           <select id="item_maker" name="item_maker">
               <option value="">メーカー名を選択してください</option>
             <?php foreach($maker_name as $maker) { ?>
               <option value="<?php echo $maker['maker_name']?>" ><?php echo $maker['maker_name']?></option>
             <?php } ?>
           </select>
           <select id="item_brand" name="item_brand">
               <option value="">ブランド名を選択してください</option>
             <?php foreach($brand_name as $brand) { ?>
               <option value="<?php echo $brand['brand_name']?>" ><?php echo $brand['brand_name']?></option>
             <?php } ?>
           </select>
           <input type="text" id="item_price" name="item_price" value="" placeholder="価格を入力してください">円
         <br>
           <input type="button" id="button_search" name="button_search" value="検索">
         </div>
         <br>
         <br>
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
      <?php foreach ($item_all as $value): ?>
      <form class="item-list_line" action="selling_price_regist.php" method="post">
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
          <input type="submit" class="item-edit-price-change_submit" formaction="selling_price_regist.php" value="売価管理登録">
        </div>
      </form>

      <?php endforeach; ?>
    </div>
   </div>
  </body>
 </html>

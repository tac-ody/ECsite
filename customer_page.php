<?php
// 今の日時を取得
$today = date('Y-m-d H:i:s');


$pdo = new PDO("mysql:host=127.0.0.1;dbname=ecsite;charset=utf8","root","");

$sql = "SELECT * FROM item JOIN genre ON item.genre_id = genre.id
                           JOIN maker ON item.maker_id = maker.id
                           JOIN brand ON item.brand_id = brand.id
                           ORDER BY item_id DESC";
$item_data = $pdo->query($sql);
$item_all = $item_data->fetchAll();

$sql = "SELECT * FROM selling_price JOIN item ON selling_price.foreign_item_id = item.item_id
                                    JOIN genre ON item.genre_id = genre.id
                                    JOIN maker ON item.maker_id = maker.id
                                    JOIN brand ON item.brand_id = brand.id
                                    WHERE start_datetime < '$today' AND end_datetime > '$today'
                                    ORDER BY item_id DESC";
$item_data_all = $pdo->query($sql);
$item_all_total = $item_data_all->fetchAll();


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
     <link rel="stylesheet" href="css/customer_page.css">
     <link rel="stylesheet" href="css/pagination_contents.css">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
     <script type="text/javascript" src="js/jquery.pagination.js"></script>
     <script type="text/javascript" src="js/customer_page_pagination.js"></script>
     <script type="text/javascript" src="js/sidebar_selling_price_regist.js"></script>
     <script type="text/javascript" src="js/customer_page_search.js"></script>
     <title>○○○ドラッグストア</title>
   </head>
   <body>

     <div id="overlay">
       <a class="ajax_message">非同期通信中</a>
      <div class="cv-spinner">
        <span class="spinner"></span>
      </div>
     </div>

    <div id="contents">
     <h1 id="main_title">ゼネックドラッグストア</h1>
      <div id="other">
       <div id="payment">
        <a class="text">ご利用いただけるお支払い方法</a>
        <a class="fab fa-cc-visa fa-3x"></a>
        <a class="fab fa-cc-jcb fa-3x"></a>
        <a class="fab fa-cc-mastercard fa-3x"></a>
        <a class="fab fa-cc-amex fa-3x"></a>
        <a class="fab fa-cc-apple-pay fa-3x"></a>
        <a class="fab fa-alipay fa-3x"></a>
       </div>
       <div id="question">
        <a class="text">よくあるご質問</a>
        <a class="fas fa-question fa-3x"></a>
       </div>
       <div id="login">
         <a class="text">ログイン</a>
         <a class="fas fa-user fa-3x"></a>
       </div>
　     <div id="cart">
        <a class="text">カートをみる</a>
        <a class="fas fa-shopping-basket fa-3x"></a>
       </div>
      </div>
      <div id="search">
       <h2 id="title">商品検索</h2>
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
       </div>
         <br>
         <br>
    <div class="column-title">
      <div class="column-title_individual">
        <div class="text=information">
          <span>商品画像</span>
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
            <span>価格</span>
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
          <?php if(!empty($array_res_all)) { ?>
           <?php foreach ($array_res_all as $value_all) { ?>
           <?php if($value['item_id'] == $value_all['foreign_item_id']) { ?>
             <?php $item_price = $value_all['changed_selling_price']; ?>
           <?php } elseif ($value['item_name'] !== $value_all['item_name']) { ?>
             <?php $item_price = $value['price']; ?>
           <?php } ?>
         <?php } ?>
       <?php  } ?>
           <?php if(empty($array_res_all)) { ?>
               <?php $item_price = $value['price']; ?>
           <?php } ?>
           <?php if(isset($item_price)) { ?>
              <?php echo $item_price.'円'; ?>
           <?php } ?>
        </div>
        <a class="fas fa-shopping-cart"></a><input type="button" class="cart_item " value="商品をカゴに入れる">
      </form>
      <?php endforeach; ?>
    </div>
    </div>
   </body>
 </html>

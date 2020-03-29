<?php
session_start();

$pdo = new PDO("mysql:host=127.0.0.1;dbname=ecsite;charset=utf8","root","");

$sql = "SELECT * FROM genre";
$genre_data = $pdo->query($sql);
$genre_all = $genre_data->fetchAll();
 ?>

 <!DOCTYPE html>
 <html lang="ja" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="css/genre_edit_delete.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <title>ジャンル修正削除</title>
   </head>
   <body>
     <?php
     include ('header.php');
     include ('sidebar.php');
     ?>
     <div id="main_contents">
       <h1>ジャンルマスタ修正削除</h1>
        <form method="POST" action="genre_edit_delete_done.php">
         <div id="input_genre">
           <select id="select_genre" name="genre[]">
             <option value="">---</option>
             <?php foreach($genre_all as $genre) { ?>
             <option value="<?php echo $genre['genre_name']?>" ><?php echo $genre['genre_name']?>
             </option>
             <?php } ?>
          </select>
         </div>
           <br>
          <div id="button">
            <input type="button" id="edit_genre" name="edit_genre" value="修正">
            <input type="submit" id="delete_genre" name="delete_genre" value="削除">
          </div>
        </form>
     </div>
    <script type="text/javascript" src="js/genre_edit_delete.js"></script>
   </body>
 </html>

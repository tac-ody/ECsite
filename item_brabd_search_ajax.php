<?php
$maker_id = $_POST["id"];
if (!empty($maker_id)) {
  $pdo = new PDO ('mysql:host=127.0.0.1;dbname=ecsite; charset=utf8', 'root', '');
  $sql = "SELECT * FROM brand WHERE maker_select_id = '$maker_id'";
  $res = $pdo->query($sql);
  echo '<option value="">---</option>';
  foreach($res as $value) {
    echo '<option value='.$value["id"].'>'.$value["brand_name"].'</option>';
  }
}
?>

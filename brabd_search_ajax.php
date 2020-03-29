<?php
$maker_name = $_POST["name"];
if (!empty($maker_name)) {
  $pdo = new PDO ('mysql:host=127.0.0.1;dbname=ecsite; charset=utf8', 'root', '');
  $sql = "SELECT * FROM maker WHERE maker_name = '$maker_name'";
  $res_maker_name = $pdo->query($sql);
  foreach($res_maker_name as $value) {
    $maker_id = $value['id'];
  }

  $sql = "SELECT * FROM brand WHERE maker_select_id = '$maker_id'";
  $arrey_res = $pdo->query($sql);
  echo '<option value="">---</option>';
  foreach($arrey_res as $value) {
    echo '<option value='.$value["brand_name"].'>'.$value["brand_name"].'</option>';
  }
}
?>

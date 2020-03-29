<?php
const HOST_NAME = "127.0.0.1";
const DB_NAME = "ecsite";
const DB_CHARSET_SELECT = "utf8";
const DB_USER_NAME = "root";
const DB_USER_PASSWORD = "";
//DB接続
function db_connect(){
  $pdo = new PDO ('mysql:host='.HOST_NAME.';dbname='.DB_NAME.'; charset='.DB_CHARSET_SELECT, DB_USER_NAME, DB_USER_PASSWORD);
  return $pdo;
}

function fetch_user_data($user_id, $user_password) {
  $pdo = db_connect();
  $sql = "SELECT count(*) FROM user
          WHERE id_identify_user = '$user_id'
          AND user_password = '$user_password'";
  $array_res = $pdo->prepare($sql);
  $array_res->execute();
  $number = $array_res->fetch(PDO::FETCH_ASSOC);
  $res = $number["count(*)"];
  $pdo = null;
  return $res;
}

//メーカーテーブルの値を全て取ってくる
function maker_select_all() {
  $pdo = db_connect();
  $sql = "SELECT * FROM maker";
  $array_res = $pdo->query($sql);
  $pdo = null;
  return $array_res;
}
//ジャンルテーブルの値を全て取ってくる
function genre_select_all() {
  $pdo = db_connect();
  $sql = "SELECT * FROM genre";
  $array_res = $pdo->query($sql);
  $pdo = null;
  return $array_res;
}

//itemテーブルの値を全て取ってくる
function item_select_all() {
  $pdo = db_connect();
  $sql = "SELECT * FROM item
          JOIN genre ON item.genre_id = genre.id
          JOIN maker ON item.maker_id = maker.id
          JOIN brand ON item.brand_id = brand.id
          ORDER BY item_id DESC";
  $array_res = $pdo->query($sql);
  $pdo = null;
  return $array_res;
}

function item_id_search($item_id) {
  $pdo = db_connect();
  $sql = "SELECT * FROM item
          JOIN genre ON item.genre_id = genre.id
          JOIN maker ON item.maker_id = maker.id
          JOIN brand ON item.brand_id = brand.id
          WHERE item_id = '$item_id'";
  $array_res = $pdo->prepare($sql);
  $array_res->execute();
  $pdo = null;
  return $array_res;
}


//商品全てから検索
function item_search_all($item_name = "%", $genre_name = "%", $maker_name = "%", $brand_name = "%", $price = "%") {
  $pdo = db_connect();
  $sql = "SELECT * FROM item
          JOIN genre ON item.genre_id = genre.id
          JOIN maker ON item.maker_id = maker.id
          JOIN brand ON item.brand_id = brand.id
          WHERE (item_name LIKE '%$item_name%')
          AND genre_name LIKE '%$genre_name%'
          AND maker_name LIKE'%$maker_name%'
          AND brand_name LIKE '%$brand_name%'
          AND price LIKE '%$price%'";
  $array_res = $pdo->prepare($sql);
  $array_res->execute();
  $pdo = null;
  return $array_res;
}


//DB処理
function db_process($overlap_check_sql, $process_sql, $success, $failure, $select_column) {
  $pdo = db_connect();
  $array_res = $pdo->prepare($overlap_check_sql);
  $array_res->execute();
  //連想配列にする。キーはSELECTの後の文になる
  $number = $array_res->fetch(PDO::FETCH_ASSOC);
  if ($number[$select_column] > 0) {
    $result = $failure;
  } else {
    $res = $pdo->prepare($process_sql);
    $res->execute();
    $result = $success;
  }
  $pdo = null;
  return $result;
}


//商品登録
function item_registration($item_name, $genre_id, $maker_id, $brand_id, $price, $component, $item_description, $image_path) {
  $select_column = "count(*)";
  $overlap_check_sql = "SELECT '$select_column'
                        FROM item JOIN genre ON item.genre_id = genre.id
                        JOIN maker ON item.maker_id = maker.id
                        JOIN brand ON item.brand_id = brand.id
                        WHERE item_name = '$item_name'
                        AND genre_id = '$genre_id'
                        AND maker_id = '$maker_id'
                        AND brand_id = '$brand_id'
                        AND price = '$price'
                        AND component = '$component'
                        AND item_description = '$item_description'
                        AND image_path = '$image_path'";
  $process_sql = "INSERT INTO item (item_name, genre_id, maker_id, brand_id, price, component, item_description, image_path)
                  VALUES ('$item_name', '$genre_id', '$maker_id', '$brand_id', '$price', '$component', '$item_description', '$image_path')";
  $success = "登録が完了しました。";
  $failure = "同じ商品が登録されているので登録出来ませんでした。";
  $registration = db_process($overlap_check_sql, $process_sql, $success, $failure, $select_column);
  return $registration;
}

//商品削除
function item_delete($item_id) {
  $select_column = "count(*)";
  $overlap_check_sql = "";
  $process_sql = "DELETE FROM item WHERE item_id = '$item_id'";
  $success = "削除が完了しました。";
  $failure = "使用中ですので削除出来ません。";
  $delete = db_process($overlap_check_sql, $process_sql, $success, $failure, $select_column);
  return $delete;
}

//商品修正
function item_edit($item_id, $item_name, $genre_id, $maker_id, $brand_id, $price, $component, $item_description, $image_path) {
  $select_column = "count(*)";
  $overlap_check_sql = "";
  $process_sql = "UPDATE item
                  SET item_name = '$item_name',
                  genre_id = '$genre_id',
                  maker_id = '$maker_id',
                  brand_id = '$brand_id',
                  price = '$price',
                  component = '$component',
                  item_description = '$item_description',
                  image_path = '$image_path'
                  WHERE item_id = '$item_id'";
  $success = "修正が完了しました。";
  $failure = "使用中ですので修正出来ません。";
  $edit = db_process($overlap_check_sql, $process_sql, $success, $failure, $select_column);
  return $edit;
}


//メーカー名登録
function maker_name_registration($maker_name) {
  $select_column = "count(maker_name)";
  $overlap_check_sql = "SELECT ".$select_column." FROM maker WHERE maker_name = '$maker_name'";
  $process_sql = "INSERT INTO maker (maker_name) VALUES ('$maker_name')";
  $success = "登録が完了しました。";
  $failure = "登録済みですので他のメーカー名にしてください。";
  $registration = db_process($overlap_check_sql, $process_sql, $success, $failure, $select_column);
  return $registration;
}
//メーカー名削除
function maker_name_delete($maker_id) {
  $select_column = "count(maker_id)";
  $overlap_check_sql = "SELECT ".$select_column." FROM brand WHERE maker_select_id = '$maker_id'";
  $process_sql = "DELETE FROM maker WHERE id = '$maker_id'";
  $success = "削除が完了しました。";
  $failure = "使用中ですので削除出来ません。";
  $delete = db_process($overlap_check_sql, $process_sql, $success, $failure, $select_column);
  return $delete;
}
//メーカー名修正
function maker_name_edit($maker_id, $maker_name) {
  $select_column = "count(maker_name)";
  $overlap_check_sql = "SELECT ".$select_column." FROM maker WHERE maker_name = '$maker_name'";
  $process_sql = "UPDATE maker SET maker_name = '$maker_name' WHERE id = '$maker_id'";
  $success = "修正が完了しました。";
  $failure = "登録済みですので他のメーカー名にしてください。";
  $edit = db_process($overlap_check_sql, $process_sql, $success, $failure, $select_column);
  return $edit;
}


//ブランド名登録
function brand_name_registration($maker_id, $brand_name) {
  $select_column = "count(*)";
  $overlap_check_sql = "SELECT ".$select_column." FROM brand WHERE brand_name = '$brand_name' AND maker_select_id = '$maker_id'";
  $process_sql = "INSERT INTO brand (brand_name, maker_select_id) VALUES ('$brand_name', '$maker_id')";
  $success = "登録が完了しました。";
  $failure = "登録済みですので他のブランド名にしてください。";
  $registration = db_process($overlap_check_sql, $process_sql, $success, $failure, $select_column);
  return $registration;
}

//メーカー名からIDを取得
function maker_id_search($maker_name) {
  $pdo = db_connect();
  $sql = "SELECT id FROM maker WHERE maker_name = '$maker_name'";
  $res = $pdo->prepare($sql);
  $res->execute();
  $pdo = null;
  foreach($res as $value) {
    $maker_id = $value["id"];
  }
  return $maker_id;
}

//ブランド名からIDを取得
function brand_id_search($brand_name) {
  $pdo = db_connect();
  $sql = "SELECT * FROM brand WHERE brand_name = '$brand_name'";
  $res = $pdo->prepare($sql);
  $res->execute();
  $pdo = null;
  foreach($res as $value) {
    $brand_id = $value["id"];
  }
  return $brand_id;
}

//ブランド名削除
function brand_name_delete($brand_name) {
  $brand_id = brand_id_search($brand_name);
  $select_column = "count(*)";
  $overlap_check_sql = "SELECT ".$select_column." FROM item WHERE brand_id = '$brand_id'";
  $process_sql = "DELETE FROM brand WHERE brand_name = '$brand_name'";
  $success = "削除が完了しました。";
  $failure = "使用中ですので削除出来ません。";
  $delete = db_process($overlap_check_sql, $process_sql, $success, $failure, $select_column);
  return $delete;
}
//ブランド名修正
function brand_name_edit($maker_name, $brand_name, $previous_brand) {
  $brand_id = brand_id_search($previous_brand);
  $maker_id = maker_id_search($maker_name);
  $select_column = "count(*)";
  $overlap_check_sql = "SELECT ".$select_column." FROM brand WHERE brand_name = '$brand_name' AND maker_id = '$maker_id'";
  $process_sql = "UPDATE brand SET brand_name='$brand_name' WHERE id = '$brand_id'";
  $success = "修正が完了しました。";
  $failure = "登録済みですので他のブランド名にしてください。";
  $edit = db_process($overlap_check_sql, $process_sql, $success, $failure, $select_column);
  return $edit;
}
?>

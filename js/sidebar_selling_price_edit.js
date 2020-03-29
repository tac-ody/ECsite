$(function() {
  //値が変わったら処理
  $('#item_maker').change(function() {
    //HTMLから受け取るデータ
    var data = {maker_name: $('#item_maker').val()};
    //ここからajaxの処理
    $.ajax({
      //POST通信
      type: "POST",
      //ここでデータの送信先URLを指定
      url: "sidebar_selling_price_edit_ajax.php",
      data: data,
      //処理が成功
      success : function(data, dataType) {
        //HTMLファイル内の該当箇所にレスポンスデータを追加。
        $('#item_brand').html(data);
      },
      //処理がエラーの時
      error : function() {
        alert('通信エラー');
      }
    });
    });
  });

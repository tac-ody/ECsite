$(function() {
  //値が変わったら処理
  $('#maker_name').change(function() {
    //HTMLから受け取るデータ
    var data = {name: $('#maker_name').val()};
    //ここからajaxの処理
    $.ajax({
      //POST通信
      type: "POST",
      //ここでデータの送信先URLを指定
      url: "item_top_page_brabd_search_ajax.php",
      data: data,
      //処理が成功
      success : function(data, dataType) {
        //HTMLファイル内の該当箇所にレスポンスデータを追加。
        $('#brand_name').html(data);
      },
      //処理がエラーの時
      error : function() {
        alert('通信エラー');
      }
    });
    });
  });

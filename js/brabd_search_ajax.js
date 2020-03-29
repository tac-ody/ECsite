$(function() {
  //検索ボタンがクリックされたら処理
  $('#registered').change(function() {
    //HTMLから受け取るデータ
    var data = {name: $('#registered').val()};
    //ここからajaxの処理
    $.ajax({
      //POST通信
      type: "POST",
      //ここでデータの送信先URLを指定
      url: "brabd_search_ajax.php",
      data: data,
      //処理が成功
      success : function(data, dataType) {
        //HTMLファイル内の該当箇所にレスポンスデータを追加。
        $('#brand-registered').html(data);
      },
      //処理がエラーの時
      error : function() {
        alert('通信エラー');
      }
    });
    });
  });

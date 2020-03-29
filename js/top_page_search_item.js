$(function() {
  //検索ボタンがクリックされたら処理
  $('#search_item_button').click(function() {
    //HTMLから受け取るデータ
    var data = {item_name: $('#item_name').val(),
                genre_name: $('#genre_name').val(),
                maker_name: $('#maker_name').val(),
                brand_name: $('#brand_name').val(),
                price: $('#item_price').val()};
    //ここからajaxの処理
    $.ajax({
      //POST通信
      type: "POST",
      //ここでデータの送信先URLを指定
      url: "top_page_search_item_ajax.php",
      data: data,
      //処理が成功
      success : function(data, dataType) {
        //HTMLファイル内の該当箇所にレスポンスデータを追加。
        $('.item-list').html(data);
        $('.pagination_contents').remove();
        $('.item-list').pagination({
          itemElement : '> .item-list_line', // アイテムの要素
          displayItemCount : 5
      });
      },
      //処理がエラーの時
      error : function() {
        alert('通信エラー');
      }
    });
    });
  });
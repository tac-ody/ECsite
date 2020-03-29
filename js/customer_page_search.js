$(function() {
  //検索ボタンがクリックされたら処理
  $('#button_search').click(function() {
    //HTMLから受け取るデータ
    var data = {item_name: $('#item_name').val(),
                genre_name: $('#item_genre').val(),
                maker_name: $('#item_maker').val(),
                brand_name: $('#item_brand').val(),
                price: $('#item_price').val()};
    //ここからajaxの処理
    $.ajax({
      //POST通信
      type: "POST",
      //ここでデータの送信先URLを指定
      url: "customer_page_search.php",
      data: data,
      //処理が成功
      success : function(data, dataType) {
        //HTMLファイル内の該当箇所にレスポンスデータを追加。
        $('.item-list').html(data);
      //   $('div:last').remove();
      //   $('.item-list').pagination({
      //     itemElement : '> .item-list_line', // アイテムの要素
      //     displayItemCount : 5
      // });
      },
      //処理がエラーの時
      error : function() {
        alert('非同期通信エラー');
      }
    });
    });
  });

 $(function() {
      $('#button_search').click(function() {
        // $(document).ajaxSend(function() {
            $("#overlay").fadeIn(300);　
            setTimeout(function(){
                $("#overlay").fadeOut(800);
            },100);
        // });
          $.ajax({
              type: 'POST',
              success: function(data){
                  console.log(data);
              }
          }).done(function() {
              setTimeout(function(){
                  $("#overlay").fadeOut(800);
              },100);
          });
      });
  });

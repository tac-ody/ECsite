// 入力欄が空欄でないときにポップアップ表示
$('#register_genre').click(function() {
  if($('#input_genre').val() !== "" && !confirm('本当に登録しますか？')) {
        return false;
     }
});

// 入力欄が空欄のときにアラート表示
$('#register_genre').click(function() {
  if($('#input_genre').val() == "") {
        alert('ジャンル名が入力されていません');
        return false;
     }
});

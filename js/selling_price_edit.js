// 修正確認ポップアップ表示
$('#selling_price_edit').click(function() {
  if(!confirm('本当に修正しますか？')) {
        return false;
     }
});
// 削除確認ポップアップ表示
$('#selling_price_delete').click(function() {
  if(!confirm('本当に削除しますか？')) {
        return false;
     }
});

// 開始日が空欄のときにアラート表示
$('#selling_price_edit').click(function() {
  if($('#start_datetime').val() == "") {
        alert('開始日時が入力されていません \n ※時刻も入力してください');
        return false;
     }
});

// 終了日が空欄のときにアラート表示
$('#selling_price_edit').click(function() {
  if($('#end_datetime').val() == "") {
        alert('終了日時が入力されていません \n ※時刻も入力してください');
        return false;
     }
});

// 価格が空欄のときにアラート表示
$('#selling_price_edit').click(function() {
  if($('#selling_price').val() == "") {
        alert('売価変更後の価格が入力されていません');
        return false;
     }
});

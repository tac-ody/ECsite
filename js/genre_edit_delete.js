$('#delete_genre').click(function() {
  if(!confirm('本当に削除しますか？')) {
        return false;
     }
});

$('#edit_genre').click(function() {
  if($('#select_genre').val() == "") {
        alert('修正するジャンル名を選択してください');
        return false;
     }
});

$('#delete_genre').click(function() {
  if($('#select_genre').val() == "") {
        alert('削除するジャンル名を選択してください');
        return false;
     }
});

$('#edit_genre').click(function(){
  if($('#select_genre').val() !== "") {
   // ボタンのHTMLタグを上書き
   $('#button').html('<input type="submit" id="confirm_genre" name="edit_genre" value="確定">  <input type="submit" id="edit_genre" name="edit_genre" value="削除" disabled>');
   // 変数genre_nameにセレクトボックスで選択したジャンル名を代入
   var genre_name = $('#select_genre').val();
   // セレクトボックスをテキストボックスに上書き
   $('#input_genre').html('<input type="hidden" id="genre_targrt" name="genre_name" value=""> <input type="text" id="select_genre" name="genre[]" value="">');
   // 上書き生成したテキストボックスのvalueに選択したジャンル名をセット
   $('#select_genre').val(genre_name);
   $('#genre_targrt').val(genre_name);
 }
});

$(document).on("click","#confirm_genre",function() {
  if(!confirm('本当に修正しますか？')) {
        return false;
     }
});

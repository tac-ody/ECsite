function change_input() {
  var element = document.getElementById("registered");
  var select_value = element.value
  if (select_value) {
    var select_value_split = select_value.split(",");
    //select削除
    element.remove();
    var element = document.getElementById("maker-search");
    //inputボックス追加
    var html = '<input type="hidden" name="id" value=' + select_value_split[0] + '>'
            + '<input type="text" name="maker" class="maker-search_registered" id="registered" value=' + select_value_split[1] + '>'
            + '<div class="to_result_screen" id="change_button">'
            + '<input type="submit" class="edit_deletion" id="fixed_button" formaction="maker_edit_result.php" value="確定">'
            + '<input type="submit" class="edit_deletion" id="deletion_button" disabled formaction="maker_deletion_result.php" value="削除">'
            + '</div>';
    element.innerHTML = html;
  } else {
    alert("未入力です");
  }
}

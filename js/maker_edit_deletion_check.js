function maker_edit_deletion_check() {
  var maker_input = document.getElementById("registered");
  var fixed_button = document.getElementById("fixed_button");
  //修正削除アラート
  if (fixed_button && maker_input.value) {
    var result = window.confirm("修正してもよろしいですか？");
    return result;
  } else if(fixed_button) {
    alert("未入力です");
    return false;
  } else if (maker_input.value) {
    var result = window.confirm("削除してもよろしいですか？");
    return result;
  } else {
    alert("未入力です");
    return false;
  }
}


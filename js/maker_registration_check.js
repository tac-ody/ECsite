function maker_registration_check() {
  var maker = document.getElementsByClassName("maker-input_text");
  var maker_value = maker[0].value;
  if(maker_value) {
    var result = window.confirm("登録してもよろしいですか？");
    return result;
  } else {
    alert("未入力です");
    return false;
  }
}

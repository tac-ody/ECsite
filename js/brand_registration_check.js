function brand_registration_check() {
  var brand = document.getElementsByName("brand");
  var maker = document.getElementsByName("maker");
  var brand_value = brand[0].value;
  var maker_value = maker[0].value;
  if(brand_value && maker_value) {
    var result = window.confirm("登録してもよろしいですか？");
    return result;
  } else {
    alert("未入力です");
    return false;
  }
}

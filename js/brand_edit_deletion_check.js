function brand_edit_deletion_check() {
  var brand = document.getElementById("brand-registered");
  var fixed_button = document.getElementById("fixed_button");
  console.log(brand.value);
  //修正削除アラート
  if (fixed_button && brand.value) {
    var result = window.confirm("修正してもよろしいですか？");
    return result;
  } else if(fixed_button) {
    alert("未入力です");
    return false;
  } else if (brand.value) {
    var result = window.confirm("削除してもよろしいですか？");
    return result;
  } else {
    alert("未入力です");
    return false;
  }
}

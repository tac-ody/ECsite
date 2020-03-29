function change_input() {
  var registered = document.getElementById("registered");
  var maker_name = registered.value;
  // var maker_value = maker.split(",");
  var brand_registered = document.getElementById("brand-registered");
  var brand_name = brand_registered.value;
  // var brand_value = brand.split(",");
  if (maker_name && brand_name) {
    registered.remove();
    brand_registered.remove();
    var change_button = document.getElementById("change_button");
    change_button.remove();
    var element = document.getElementById("brand-search");
    var html = '<input type="hidden" name="previous_brand" value=' + brand_name +'>'
            + '<select class="brand-search_registered" name="maker-name">'
            + '<option value=' + maker_name +'>' + maker_name + '</option>'
            + '</select>'
            + '<input type="text" class="brand-search_registered" name="brand-name" id="brand-registered" value=' + brand_name +'>'
            + '<div class="to_result_screen" id="change_button">'
            + '<input type="submit" class="edit_deletion" id="fixed_button" formaction="brand_edit_result.php" value="確定">'
            + '<input type="submit" class="edit_deletion" id="deletion_button" disabled formaction="brand_deletion_result.php" value="削除">'
            + '</div>';
    element.innerHTML = html;
  } else {
    alert("未入力項目があります")
  }
}

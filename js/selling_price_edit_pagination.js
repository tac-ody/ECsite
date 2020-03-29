$(function() {
    $('.present').pagination({
        itemElement : '> .present_line', // アイテムの要素
        displayItemCount: 5,
    });
});
$(function() {
    $('.future').pagination({
        itemElement : '> .future_line', // アイテムの要素
        displayItemCount: 5,
    });
});
$(function() {
    $('.past').pagination({
        itemElement : '> .past_line', // アイテムの要素
        displayItemCount: 5,
    });
});

$('.qtyPlus').click(function () {
    $(this).prev().val(+$(this).prev().val() + 1);
});
$('.qtyMinus').click(function () {
    if ($(this).next().val() > 0) $(this).next().val(+$(this).next().val() - 1);
});
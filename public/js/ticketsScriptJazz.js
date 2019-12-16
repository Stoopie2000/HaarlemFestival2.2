<<<<<<< HEAD
$('.qtyPlus').click(function (e) {
    e.preventDefault();
    var $this = $(this);
    var $target = $this.prev('input[name=' + $this.attr('field') + ']');
    var currentVal = parseInt($target.val());
    if (!isNaN(currentVal)) {
        $target.val(currentVal+1);
    } else {
        $target.val(0);
    }
});
$(".qtyMinus").click(function (e) {
    e.preventDefault();
    var $this = $(this);
    var $target = $this.next('input[name=' + $this.attr('field') + ']');
    var currentVal = parseInt($target.val());
    if (!isNaN(currentVal)) {
        $target.val((currentVal == 0) ? 0 :currentVal-1);
    } else {
        $target.val(0);
    }
=======
$('.qtyPlus').click(function () {
    $(this).prev().val(+$(this).prev().val() + 1);
});
$('.qtyMinus').click(function () {
    if ($(this).next().val() > 0) $(this).next().val(+$(this).next().val() - 1);
>>>>>>> bdaabd9e899204d515cdde398c50c7dceb8ed927
});
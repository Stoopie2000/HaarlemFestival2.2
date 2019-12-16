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
});
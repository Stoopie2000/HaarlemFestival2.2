$('button[field="quantityTicket"]').click(function (e) {
    e.preventDefault();
    var $this = $(this);
    var $target = $this.parent().find('.qtyTicket');
    var currentVal = parseInt($target.val());
    //check to see if we're adding one or subtracting one
    var adjustment = ($this.hasClass('qtyPlus')) ? 1 : -1;
    if (!isNaN(currentVal)) {
        //check to see if adjustment would go negative if so set to 0.
        $target.val((currentVal + adjustment < 0) ? 0 : currentVal + adjustment);
    } else {
        $target.val(0);
    }
});
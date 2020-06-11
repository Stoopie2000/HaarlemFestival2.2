$("form").one('submit', function() {
    $(this).find('button[type="submit"]').attr('disabled','disabled');
});
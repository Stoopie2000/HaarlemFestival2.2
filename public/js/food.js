$(document).ready(function () {
    $('[data-event="filter"]').on('change', function () {
        let val = $(this).val();
        let cuisineSpans = $('.cuisine');

        $('.restaurant').removeClass('d-none');

        if (val !== 'Select Cuisine style') {
            for(let i = 0; i < cuisineSpans.length; i++) {
                if ($(cuisineSpans[i]).text().search(val) === -1) {
                    $(cuisineSpans[i]).closest('.restaurant').addClass('d-none');
                }
            }
        }
    });

    $('[data-event="reserve"]').on('click', function () {
        const restaurant = $(this).data('restaurant');
        $(this).closest('.box').find('[data-restaurant-name="' + restaurant + '"]').animate({
            marginRight: 0,
            opacity: 1,
        }, 100);
    });

    $('[data-event="cancel"]').on('click', function () {
        const restaurant = $(this).data('restaurant');
        $(this).closest('.box').find('[data-restaurant-name="' + restaurant + '"]').animate({
            marginRight: -800,
            opacity: 0,
        }, 75);
    });
});
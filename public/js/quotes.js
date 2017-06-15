var hidedimmer = function(card) {
    $(card).find('.button.hide-author').hide();
    $(card).find('.card-content').dimmer('hide');
    $(card).find('.button.show-author').show();
}

$(document).ready(function() {
    $('.card .button.show-author').click(function() {
        $(this).hide();
        $(this).parent('.card').find('.card-content').dimmer('show');
        $(this).parent('.card').find('.button.hide-author').show()
    });

    $('.card .button.hide-author').click(function() {
        hidedimmer($(this).parent('.card'));
    });
})
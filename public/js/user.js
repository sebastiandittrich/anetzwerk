var refreshview = function() {
    if ($(window).width() < 768) {
        $('img.profile-image').addClass('centered');
    } else {
        $('img.profile-image').removeClass('centered');
    }
}

$(document).ready(function() {
    refreshview();
    $(window).resize(function() {
        refreshview();
    });
});
$(document).ready(function() {
    refreshview();
    $('#pagemenubutton').click(function() {
        $('#menu').slideToggle("fast", function() {});
    });

    $(window).resize(function() {
        console.log('Size changed')
        refreshview();
    })
});

var refreshview = function() {
    if ($(window).width() < 768) {
        $('.responsive-buttons').children().removeClass('right floated')
        $('.responsive-buttons').children().addClass('fluid')
    } else {
        $('.responsive-buttons').children().last().addClass('right floated')
        $('.responsive-buttons').children().removeClass('fluid')
    }
}
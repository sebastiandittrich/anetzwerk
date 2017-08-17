$(document).ready(function() {
    refreshview();
    $('#pagemenubutton').click(function() {
        $('#menu').slideToggle("fast", function() {});
    });

    $(window).resize(function() {
        refreshview();
    })
});

var refreshview = function() {
    if ($(window).width() < 768) {
        $('.responsive-buttons').children().removeClass('right floated')
        $('.responsive-buttons').children().addClass('fluid')
        $('.responsive-buttons').children('.menu').removeClass('compact')
        $('.responsive-buttons').children('.menu').addClass('item')
    } else {
        $('.responsive-buttons').children().last().addClass('right floated')
        $('.responsive-buttons').children().removeClass('fluid')
        $('.responsive-buttons').children('.menu').addClass('compact')
        $('.responsive-buttons').children('.menu').removeClass('item')
    }
}
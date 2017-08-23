$(document).ready(function() {
    refreshview();
    $('#pagemenubutton').click(function() {
        $('#menu').slideToggle("fast", function() {});
        $('body').animate({scrollTop: 0},500);
    });

    $(window).resize(function() {
        refreshview();
    })

    $('#searchicon').click(function() {
        $('.asearchinput').parent().slideToggle('fast')
        $(this).slideToggle('fast')
        setNavItem('search')
    })

    $('.asearchinput .link.icon').click(function() {
        if($(this).parent().children('input').val() !== "") {
            window.location.href = "/search/all/?query=" + encodeURI($(this).parent().children('input').val())
        }
    })
});

var refreshview = function() {
    if ($(window).width() < 768) {
        $('.responsive-buttons').children().removeClass('right floated')
        $('.responsive-buttons').children().addClass('fluid')
        $('.responsive-buttons').children('.menu').removeClass('compact')
        $('.responsive-buttons').children('.menu').addClass('item')
        headermobile();
    } else {
        $('.responsive-buttons').children().last().addClass('right floated')
        $('.responsive-buttons').children().removeClass('fluid')
        $('.responsive-buttons').children('.menu').addClass('compact')
        $('.responsive-buttons').children('.menu').removeClass('item')
        headerpc();
    }
}

var headermobile = function() {
    var header = $('#pageheader').addClass('icon center aligned')
    header.find('img').addClass('ui image icon')
    header.find('img').css('max-height','70px').css('width', 'auto')
    var menu = $('#menu').addClass('violet')
    menu.css('display', 'none')
    menu.parent().removeClass('ui container')
    $('#pagemenubuttoncontainer.sticky').sticky({onStick: function() {}})
}

var headerpc = function() {
    var header = $('#pageheader').removeClass('icon center aligned')
    header.find('img').removeClass('ui image icon')
    header.find('img').css('max-height:auto;width:auto')
    var menu = $('#menu').removeClass('violet')
    menu.css('display', '')
    menu.parent().addClass('ui container')
}
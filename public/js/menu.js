var sticked = false;

var searchFor = function(string) {
    if(string !== "") {
        window.location.href = "/search/all/?query=" + encodeURI(string)
    }
}

$(document).ready(function() {
    var lastposition = window.scrollY;

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

    $('.asearchinput input').keypress(function(event) {
        if(event.which == 13) {
            searchFor($(this).val());
        }
    })

    $('.asearchinput .link.icon').click(function() {
        searchFor($(this).parent().children('input').val());
    })

    $(window).scroll($.throttle(250, function() {
        var $menu = $('#pagemenubuttoncontainer');
        var difference = window.scrollY - lastposition;
        if(sticked) {
            if(difference > 0) {
                if(!$menu.hasClass('a-hidden')) {
                    $menu.addClass('a-hidden')
                }
            } else {
                if($menu.hasClass('a-hidden')) {
                    $menu.removeClass('a-hidden')
                }
            }
        } else {
            if($menu.hasClass('a-hidden')) {
                $menu.removeClass('a-hidden')
            }
        }
        lastposition = window.scrollY;
    }))
});

var refreshview = function() {
    if ($(window).width() < 768) {
        $('.responsive-buttons').children().removeClass('right floated')
        $('.responsive-buttons').children().addClass('fluid')
        $('.responsive-buttons').children('.menu').removeClass('compact')
        $('.responsive-buttons').children('.menu').addClass('item')
        $('.responsive.cards').find('.card').addClass('fluid');
        headermobile();
    } else {
        $('.responsive-buttons').children().last().addClass('right floated')
        $('.responsive-buttons').children().removeClass('fluid')
        $('.responsive-buttons').children('.menu').addClass('compact')
        $('.responsive-buttons').children('.menu').removeClass('item')
        $('.responsive.cards').find('.card').removeClass('fluid');
        headerpc();
    }
}

var headermobile = function() {
    var header = $('#pageheader').closest('.masthead').hide()
    var menu = $('#menu').addClass('violet')
    $('#pagemenubuttoncontainer.sticky').sticky({onStick: function() {sticked = true;}, onUnstick: function() {sticked = false;}})
}

var headerpc = function() {
    $('#pageheader').closest('.masthead').show()
    $('#menu').removeClass('violet')
}
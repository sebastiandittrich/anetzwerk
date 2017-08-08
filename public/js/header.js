var setNav = function($name) {
    $(document).ready(setNavItem($name));
}

var setNavItem = function($name) {
    $('.large.pointing.menu a.active').removeClass('active');
    $('.large.pointing.menu a#' + $name).addClass('active');
}

var imagedialog = function(element, callback) {
    $.get('/ajax/image.choose-popup').done(function(response) {
        $(element).append(response)
        $(element).click(function() {
            $(element).find('.a-chooseimage').modal('show')
            $(element).find('.a-chooseimage').modal('show dimmer')
        })
        $('.a-chooseimage .uploadform #files').change(function() {
            $.ajax({url: '/images/new', type: 'POST', data: new FormData($('.uploadform')[0]), processData: false, contentType: false, success: function(response) {
                for(var i = 0; i < response.length; i++) {
                    callback(response[i][0], response[i][1])
                }
            $('.a-chooseimage').modal('hide dimmer')
            }});
        })
        $(element).find('.item.upload').click(function() {
            $('.a-chooseimage .uploadform #files').click()
        })
        $('.a-chooseimage').find('.item.my').click(function() {
            $('.a-chooseimage').find('.content').hide()
            $('.a-chooseimage').find('.content.my').css('display', '')
        })
        $('.a-chooseimage .content.my img').click(function() {
            $('.a-chooseimage').modal('hide dimmer')
            callback($(this).attr('data-id'), $(this).attr('src'))
        })
        $('.a-chooseimage').find('.a-backbutton').click(function() {
            $('.a-chooseimage').find('.content').hide()
            $('.a-chooseimage').find('.content.main').css('display', '')
        })
    });
}

$(document).ready(function() {
    $('.ui.checkbox').checkbox();
})
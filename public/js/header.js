var setNav = function($name) {
    $(document).ready(setNavItem($name));
}

var setNavItem = function($name) {
    $('.large.pointing.menu a.active').removeClass('active');
    $('.large.pointing.menu a#' + $name).addClass('active');
}

var imagedialog = function(element, callback) {
    $(element).click(function() {
        $('.a-chooseimage').modal('show')
    })
    $('.a-chooseimage .uploadform #files').change(function() {
        $.ajax({url: '/images/new', type: 'POST', data: new FormData($('.a-chooseimage .uploadform')[0]), processData: false, contentType: false, success: function(response) {
            for(var i = 0; i < response.length; i++) {
                callback(response[i][0], response[i][1])
            }
        $('.a-chooseimage').modal('hide')
        }});
    })
    $('.a-chooseimage .item.upload').click(function() {
        $('.a-chooseimage .uploadform #files').click()
    })
    $('.a-chooseimage .item.my').click(function() {
        $('.a-chooseimage').find('.content.main, .content.all').hide()
        $('.a-chooseimage').find('.content.my').show()
    })
    $('.a-chooseimage .content.my img').click(function() {
        $('.a-chooseimage').modal('hide')
        callback($(this).attr('data-id'), $(this).attr('src'))
    })
    $('.a-chooseimage .a-backbutton').click(function() {
        $('.a-chooseimage').find('.content.my, .content.all').hide()
        $('.a-chooseimage').find('.content.main').show()
    })
}

$(document).ready(function() {
    $('.ui.checkbox').checkbox();
})

$.fn.hasParent=function(e){
        return !$(this).parents(e).length
    }

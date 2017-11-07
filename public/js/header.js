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
        $('.a-chooseimage .dimmer').addClass('active');
        $.ajax({url: '/images/new', type: 'POST', data: new FormData($('.a-chooseimage .uploadform')[0]), processData: false, contentType: false, success: function(response) {
            for(var i = 0; i < response.length; i++) {
                callback(response[i][0], response[i][1])
            }
            $('.a-chooseimage .dimmer').removeClass('active');
            $('.a-chooseimage').modal('hide')
        }});
    })
    $('.a-chooseimage .item.upload').click(function() {
        $('.a-chooseimage .uploadform #files').click()
    })
    $('.a-chooseimage .item.my').click(function() {
        $('.a-chooseimage').find('.content.main, .content.other').hide()
        $('.a-chooseimage').find('.content.my').show()
    })
    $('.a-chooseimage .item.other').click(function() {
        $('.a-chooseimage').find('.content.main, .content.my').hide()
        $('.a-chooseimage').find('.content.other').show()
    })
    $('.a-chooseimage .content img').not('.prevent-click').click(function() {
        $('.a-chooseimage').modal('hide')
        callback($(this).attr('data-id'), $(this).attr('src'))
    })
    $('.a-chooseimage .a-backbutton').click(function() {
        $('.a-chooseimage').find('.content.my, .content.other').hide()
        $('.a-chooseimage').find('.content.main').show()
    })
}

var maximizeimage = function(image) {
    $(document).on('click', image ,function(event) {
        if($(this).hasClass('prevent-fullscreen')) {
            return 
        } else {
            event.preventDefault();
        }
        $('.a-fullscreen-image').find('img').attr('src', $(this).attr('src'));
        $('.a-fullscreen-image').modal('show');
        $('.a-fullscreen-image').find('.a-close').click(function() {
            $('.a-fullscreen-image').modal('hide');
        });
    });
}

var renderdeletemodal = function() {
    if($('#deletemodal').attr('data-object') == "App\\Collection") {
        $('#deletemodal .other').hide()
        $('#deletemodal .collection').show()
    } else {
        $('#deletemodal .other').show()
        $('#deletemodal .collection').hide()
    }
}
$(document).ready(function() {
    $('.ui.checkbox').checkbox();
    maximizeimage('.image img, img.image')
})

var load_content = function(url, array, container, callback) {
    if(array.length < 1) {
        callback()
    } else {
        $.get(url + array.shift()).done(function(data) {
            $(container).append(data)
            $(container).children('div:last-child').hide()
            $(container).children('div:last-child').slideToggle('fast')
            load_content(url, array, container, callback)
        }).fail(function() {
            alert('Etwas ist schief gelaufen. Überprüfe deine Internetverbindung!')
        })
    }
}

$.fn.hasParent=function(e){
        return !$(this).parents(e).length
    }

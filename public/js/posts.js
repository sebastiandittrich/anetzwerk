var toggleShit = function(id, object_name) {
    $.ajax({
        url: '/shits/new',
        data: {object_name: object_name, object_id: id, _token: $('input[name=_token]').val() },
        method: "POST"
    }).done(function(data) {
        if (data == 'richtig') {
            return true;
        } else if (data == 'falsch') {
            return false;
        } else if (data === "notloggedin") {
            alert('Um diese Funktion zu nutzen müssen sie angemeldet sein');
            return "notloggedin"
        } else {
            alert("Ein Fehler ist aufgetreten, versuche es erneut");
            return "fail"
        }
    })
}

var postcomment = function(object, object_id, text, callback) {
    $.ajax({
        url: '/comments/new',
        data: {object: object, object_id: object_id, content: text, _token: $('input[name=_token]').val() },
        method: "POST"
    }).done(function(data) {
        callback();
    }).always(function(data) {
        $('body').prepend(data)
    })
}

var main = function() {
    $('.a-shit').click(function() {
        toggleShit( $(this).attr('data-id'), $(this).attr('data-object') )
        if ($(this).find('i').hasClass('outline')) {
            $(this).find('i').removeClass('outline');
            $(this).find('.counter').text(parseInt($(this).find('.counter').text()) + 1)
        } else {
            $(this).find('i').addClass('outline');
            $(this).find('.counter').text(parseInt($(this).find('.counter').text()) - 1)
        }
    })

    $('.a-comment').keypress(function(event) {
        if(event.which == 13) {
            var self = this
            postcomment($(this).attr('data-object'), $(this).attr('data-id'), $(this).val(), function() {
                alert('comment posted')
                $(self).closest('.card').find('.counter').text(parseInt($(self).closest('.card').find('.counter').text() + 1));
                $(self).val('')
                $(self).parent().find('i').removeClass('outline')
            })
        }
    })

    $('.image img').click(function() {
        $(this).parent().children('.modal').modal('show');
    })

    $('.button .close').parent().click(function() {
        $(this).parent().parent().modal('hide');
    });
}

$(document).ready(main);
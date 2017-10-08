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

var deleteElement = function(object_name, object_id, callback) {
    $.post('/ajax/deleteelement/all', {_token: $('input[name=_token]').val(), object_name: object_name, object_id: object_id}).done(function(response) {
        if(response) {
            callback()
        } else {
            alert('Etwas ist schief gelaufen.')    
        }
    }).fail(function() {
        alert('Etwas ist schief gelaufen.')
    })
}

var elementdeleted = function(element) {
    element.remove()
    $('#deletemodal').modal('hide')
}

var postcomment = function(object, object_id, text, callback) {
    $.ajax({
        url: '/comments/new',
        data: {object: object, object_id: object_id, content: text, _token: $('input[name=_token]').val() },
        method: "POST"
    }).done(function(data) {
        callback(data);
    }).fail(function(data) {
        alert('Etwas ist schief gegangen. Versuche es noch einmal')
    })
}

var main = function() {
    $('.a-shit').click(function() {
        toggleShit( $(this).attr('data-id'), $(this).attr('data-object') )
        if ($(this).find('i').hasClass('outline')) {
            $(this).find('i').removeClass('outline');
            $(this).find('.counter').text(parseInt($(this).find('.counter.a-shit').text()) + 1)
        } else {
            $(this).find('i').addClass('outline');
            $(this).find('.counter').text(parseInt($(this).find('.counter.a-shit').text()) - 1)
        }
    })

    $('.a-comment.a-close').click(function() {
        $(this).closest('.content').slideToggle('fast');
        $(this).closest('.card').find('.show-comments.hint').toggle();
        $(this).closest('.card').find('.hide-comments.hint').toggle();
    })

    $('.a-comment.a-show').click(function() {
        $(this).closest('.card').find('.content.a-comment').slideToggle('fast');
        $(this).closest('.card').find('.show-comments.hint').toggle();
        $(this).closest('.card').find('.hide-comments.hint').toggle();
    })

    $('.a-comment').keypress(function(event) {
        if(event.which == 13) {
            var self = this
            var $card = $(self).closest('.card')
            $(self).closest('.card').find('.comments').append('<i class="notched circle loading icon"></i>')
            if(($card).find('.comments').parent().css('display') == 'none') {
                $card.find('.comments').parent().css('display', '');
                $(this).closest('.card').find('.show-comments.hint').toggle();
                $(this).closest('.card').find('.hide-comments.hint').toggle();
            }
            postcomment($(this).attr('data-object'), $(this).attr('data-id'), $(this).val(), function(data) {
                $card.find('.counter.a-comment').text(parseInt($card.find('.counter.a-comment').text()) + 1);
                $(self).val('')
                $(self).parent().find('i').removeClass('outline')
                $card.find('.comments').append(data)
                $card.find('.comments').find('i').remove()
            })
        }
    })

    $('.a-delete').click(function() {
        $('#deletemodal').attr('data-id', $(this).attr('data-id')).attr('data-object', $(this).attr('data-object'));
        $('#deletemodal').modal('show');
    })

    $('#deletemodal').modal({
        onApprove: function() {
            deleteElement($(this).attr('data-object'), $(this).attr('data-id'), function() {
                elementdeleted($('.card[data-object="'+$(this).attr('data-object')+'"][data-id="'+$(this).attr('data-id')+'"]'))
            })  
            return false;
        },
        blurring: true,
        inverted: true,
    })

    $('#deletemodal .all').click(function() {
        var self = this;
        console.log('all clicked')
        $.post('/ajax/deleteelement/all', {_token: $('input[name=_token]').val(), object_name: $('#deletemodal').attr('data-object'), object_id: $('#deletemodal').attr('data-id')}).done(function(response) {
            if(response) {
                elementdeleted($(self).closest('.card'))
            } else {
                alert('Etwas ist schief gelaufen.')    
            }
        }).fail(function() {
            alert('Etwas ist schief gelaufen.')
        })
    })
    $('#deletemodal .hide').click(function() {
        var self = this;
        $.post('/ajax/deleteelement/hide', {_token: $('input[name=_token]').val(), object_name: $('#deletemodal').attr('data-object'), object_id: $('#deletemodal').attr('data-id')}).done(function(response) {
            if(response) {
                elementdeleted($(self).closest('.card'))
            } else {
                alert('Etwas ist schief gelaufen.')    
            }
        }).fail(function() {
            alert('Etwas ist schief gelaufen.')
        })
    })
}

$(document).ready(main);
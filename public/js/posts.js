var toggleShit = function(id) {
    $.ajax({
        url: '/posts/' + id + '/shits/new',
        data: { _token: $('input[name=_token]').val() },
        method: "POST"
    }).done(function(data) {
        if (data == "true") {
            $(this).removeClass('basic');
            $(this).text('Findest du Scheiße');
            return true;
        } else if (data == "false") {
            $(this).addClass('basic');
            $(this).text('Findest du nicht mehr Scheiße');
            return true;
        } else if (data === "notloggedin") {
            alert('Um diese Funktion zu nutzen müssen sie angemeldet sein');
        } else {
            alert("Ein Fehler ist aufgetreten, versuche es erneut");
        }
    })
}

var main = function() {
    $('.button.shit').click(function() {
        toggleShit($(this).attr('id'))
        if ($(this).hasClass('basic')) {
            $(this).removeClass('basic');
            $(this).text('Findest du Scheiße');
        } else {
            $(this).addClass('basic');
            $(this).text('Findest du nicht mehr Scheiße');
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
$(document).ready(function() {
    $('#changeprofilepicture .item').click(function() {
        var self = $(this)
        self.find('.dimmer .content .center').html('<i class="huge blue notched circle loading icon"></i>')
        $.post('edit/profilepicture', {image_id: $(this).attr('data-id'), _token: $('input[name=_token]').val() }).done(function() {
            self.find('.dimmer .content .center').html('<h5 class="ui green icon header"><i class="green checkmark icon"></i><div class="content">Gespeichert</div></h2>')
            self.dimmer('show')
        })
    })
    imagedialog('#changeprofileimage', function(id, url) {
        $.post('edit/profilepicture', {image_id: id, _token: $('input[name=_token]').val() }).done(function() {
            $('#changeprofileimage').parent().append('<span class="ui green header"><i class="green checkmark icon"></i>Profilbild geändert</span>')
        })
    })
});
$(document).ready(function() {
    $('#changeprofilepicture .item').click(function() {
        var self = $(this)
        self.find('.dimmer .content .center').html('<i class="huge blue notched circle loading icon"></i>')
        $.post('edit/profilepicture', {image_id: $(this).attr('data-id'), _token: $('input[name=_token]').val() }).done(function() {
            self.find('.dimmer .content .center').html('<h5 class="ui green icon header"><i class="green checkmark icon"></i><div class="content">Gespeichert</div></h2>')
            self.dimmer('show')
        }).fail(function() {
            self.find('.dimmer .content .center').html('<h5 class="ui red icon header"><i class="tiny red remove icon"></i><div class="content">Error</div></h2>')
            self.dimmer('show')
        });
    })
});
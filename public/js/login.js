$(document).ready(function() {
    var vue = new Vue({
        el: '#vue',
        data: {
            changing: false,
            failed: false,
            failtext: null,
            steps: {
                username: true,
                password: false
            },
            userdata: {
                username: null,
                firstname: null,
                lastname: null,
                password: null,
                imageurl: null
            }
        },
        methods: {
            continue_clicked() {
                this.steps.username = false;
                this.steps.password = true;
                this.userdata.imageurl = null;
                this.failed = false;
                this.changing = true;
                this.load_profile();
                this.set_focus()
                this.changing = false;
            },
            back_clicked() {
                this.changing = true
                this.steps.username = true
                this.steps.password = false
                this.set_focus()
                $('#profile-background').removeClass('a-ctive')
                this.changing = false
            },
            set_focus(){
            },
            load_profile() {
                var self = this;
                $.get('/api/users/' + self.userdata.username + '/getid', function(response, textStatus, xhr) {
                    self.userdata.username = response.username
                    self.userdata.firstname = response.first_name
                    self.userdata.lastname = response.last_name
                    $.get('/api/images/' + response.image_id, function(responsetwo) {
                        self.userdata.imageurl = '/storage/images/' + responsetwo.path
                    })
                }).fail(function(xhr) {
                    self.failed = true;
                    self.failtext = "Benutzer nicht gefunden"
                })
            },
            profile_image_loaded(fail = false) {
                var self = this
                $('#profile-background').addClass('a-ctive').css({
                    background: "url(" + self.userdata.imageurl + ")",
                    "background-size": "100% 100%"
                })
            }
        }
    })
    var activeinput = null;

    $('input').focus(function() {
        activeinput = $(this);
    });

    $('form').submit(function(event) {
        if (activeinput != null) {
            if (activeinput.attr('name') == 'username') {
                event.preventDefault();
                vue.continue_clicked();
            }
        }
    });
});
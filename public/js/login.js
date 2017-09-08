$(document).ready(function() {
    var vue = new Vue({
        el: '#vue',
        data: {
            changing: false,
            steps: {
                username: true,
                password: false
            },
            userdata: {
                username: null,
                firstname: null,
                lastname: null,
                imageurl: null
            }
        },
        methods: {
            continue_clicked() {
                this.steps.username = false;
                this.steps.password = true;
                this.userdata.imageurl = null;
                this.changing = true;
                this.load_profile();
                this.changing = false;
            },
            load_profile() {
                var self = this;
                $.get('/api/users/' + self.userdata.username + '/getid', function(response) {
                    self.userdata.username = response.username
                    self.userdata.firstname = response.first_name
                    self.userdata.lastname = response.last_name
                    $.get('/api/images/' + response.image_id, function(responsetwo) {
                        self.userdata.imageurl = '/storage/images/' + responsetwo.path
                    })
                })
            },
            profile_image_loaded() {
                var self = this
                $('#profile-background').addClass('a-ctive').css({
                    background: "url(" + self.userdata.imageurl + ")",
                    "background-size": "100% 100%"
                })
            }
        }
    })
    var activeinput = null;

    $('input[type=username]').focus(function() {
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
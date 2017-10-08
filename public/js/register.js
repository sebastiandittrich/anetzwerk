$(document).ready(function() {
    var vue = new Vue({
        el: '#vue',
        data: {
            changing: false,
            failed: false,
            failtext: null,
            username_checked: false,
            username_checking: false,
            username_available: false,
            email_checked: false,
            email_checking: false,
            email_valid: false,
            password_checked: false,
            password_checking: false,
            password_valid: false,
            password_failtext: "",
            submitclicked: false,
            steps: {
                username: true,
                email: false,
                password: false,
            },
            userdata: {
                username: null,
                email: null,
                password: null,
                password_confirmation: null,
            },
            random: {
                fruits: ['ananas', 'banane', 'birne', 'kiwi', 'apfel', 'zitrone', 'orange', 'weintraube', 'aprikose', 'kirsche', 'pflaume', 'pfirsich', 'brombeere', 'himbeere', 'erdbeere', 'blaubeere', 'johannisbeere', 'holunder', 'erdnuss', 'haselnuss', 'kokonuss', 'limette', 'pampelmuse', 'dattel', 'mango', 'melone', 'kürbis'],
                actions: ['subtraktions', 'additions', 'divisions', 'multiplikations', 'minus', 'plus', 'wurzelzieher', 'quadrierer'],
            }
        },
        computed: {
            usernameCheckText() {
                if(this.username_checking) {
                    return "Benutzername wird überprüft"
                } else if(this.username_checked && !this.username_available) {
                    return "Benutzername nicht verfügbar"
                } else if(this.username_checked && this.username_available) {
                    return "Weiter"
                } else if(!this.username_checked && !this.username_checking) {
                    return "Benutzername überprüfen"
                }
            },
            usernameCheckColor() {
                if(this.username_checking) {
                    return "basic blue"
                } else if(this.username_checked && !this.username_available) {
                    return "red"
                } else if(this.username_checked && this.username_available) {
                    return "green"
                } else if(!this.username_checked && !this.username_checking) {
                    return "basic blue"
                }
            },
            usernameCheckIcon() {
                if(this.username_checking) {
                    return "notched loading circle"
                } else if(this.username_checked && !this.username_available) {
                    return "close"
                } else if(this.username_checked && this.username_available) {
                    return "checkmark"
                } else if(!this.username_checked && !this.username_checking) {
                    return "help"
                }
            },
            emailCheckText() {
                if(this.email_checking) {
                    return "Email wird überprüft"
                } else if(this.email_checked && !this.email_valid) {
                    return "Email nicht gültig"
                } else if(this.email_checked && this.email_valid) {
                    return "Weiter"
                } else if(!this.email_checked && !this.email_checking) {
                    return "Email überprüfen"
                }
            },
            emailCheckColor() {
                if(this.email_checking) {
                    return "basic blue"
                } else if(this.email_checked && !this.email_valid) {
                    return "red"
                } else if(this.email_checked && this.email_valid) {
                    return "green"
                } else if(!this.email_checked && !this.email_checking) {
                    return "basic blue"
                }
            },
            emailCheckIcon() {
                if(this.email_checking) {
                    return "notched loading circle"
                } else if(this.email_checked && !this.email_valid) {
                    return "close"
                } else if(this.email_checked && this.email_valid) {
                    return "checkmark"
                } else if(!this.email_checked && !this.email_checking) {
                    return "help"
                }
            },
            passwordCheckText() {
                if(this.password_checking) {
                    return "Passwort wird überprüft"
                } else if(this.password_checked && !this.password_valid) {
                    return this.password_failtext;
                } else if(this.password_checked && this.password_valid) {
                    return "Registrieren"
                } else if(!this.password_checked && !this.password_checking) {
                    return "Passwort überprüfen"
                }
            },
            passwordCheckColor() {
                if(this.password_checking) {
                    return "basic blue"
                } else if(this.password_checked && !this.password_valid) {
                    return "red"
                } else if(this.password_checked && this.password_valid) {
                    return "blue"
                } else if(!this.password_checked && !this.password_checking) {
                    return "basic blue"
                }
            },
            passwordCheckIcon() {
                if(this.password_checking) {
                    return "notched loading circle"
                } else if(this.password_checked && !this.password_valid) {
                    return "close"
                } else if(this.password_checked && this.password_valid) {
                    return ""
                } else if(!this.password_checked && !this.password_checking) {
                    return "help"
                }
            }
        },
        methods: {
            switchToUsername() {
                this.changing = true;
                this.steps.username = true;
                this.steps.email = false;
                this.steps.password = false;
                this.changing = false;
            },
            switchToEmail() {
                this.changing = true;
                this.steps.username = false;
                this.steps.email = true;
                this.steps.password = false;
                this.changing = false;
            },
            switchToPassword() {
                this.changing = true;
                this.steps.username = false;
                this.steps.email = false;
                this.steps.password = true;
                this.changing = false;
            },
            checkUsername(callback = function() {}) {
                this.username_checking = true;
                var self = this;
                $.post('/ajax/isusernamefree', {username: this.userdata.username, _token: $('input[name=_token]').val()}).done(function(response) {
                    var isfree = Boolean(response)
                    self.username_available = isfree;
                    self.username_checked = true;
                    self.username_checking = false;
                    callback(isfree)
                })
            },
            usernameChanged(event) {
                if(event.which == 13) {
                    this.usernameCheckClick()
                } else {
                    this.checkUsername()
                }
            },
            usernameCheckClick() {
                if(this.username_checking) {
                    return 
                } else if(this.username_checked && !this.username_available) {
                    return 
                } else if(this.username_checked && this.username_available) {
                    var self = this;
                    this.checkUsername(function(goon) {
                        if(goon) {
                            self.switchToEmail()
                        }
                    })
                } else if(!this.username_checked && !this.username_checking) {
                    return this.checkUsername()
                }
            },
            emailCheckClick() {
                if(this.email_checking) {
                    return 
                } else if(this.email_checked && !this.email_valid) {
                    return 
                } else if(this.email_checked && this.email_valid) {
                    if(this.checkEmail()) {
                        return this.switchToPassword()
                    }
                } else if(!this.email_checked && !this.email_checking) {
                    return this.checkEmail()
                }
            },
            emailChanged(event) {
                if(event.which == 13) {
                    this.emailCheckClick()
                } else {
                    this.checkEmail()
                }
            },
            checkEmail() {
                this.email_checking = true
                if(this.userdata.email != null) {
                    this.email_valid = Boolean(this.userdata.email.match(/(.+)@(.+[.].+)/g))
                }
                this.email_checked = true;
                this.email_checking = false
                return this.email_valid
            },
            passwordCheckClick() {
                if(this.password_checking) {
                    return 
                } else if(this.password_checked && !this.password_valid) {
                    return 
                } else if(this.password_checked && this.password_valid) {
                    if(this.checkPassword()) {
                        return this.submitClicked()
                    }
                } else if(!this.password_checked && !this.password_checking) {
                    return this.checkPassword()
                }
            },
            passwordChanged(event) {
                if(event.which == 13) {
                    this.passwordCheckClick()
                } else {
                    this.checkPassword()
                }
            },
            checkPassword() {
                this.password_checking = true
                if(this.userdata.password != null) {
                    this.password_valid = this.userdata.password === this.userdata.password_confirmation && this.userdata.password.length > 7
                    this.password_failtext = this.userdata.password.length < 8 ? "Mindestens 8 Zeichen" : "Passwörter stimmen nicht überein"
                }
                this.password_checked = true;
                this.password_checking = false
                return this.password_valid
            },
            usernameRandomClicked() {
                var self = this
                this.userdata.username = this.random.actions[Math.floor(Math.random() * this.random.actions.length)] + '_' + this.random.fruits[Math.floor(Math.random() * this.random.fruits.length)]
                this.checkUsername(function(isfree) {
                    if(!isfree) {
                        self.usernameRandomClicked();
                    }
                })
            },
            submitClicked() {
                this.submitclicked = true;
            }
        }
    })
    $('form').submit(function(event) {
        if(vue.submitclicked == true ) {
            return
        } else {
            event.preventDefault();
        }
    })
    $('a[href=""]').click(function(event) {
        event.preventDefault();
    })
})
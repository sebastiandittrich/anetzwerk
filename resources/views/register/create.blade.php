<html>
    <head>
        @include('layout.includes')
    </head>
    <body style="background:linear-gradient(45deg, #000BA5 0%, #7781FF 100% )">
        <div style="
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background: rgba(0,0,0,0);">
            <a href="/home" style="color:black;text-decoration:none;position:fixed;z-index:1;left:0;top:0;background:rgba(255,255,255,0.6);width:100%;padding:10px">
                <div>
                    <i class="left arrow icon"></i> Zurück zur Startseite
                </div>
            </a>
            <div style="width:500px; margin: 10px !important">
                <h1 class="ui inverted image header"><img class="ui image" src="{{asset('pictures/logo-transparent.png')}}" alt="">Registrieren</h1>
                @include('layout.formerrors')
                <div class="ui stacked segment">
                    <form action="/register" class="ui form" method='POST'>
                        <h4 class='ui dividing header'>Persönliche Informationen (freiwillige Angabe)</h4>
                        <div class="two fields">
                            <div class="field">
                                <input type="text" name='first_name' placeholder='Vorname'/>
                            </div>
                            <div class="field">
                                <input type="text" name='last_name' placeholder='Nachname'/>
                            </div>
                        </div>
                        <h4 class="dividing header ui">Login Informationen</h4>
                        <div class="two fields">
                            <div class="field">
                                <input type="text" name="username" placeholder="Benutzername">
                            </div>
                            <div class="field">
                                <input type="email" name="email" placeholder="E-Mail">
                            </div>
                        </div>
                        <h4 class="ui dividing header">Passwort</h4>
                        <div class="two fields">
                            <div class="field">
                                <input type="password" placeholder="Passwort" name='password'>
                            </div>
                            <div class="field">
                                <input type="password" placeholder="Passwort Wiederholen" name='password_confirmation'>
                            </div>
                        </div>
                        {{csrf_field()}}
                        <input type="submit" class="ui blue basic fluid button" id="login" value='Registrieren'>
                    </form>
                </div>
                <div style="text-align:center" class="ui message">
                    Du bist dem Asozialen Netzwerk schon beigetreten? <a href="/login">Anmelden</a>
                </div>
            </div>
        </div>
        <script>
            $('#login').mouseenter(function() {
                $(this).removeClass('basic')
            })
            $('#login').mouseleave(function() {
                $(this).addClass('basic')
            })
        </script>
    </body>
</html>
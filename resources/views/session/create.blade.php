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
            background: rgba(0,0,0,0)">
            <a href="/home" style="color:black;text-decoration:none;position:fixed;z-index:1;left:0;top:0;background:rgba(255,255,255,0.6);width:100%;padding:10px">
                <div>
                    <i class="left arrow icon"></i> Zurück zur Startseite
                </div>
            </a>
            <div style="width:500px; margin: 10px !important;">
                <h1 class="ui inverted image header"><img class="ui image" src="{{asset('pictures/logo-transparent.png')}}" alt="">Anmelden</h1>
                @include('layout.formerrors')
                <div class="ui stacked segment">
                    <form action="/login" class="ui large form" method="POST">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="user icon"></i>
                                <input type="username" name="username" placeholder="Benutzernamen eingeben...">
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="password" name="password" placeholder="Passwort eingeben...">
                            </div>
                        </div>
                        <div class="field">
                            <button type="submit" class="ui fluid blue basic submit button" id="login">
                                Log in
                            </button>
                        </div>
                        {{csrf_field()}}
                    </form>
                </div>
                <div style="text-align:center" class="ui message">
                    Du bist dem Asozialen Netzwerk noch nicht beigetreten? <a href="/register">Registrieren</a>
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
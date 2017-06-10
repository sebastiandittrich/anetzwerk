<html>
    <head>
        <link rel="stylesheet" href='{{asset('css/semantic/dist/semantic.min.css')}}' />
        <script src='{{asset('js/jquery.js')}}'></script>
        <script src='{{asset('js/header.js')}}'></script>
        <script src='{{asset('css/semantic/dist/semantic.min.js')}}'></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    </head>

    <body class='pushable'>
        <div class="pusher">
            <div class="ui blue tabular inverted vertical masthead center aligned segment">
                <div class="ui container">
                    <h1 class='ui inverted header'><img src="{{asset('pictures/logo-home.png')}}" /> Asoziales Netzwerk</h1>
                    <div class="ui large inverted secondary pointing menu" style="border-left: none; border-top: none; border-right: none;">
                        <a id='home' href="/" class="active item">Home</a>
                        <a id='posts' href="/posts" class="item">Posts</a>
                        <a href="/users" id="user" class="item">Benutzer</a>
                        @if(Auth::check())
                            <a id='myprofile' href='/users/{{Auth::user()->id}}' class="item right">
                                <div class="content">
                                    <div class="ui sub header">Mein Profil</div>
                                    {{Auth::user()->username}}
                                </div>
                            </a>
                        @else
                            <a id='login' href="/login" class="item right">Login</a>
                        @endif
                    </div>
                    @yield('header')
                </div>
            </div>
            <div class="ui vertical inverted grey stripe segment">
                <div class="ui container">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>


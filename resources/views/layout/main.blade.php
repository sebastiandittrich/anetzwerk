<html>
    <head>
        @include('layout.includes')
    </head>

    <body class='pushable'>
        <div class="pusher">
            <div class="ui blue tabular inverted vertical masthead segment">
                <div class="ui center aligned container">
                    <div class="ui left aligned container">
                        <span class='ui huge inverted header' id="pageheader"><img src="{{asset('pictures/logo-home.png')}}" /> Asoziales Netzwerk</span>
                        <button class="ui right floated blue button" id="pagemenubutton"><i class="sidebar icon"></i>Menu</button>
                    </div>
                    <div class="ui large stackable inverted secondary pointing menu" style="border-left: none; border-top: none; border-right: none;" id="menu">
                        <a id='home' href="/" class="active item">Home</a>
                        <a id='activities' href="/activities" class="active item">Aktivitäten</a>
                        <a id='posts' href="/posts" class="item">Posts</a>
                        <a id='quotes' href="/quotes" class="item">Zitate</a>
                        <a href="/users" id="user" class="item">Benutzer</a>
                        @if(Auth::check())
                            <a id='myprofile' href='/users/{{Auth::user()->id}}' class="item right">
                                <div class="content">
                                    <div>
                                        <img src="{{Auth::user()->profileimage()->getURL()}}" alt="Profile Picture" class="ui avatar image">{{Auth::user()->username}}
                                    </div>
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
                <div id="page-content" class="ui container">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>


<html lang="de">
    <head>
        @include('layout.includes')
    </head>

    <body class='pushable'>
        <div class="pusher">
            <div class="ui blue tabular inverted vertical masthead segment">
                <div class="ui center aligned container">
                    <div class="ui left aligned container">
                        <a href="/home" class='ui huge inverted header' id="pageheader"><img src="{{asset('pictures/logo-outline-white.svg')}}" class="ui image icon" /> Asoziales Netzwerk</a>
                    </div>                    
                </div>
            </div>
            <div class="ui segment vertical inverted stripe violet sticky" id="pagemenubuttoncontainer">
                <div class="ui container segment basic clearing" style="padding: 0px">
                    <div class="ui violet right floated button" id="pagemenubutton">
                        <i class="sidebar icon"></i>
                        Menu
                    </div>
                    <div class="ui fluid icon input asearchinput">
                        <i class="ui inverted link search icon"></i>
                        <input type="text" placeholder="Search...">
                    </div>
                </div>
            </div>
            <div class="ui blue tabular inverted vertical masthead segment">
                <div class="ui container">
                    <div class="ui large stackable inverted secondary pointing menu" style="border-left: none; border-top: none; border-right: none;" id="menu">
                        <a id='home' href="/" class="active item"><i class="@lang('site_icons.App\\Home') icon"></i> Home</a>
                        <a id='activities' href="/activities" class="active item"><i class="@lang('site_icons.App\\Activity') icon"></i> Feed</a>
                        <a id='quotes' href="/quotes" class="item"><i class="@lang('site_icons.App\\Quote') icon"></i> Zitate</a>
                        <a href="/users" id="user" class="item"><i class="@lang('site_icons.App\\User') icon"></i> Benutzer</a>
                        <a id="searchicon" class="item"><i class="@lang('site_icons.App\\Search') icon"></i></a>
                        <div class="item" id="search" style="display:none">
                            <div class="ui icon input asearchinput">
                                <i class="ui inverted link @lang('site_icons.App\\Search') icon"></i>
                                <input type="text" placeholder="Search...">
                            </div>
                        </div>
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
                </div>  
            </div>
            <div class="ui segment vertical inverted stripe blue" style="padding-top: 0px">
                <div class="ui container not-responsive">
                    @yield('header')
                </div>
            </div>
            @yield('outercontent')
            <div class="ui vertical inverted grey stripe segment">
                <div id="page-content" class="ui container">
                    @yield('content')
                    @include('image.fullscreen')
                </div>
            </div>
        </div>
    </body>
</html>


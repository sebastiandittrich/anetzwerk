@extends('layout.main')

@section('title')
    Home
@endsection

@section('header')
    <h1 class='ui inverted header'>Willkommen beim Asozialen Netzwerk.</h1>
    <script>setNav('home')</script>
    <style>
        p {
            font-size: 16px;
        }
        .segment.padded {
            padding: 50px !important;
        }
    </style>
@endsection

@section('outercontent')
    @if(!Auth::check())
        <div class="ui vertical stripe segment padded">
            <div class="ui center aligned container">
                <h1 class="ui icon header">
                    <i class="id badge icon"></i>
                    Du bist neu hier?
                </h1>
                <p style="color: black">
                    Registriere dich beim Asozialen Netzwerk!
                </p>
                <a href="/register" class="blue ui labeled icon button"><i class="sign in icon"></i>Jetzt Registrieren</a>
            </div>
        </div>
        <div class="ui vertical blue inverted stripe segment padded">
            <div class="ui center aligned container">
                <h1 class="ui inverted icon header">
                    <img src="{{asset('/pictures/logo-outline-white.png')}}" alt="Logo" style="height:100px;width:auto" class="ui icon image">
                    Was ist das Asoziale Netzwerk?
                </h1><br><br>
                <p>
                    Weil nähmlich das System asozial ist, ist alles was sozial genannt wird eigentlich asozial, darum muss etwas wahrhaft soziales asozial genannt werden. Folglich ist ein soziales Netzwerk ein asoziales." 
                    <br>~ Das Känguru im Känguru-Manifest von Marc-Uwe Kling
                </p><br>
                <a href="http://www.marcuwekling.de" class="ui inverted button labeled icon"><i class="ui linux icon"></i>Webseite von Marc-Uwe-Kling</a>
            </div>
        </div>
        <div class="ui vertical stripe segment padded">
            <div class="ui center aligned container">
                <h1 class="ui icon header">
                    <i class="outline user icon"></i>
                    Du bist dem asozialen Netzwerk schon beigetreten?
                </h1>
                <p>
                    Melde dich an, um zu sehen was zu verpasst hast!
                </p>
                <a href="/login" class="blue ui labeled icon button"><i class="sign in icon"></i>Jetzt Anmelden</a>
            </div>
        </div>
    @endif
    {{--  <div class="ui padded segment">
        <h3 class="ui horizontal divider header">Erklärung zum Asozialen Netzwerk</h3>
        Weil nähmlich das System asozial ist, ist alles was sozial genannt wird eigentlich asozial, darum muss etwas wahrhaft soziales asozial genannt werden. Folglich ist ein soziales Netzwerk ein asoziales." ~ Das Känguru im Känguru-Manifest von Marc-Uwe Kling
    </div>
    <img src="{{asset('/pictures/logo-home.png')}}" alt="" class="ui huge centered image">  --}}
@endsection
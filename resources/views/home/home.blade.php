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
@endsection

@section('content')
@if(Auth::check())
    <h2 class="ui horizontal divider header">Neuigkeiten</h2>
    <div class="ui centered cards">
        <div class="ui card">
            <div class="content">
                <div class="ui icon header"><i class="newspaper blue icon"></i>Erweiterte Posts</div>
                <div class="description">Du kannst jetzt mehrere Elemente auf einmal hochladen, die als Sammlung angezeigt werden.</div>
            </div>
            <a href="/activities/new" class="ui bottom attached green button right labeled icon">
                <i class="add icon"></i> 
                Elemente hochladen   
            </a>
        </div>
        <div class="ui card">
            <div class="content">
                <div class="ui icon header"><i class="user blue icon"></i>Login</div>
                <div class="description">Die Login und Registrierungs-Oberflächen wurden Überarbeitet und sehen jetzt noch besser aus!</div>
            </div>
            <a href="/login" class="ui bottom attached green right labeled icon button">
                <i class="id card outline icon"></i> 
                Jetzt ansehen 
            </a>
        </div>
        <div class="ui card">
            <div class="content">
                <div class="ui icon header"><i class="image blue icon"></i>Profilbilder</div>
                <div class="description">Jeder Benutzer kann jetzt ein persönliches Profilbild hochladen, welches überall angezeigt wird, wo dein Profil auftaucht.</div>
            </div>
            <a href="/users/{{Auth::user()->id}}/edit" class="ui bottom attached green right labeled icon button">
                <i class="id mouse pointer icon"></i> 
                Jetzt ein Profilbild festlegen
            </a>
        </div>
        <div class="ui card">
            <div class="content">
                <div class="ui icon header"><i class="blue search icon"></i>Suche</div>
                <div class="description">Du kannst jetzt das Asoziale Netzwerk einfach nach Benutzern, Aktivitäten und anderem durchsuchen!</div>
            </div>
            <a href="/search/all/?query=Test" class="ui bottom attached green right labeled icon button">
                <i class="search icon"></i> 
                Suche starten
            </a>
        </div>
        <div class="ui card">
            <div class="content">
                <div class="ui icon header"><i class="red remove icon"></i>Posts</div>
                <div class="description">Posts wurden durch Erweiterte Posts ersetzt. Aber keine Angst: bestehende Posts bleiben weiterhin erhalten!</div>
            </div>
            <a href="/activities" class="ui bottom attached red right labeled icon button">
                <i class="newspaper icon"></i> 
                Erweiterte Posts anzeigen
            </a>
        </div>
    </div>
@endif
@endsection
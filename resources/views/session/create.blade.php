@extends('layout.fullscreen')

@section('title')
    Anmelden
@endsection

@section('content')
<div id="vue">
    <div class="ui dimmer" :class="{active: changing}"><div class="ui inverted text loader">Profil wird gesucht</div></div>
    <a href="/home" style="color:black;text-decoration:none;position:fixed;z-index:1;left:0;top:0;background:rgba(255,255,255,0.6);width:100%;padding:10px">
        <div>
            <i class="left arrow icon"></i> Zurück zur Startseite
        </div>
    </a>
    <div style="max-width: 500px; margin: 10px !important;filter: drop-shadow(0px 0px 1px rgba(0,0,0,0.6))" :class="{changing: changing}">
        
        <h1 class="ui inverted image header"><img class="ui image" src="{{asset('pictures/logo-outline-white.svg')}}" alt="">Anmelden</h1>
        @include('layout.formerrors')
        <div class="ui segment">
            <div class="ui clearing container" v-if="steps.password">
                <div class="ui large right floated list">
                    <div class="item">
                        <img :src="userdata.imageurl" v-show="userdata.imageurl != null && !failed" @load="profile_image_loaded" class="ui right floated image avatar profile" :class="{loaded: userdata.imageurl !== null}"/>
                        <div class="content">
                            <div class="header"><span v-show="!failed">@{{userdata.firstname}} @{{userdata.lastname}}</span><span style="color: red;" v-show="failed"><i class="red warning circle icon"></i>@{{failtext}}</span></div>
                            <div class="description" v-show="!failed">@{{userdata.username}}</div>  
                        </div>    
                    </div>
                </div>
            </div><br class="responsive">
            <div v-if="steps.username" class="ui tiny header">Bitte gib als erstes deinen Benutzernamen an.</div>
            <div v-if="steps.password" class="ui tiny header">Bitte gib jetzt dein Passwort ein.</div>
            <form action="/login" class="ui large form" method="POST">
                <div class="field">
                    <div class="ui left icon input" v-show="steps.username">
                        <i class="user icon"></i>
                        <input v-model="userdata.username" type="username" name="username" placeholder="Benutzernamen eingeben..." >
                    </div>
                </div>
                <div class="field" v-show="steps.password">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input v-model="userdata.password" type="password" name="password" placeholder="Passwort eingeben..." >
                    </div>
                </div>
                <div id="log-in-button" v-show="steps.password" class="field" v-show="steps.password">
                    <button v-show="userdata.password" type="submit" class="ui fluid blue submit button" id="login">
                        Log in
                    </button>
                    <div class="ui fluid blue basic button" v-show="userdata.password == null || userdata.password == ''" @click="back_clicked">
                        Zurück
                    </div>
                </div>
                <div id="continue-button" class="field" v-show="steps.username" @click="continue_clicked">
                    <button class="ui fluid blue button">
                        Weiter <i class="angle right icon"></i>
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
    <script src="{{asset('js/login.js')}}"></script>
@endsection
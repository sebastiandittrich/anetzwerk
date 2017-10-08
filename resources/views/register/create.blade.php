@extends('layout.fullscreen')

@section('title')
    Registrieren
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
        
        <h1 class="ui inverted image header"><img class="ui image" src="{{asset('pictures/logo-transparent.png')}}" alt="">Registrieren</h1>
        @include('layout.formerrors')
        <div class="ui segment">
            <div v-if="steps.username" class="ui tiny header">Bitte gib als erstes einen Benutzernamen an, den den du gerne haben würdest.</div>
            <div v-if="steps.email" class="ui tiny header">Als nächstes teile uns bitte deine Email-Adresse mit.</div>
            <div v-if="steps.password" class="ui tiny header">Bitte gib jetzt dein Passwort ein und wiederhole es zur Sicherheit.</div>
            <form action="/register" class="ui large form" method="POST">
                <div class="field" v-show="steps.username">
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input @input="usernameChanged" @change="usernameChanged" v-model="userdata.username" type="username" name="username" placeholder="Benutzernamen eingeben...">
                    </div>
                </div>
                <div class="field" v-show="steps.email">
                    <div class="ui left icon input">
                        <i class="mail icon"></i>
                        <input @input="emailChanged" @change="emailChanged" v-model="userdata.email" type="email" name="email" placeholder="Email-Adresse eingeben..." >
                    </div>
                </div>
                <div class="field" v-show="steps.password">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input @input="passwordChanged" @change="passwordChanged" v-model="userdata.password" type="password" name="password" placeholder="Passwort eingeben..." >
                    </div>
                </div>
                <div class="field" v-show="steps.password">
                    <div class="ui left icon input">
                        <i class="lock icon"></i>
                        <input @input="passwordChanged" @change="passwordChanged" v v-model="userdata.password_confirmation" type="password" name="password_confirmation" placeholder="Passwort wiederholen..." >
                    </div>
                </div>
                <div class="field" v-show="steps.username">
                    <button class="ui fluid button" :class="usernameCheckColor" @click="usernameCheckClick">
                        <i class="icon" :class="usernameCheckIcon"></i>@{{usernameCheckText}}
                    </button>
                </div>
                <div class="field" v-show="steps.username">
                    <button class="ui fluid button" @click="usernameRandomClicked">
                        <i class="gift icon" ></i>Zufälliger Benutzername
                    </button>
                </div>
                <div class="field" v-show="steps.email">
                    <button class="ui fluid button" v-show="userdata.email != null && userdata.email != ''" :class="emailCheckColor" @click="emailCheckClick">
                        <i class="icon" :class="emailCheckIcon"></i>@{{emailCheckText}}
                    </button>
                    <button class="ui fluid blue basic button" v-show="userdata.email == null || userdata.email == ''" @click="switchToUsername">
                        Zurück
                    </button>
                </div>
                <a href="" v-show="userdata.email != null && userdata.email != '' && steps.email" @click="switchToUsername">
                    Zurück
                </a>
                <div v-show="steps.password" class="field">
                    <button @click="passwordCheckClick" v-show="userdata.password" type="submit" class="ui fluid submit button" :class="passwordCheckColor">
                        <i class="icon" :class="passwordCheckIcon"></i>@{{passwordCheckText}}
                    </button>
                    <button class="ui fluid blue basic button" v-show="userdata.password == null || userdata.password == ''" @click="switchToEmail">
                        Zurück
                    </button>
                </div>
                <a href="" v-show="userdata.password != null && userdata.password != '' && steps.password" @click="switchToEmail">
                    Zurück
                </a>
                {{csrf_field()}}
            </form>
        </div>
        <div style="text-align:center" class="ui message">
            Du bist dem Asozialen Netzwerk schon beigetreten? <a href="/login">Anmelden</a>
        </div>
    </div>
</div>
<script src="{{asset('js/register.js')}}"></script>
@endsection
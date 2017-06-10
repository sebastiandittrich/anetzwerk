@extends('layout.main')

@section('header')
    <h2 class='ui left aligned inverted header'>Registrieren</h2>
    <script>setNav('login');</script>
@endsection

@section('content')

    @include('layout.formerrors')

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
        <input type="submit" class="ui positive left aligned button" value='Registrieren'>
    </form>

@endsection
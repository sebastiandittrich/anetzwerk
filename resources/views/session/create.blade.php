@extends('layout.main')

@section('header')
    <h2 class='ui left aligned inverted header'>Anmelden</h2>
    <script>setNav('login');</script>
@endsection

@section('content')

    @include('layout.formerrors')

    <form action="/login" class="ui form" method='POST'>
        <h4 class='ui dividing header'>Benutzername</h4>
        <div class="ui field">
            <input type="text" name='username' placeholder='Benutzername'/>
        </div>
        <h4 class="dividing header ui">Passwort</h4>
        <div class="field">
            <input type="password" name="password" placeholder="Passwort">
        </div>
        {{csrf_field()}}
        <input type="submit" class="ui positive center aligned button" value='Anmelden'>
    </form>
    <a href="/register" class='ui right aligned basic blue button'>Ich habe noch kein Konto</a>

@endsection
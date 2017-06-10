@extends('layout.main')

@section('header')
    <h2 class='ui left aligned header inverted'>Andere Benutzer</h2>
    <script>setNav('user')</script>
@endsection

@section('content')

    <div class="ui segment">
    <h4 class="ui horizontal divider header">Alle Benutzer</h4>
    <div class="ui dividied selection list">
    @foreach($users as $user)
        <a href="users/{{$user->id}}" class="item">
            <div class="ui red label">
                <i class="white user icon"></i>
                {{$user->username}}
            </div>
            {{$user->created_at->diffForHumans()}} beigetreten
        </a>
    @endforeach
    </div>
    </div>

@endsection
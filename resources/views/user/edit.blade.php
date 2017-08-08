@extends('layout.main')

@section('header')
    <h2 class='ui left aligned inverted header'>Mein Profil bearbeiten</h2>
    <script>setNav('myprofile');</script>
    <script src='{{asset('js/edituser.js')}}'></script>
@endsection

@section('content')

    @include('layout.formerrors')

    <form action="/users/{{$user->id}}/edit" class="ui form" method='POST'>
        <div class="ui segment">
            <h4 class="ui horizontal divider header">Profilbild</h4>
            <div class="ui horizontal list" id='changeprofilepicture'>
                @foreach($user->images as $image)
                    <div class='ui blurring item' data-id='{{$image->id}}'>
                        @include('layout.postimage')
                        <div class='ui inverted dimmer'>
                            <div class="content">
                                <div class="center"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="ui segment">
            <h4 class="ui horizontal divider header">Persönliche Informationen</h4>
            <div class="two fields">
                <div class="field">
                    <div class="ui labeled input">
                        <div class="ui label">Vorname</div>
                        <input type="text" name='first_name' placeholder='Vorname eingeben' value="{{$user->first_name}}"/>
                    </div>
                </div>
                <div class="field">
                    <div class="ui labeled input">
                        <div class="ui label">Nachname</div>
                        <input type="text" name='last_name' placeholder='Nachname eingeben' value="{{$user->last_name}}"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui segment">
            <h4 class="ui horizontal divider header">Kontoinformationen</h4>
            <div class="field">
                <div class="ui labeled input">
                    <div class="ui label"><i class='mail icon'></i>Email</div>
                    <input type="text" name='email' placeholder='Email Adresse eingeben' value="{{$user->email}}"/>
                </div>
            </div>
        </div>
        {{csrf_field()}}
        <button type="submit" class="ui positive labeled icon left aligned button"><i class='save icon'></i>Änderungen speichern</button>
    </form>

@endsection

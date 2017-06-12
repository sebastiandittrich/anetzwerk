@extends('layout.main')

@section('header')
    <h2 class='ui left aligned inverted header'>Post bearbeiten</h2>
    <script>setNav('posts');</script>
    <script src='{{asset('js/newpost.js')}}'></script>
    <style>
        #result img {
            height: 100px;
        }

        #files {
            display: none;
        }
    </style>
@endsection

@section('content')

    @include('layout.formerrors')
    <output id="list"></output>

    <form action="/posts/{{$post->id}}/edit" class="ui form" method='POST' enctype="multipart/form-data">
        <h4 class='ui dividing header'>Titel</h4>
            <div class="field">
                <input type="text" name='header' placeholder='Titel eingeben' value="{{$post->header}}"/>
            </div>
        <h4 class="dividing header ui">Inhalt</h4>
            <div class="field">
                <textarea name="content" placeholder="Inhalt eingeben">{{$post->content}}</textarea>
            </div>
        {{csrf_field()}}
        <button type="submit" class="ui positive labeled icon left aligned button"><i class="save icon"></i>Änderungen speichern</button>
    </form>

@endsection

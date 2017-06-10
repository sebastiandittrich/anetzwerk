@extends('layout.main')

@section('header')
    <h2 class='ui left aligned inverted header'>Neuer Post</h2>
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

    <form action="/posts/new" class="ui form" method='POST' enctype="multipart/form-data">
        <div class="ui segment">
            <h4 class="ui horizontal divider header">Bilder</h4>
            <div class="ui horizontal list" id='result'>
                <div class="item">
                    <div class="ui huge icon button" id='modernfilebutton'><i class="add icon"></i></div>
                </div>
            </div>
            <input type="file" accepts='image/*' name='files[]' id='files' style='' multiple>
        </div>
        <div class="ui segment" id='tags'>
            <h4 class="ui horizontal divider header">Tags</h4>
            <div class="ui horizontal list">
            </div><br><br>
            <div class="ui input">
                <input id='taginput' type='text' placeholder='Tag eingeben' />
            </div>
            <div class="ui button" id='tagsubmit'>Hinzufügen</div>
            <textarea style='display: none' name='tagdata' id='tagdata'></textarea>
        </div>
        <h4 class='ui dividing header'>Titel</h4>
            <div class="field">
                <input type="text" name='header' placeholder='Titel eingeben'/>
            </div>
        <h4 class="dividing header ui">Inhalt</h4>
            <div class="field">
                <textarea name="content" placeholder="Inhalt eingeben"></textarea>
            </div>
        {{csrf_field()}}
        <input type="submit" class="ui positive left aligned button" value='Veröffentlichen'>
    </form>

@endsection

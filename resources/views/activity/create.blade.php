@extends('layout.main')

<title>Elemente hochladen - Asoziales Netzwerk</title>

@section('header')
    <h1 class='ui inverted header'>Neue Aktivität</h1>
    <script>setNav('activities')</script>
    <script src="{{asset('js/newactivity.js')}}"></script>
    <script src="//cdn.quilljs.com/1.3.1/quill.min.js"></script>
    <link href="//cdn.quilljs.com/1.3.1/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
{{csrf_field()}}
<div id="vuebox">
    <div id="addedcontent" class="ui container">
        <div style="margin-top:10px;margin-bottom:10px;" class="ui container" v-for="element in addedelements">
            <div class="ui small rounded image" v-if="element.object=='App\\Image'">
                <a class="ui red right corner label a-close" @click="deleteElement(element.index)"><i class="close window icon"></i></a>
                <img v-bind:src="element.url" alt="Picture">
            </div>
            <div class="ui segment" style="padding:0px;" v-if="element.object=='App\\Post'">
                <a class="ui red right corner label a-close" @click="deleteElement(element.index)"><i class="close window icon"></i></a>
                <div v-bind:id="'editor' + element.index" style="height:300px">
                </div>
            </div>
        </div>
    </div><br>
    <div class='responsive-buttons' id="additembuttons">
        <h4 class="ui header">Elemente hinzufügen</h4>
        <div class="ui huge compact two item menu">
            <a class="item a-image" style=""><i class="large icons"><i class="green image icon"></i><i class="corner add icon"></i></i></a>
            <a @click="addText" class="item a-text"><i class="large icons"><i class="blue left align icon"></i><i class="corner add icon"></i></i></a>
        </div>
        <div @click="submitForm" class="ui positive huge left labeled icon button" id="submitbutton">Hochladen<i class="checkmark icon"></i></div>
    </div>

    <div class="ui modal" id="additemmodal">
        <div class="header">Welches Element willst du hochladen?</div>
        <div class="content">
            <div class="ui list">
                <a class="ui a-image item">
                    <i class="green image icon"></i>
                    <div class="content">
                        <div class="header">Bild</div>
                        <div class="description">Lade ein Bild hoch oder wähle eines aus bereits hochgeladenen aus.</div>
                    </div>
                </a>
                <a class="ui item a-text">
                    <i class="blue align left icon"></i>
                    <div class="content">
                        <div class="header">Text</div>
                        <div class="description">Schreibe einen Text mit Formatierung</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div id="templates" style="display:none">
        <div class="image">
            <div class="ui small rounded image">
                <a class="ui red right corner label a-close"><i class="close window icon"></i></a>
                <img src="" alt="Picture"><br>
            </div>
        </div>
        <div class="text">
            <div class="ui segment">
                <div id="editor" style="height:300px">
                </div>
            </div>
        </div>
    </div>

    @include('image.choose-popup')
</div>
@endsection
@extends('layout.main')

@section('header')
    <h2 class='ui left aligned inverted header'>Alle Posts zum Tag</h2>
    <script>setNav('posts');</script>
    <script src='{{asset('js/posts.js')}}'></script>
    {{csrf_field()}}
@endsection

@section('content')

    <div class="ui grid">
        <div class="row">
            <div class="column">
                <div class="ui segment">
                    <h4 class="ui divider horizontal header">Tag</h4>
                    <div class="ui blue tag label">{{$tag->name}}</div>
                </div>
            </div>
        </div>

        @foreach($tag->posts as $post)
            <div class="row">
                <div class="column">
                    @include('layout.postoverview')
                </div>
            </div>
        @endforeach

    </div>

@endsection
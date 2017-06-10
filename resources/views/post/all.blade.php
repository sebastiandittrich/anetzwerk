@extends('layout.main')

@section('header')
    <script>setNav('posts')</script>
    <script src='{{asset('js/posts.js')}}'></script>
@endsection

@section('content')
    {{csrf_field()}}
    <div class='ui segment'>
        <h4 class="ui horizontal divider header">Optionen</h4>
        
        
        <div class="ui vertical buttons">
            <button class="ui labeled icon button"><i class="filter icon"></i>Filtern</button>
            <button class="ui labeled icon button"><i class="sort icon"></i>Ordnen nach: Datum</button>
        </div>

        @if(Auth::check())
            <a href='/posts/new' class="ui right floated labeled icon button"><i class="add icon"></i>Neuen Post schreiben</a>
        @endif
        
    </div>
    <h4 class='ui horizontal divider header'>Alle Posts</h4>

    <div class='ui grid'>
        @foreach($posts as $post)
            <div class="row">
                <div class='column'>
                    @include('layout.postoverview')
                </div>
            </div>
        @endforeach
    </div>

@endsection
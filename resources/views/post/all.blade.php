@extends('layout.main')

@section('header')
    <h2 class='ui left aligned inverted header'>Alle Posts</h2>
    <script>setNav('posts')</script>
    <script src='{{asset('js/posts.js')}}'></script>
@endsection

@section('content')
    {{csrf_field()}}
    <div class='ui segment'>
    <h4 class="ui horizontal divider header">Optionen</h4>
        <div class='responsive-buttons'>
            <button class="ui fluid labeled icon button"><i class="filter icon"></i>Filtern</button><br class="responsive">
            <button class="ui fluid labeled icon button"><i class="sort icon"></i>Ordnen nach: Datum</button>
            

            @if(Auth::check())
                <br class="responsive"><a href="/posts/new" class="ui fluid blue labeled icon button"><i class="add icon"></i>Neuer Post</a>
            @endif
        </div>
        
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
@extends('layout.main')

@section('header')
    <h2 class='ui left aligned inverted header'>Details</h2>
    <script>setNav('posts');</script>
    <script src='{{asset('js/posts.js')}}'></script>
@endsection

@section('content')

    <div class="ui grid">
        @if(Auth::user())
            @if(Auth::user()->id == $post->user_id)
                <div class="row">
                    <div class="column">
                        <div class="ui segment">
                            <h4 class="ui horizontal divider header">Aktionen</h4>
                                <div class="ui buttons">
                                    <a href='/posts/{{$post->id}}/delete' class="ui red labeled icon button">
                                        <i class="delete icon"></i> 
                                        Löschen
                                    </a>
                                    <a href='/posts/{{$post->id}}/edit' class="ui blue right labeled icon button">
                                        <i class="edit icon"></i>
                                        Bearbeiten
                                    </a>
                                </div>
                        </div>
                    </div>
                </div>  
            @endif
        @endif

        <div class="row">
            <div class="column">
                <h4 class="ui horizontal divider header">Post</h4>
                <div class="ui top attached violet inverted segment">
                    {{$post->header}}
                </div>
                <div class="ui bottom attached segment">
                    <div class="ui grid">
                        <div class="row">
                            <div class="column">{!! nl2br($post->content) !!}</div>
                        </div>
                        <div class="row">
                            <div class="column">
                                @include('layout.shitbutton')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <div class="ui segment">
                    <h4 class="ui horizontal divider header">Details</h4>
                    <div class="ui divided selection list">
                        <a href='user/{{$post->user->id}}' class="item">
                            <div class="ui red horizontal label">{{$post->user->username}}</div>
                            Autor
                        </a>
                        <div class="item">
                            <div class="ui brown horizontal label">{{count($post->shits())}}</div>
                            Leute finden das Scheiße
                        </div>
                        <div class="item">
                            <div class="ui violet horizontal label">{{count($post->comments)}}</div>
                            Leute haben ihren Senf dazugegeben
                        </div>
                        <a href="/posts/date/{{$post->created_at->format('o-m-d')}}" class="item">
                            <div class="ui red horizontal label"><?php setlocale(LC_TIME, 'German'); ?>{{$post->created_at->formatLocalized('%A %d %B %Y')}}</div>
                            Veröffentlicht
                        </a>
                        <a href="/posts/date/{{$post->updated_at->format('o-m-d')}}" class="item">
                            <div class="ui red horizontal label"><?php setlocale(LC_TIME, 'German'); ?>{{$post->updated_at->formatLocalized('%A %d %B %Y')}}</div>
                            Zuletzt bearbeitet
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if(count($post->tags))
            <div class="row">
                <div class="column">
                    <div class="ui segment">
                        <h4 class="ui horizontal divider header">Tags</h4>
                        <div class="ui horizontal list">
                            @foreach($post->tags as $tag)
                                <div class="item"><a href="/tags/{{$tag->id}}" class="ui blue tag label">{{$tag->name}}</a></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(count($post->images))
            <div class="row">
                <div class="column">
                    <div class="ui segment">
                        <h4 class="ui horizontal divider header">Bilder</h4>
                        <div class="ui horizontal list">
                            @foreach($post->images as $image)
                                <div class='item'>
                                    @include('layout.postimage')
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(Auth::check())
            <div class="row">
                <div class="column">
                    <div class="ui segment">
                        <h4 class="ui horizontal divider header">Neuen Kommentar schreiben</h4>
                        <form action="/posts/{{$post->id}}/comments/new" class="ui form" method='POST'>
                            <div class="field">
                                <textarea name="content" placeholder="Kommentar eingeben"></textarea>
                            </div>
                            {{csrf_field()}}
                            <input type="submit" class="ui violet button" value='Kommentar veröffentlichen'>
                        </form>
                    </div>
                </div>
            </div>            
        @endif

        <div class="row">
            <div class="column">
                <h4 class="ui divider horizontal header">Kommentare</h4>
                @foreach($post->comments as $comment)
                    <div class="ui top attached violet segment">
                        <a href='{{$comment->user->id}}'>{{$comment->user->username}}</a> {{$comment->created_at->diffForHumans()}}
                    </div>
                    <div class="ui bottom attached segment">
                        {!! nl2br($comment->content) !!}
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

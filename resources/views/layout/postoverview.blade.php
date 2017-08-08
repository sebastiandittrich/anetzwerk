<a href='/posts/{{$post->id}}/details'><h5 class="ui top attached inverted header">{{$post->header}}</h5></a>
<div class='ui attached tiny violet header'><a href='/users/{{$post->user->id}}'><img src="{{$post->user->profileimage()->getURL()}}" alt="Profile Picture" class="ui avatar image">{{$post->user->username}} {{$post->created_at->diffForHumans()}}</a></div>
@if(count($post->images))
    <div class="ui attached segment">
        <div class="ui horizontal list">
            @foreach($post->images as $image)

                <div class='item'>
                    @include('layout.postimage')
                </div>

            @endforeach
        </div>
    </div>
@endif
<div class="ui bottom attached segment">

    <div class="ui grid">
        <div class="row">
            <div class="column">
                {!! nl2br($post->content) !!}
            </div>
        </div>
        <div class="row">
            <div class="column">
                <div class="ui horizontal list">

                    @foreach($post->tags as $tag)
                        <div class="item">
                            <a href="/tags/{{$tag->id}}" class="ui blue tag label">{{$tag->name}}</a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="two column row">
            <div class="column">
                @include('layout.shitbutton')
            </div>
            <div class="column">
                <a href='/posts/{{$post->id}}/details' class="ui right floated violet button">
                    <i class="comment icon"></i>
                    Kommentare anzeigen
                </a>
            </div>
        </div>
    </div>
</div>

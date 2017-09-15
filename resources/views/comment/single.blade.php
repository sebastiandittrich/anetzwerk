<div class="comment">
    <a class="avatar image"><img style="height: auto !important" src="{{$comment->user->profileimage()->getURL()}}" alt="Profile Image"/></a>
    <div class="content">
        <a href="{{$comment->user->getURL()}}" class="author">{{$comment->user->displayName()}}</a>
        <div class="metadata">
            <span class="date">{{$comment->updated_at->diffForHumans()}}</span>
        </div>
        <div class="text">
            {{$comment->content}}
        </div>
    </div>
</div>
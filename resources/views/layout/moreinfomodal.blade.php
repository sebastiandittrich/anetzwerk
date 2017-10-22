<div class="ui modal" id="moreinfomodal">
    <div class="header">Mehr Informationen über diesen Post</div>
    <div class="content">
        @if(Auth::check() && Auth::user()->id == $object->user_id)
            <a data-id="{{$object->id}}" data-object="{{get_class($object)}}" class="right floated a-delete">
                <i class="red close icon"></i>
                <span style="color: red">Löschen</span>
            </a>
        @endif
    </div>
    <div class="extra content">
        @include('comment.create', ['object' => $object])
    </div>
</div>
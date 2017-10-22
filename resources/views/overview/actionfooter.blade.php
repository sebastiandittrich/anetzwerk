@if($object != null && (property_exists($object, 'commentable') || property_exists($object, 'shittable')))
    <div class="content">
        @if(property_exists($object, 'shittable') && Auth::check() && Auth::user()->id != $object->user_id)
            <span data-id="{{$object->id}}" data-object="{{get_class($object)}}" class="ui right floated  {{$object->userShits() ? 'brown' : ''}} label a-shit">
                <i class="{{$object->userShits() ? '' : 'outline'}} thumbs down icon"></i>
                <span class="counter a-shit">{{count($object->shits())}}</span>
            </span>  
        @endif
        @if(Auth::check() && Auth::user()->id == $object->user_id)
            <a data-id="{{$object->id}}" data-object="{{get_class($object)}}" class="right floated a-delete">
                <i class="red close icon"></i>
                <span style="color: red">Löschen</span>
            </a>
        @endif
        {{--  <a class="right floated a-more-infos">
            <i class="blue info icon"></i>
            <span style="color: blue">Mehr</span>
        </a>  --}}
        @if(property_exists($object, 'commentable'))
            <a style="color:black" class="ui violet label a-comment a-show">
                <i class="comment <?php echo count($object->comments()) ? '' : 'outline' ?> icon"></i>
                <span class="counter a-comment">{{count($object->comments())}}</span>
            </a>
        @endif
    </div>
    @if(property_exists($object, 'commentable'))
        <div class="ui a-comment content" style="background:#EFEFEF;display:none">
            <div class="ui comments">
                @foreach($object->comments() as $comment)
                    @include('comment.single', ['comment' => $comment])
                @endforeach
            </div>
            <a style="color: #3F48CC" class="right floated a-close a-comment">
                <i class="up angle icon"></i>Ausblenden
            </a>
        </div>
    @endif
    @if(property_exists($object, 'commentable') && Auth::check())
        @include('comment.create', ['object' => $activity->object()])
    @endif
@endif
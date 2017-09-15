@if($object != null && (property_exists($object, 'commentable') || property_exists($object, 'shittable')))
    <div class="content">
        @if(property_exists($object, 'shittable'))
            <span data-id="{{$object->id}}" data-object="{{get_class($object)}}" class="right floated a-shit">
                <i class="{{$object->userShits() ? '' : 'outline'}} thumbs down icon"></i>
                <span class="counter a-shit">{{count($object->shits())}}</span>
            </span>  
        @endif
        @if(property_exists($object, 'commentable'))
            <a style="color:black" class="a-comment a-show"><i class="comment <?php echo count($object->comments()) ? '' : 'outline' ?> icon"></i><span class="counter a-comment">{{count($object->comments())}}</span><span style="color: gray ;margin-left: 10px">Tippen zum Anzeigen</span></a>
        @endif
    </div>
    @if(property_exists($object, 'commentable'))
        <div class="ui a-comment content" style="background:#EFEFEF;display:none">
            <div class="ui comments">
                @foreach($object->comments() as $comment)
                    @include('comment.single', ['comment' => $comment])
                @endforeach
            </div>
            <a style="color: red" class="right floated a-close a-comment">
                <i class="close icon"></i>Ausblenden
            </a>
        </div>
    @endif
    @if(property_exists($object, 'commentable') && Auth::check())
        <div class="extra content">
            <div class="ui fluid transparent large left icon input">
                <i class="comment outline icon"></i>
                <input data-id="{{$object->id}}" data-object="{{get_class($object)}}" class="a-comment" type="text" placeholder="Gib deinen Senf dazu...">
            </div>
        </div> 
    @endif
@endif
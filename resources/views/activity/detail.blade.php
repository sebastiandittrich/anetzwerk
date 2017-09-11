<div class="ui fluid centered card" style="color:black">
    <div class="content">
        <div class="right floated meta">{{$activity->created_at->diffForHumans()}}</div>
        <a href="/users/{{$activity->user->id}}" class="header">
            <img src="{{$activity->user->profileimage()->getURL()}}" alt="Profile Picture" class="ui avatar image">
            {{$activity->user->username}}
            @lang('activities.'.$activity->object.'.'.$activity->action)
        </a>
    </div>
    @if($activity->action != 'delete')
        @if(View::exists('activity.detailed.'.str_slug($activity->object, '-')))
            @include('activity.detailed.'.str_slug($activity->object, '-'), ['object' => $activity->object()])
        @endif
    @endif
@if(Auth::check())
    <div class="content">
        @if(property_exists($activity->object(), 'shittable'))
            <span data-id="{{$activity->id}}" data-object="{{$activity->object}}" class="right floated a-shit">
                <i class="{{$activity->object()->userShits() ? '' : 'outline'}} thumbs down icon"></i>
                <span class="counter">{{count($activity->shits())}}</span>
            </span>  
        @endif
        <i class="comment <?php echo count($activity->comments()) ? '' : 'outline' ?> icon"></i><span class="counter">{{count($activity->comments())}}</span> Comments
    </div>
    <div class="extra content">
        <div class="ui fluid transparent large left icon input">
            <i class="comment outline icon"></i>
            <input data-id="{{$activity->id}}" data-object="{{$activity->object}}" class="a-comment" type="text" placeholder="Gib deinen Senf dazu...">
        </div>
    </div> 
@endif 
</div>
<div class="event">
    <div class="label">
        <i class="circular blue user icon"></i>
    </div>
    <div class="content">
        <div class="summary">
            <a href="/users/{{$activity->user->id}}" class="user">{{$activity->user->username}}</a>
            @lang('activities.'.$activity->object_name.'.'.$activity->action)
            <i class="
                @lang('activities.icons.'.$activity->action)
                icon corner">
            </i>
            <div class="date">{{$activity->created_at->diffForHumans()}}</div>
        </div>
        <div class="extra text">
            @if($activity->action != 'delete')
                @if(View::exists('activity.preview.'.str_slug($activity->object_name, '-')))
                    @include('activity.preview.'.str_slug($activity->object_name, '-'))
                @endif
            @endif
        </div>
    </div> 
</div>
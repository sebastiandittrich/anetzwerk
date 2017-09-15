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
        @if(View::exists('overview.'.str_slug($activity->object, '-')) && $activity->object() != null)
            @include('overview.'.str_slug($activity->object, '-'), ['object' => $activity->object()])
        @endif
    @endif
    @include('overview.actionfooter', ['object' => $activity->object()])
</div>
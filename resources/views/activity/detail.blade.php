<div class="ui fluid centered card" style="color:black">
    <div class="content">
        <a class="ui fluid list" href="/users/{{$activity->user->id}}">
            <div class="item">
                <img src="{{$activity->user->profileimage()->getURL()}}" alt="Profile Picture" class="ui avatar image">
                <div class="content">
                    <span class="header">{{$activity->user->username}}</span>
                    <div class="description"><div class="meta">@lang('activities.'.$activity->object.'.'.$activity->action)</div></div>
                </div>
                <div class="right floated content">
                    <span class="meta">{{$activity->created_at->diffForHumans()}}</span>
                </div>
            </div>
        </a>
    </div>
    @if($activity->action != 'delete')
        @if(View::exists('overview.'.str_slug($activity->object, '-')) && $activity->object() != null)
            @include('overview.'.str_slug($activity->object, '-'), ['object' => $activity->object(), 'rootobject' => $activity])
        @endif
    @endif
    @include('overview.actionfooter', ['object' => $activity->object()])
    {{--  @include('layout.moreinfomodal', ['object' => $activity->object()])  --}}
</div>
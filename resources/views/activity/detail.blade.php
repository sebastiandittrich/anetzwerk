<div class="ui fluid centered card" style="color:black">
    <div class="content">
        <div class="right floated meta">{{$activity->created_at->diffForHumans()}}</div>
        <a href="/users/{{$activity->user->id}}" class="header">
            <img src="{{$activity->user->profileimage()->getURL()}}" alt="Profile Picture" class="ui avatar image">
            {{$activity->user->username}}
            @lang('activities.'.$activity->object_name.'.'.$activity->action)
        </a>
    </div>
@foreach($activity->collection as $activity)
    @if($activity->action != 'delete')
        @if(View::exists('activity.detailed.'.str_slug($activity->object_name, '-')))
            @include('activity.detailed.'.str_slug($activity->object_name, '-'))
        @endif
    @endif
@endforeach
@if(Auth::check())
    <div class="content">
        <span class="right floated"><i class="heart outline icon"></i>17 Shits</span>  
        <i class="comment icon"></i>13 Comments
    </div>
    <div class="extra content">
        <div class="ui fluid transparent large left icon input">
            <i class="comment outline icon"></i>
            <input type="text" placeholder="Gib deinen Senf dazu...">
        </div>
    </div>
@endif 
</div>
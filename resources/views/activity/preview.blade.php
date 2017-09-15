<div class="event">
    <div class="label">
        <img src="{{$object->user->profileimage()->getURL()}}" alt="Profile Picture" class="ui middle aligned avatar image">
    </div>
    <div class="content">
        <div class="summary">
            <a href="/users/{{$object->user->id}}" class="user">{{$object->user->username}}</a>
            @lang('activities.'.$object->object.'.'.$object->action)
            <i class="
                @lang('activities.icons.'.$object->action)
                icon corner">
            </i>
            <div class="date">{{$object->created_at->diffForHumans()}}</div>
        </div>
    </div> 
</div>
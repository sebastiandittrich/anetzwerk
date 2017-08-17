<div class="content">
    <div class="ui list">
        <a class="ui item" href="/users/{{$activity->object->id}}">
            <img src="{{$activity->object->profileimage()->getURL()}}" alt="" class="ui mini image">
            <div class="content">
                @if($activity->object->first_name != "" || $activity->object->last_name != "")
                    <div class="header">{{$activity->object->first_name}} {{$activity->object->last_name}}</div>
                    <div class="description">{{$activity->object->username}}</div>
                @else
                    <div class="header">{{$activity->object->username}}</div>
                @endif
                
            </div>
        </a>
    </div>
</div>
<div class="center aligned content">
    <a href="/users/{{$activity->object->id}}" class="ui compact segments">
        <div href="/users/{{$activity->object->id}}" class="ui raised segment">
            <img class="ui small rounded image" src="{{$activity->object->profileimage()->getURL()}}" />
        </div>
        <div href="/users/{{$activity->object->id}}" class="ui raised segment">
            @if($activity->object->first_name != "" || $activity->object->last_name != "")
                <div class="ui small header">{{$activity->object->first_name}} {{$activity->object->last_name}}</div>
            @endif
            {{$activity->object->username}}
        </div>
    </a>
</div>
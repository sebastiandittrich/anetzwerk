<div class="content">
    <div class="ui list">
        <a class="ui item" href="/users/{{$object->id}}">
            <img src="{{$object->profileimage()->getURL()}}" alt="" class="ui mini image">
            <div class="content">
                @if($object->first_name != "" || $object->last_name != "")
                    <div class="header">{{$object->first_name}} {{$object->last_name}}</div>
                    <div class="description">{{$object->username}}</div>
                @else
                    <div class="header">{{$object->username}}</div>
                @endif
                
            </div>
        </a>
    </div>
</div>
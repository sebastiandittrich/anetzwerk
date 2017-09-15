@if(get_class($object) != 'App\\User')
    <div class="ui fluid centered card" style="color:black">
        <div class="content">
            <div class="right floated meta">{{$object->created_at->diffForHumans()}}</div>
            <a href="/users/{{$object->user->id}}" class="header">
                <img src="{{$object->user->profileimage()->getURL()}}" alt="Profile Picture" class="ui avatar image">
                {{$object->user->username}}
            </a>
        </div>
            @if($object != null)
                @includeIf('overview.'.str_slug(get_class($object), '-'), ['object' => $object])
            @endif
            @include('overview.actionfooter', ['object' => $object])
    </div>
@else

    @if($object != null)
        @includeIf('overview.'.str_slug(get_class($object), '-'), ['object' => $object])
    @endif

@endif
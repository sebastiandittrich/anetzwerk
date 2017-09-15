<div class="content">
    <a class="ui item" href="/users/{{$object->id}}">
        <div class="ui nested segment">
                @include('user.preview', ['user' => $object])
        </div>
    </a>
</div>
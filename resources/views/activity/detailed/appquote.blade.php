<div class="blurring dimmable content card-content">

    <div class="ui inverted dimmer">
        <div class="content">
            <div class="center">
                <div class="ui blue huge header"><i class="user icon"></i>{{$activity->object->fake_author}}</div>
                <div class="ui small green header"><i class="checkmark icon"></i>Ursprünglich von {{$activity->object->real_author}}</div>
            </div>
        </div>
    </div>

    <div class="ui blue header">
        <div class="ui blue ribbon label">
            <i class="left aligned huge quote left icon"></i>
        </div>
        {{$activity->object->user->username}} {{$activity->object->updated_at->diffForHumans()}}
    </div>
    <div class="description">
        <div>{{$activity->object->content}}</div>
    </div>
</div>
<div class="ui blue  attached button show-author">
Autor anzeigen
</div>
<div class="ui red attached button hide-author" style='display: none'>
Autor ausblenden
</div>
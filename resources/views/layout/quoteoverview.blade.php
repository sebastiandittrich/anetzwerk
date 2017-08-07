<div class="ui fluid raised card">
    <div class="blurring dimmable content card-content">

        <div class="ui inverted dimmer">
            <div class="content">
                <div class="center">
                    <div class="ui blue huge header"><i class="user icon"></i>{{$quote->fake_author}}</div>
                    <div class="ui small green header"><i class="checkmark icon"></i>Ursprünglich von {{$quote->real_author}}</div>
                </div>
            </div>
        </div>

        <div class="ui blue header">
            <div class="ui blue ribbon label">
                <i class="left aligned huge quote left icon"></i>
            </div>
            {{$quote->user->username}} {{$quote->updated_at->diffForHumans()}}
        </div>
        <div class="description">
            <div>{{$quote->content}}</div>
        </div>
    </div>
    <div class="ui blue bottom attached button show-author">
        Autor anzeigen
    </div>
    <div class="ui red bottom attached button hide-author" style='display: none'>
        Autor ausblenden
    </div>
</div>
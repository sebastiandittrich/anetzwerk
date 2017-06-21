<a href='/posts/{{$activity->object->id}}/details'>
    <div class="ui raised segment">
        <h4 class="ui header">{{$activity->object->header}}</h4>
        {{str_limit($activity->object->content, 150)}}
    </div>
</a>
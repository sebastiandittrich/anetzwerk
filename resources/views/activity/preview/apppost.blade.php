<a href='/posts/{{$activity->collection[0]->object->id}}/details'>
    <div class="ui raised segment">
        <h4 class="ui header">{{$activity->collection[0]->object->header}}</h4>
        {{str_limit($activity->collection[0]->object->content, 150)}}
    </div>
</a>
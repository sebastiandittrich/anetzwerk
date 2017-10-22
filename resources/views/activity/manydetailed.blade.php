<script src='{{asset('js/quotes.js')}}'></script>
<script src='{{asset('js/posts.js')}}'></script>
{{csrf_field()}}
<div class="ui feed dynamic-loading">
    <script>var autoload_elements = [
        @foreach($activities as $activity)
            {{$activity->id}},
        @endforeach
    ];</script>
</div>
<img class="ui centered small image" id="feed-loading" src="{{asset('/pictures/load-blue.svg')}}">
@includeIf('layout.deletemodal')
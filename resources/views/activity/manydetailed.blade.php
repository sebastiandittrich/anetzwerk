<script src='{{asset('js/quotes.js')}}'></script>
<script src='{{asset('js/posts.js')}}'></script>
{{csrf_field()}}
<div class="ui feed">
    @foreach($activities as $activity)
        @include('activity.detail')
    @endforeach
</div>
@includeIf('layout.deletemodal')
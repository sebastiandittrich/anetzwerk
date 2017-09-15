<div class="ui feed">
    @foreach($objects as $object)
        @include('activity.preview', ['object' => $object])
    @endforeach
</div>
@if(Auth::check())

    @if(Auth::user()->shit($post))
        <div class="shit ui brown button" id='{{$post->id}}'>
            Findest du Scheiße
        </div>
    @else
        <button class="shit ui basic brown button" id='{{$post->id}}'>
            Scheiße finden
        </button>
    @endif

@endif
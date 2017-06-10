@if(count($errors))
    <div class='ui error message'>
        <i class="close icon"></i>
        <div class="header">Hoppla, da ist etwas schief gelaufen</div>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif


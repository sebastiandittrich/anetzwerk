<div class="ui list">
    <div class="item">
    <img src="{{$user->profileimage()->getURL()}}" alt="Profile Image" class="ui middle aligned avatar image">
    <div class="content">
        @if($user->first_name != "" || $user->last_name != "")
            <div class="header" style="color: {{$font or 'black'}}">{{$user->first_name}} {{$user->last_name}}</div>
            <div class="description" style="color: {{$font or 'black'}}">{{$user->username}}</div>
        @else
            <div class="header" style="color: {{$font or 'black'}}">{{$user->username}}</div>
        @endif
    </div>
    </div>
</div>
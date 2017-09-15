<div class="ui modal a-chooseimage">
    <div class="ui dimmer">
        <div class="ui indeterminate text loader">Bilder werden hochgeladen</div>
    </div>
    <form class="uploadform" style="display:none">
        {{csrf_field()}}
        <input type="file" accepts='image/*' name='files[]' id='files' style='' multiple>
    </form>
    <div class="header"><i class="black arrow left icon a-backbutton"></i> Wie willst du ein Bild hinzufügen?</div>
    <div class="content main">
        <div class="ui list">
            <a class="item upload">
                <i class="upload icon"></i>
                <div class="content">
                    <div class="header">Upload</div>
                    <div class="description">Lade ein Bild von deinem Gerät hoch</div>
                </div>
            </a>
            <a class="item my">
                <i class="green image icon"></i>
                <div class="content">
                    <div class="header">Meine Bilder</div>
                    <div class="description">Wähle ein Bild aus deinen bereits hochgeladenen Bildern aus</div>
                </div>
            </a>
            <a class="item search">
                <i class="blue search icon"></i>
                <div class="content">
                    <div class="header">Other</div>
                    <div class="description">Durchsuche das Asoziale Netzwerk nach Bildern</div>
                </div>
            </a>
        </div>
    </div>
    <div class="content my" style="display:none">
        <div class="ui list horizontal">
        @foreach(Auth::user()->images as $image)
            <div class="item">
                <div class='ui rounded tiny image'>
                    <img data-id='{{$image->id}}' src='{{asset('storage/images/'.$image->path)}}'>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
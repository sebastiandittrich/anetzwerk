<div class='ui rounded tiny image'>
    <img src='{{asset('storage/images/'.$image->path)}}'>
    <div class='ui modal'>
        <div class='image content'>
            <img class='ui rounded image' src='{{asset('storage/images/'.$image->path)}}'>
        </div>
        <div class="actions">
            <div class="ui red button">
                <i class="close icon"></i>
                Schließen
            </div>
        </div>
    </div>
</div>
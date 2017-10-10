@if($object->user->id != $rootobject->user->id)
    <div class="ui center aligned meta content"><i class="share alternate icon"></i> Bild von <a href="{{$object->user->getURL()}}">{{$object->user->displayName()}}</a></div>
@endif
<img style="max-height:500px;width:auto;background-color:transparent" class="image centered ui" style="" src="{{$object->getURL()}}" alt="Image">
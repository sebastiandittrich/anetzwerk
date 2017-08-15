<?php
    return [
        'icons' => [
            'create' => 'blue add',
            'update' => 'orange refresh',
            'delete' => 'red erase',
        ],
        'App\\Post' => [
            'create' => 'hat einen Post veröffentlicht',
            'delete' => 'hat einen Post gelöscht',
            'update' => 'hat etwas an einem seiner Posts geändert',
        ],
        'App\\Comment' => [
            'create' => 'hat einen Kommentar verfasst',
            'delete' => 'hat einen Kommentar gelöscht',
            'update' => 'hat etwas an einem seiner Kommentare geändert',
        ],
        'App\\Quote' => [ 
            'create' => 'hat ein Zitat veröffentlicht',
            'delete' => 'hat ein Zitat gelöscht',
            'update' => 'hat etwas an einem seiner Zitate geändert',
        ],
        'App\\User' => [
            'create' => 'ist dem Asozialen Netzwerk beigetreten',
            'delete' => 'hat das Asoziale Netzwerk wieder verlassen',
            'update' => 'hat sein Profil aktualisiert'
        ],
        'App\\Image' => [
            'create' => 'hat ein Bild hochgeladen',
            'delete' => 'hat eines seiner Bilder gelöscht',
            'update' => 'hat eines seiner Bilder ausgetauscht'
        ],
        'App\\Shit' => [
            'create' => 'findet etwas scheiße',
            'delete' => 'findet etwas doch nicht mehr scheiße'
        ],
        'App\\Follow' => [
            'create' => 'folgt jetzt jemandem',
            'delete' => 'folgt jetzt jemandem nicht mehr'
        ],
        'App\\Collection' => [
            'create' => 'hat mehrere Elemente hochgeladen',
            'update' => 'hat mehrere Elemente aktualisiert',
            'delete' => 'hat mehrere Elemente gelöscht'
        ]
    ];
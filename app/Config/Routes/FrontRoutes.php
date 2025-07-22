<?php

$routes->get('/', [App\Modules\Front\Controllers\Home::class, 'index']);
$routes->get('aviso-de-privacidad', [App\Modules\Front\Controllers\Home::class, 'privacyNotice']);
<?php

$routes->get('/', [App\Modules\Front\Controllers\Home::class, 'index']);
$routes->get('aviso-de-privacidad', [App\Modules\Front\Controllers\Home::class, 'privacyNotice']);

// Endpoints
$routes->get('api/carousel', [App\Modules\Front\Controllers\CarouselController::class, 'getCarouselItems']);
$routes->get('api/all-categories-carousel', [App\Modules\Front\Controllers\CarouselController::class, 'getAllCategoriesCarousel']);
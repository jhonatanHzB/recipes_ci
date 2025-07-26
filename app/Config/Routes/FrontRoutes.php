<?php

$routes->get('/', [App\Modules\Front\Controllers\Home::class, 'index']);
$routes->get('receta/(:any)', [App\Modules\Front\Controllers\RecipeController::class, 'index']);
$routes->get('aviso-de-privacidad', [App\Modules\Front\Controllers\Home::class, 'privacyNotice']);

// Endpoints
$routes->get('api/carousel', [App\Modules\Front\Controllers\CarouselController::class, 'getCarouselItems']);
$routes->post('api/score', [App\Modules\Front\Controllers\RecipeController::class, 'setScoreRecipe']);
$routes->get('api/score/(:any)', [App\Modules\Front\Controllers\RecipeController::class, 'getScoreRecipe']);
$routes->get('api/all-categories-carousel', [App\Modules\Front\Controllers\CarouselController::class, 'getAllCategoriesCarousel']);
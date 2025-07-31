<?php

$routes->get('/', [App\Modules\Front\Controllers\Home::class, 'index']);
$routes->get('recetas/(:any)', [App\Modules\Front\Controllers\RecipeController::class, 'getRecipesByParam']);
$routes->get('receta/(:any)', [App\Modules\Front\Controllers\RecipeController::class, 'index']);
$routes->get('recetas', [App\Modules\Front\Controllers\RecipeController::class, 'getRecipes']);
$routes->get('aviso-de-privacidad', [App\Modules\Front\Controllers\Home::class, 'privacyNotice']);
$routes->get('videos', [App\Modules\Front\Controllers\MediaController::class, 'index']);
$routes->get('chef-ana-paula', [App\Modules\Front\Controllers\Home::class, 'aboutMe']);
$routes->get('contacto', [App\Modules\Front\Controllers\ContactController::class, 'index']);
$routes->get('buscar', [App\Modules\Front\Controllers\RecipeController::class, 'query']);

// Endpoints
$routes->get('api/carousel', [App\Modules\Front\Controllers\CarouselController::class, 'getCarouselItems']);
$routes->post('api/score', [App\Modules\Front\Controllers\RecipeController::class, 'setScoreRecipe']);
$routes->get('api/score/(:any)', [App\Modules\Front\Controllers\RecipeController::class, 'getScoreRecipe']);
$routes->get('api/all-categories-carousel', [App\Modules\Front\Controllers\CarouselController::class, 'getAllCategoriesCarousel']);
$routes->get('api/menu/(:num)', [App\Modules\Front\Controllers\MenuController::class, 'getMenu']);
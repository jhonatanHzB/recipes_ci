<?php

$routes->get('/', [App\Modules\Admin\Controllers\DashboardController::class, 'index']);
$routes->get('recipe/create', [App\Modules\Admin\Controllers\RecipeController::class, 'createRecipe']);
$routes->get('recipe/update/(:num)', [App\Modules\Admin\Controllers\RecipeController::class, 'updateRecipe/$1']);

// Forms
$routes->post('section/update', [App\Modules\Admin\Controllers\FormController::class, 'updateSection']);
$routes->post('recipe', [App\Modules\Admin\Controllers\FormController::class, 'createRecipe']);;

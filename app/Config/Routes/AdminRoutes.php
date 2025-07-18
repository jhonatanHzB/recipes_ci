<?php

$routes->get('/', [App\Modules\Admin\Controllers\DashboardController::class, 'index']);
$routes->get('recipe/create', [App\Modules\Admin\Controllers\RecipeController::class, 'createRecipe']);
$routes->get('recipe/edit', [App\Modules\Admin\Controllers\RecipeController::class, 'editRecipeView']);
$routes->get('recipe/search', [App\Modules\Admin\Controllers\RecipeController::class, 'searchRecipes']);
$routes->get('recipe/update/(:num)', [App\Modules\Admin\Controllers\RecipeController::class, 'updateRecipe/$1']);

// Forms
$routes->post('section/update', [App\Modules\Admin\Controllers\FormController::class, 'updateSection']);
$routes->post('recipe', [App\Modules\Admin\Controllers\FormController::class, 'createRecipe']);;

// Exportar datos a Excel
$routes->get('reports/export-categories', [App\Modules\Admin\Controllers\ReportController::class, 'exportCategoriesToExcel']);
$routes->get('reports/export-recipes-with-categories', [App\Modules\Admin\Controllers\ReportController::class, 'exportRecipesWithCategoryToExcel']);
$routes->get('reports/export-recipes-without-categories', [App\Modules\Admin\Controllers\ReportController::class, 'exportRecipesWithoutCategoryToExcel']);
$routes->get('reports/export-tags', [App\Modules\Admin\Controllers\ReportController::class, 'exportTagsToExcel']);
$routes->get('reports/export-recipes-with-tag', [App\Modules\Admin\Controllers\ReportController::class, 'exportRecipesWithTagToExcel']);

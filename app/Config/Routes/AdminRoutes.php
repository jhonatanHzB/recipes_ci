<?php

// Routes for recipes management in the admin panel
$routes->get('/', [App\Modules\Admin\Controllers\DashboardController::class, 'index']);
$routes->get('recipe/create', [App\Modules\Admin\Controllers\RecipeController::class, 'createRecipeView']);
$routes->get('recipe/edit', [App\Modules\Admin\Controllers\RecipeController::class, 'editRecipeView']);
$routes->get('recipe/search', [App\Modules\Admin\Controllers\RecipeController::class, 'searchRecipes']);
$routes->get('recipe/update/(:num)', [App\Modules\Admin\Controllers\RecipeController::class, 'updateRecipeView/$1']);
$routes->post('recipe/delete', [App\Modules\Admin\Controllers\RecipeController::class, 'deleteRecipe']);

// Routes for categories management
$routes->get('category/create', [App\Modules\Admin\Controllers\CategoryController::class, 'createCategoryView']);
$routes->get('category/edit', [App\Modules\Admin\Controllers\CategoryController::class, 'editCategoryView']);
$routes->post('category/save', [App\Modules\Admin\Controllers\CategoryController::class, 'save']);

// Forms
$routes->post('section/update', [App\Modules\Admin\Controllers\FormController::class, 'updateSection']);
$routes->post('recipe', [App\Modules\Admin\Controllers\FormController::class, 'createRecipe']);;

// Exportar datos a Excel
$routes->get('reports/export-categories', [App\Modules\Admin\Controllers\ReportController::class, 'exportCategoriesToExcel']);
$routes->get('reports/export-recipes-with-categories', [App\Modules\Admin\Controllers\ReportController::class, 'exportRecipesWithCategoryToExcel']);
$routes->get('reports/export-recipes-without-categories', [App\Modules\Admin\Controllers\ReportController::class, 'exportRecipesWithoutCategoryToExcel']);
$routes->get('reports/export-tags', [App\Modules\Admin\Controllers\ReportController::class, 'exportTagsToExcel']);
$routes->get('reports/export-recipes-with-tag', [App\Modules\Admin\Controllers\ReportController::class, 'exportRecipesWithTagToExcel']);

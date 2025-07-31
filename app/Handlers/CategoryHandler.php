<?php

namespace App\Handlers;

use App\Modules\Front\Models\CategoryModel;
use App\Repositories\RecipeRepository;

class CategoryHandler extends AbstractRecipeHandler
{
    private CategoryModel $categoryModel;
    private RecipeRepository $recipeRepository;

    public function __construct(CategoryModel $categoryModel, RecipeRepository $recipeRepository)
    {
        $this->categoryModel = $categoryModel;
        $this->recipeRepository = $recipeRepository;
    }

    public function handle(string $slug): ?array
    {
        $category = $this->categoryModel->getCategoryBySlug($slug);
        if ($category) {
            return [
                'page'    => $category->name,
                'recipes' => $this->recipeRepository->getRecipesByCategory($category->id),
            ];
        }

        return parent::handle($slug);
    }

}

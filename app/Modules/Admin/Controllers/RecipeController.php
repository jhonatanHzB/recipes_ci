<?php

namespace App\Modules\Admin\Controllers;

use App\Entities\RecipeEntity;
use App\Helpers\TimeHelper;
use App\Modules\Admin\Controllers\BaseController;
use App\Modules\Admin\Models\CategoryModel;
use App\Modules\Admin\Models\RecipeModel;
use App\Modules\Admin\Models\TagModel;

class RecipeController extends BaseController
{

    protected TimeHelper $timeHelper;
    protected CategoryModel $categoryModel;
    protected RecipeModel $recipeModel;
    protected TagModel $tagModel;

    public function __construct()
    {
        $this->timeHelper = new TimeHelper();
        $this->categoryModel = new CategoryModel();
        $this->recipeModel = new RecipeModel();
        $this->tagModel = new TagModel();
    }

    public function createRecipe(): string
    {
        $data = [
            'user_id' => auth()->id(),
            'categories' => $this->categoryModel->findAll(),
            'tags' => $this->tagModel->findAll(),
        ];

        return view('admin/pages/recipe', $data);
    }

    public function updateRecipe($recipe_id): string
    {
        $recipe = $this->recipeModel->getRecipeWithCategoriesAndTags($recipe_id);
        $recipe->setTime($this->timeHelper->minutesToTime($recipe->time));
        $recipe->setBaked($this->timeHelper->minutesToTime($recipe->baked));
        $recipe->setRefrigeration($this->timeHelper->minutesToTime($recipe->refrigeration));

        $data = [
            'user_id' => auth()->id(),
            'recipe_id' => $recipe_id,
            'categories' => $this->categoryModel->findAll(),
            'tags' => $this->tagModel->findAll(),
            'recipe' => $recipe
        ];

        return view('admin/pages/recipe', $data);
    }

}
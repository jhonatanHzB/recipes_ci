<?php

namespace App\Modules\Admin\Controllers;

use App\Helpers\TimeHelper;
use App\Modules\Admin\Controllers\BaseController;
use App\Modules\Admin\Models\CategoryModel;
use App\Modules\Admin\Models\RecipeModel;
use App\Modules\Admin\Models\TagModel;
use CodeIgniter\HTTP\ResponseInterface;

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

    public function createRecipeView(): string
    {
        $data = [
            'user_id' => auth()->id(),
            'categories' => $this->categoryModel->findAll(),
            'tags' => $this->tagModel->findAll(),
        ];

        return view('admin/pages/recipe', $data);
    }

    public function updateRecipeView($recipe_id): string
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

    public function editRecipeView(): string {
        $currentPage = $this->request->getVar('page') ?? 1;
        $perPage = 10;

        $recipeModel = new RecipeModel();

        $data = [
            'recipes' => $recipeModel->paginateWithRelations($perPage),
            'pager' => $recipeModel->pager
        ];

        return view('admin/pages/edit-recipes', $data);
    }

    public function searchRecipes(): ResponseInterface
    {
        if ($this->request->isAJAX()) {
            $search = $this->request->getGet('search');
            $page = $this->request->getGet('page') ?? 1;
            $perPage = 10;

            $recipes = $this->recipeModel->searchRecipes($search, $page, $perPage);
            $total = $this->recipeModel->countSearchResults($search);
            $totalPages = ceil($total / $perPage);

            $data = [
                'recipes' => $recipes,
                'currentPage' => $page,
                'totalPages' => $totalPages,
                'total' => $total
            ];

            return $this->response->setJSON($data);
        }

        return $this->response->setStatusCode(404);
    }

    public function deleteRecipe(): ResponseInterface
    {
        if ($this->request->isAJAX()) {
            $recipeId = $this->request->getJSON()->recipe_id;

            if ($this->recipeModel->delete($recipeId)) {
                return $this->response->setJSON(['success' => true]);
            }

            return $this->response->setJSON(['success' => false, 'error' => 'No se pudo eliminar la receta']);
        }

        return $this->response->setJSON(['success'=> false,'error'=> 'Invalid request']);
    }

}

<?php

namespace App\Modules\Front\Controllers;

use App\Modules\Front\Controllers\BaseController;
use App\Modules\Front\Models\RecipeCategoryModel;
use App\Modules\Front\Models\RecipeModel;
use App\Modules\Front\Models\RecipeScoreModel;
use App\Modules\Front\Models\TagModel;
use CodeIgniter\HTTP\ResponseInterface;

class RecipeController extends BaseController
{

    private RecipeCategoryModel $recipeCategoryModel;
    private RecipeModel $recipeModel;
    private TagModel $tagModel;
    private RecipeScoreModel $recipeScoreModel;

    public function __construct()
    {
        $this->recipeCategoryModel = new RecipeCategoryModel();
        $this->recipeModel = new RecipeModel();
        $this->tagModel = new TagModel();
        $this->recipeScoreModel = new RecipeScoreModel();
    }

    public function index(string $slug): string
    {
        $recipe = $this->recipeModel->getRecipeWithScore($slug);
        $tags = $this->tagModel->getTagsOfRecipe($recipe->id);
        $recipeCategory = $this->recipeCategoryModel->where('recipe_id', $recipe->id)->first();
        $relatedRecipesWithCategory = $this->recipeModel->getRandomRecipesWithSameCategory($recipeCategory->category_id, $recipe->id);


        $data = [
            'location' => 'Recetas',
            'page'     => ucfirst(mb_strtolower($recipe->name, 'UTF-8')),
            'recipe'   => $recipe,
            'tags'     => $tags,
            'relatedRecipesWithCategory' => $relatedRecipesWithCategory,
        ];

        return view('front/pages/recipe', $data);
    }

    public function setScoreRecipe(): ResponseInterface {
        $input = $this->request->getJSON();

        $recipeId    = $input->recipe_id;
        $recipeScore = $input->recipe_score;

        $data = [
            'recipe_id' => $recipeId,
            'score' => $recipeScore,
        ];

        if ($this->recipeScoreModel->save($data)) {
            return $this->response
                ->setStatusCode(200)
                ->setJSON(['message' => '¡Gracias! por calificar nuestra receta']);
        }

        return $this->response
            ->setStatusCode(500)
            ->setJSON(['message' => 'Error al calificar la receta']);
    }

    public function getScoreRecipe($slug): ResponseInterface {
        $recipe = $this->recipeModel->getRecipeWithScore($slug);
        unset($recipe->id);

        return $this->response->setJSON($recipe);
    }

}
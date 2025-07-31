<?php

namespace App\Modules\Front\Controllers;

use App\Handlers\CategoryHandler;
use App\Handlers\MenuHandler;
use App\Handlers\TagHandler;
use App\Modules\Front\Controllers\BaseController;
use App\Modules\Front\Models\CategoryModel;
use App\Modules\Front\Models\MenuModel;
use App\Modules\Front\Models\RecipeCategoryModel;
use App\Modules\Front\Models\RecipeModel;
use App\Modules\Front\Models\RecipeScoreModel;
use App\Modules\Front\Models\RecipeTagModel;
use App\Modules\Front\Models\TagModel;
use App\Repositories\RecipeRepository;
use App\Repositories\RecipeRepositoryInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RecipeController extends BaseController
{

    private CategoryModel $categoryModel;
    private MenuModel $menuModel;
    private RecipeCategoryModel $recipeCategoryModel;
    private RecipeModel $recipeModel;
    private RecipeScoreModel $recipeScoreModel;
    private RecipeTagModel $recipeTagModel;
    private TagModel $tagModel;
    private RecipeRepositoryInterface $recipeRepository;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->menuModel = new MenuModel();
        $this->recipeCategoryModel = new RecipeCategoryModel();
        $this->recipeModel = new RecipeModel();
        $this->recipeScoreModel = new RecipeScoreModel();
        $this->recipeTagModel = new RecipeTagModel();
        $this->tagModel = new TagModel();
        $this->recipeRepository = new RecipeRepository(\Config\Database::connect());
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

    public function getRecipes(): string
    {
        $data = [
            'location'   => 'Home',
            'page'       => 'Recetas',
            'categories' => $this->categoryModel->findAll(),
        ];

        return view('front/pages/recipes', $data);
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

    public function getRecipesByParam(string $param): string
    {
        $categoryHandler = new CategoryHandler($this->categoryModel, $this->recipeRepository);
        $menuHandler = new MenuHandler($this->menuModel, $this->recipeRepository);
        $tagHandler = new TagHandler($this->tagModel, $this->recipeRepository);

        $categoryHandler->setNext($menuHandler)->setNext($tagHandler);

        $result = $categoryHandler->handle($param);

        if ($result === null) {
            $data = [
                'message' => lang('Errors.pageNotFound'),
            ];

            return view('errors/html/error_404', $data);
        }

        $data = [
            'location' => 'Recetas',
            'page'     => $result['page'],
            'recipes'  => json_encode($result['recipes']),
        ];

        return view('front/pages/recipes_by_param', $data);
    }

    public function query(): string
    {
        $results    = [];
        $queryParam = $this->request->getGet('q');

        if (strlen($queryParam) > 3) {
            $recipes = $this->recipeModel->getLikeRecipes($queryParam);

            if (! empty($recipes)) {
                $results = [...$recipes];
            }

            $categories = $this->categoryModel->like('name', $queryParam)
                ->asArray()
                ->orLike('slug', $queryParam)
                ->findAll();

            if (! empty($categories)) {
                $categoryIds       = array_column($categories, 'id');
                $recipesCategories = $this->recipeModel->getRecipesByCategory($categoryIds);

                $results = [...$results, ...$recipesCategories];
            }

            $tags = $this->tagModel->like('name', $queryParam)
                ->asArray()
                ->findAll();

            if (! empty($tags)) {
                $tagIds     = array_column($tags, 'id');
                $recipeTags = $this->recipeTagModel->getRecipesByTag($tagIds);

                $results = [...$results, ...$recipeTags];
            }
        }

        $data = [
            'location'   => 'Recetas',
            'page'       => 'Buscar',
            'queryParam' => $queryParam,
            'recipes'    => json_encode($results),
        ];

        return view('front/pages/search_results', $data);
    }

}
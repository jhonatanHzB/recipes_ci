<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\CategoryModel;
use App\Modules\Admin\Models\RecipeModel;
use App\Modules\Admin\Models\SectionModel;
use App\Modules\Admin\Models\TagModel;
use Config\Services;

class DashboardController extends BaseController
{

    protected CategoryModel $categoryModel;
    protected RecipeModel $recipeModel;
    protected SectionModel $sectionModel;
    protected TagModel $tagModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->recipeModel = new RecipeModel();
        $this->sectionModel = new SectionModel();
        $this->tagModel = new TagModel();
    }

    public function index(): string
    {
        $user = auth()->user();
        $data = [
            'username' => $user->username,
            'total_recipes' => $this->recipeModel->countAllResults(),
            'correct_recipes' => $this->recipeModel->getCorrectRecipes(),
            'incorrect_recipes' => $this->recipeModel->getIncorrectRecipes(),
            'total_categories' => $this->categoryModel->countAllResults(),
            'recipes_with_category' => $this->recipeModel->getRecipesWithCategories(),
            'total_tags' => $this->tagModel->countAllResults(),
            'recipes_with_tag' => $this->recipeModel->getRecipesWithTags(),
            'recipes_without_category' => $this->recipeModel->getRecipesWithoutCategories(),
            'last_recipes_updated' => $this->recipeModel->getRecipesWithRelations(5, 'DESC', true),
            'sections' => $this->sectionModel->getSections(),
            'draft_recipes' => $this->recipeModel->getDrafts(),

            'categories_chart' => [
                'names' => array_map(function ($value) {
                    return $value->name;
                }, $this->categoryModel->select('name')->findAll()),
                'values' => array_map(function ($value) {
                    return $value->count;
                }, $this->categoryModel->select('count')->findAll())
            ],
            'tags_chart' => [
                'names' => array_map(function ($value) {
                    return $value->name;
                }, $this->tagModel->select('name')->orderBy('count', 'DESC')->findAll(10)),
                'values' => array_map(function ($value) {
                    return $value->count;
                }, $this->tagModel->select('count')->orderBy('count', 'DESC')->findAll(10))
            ]
        ];

        return view('admin/pages/index', $data);
    }

}
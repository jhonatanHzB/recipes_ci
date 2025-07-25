<?php

namespace App\Cells;

use App\Modules\Front\Models\RecipeModel;
use App\Modules\Front\Models\RecipeSectionModel;
use App\Modules\Front\Models\SectionModel;
use CodeIgniter\View\Cells\Cell;

class SectionCell extends Cell
{
    private RecipeModel $recipeModel;
    private RecipeSectionModel $recipeSectionModel;
    private SectionModel $sectionModel;
    public string $section = '';

    public function __construct()
    {
        $this->recipeModel = new RecipeModel();
        $this->recipeSectionModel = new RecipeSectionModel();
        $this->sectionModel = new SectionModel();
    }

    public function renderFirstSection(): string
    {
        $recipe_ids = array_column($this->recipeSectionModel->where('section_id', $this->section)->findAll(), 'recipe_id');
        $data = [
            'section_name' => $this->sectionModel->where('id', $this->section)->first(),
            'recipes' => $this->recipeModel->getRecipesWithScore($recipe_ids)
        ];

        return $this->view('../Views/front/sections/popular', $data);
    }

    public function renderSecondSection(): string
    {
        $recipe_ids = array_column($this->recipeSectionModel->where('section_id', $this->section)->findAll(), 'recipe_id');
        $data = [
            'section_name' => $this->sectionModel->where('id', $this->section)->first(),
            'recipes' => $this->recipeModel->getRecipesWithScore($recipe_ids)
        ];

        return $this->view('../Views/front/sections/semana', $data);
    }

    public function renderThirdSection(): string
    {
        $recipe_ids = array_column($this->recipeSectionModel->where('section_id', $this->section)->findAll(), 'recipe_id');
        $data = [
            'section_name' => $this->sectionModel->where('id', $this->section)->first(),
            'recipes' => $this->recipeModel->getRecipesWithScore($recipe_ids)
        ];

        return $this->view('../Views/front/sections/nuevas', $data);
    }

    public function renderFourthSection(): string
    {
        $recipe_ids = array_column($this->recipeSectionModel->where('section_id', $this->section)->findAll(), 'recipe_id');
        $data = [
            'section_name' => $this->sectionModel->where('id', $this->section)->first(),
            'recipes' => $this->recipeModel->getRecipesWithScore($recipe_ids)
        ];

        return $this->view('../Views/front/sections/holidays', $data);
    }
}
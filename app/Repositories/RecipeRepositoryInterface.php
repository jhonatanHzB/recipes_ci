<?php

namespace App\Repositories;

interface RecipeRepositoryInterface
{

    public function getRecipesByCategory(int $category_id): array;

    public function getRecipesByMenu(int $menu_id): array;

    public function getRecipesByTag(int $tag_id): array;

}
<?php

namespace App\Repositories;

use App\Repositories\RecipeRepositoryInterface;
use CodeIgniter\Database\ConnectionInterface;

class RecipeRepository implements RecipeRepositoryInterface
{

    protected ConnectionInterface $db;

    public function __construct(ConnectionInterface $db)
    {
        $this->db = $db;
    }

    public function getRecipesByCategory(int $category_id): array
    {
        $builder = $this->db->table('recipe');
        $builder->select('
            recipe.id,
            recipe.name,
            recipe.slug,
            recipe.image,
            recipe.difficulty,
            recipe.calories,
            (SELECT rating FROM score WHERE recipe_id = recipe.id) as rating
        ');
        $builder->join('recipe_category', 'recipe_category.recipe_id = recipe.id');
        $builder->where('recipe_category.category_id', $category_id);
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getRecipesByMenu(int $menu_id): array
    {
        $builder = $this->db->table('recipe');
        $builder->select('
            recipe.id,
            recipe.name,
            recipe.slug,
            recipe.image,
            recipe.difficulty,
            recipe.calories,
            (SELECT rating FROM score WHERE recipe_id = recipe.id) as rating
        ');
        $builder->join('menu_recipe', 'menu_recipe.recipe_id = recipe.id');
        $builder->where('menu_recipe.menu_id', $menu_id);
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getRecipesByTag(int $tag_id): array
    {
        $builder = $this->db->table('recipe');
        $builder->select('
            recipe.id,
            recipe.name,
            recipe.slug,
            recipe.image,
            recipe.difficulty,
            recipe.calories,
            (SELECT rating FROM score WHERE recipe_id = recipe.id) as rating
        ');
        $builder->join('recipe_tag', 'recipe_tag.recipe_id = recipe.id');
        $builder->where('recipe_tag.tag_id', $tag_id);
        $query = $builder->get();

        return $query->getResultArray();
    }

}
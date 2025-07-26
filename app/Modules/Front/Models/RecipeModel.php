<?php

namespace App\Modules\Front\Models;

use CodeIgniter\Model;

class RecipeModel extends Model
{

    protected $table = 'recipe';
    protected $primaryKey = 'id';
    protected $returnType = \App\Entities\Recipe::class;
    protected $allowedFields = ['user_id', 'name', 'slug', 'description', 'status', 'image', 'portions', 'ingredients',
        'instructions', 'time', 'baked', 'difficulty', 'refrigeration', 'calories',
        'calories_unit', 'carbohydrates', 'carbohydrates_unit', 'protein', 'protein_unit',
        'fat', 'fat_unit'];
    protected bool $updateOnlyChanged = true;
    protected $useSoftDeletes = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getRecipesWithScore($ids): array
    {
        $builder = $this->builder();
        $builder->select('
            recipe.id,
            recipe.name,
            recipe.slug,
            recipe.image,
            recipe.portions,
            recipe.time,
            recipe.difficulty,
           (SELECT rating FROM score WHERE recipe_id = recipe.id) as rating,
        ');
        $builder->whereIn('recipe.id', $ids);
        return $builder->get()->getCustomResultObject(\App\Entities\Recipe::class);
    }

    public function getRecipeWithScore($slug)
    {
        $builder = $this->builder();
        $builder->select('
            recipe.*,
            (SELECT rating FROM score WHERE recipe_id = recipe.id) as rating,
            (SELECT COUNT(*) FROM recipe_score WHERE recipe_id = recipe.id) as count,
        ');
        $builder->where('recipe.slug', $slug);
        return $builder->get()->getCustomRowObject(0, \App\Entities\Recipe::class);
    }

    public function getRandomRecipesWithSameCategory($category, $currentRecipeId, $limit = 4): array
    {
        $builder = $this->builder();
        $builder->select('
            recipe.id,
            recipe.name,
            recipe.slug,
            recipe.image,
            recipe.portions,
            recipe.time,
            recipe.difficulty,
            (SELECT rating FROM score WHERE recipe_id = recipe.id) as rating
        ');
        $builder->join('recipe_category', 'recipe_category.recipe_id = recipe.id');
        $builder->join('category', 'category.id = recipe_category.category_id');
        $builder->where('category.id', $category);
        $builder->where('recipe.id !=', $currentRecipeId); // Excluye la receta actual
        $builder->orderBy('RAND()'); // Ordena aleatoriamente
        $builder->limit($limit);

        return $builder->get()->getCustomResultObject(\App\Entities\Recipe::class);
    }

}
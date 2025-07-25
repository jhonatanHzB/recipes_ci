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

}
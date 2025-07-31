<?php

namespace App\Modules\Front\Models;

use CodeIgniter\Model;

class RecipeTagModel extends Model
{

    protected $table = 'recipe_tag';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['recipe_id', 'tag_id'];
    protected bool $updateOnlyChanged = true;
    protected $useSoftDeletes = false;

    // Dates
    protected $useTimestamps = false;

    public function getRecipesByTag(array $tagIds): array
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
        $builder->join('recipe', 'recipe_tag.recipe_id = recipe.id');
        $builder->whereIn('recipe_tag.tag_id', $tagIds);
        return $builder->get()->getCustomResultObject(\App\Entities\Recipe::class);
    }

}
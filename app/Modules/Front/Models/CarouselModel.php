<?php

namespace App\Modules\Front\Models;

use CodeIgniter\Model;

class CarouselModel extends Model
{

    protected $table = 'carousel';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['recipe_id', 'description', 'position'];
    protected bool $updateOnlyChanged = true;
    protected $useSoftDeletes = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getCarouselWithRecipe(): array
    {
        $builder = $this->builder();
        $builder->select('
            carousel.description,
            carousel.position,
            recipe.name,
            recipe.slug,
            recipe.image
        ');
        $builder->orderBy('carousel.position', 'ASC');
        $builder->join('recipe', 'recipe.id = carousel.recipe_id');
        return $builder->get()->getResult();
    }

}
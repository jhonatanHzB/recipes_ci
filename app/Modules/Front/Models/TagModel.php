<?php

namespace App\Modules\Front\Models;

use CodeIgniter\Model;

class TagModel extends Model
{

    protected $table = 'tag';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['name', 'count'];
    protected bool $updateOnlyChanged = true;
    protected $useSoftDeletes = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getTagsOfRecipe($id): array
    {
        $builder = $this->builder();
        $builder->select('tag.name');
        $builder->join('recipe_tag', 'recipe_tag.tag_id = tag.id');
        $builder->where('recipe_tag.recipe_id', $id);
        return $builder->get()->getResult();
    }

    public function getTagByName(string $name): ?object
    {
        return $this->where('name', $name)->first();
    }

}
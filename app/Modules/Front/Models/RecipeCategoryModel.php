<?php

namespace App\Modules\Front\Models;

use CodeIgniter\Model;

class RecipeCategoryModel extends Model
{

    protected $table = 'recipe_category';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['recipe_id', 'category_id'];
    protected bool $updateOnlyChanged = true;
    protected $useSoftDeletes = false;

    // Dates
    protected $useTimestamps = false;

}
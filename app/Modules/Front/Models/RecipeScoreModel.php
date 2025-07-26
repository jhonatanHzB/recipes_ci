<?php

namespace App\Modules\Front\Models;

use CodeIgniter\Model;

class RecipeScoreModel extends Model
{

    protected $table = 'recipe_score';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['recipe_id', 'score'];
    protected bool $updateOnlyChanged = true;
    protected $useSoftDeletes = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';

}
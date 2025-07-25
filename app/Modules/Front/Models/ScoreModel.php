<?php

namespace App\Modules\Front\Models;

use CodeIgniter\Model;

class ScoreModel extends Model
{

    protected $table = 'score';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['recipe_id', 'rating'];
    protected bool $updateOnlyChanged = true;
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

}
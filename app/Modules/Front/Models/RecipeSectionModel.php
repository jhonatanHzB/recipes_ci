<?php

namespace App\Modules\Front\Models;

use CodeIgniter\Model;

class RecipeSectionModel extends Model
{

    protected $table = 'recipe_section';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['recipe_id', 'section_id', 'position'];
    protected bool $updateOnlyChanged = true;
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;

}
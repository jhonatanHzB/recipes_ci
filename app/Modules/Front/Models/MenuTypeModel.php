<?php

namespace App\Modules\Front\Models;

use CodeIgniter\Model;

class MenuTypeModel extends Model
{

    protected $table = 'menu_type';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['type_name'];
    protected bool $updateOnlyChanged = true;
    protected $useSoftDeletes = false;

    // Dates
    protected $useTimestamps = false;

}
<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuTypeModel extends Model
{

    protected $table = 'menu_type';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['type_name'];
}

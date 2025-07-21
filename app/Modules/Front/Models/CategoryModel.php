<?php

namespace App\Modules\Front\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{

    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['name', 'slug', 'image', 'position'];
    protected bool $updateOnlyChanged = true;
    protected $useSoftDeletes = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

}
<?php

namespace App\Modules\Front\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{

    protected $table = 'menu';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['menu_type_id', 'name', 'slug', 'image', 'position', 'count'];
    protected bool $updateOnlyChanged = true;
    protected $useSoftDeletes = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getMenuBySlug(string $slug): ?object
    {
        return $this->where('slug', $slug)->first();
    }

}
<?php

namespace App\Modules\Front\Models;

use CodeIgniter\Model;

class MediaModel extends Model
{

    protected $table = 'video';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['user_id', 'name', 'slug', 'description', 'image', 'url', 'duration', 'difficulty', 'position'];
    protected bool $updateOnlyChanged = true;
    protected $useSoftDeletes = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';


}
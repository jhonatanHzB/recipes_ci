<?php

namespace App\Modules\Front\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{

    protected $table = 'contact';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['full_name', 'email', 'message'];
    protected bool $updateOnlyChanged = true;
    protected $useSoftDeletes = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

}
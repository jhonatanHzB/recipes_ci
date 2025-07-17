<?php

namespace App\Repositories;

use App\Repositories\RecipeRepositoryInterface;
use CodeIgniter\Database\ConnectionInterface;

class RecipeRepository implements RecipeRepositoryInterface
{

    protected ConnectionInterface $db;

    public function __construct(ConnectionInterface $db)
    {
        $this->db = $db;
    }

}
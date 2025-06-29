<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class HeaderCell extends Cell
{


    public function __construct()
    {
    }

    public function render(): string
    {
        $data = [
            'username' => 'jhonatan',
            'email' => 'jhonatanhzb@outlook.com'
        ];

        return $this->view('../Views/admin/components/header', $data);
    }

}
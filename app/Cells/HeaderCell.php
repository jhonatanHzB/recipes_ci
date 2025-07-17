<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class HeaderCell extends Cell
{

    public array $data;

    public function render(): string
    {
        $user = auth()->user();
        $this->data['username'] = $user->username;

        return $this->view('../Views/admin/components/header', $this->data);
    }

}
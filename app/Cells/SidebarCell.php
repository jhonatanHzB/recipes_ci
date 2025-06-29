<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class SidebarCell extends Cell
{

    public function render(): string
    {
        $data['sections'] = ['Primera', 'Segundo', 'Tercero'];

        return $this->view('../Views/admin/components/sidebar', $data);
    }

}
<?php

namespace App\Cells;

use App\Models\MenuModel;
use CodeIgniter\View\Cells\Cell;

class PopularRecipesCell extends Cell
{
    private MenuModel $menuModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
    }

    public function render(): string
    {
        $data = [
            'menus' => $this->menuModel->where('id', 1)->findAll(),
        ];

        return $this->view('../Views/front/components/popular', $data);
    }
}
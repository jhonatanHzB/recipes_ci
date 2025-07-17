<?php

namespace App\Cells;

use App\Models\MenuTypeModel;
use CodeIgniter\View\Cells\Cell;
use App\Models\SectionModel;

class SidebarCell extends Cell
{
    protected SectionModel $sectionModel;
    protected MenuTypeModel $menuTypeModel;

    public function __construct()
    {
        $this->sectionModel = new SectionModel();
        $this->menuTypeModel = new MenuTypeModel();
    }

    public function render(): string
    {
        $data['sections'] = $this->sectionModel->findAll();
        $data['menus'] = $this->menuTypeModel->findAll();

        return $this->view('../Views/admin/components/sidebar', $data);
    }
}
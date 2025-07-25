<?php

namespace App\Cells;

use App\Modules\Admin\Models\MenuTypeModel;
use App\Modules\Front\Models\SectionModel;
use CodeIgniter\View\Cells\Cell;

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
<?php

namespace App\Cells;

use App\Modules\Front\Models\CategoryModel;
use App\Modules\Front\Models\MenuModel;
use CodeIgniter\View\Cells\Cell;

class MenuCell extends Cell
{
    private CategoryModel $categoryModel;
    private MenuModel $menuModel;

    public function __construct()
    {
        $this->categoryModel     = new CategoryModel();
        $this->menuModel         = new MenuModel();
    }

    public function renderCategoriesMenu(): string
    {
        $data = [
            'categories' => $this->categoryModel->findAll(),
        ];

        return $this->view('../Views/front/components/navbar/categories_menu', $data);
    }

    public function renderSeasonalMenu(): string
    {
        $data = [
            'menus' => $this->menuModel->where('id', 1)->findAll(),
        ];

        return $this->view('../Views/front/components/navbar/seasonal_menu', $data);
    }

    public function renderHolidayMenu(): string
    {
        $data = [
            'menus' => $this->menuModel->where('id', 2)->findAll(),
        ];

        return $this->view('../Views/front/components/navbar/holiday_menu', $data);
    }
}

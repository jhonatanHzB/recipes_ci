<?php

namespace App\Modules\Front\Controllers;

use App\Modules\Front\Controllers\BaseController;
use App\Modules\Front\Models\CarouselModel;
use App\Modules\Front\Models\CategoryModel;
use App\Modules\Front\Models\MenuModel;
use CodeIgniter\HTTP\ResponseInterface;

class CarouselController extends BaseController
{

    private CarouselModel $carouselModel;
    private CategoryModel $categoryModel;
    private MenuModel $menuModel;

    public function __construct()
    {
        $this->carouselModel = new CarouselModel();
        $this->categoryModel = new CategoryModel();
        $this->menuModel = new MenuModel();
    }

    public function getCarouselItems(): ResponseInterface
    {
        $items = $this->carouselModel->getCarouselWithRecipe();
        return $this->response->setJSON($items);
    }

    public function getAllCategoriesCarousel(): ResponseInterface
    {
        $categories = $this->categoryModel->findAll();
        $seasonMenu = $this->menuModel->where('menu_type_id', 1)->findAll();
        $holidayMenu = $this->menuModel->where('menu_type_id', 2)->findAll();

        $data = [
          'categories' => $categories,
          'seasonMenu' => $seasonMenu,
          'holidayMenu' => $holidayMenu,
        ];

        return $this->response->setJSON($data);
    }

}
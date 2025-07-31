<?php

namespace App\Modules\Front\Controllers;

use App\Modules\Front\Controllers\BaseController;
use App\Modules\Front\Models\MenuModel;
use App\Modules\Front\Models\MenuTypeModel;
use CodeIgniter\HTTP\ResponseInterface;

class MenuController extends BaseController
{

    private MenuModel $menuModel;
    private MenuTypeModel $menuTypeModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
        $this->menuTypeModel = new MenuTypeModel();
    }

    public function getMenu(int $menu_id): ResponseInterface
    {
        if ($menu_id > 0) {
            $options = $this->menuModel
                ->select('name, slug, image, position, count')
                ->where('menu_type_id', $menu_id)
                ->orderBy('position', 'ASC')
                ->findAll();
            $menu = $this->menuTypeModel->where('id', $menu_id)->first();
            unset($menu->id);

            $data = [
                'menu' => $menu,
                'options' => $options
            ];

            return $this->response->setJSON($data);
        }

        return $this->response->setStatusCode(400);
    }

}

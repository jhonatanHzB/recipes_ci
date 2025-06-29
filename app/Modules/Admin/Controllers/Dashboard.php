<?php
namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $data = [
            'username' => 'jhonatanhzb',
            'recipes' => [],
            'correct_recipes' => [],
            'incorrect_recipes' => [],
            'categories' => [],
            'recipe_with_category' => [],
            'tags' => [],
            'recipes_with_tag' => [],
            'recipe_without_category' => [],
            'last_recipes_updated' => []
        ];

        return view('admin/pages/index', $data);
    }
}
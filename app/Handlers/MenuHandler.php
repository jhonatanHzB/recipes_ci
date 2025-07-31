<?php

namespace App\Handlers;

use App\Modules\Front\Models\MenuModel;
use App\Repositories\RecipeRepositoryInterface;

class MenuHandler extends AbstractRecipeHandler
{
    private $menuModel;
    private $recipeRepository;

    public function __construct(MenuModel $menuModel, RecipeRepositoryInterface $recipeRepository)
    {
        $this->menuModel = $menuModel;
        $this->recipeRepository  = $recipeRepository;
    }

    public function handle(string $slug): ?array
    {
        $menu = $this->menuModel->getMenuBySlug($slug);
        if ($menu) {
            return [
                'page'    => $menu->name,
                'recipes' => $this->recipeRepository->getRecipesByMenu($menu->id),
            ];
        }

        return parent::handle($slug);
    }
}

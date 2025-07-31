<?php

namespace App\Handlers;

use App\Modules\Front\Models\TagModel;
use App\Repositories\RecipeRepositoryInterface;

class TagHandler extends AbstractRecipeHandler
{
    private $tagModel;
    private $recipeRepository;

    public function __construct(TagModel $tagModel, RecipeRepositoryInterface $recipeRepository)
    {
        $this->tagModel         = $tagModel;
        $this->recipeRepository = $recipeRepository;
    }

    public function handle(string $slug): ?array
    {
        $tag = $this->tagModel->getTagByName($slug);
        if ($tag) {
            return [
                'page'    => $tag->name,
                'recipes' => $this->recipeRepository->getRecipesByTag($tag->id),
            ];
        }

        return parent::handle($slug);
    }
}

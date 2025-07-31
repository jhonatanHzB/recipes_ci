<?php

namespace App\Handlers;

abstract class AbstractRecipeHandler implements RecipeHandlerInterface
{
    private $nextHandler;

    public function setNext(RecipeHandlerInterface $handler): RecipeHandlerInterface
    {
        $this->nextHandler = $handler;

        return $handler;
    }

    public function handle(string $slug): ?array
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($slug);
        }

        return null;
    }
}

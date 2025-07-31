<?php

namespace App\Handlers;

interface RecipeHandlerInterface
{
    public function setNext(RecipeHandlerInterface $handler): RecipeHandlerInterface;

    public function handle(string $slug): ?array;

}

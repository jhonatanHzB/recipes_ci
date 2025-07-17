<?php

namespace App\Entities;

class RecipeEntity
{
    public function __construct(
        public int    $id,
        public int    $user_id,
        public string $name,
        public string $slug,
        public string $description = '',
        public string $status,
        public string $image,
        public string $portions,
        public string $ingredients = '[]',
        public string $instructions = '[]',
        public string $time,
        public string $baked,
        public string $difficulty,
        public string $refrigeration,
        public int    $calories,
        public string $calories_unit,
        public int    $carbohydrates,
        public string $carbohydrates_unit,
        public int    $protein,
        public string $protein_unit,
        public int    $fat,
        public string $fat_unit,
        public string $created_at,
        public string $updated_at,
        public mixed $categories = null,
        public mixed $tags = null,
    )
    {
    }

    public function getBaked(): string
    {
        return $this->baked;
    }

    public function setBaked(string $baked): void
    {
        $this->baked = $baked;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function setTime(string $time): void
    {
        $this->time = $time;
    }

    public function getRefrigeration(): string
    {
        return $this->refrigeration;
    }

    public function setRefrigeration(string $refrigeration): void
    {
        $this->refrigeration = $refrigeration;
    }
}
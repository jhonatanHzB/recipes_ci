<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use InvalidArgumentException;
use Kint\Value\Context\ArrayContext;

class Recipe extends Entity
{

    protected $attributes = [
        'id' => null,
        'user_id' => null,
        'name' => null,
        'slug' => null,
        'description' => null,
        'status' => null,
        'image' => null,
        'portions' => null,
        'ingredients' => null,
        'instructions' => null,
        'time' => null,
        'baked' => null,
        'difficulty' => null,
        'refrigeration' => null,
        'calories' => null,
        'calories_unit' => null,
        'carbohydrates' => null,
        'carbohydrates_unit' => null,
        'protein' => null,
        'protein_unit' => null,
        'fat' => null,
        'fat_unit ' => null,
        'categories' => null,
        'tags' => null,
    ];

    protected function getCategories(): array
    {
        $categories = $this->attributes['categories'];
        return $categories ? explode(',', $categories) : [];
    }

    protected function getTags(): array
    {
        $tags = $this->attributes['tags'];
        return $tags ? explode(',', $tags) : [];
    }

    protected function getIngredients(): array
    {
        $ingredients = $this->attributes['ingredients'];
        if (is_string($ingredients)) {
            $decoded = json_decode($ingredients, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new InvalidArgumentException('Invalid JSON format for ingredients');
            }
            return $decoded;
        }
        return (array)$ingredients;
    }

    protected function getInstructions(): array
    {
        $instructions = $this->attributes['instructions'];
        if (is_string($instructions)) {
            $decoded = json_decode($instructions, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new InvalidArgumentException('Invalid JSON format for instructions');
            }
            return $decoded;
        }
        return (array)$instructions;
    }

    protected function getDescription(): string
    {
        return html_entity_decode($this->attributes['description']);
    }

    public function setTime(string $formatTime): static
    {
        $this->attributes['time'] = $formatTime;
        return $this;
    }

    public function setBaked(string $formatTime): static
    {
        $this->attributes['baked'] = $formatTime;
        return $this;
    }

    public function setRefrigeration(string $formatTime): static
    {
        $this->attributes['refrigeration'] = $formatTime;
        return $this;
    }
}

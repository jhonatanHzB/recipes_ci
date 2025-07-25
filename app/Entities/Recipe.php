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
        'rating' => null,
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

    public function getDifficultyIcon(): ?string
    {
        $difficulty = $this->difficulty;
        return match ($difficulty) {
            'fácil'   => '<i class="fas fa-thermometer-quarter mr-1"></i>',
            'medio'   => '<i class="fas fa-thermometer-half mr-1"></i>',
            'difícil' => '<i class="fas fa-thermometer-full mr-1"></i>',
        };
    }

    public function generateRatingStars(): string
    {
        $totalStars = 5;
        $stars = '';

        for ($i = 0; $i < $totalStars; $i++) {
            $rating = $i + 1;
            $isSelected = !is_null($this->rating) && $i < $this->rating;

            $starClass = $isSelected ? 'star star-selected' : 'star';
            $stars .= $this->createStarElement($rating, $starClass);
        }

        return $stars;
    }

    private function createStarElement(int $rating, string $starClass): string
    {
        return sprintf(
            "<i class='fas fa-star %s' data-rating='%d' data-recipe='%d'></i>",
            $starClass,
            $rating,
            $this->id
        );
    }

}

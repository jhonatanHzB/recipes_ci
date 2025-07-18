<?php

namespace App\Modules\Admin\Models;

use App\Entities\Recipe;
use App\Entities\RecipeEntity;
use CodeIgniter\Model;

class RecipeModel extends Model
{

    protected $table = 'recipe';
    protected $primaryKey = 'id';
    protected $returnType = \App\Entities\Recipe::class;
    protected $allowedFields = ['user_id', 'name', 'slug', 'description', 'status', 'image', 'portions', 'ingredients',
                                'instructions', 'time', 'baked', 'difficulty', 'refrigeration', 'calories',
                                'calories_unit', 'carbohydrates', 'carbohydrates_unit', 'protein', 'protein_unit',
                                'fat', 'fat_unit'];
    protected bool $updateOnlyChanged = true;
    protected $useSoftDeletes = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function setRecipe($data): int
    {
        if ($this->save($data)) {
            return $this->getInsertID();
        }

        return 0;
    }

    public function updateRecipe($data): int {
        $recipe_id = $data['id'];

        if ($this->update($recipe_id, $data)) {
            return $recipe_id;
        }

        return 0;
    }

    public function getRecipesWithRelations($limit = 0, $order = 'ASC', $last_updated = false): array
    {
        $builder = $this->builder();

        $builder->select('
            recipe.id,
            recipe.name,
            recipe.status,
            recipe.created_at,
            recipe.updated_at,
            GROUP_CONCAT(DISTINCT category.name) as categories,
            GROUP_CONCAT(DISTINCT tag.name) as tags
        ');

        $builder->join('recipe_category', 'recipe_category.recipe_id = recipe.id', 'left');
        $builder->join('category', 'category.id = recipe_category.category_id', 'left');
        $builder->join('recipe_tag', 'recipe_tag.recipe_id = recipe.id', 'left');
        $builder->join('tag', 'tag.id = recipe_tag.tag_id', 'left');

        $builder->groupBy('recipe.id');
        $builder->orderBy($last_updated ? 'recipe.updated_at' : 'recipe.created_at', $order);
        $builder->limit($limit);

        return $builder->get()->getCustomResultObject(Recipe::class);
    }

    public function getCorrectRecipes(): int
    {
        return $this->where('image !=', ' ')
            ->where('ingredients !=', ' ')
            ->where('instructions !=', ' ')
            ->where('time !=', ' ')
            ->where('difficulty !=', ' ')
            ->countAllResults();
    }

    public function getIncorrectRecipes(): int
    {
        return $this->where('image', ' ')
            ->orWhere('ingredients', ' ')
            ->orWhere('instructions', ' ')
            ->orWhere('time', ' ')
            ->orWhere('difficulty', ' ')
            ->countAllResults();
    }

    public function getRecipesWithCategories(): array
    {
        $builder = $this->builder();

        $builder->select('
            recipe.id,
            recipe.name,
            recipe.created_at,
            recipe.updated_at,
            GROUP_CONCAT(category.name SEPARATOR ", ") as categories   
        ');

        $builder->join('recipe_category', 'recipe_category.recipe_id = recipe.id');

        $builder->join('category', 'category.id = recipe_category.category_id');

        $builder->groupBy('recipe.id');

        $builder->orderBy('recipe.created_at', 'DESC');

        return $builder->get()->getResult();
    }

    public function getRecipesWithoutCategories(): array
    {
        $builder = $this->builder();

        $builder->select('
            recipe.id,
            recipe.name,
            recipe.created_at,
            recipe.updated_at
        ');

        $builder->where('recipe.id NOT IN (SELECT recipe_id FROM recipe_category)');

        $builder->orderBy('recipe.created_at', 'DESC');

        return $builder->get()->getResult();
    }

    public function getRecipesWithTags(): array
    {
        $builder = $this->builder();

        $builder->select('
            recipe.id,
            recipe.name,
            recipe.created_at,
            recipe.updated_at,
            GROUP_CONCAT(tag.name SEPARATOR ", ") as tags 
        ');

        $builder->join('recipe_tag', 'recipe_tag.recipe_id = recipe.id');

        $builder->join('tag', 'tag.id = recipe_tag.tag_id');

        $builder->groupBy('recipe.id');

        $builder->orderBy('recipe.created_at', 'DESC');

        return $builder->get()->getResult();
    }

    public function getRecipeWithCategoriesAndTags($id)
    {
        $builder = $this->builder();
        $builder->select("
            recipe.id,
            recipe.name,
            recipe.description,
            recipe.status,
            recipe.image,
            recipe.portions,
            recipe.ingredients,
            recipe.instructions,
            recipe.time,
            recipe.baked,
            recipe.difficulty,
            recipe.refrigeration,
            recipe.calories,
            recipe.calories_unit,
            recipe.carbohydrates,
            recipe.carbohydrates_unit,
            recipe.protein,
            recipe.protein_unit,
            recipe.fat,
            recipe.fat_unit,
            GROUP_CONCAT(DISTINCT category.id) as categories,
            GROUP_CONCAT(DISTINCT tag.id) as tags
        ");
        $builder->join('recipe_category', 'recipe_category.recipe_id = recipe.id', 'left');
        $builder->join('category', 'category.id = recipe_category.category_id', 'left');
        $builder->join('recipe_tag', 'recipe_tag.recipe_id = recipe.id', 'left');
        $builder->join('tag', 'tag.id = recipe_tag.tag_id', 'left');
        $builder->groupBy('recipe.id');
        $builder->where('recipe.id', $id);
        return $builder->get()->getCustomRowObject(0, Recipe::class);
    }

    public function getDrafts(): array
    {
        $builder = $this->builder();

        $builder->select('
            recipe.id,
            recipe.name,
            recipe.status,
            recipe.created_at,
            recipe.updated_at,
            GROUP_CONCAT(DISTINCT category.name) as categories,
            GROUP_CONCAT(DISTINCT tag.name) as tags
        ');

        $builder->join('recipe_category', 'recipe_category.recipe_id = recipe.id', 'left');
        $builder->join('category', 'category.id = recipe_category.category_id', 'left');
        $builder->join('recipe_tag', 'recipe_tag.recipe_id = recipe.id', 'left');
        $builder->join('tag', 'tag.id = recipe_tag.tag_id', 'left');

        $builder->groupBy('recipe.id');
        $builder->where('recipe.status', 'draft');
        $builder->orderBy('recipe.created_at', 'DESC');

        return $builder->get()->getCustomResultObject(Recipe::class);
    }

    public function paginateWithRelations(int $perPage = 10): array {
        $builder = $this->builder();

        $builder->select('
            recipe.id,
            recipe.name,
            recipe.status,
            recipe.created_at,
            recipe.updated_at,
            GROUP_CONCAT(DISTINCT category.name) as categories,
            GROUP_CONCAT(DISTINCT tag.name) as tags
        ');

        $builder->join('recipe_category', 'recipe_category.recipe_id = recipe.id', 'left');
        $builder->join('category', 'category.id = recipe_category.category_id', 'left');
        $builder->join('recipe_tag', 'recipe_tag.recipe_id = recipe.id', 'left');
        $builder->join('tag', 'tag.id = recipe_tag.tag_id', 'left');

        $builder->groupBy('recipe.id');
        $builder->orderBy('recipe.created_at', 'DESC');

        // Configurar la paginación
        $this->builder = $builder;
        return $this->paginate($perPage);
    }


    public function searchRecipes($search = '', $page = 1, $perPage = 10): array
    {
        $offset = ($page - 1) * $perPage;

        $builder = $this->builder();

        $builder->select('
            recipe.id,
            recipe.name,
            recipe.status,
            GROUP_CONCAT(DISTINCT category.name) as categories,
            GROUP_CONCAT(DISTINCT tag.name) as tags
        ');

        $builder->join('recipe_category', 'recipe_category.recipe_id = recipe.id', 'left');
        $builder->join('category', 'category.id = recipe_category.category_id', 'left');
        $builder->join('recipe_tag', 'recipe_tag.recipe_id = recipe.id', 'left');
        $builder->join('tag', 'tag.id = recipe_tag.tag_id', 'left');

        $builder->groupStart()
            ->like('recipe.name', $search, 'both')
            ->orLike('recipe.description', $search, 'both')
            ->groupEnd();

        $builder->groupBy('recipe.id');
        $builder->orderBy('recipe.created_at', 'DESC');

        $builder->limit($perPage, $offset);

        return $builder->get()->getCustomResultObject(Recipe::class);
    }

    public function countSearchResults($search = ''): int
    {
        return $this->like('recipe.name', $search, 'both')
            ->orLike('recipe.description', $search, 'both')
            ->countAllResults();
    }


}
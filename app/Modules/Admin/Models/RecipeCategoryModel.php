<?php

namespace App\Modules\Admin\Models;

use CodeIgniter\Model;

class RecipeCategoryModel extends Model
{

    protected $table = 'recipe_category';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['recipe_id', 'category_id'];
    protected $useSoftDeletes = false;

    public function setCategory($recipeId, $categoryId): array
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {

            $insertResult = $this->insert([
                'recipe_id' => $recipeId,
                'category_id' => $categoryId
            ]);

            if ($insertResult === false) {
                log_message('error', 'Error al insertar nueva categoria ' . $categoryId . ' en la receta ' . $recipeId);;
                throw new \RuntimeException('Error al insertar nueva categoría');
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                log_message('error', 'Error en la transacción de categorías ' . $categoryId . ' en la receta ' . $recipeId);
                throw new \RuntimeException('Error en la transacción de categorías');
            }

            return [
                'success' => true,
                'message' => 'Categoría asignada correctamente'
            ];

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Error al asignar categoría ' . $categoryId . ' en la receta ' . $recipeId . ': ' . $e->getMessage());;
            return [
                'success' => false,
                'message' => 'Error al asignar categoría: ' . $e->getMessage()
            ];
        }
    }

    public function removeExistingCategories($recipeId): void
    {
        $deleteResult = $this->where('recipe_id', $recipeId)->delete();

        if ($deleteResult === false) {
            log_message('error', 'Error al eliminar categorías existentes');
            throw new \RuntimeException('Error al eliminar categorías existentes');
        }
    }
}
<?php

namespace App\Modules\Admin\Models;

use CodeIgniter\Model;

class RecipeTagModel extends Model
{

    protected $table = 'recipe_tag';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $allowedFields = ['recipe_id', 'tag_id'];
    protected $useSoftDeletes = false;


    public function setTag($recipeId, $tagId): array
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {

            $insertResult = $this->insert([
                'recipe_id' => $recipeId,
                'tag_id' => $tagId
            ]);

            if ($insertResult === false) {
                log_message('error', 'Error al insertar nueva etiqueta ' . $tagId . ' en la receta ' . $recipeId);
                throw new \RuntimeException('Error al insertar nueva etiqueta');
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                log_message('error', 'Error en la transacción de etiquetas ' . $tagId . ' en la receta ' . $recipeId);
                throw new \RuntimeException('Error en la transacción de etiquetas');
            }

            return [
                'success' => true,
                'message' => 'Etiqueta asignada correctamente'
            ];

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Error al asignar etiqueta ' . $tagId . ' en la receta ' . $recipeId . ': ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Error al asignar etiqueta: ' . $e->getMessage()
            ];
        }
    }

    public function removeExistingTags($recipeId): void
    {
        $deleteResult = $this->where('recipe_id', $recipeId)->delete();

        if ($deleteResult === false) {
            log_message('error', 'Error al eliminar etiquetas existentes');
            throw new \RuntimeException('Error al eliminar etiquetas existentes');
        }
    }

}
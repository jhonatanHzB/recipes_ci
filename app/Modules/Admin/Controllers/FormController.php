<?php

namespace App\Modules\Admin\Controllers;

use App\Entities\Recipe;
use App\Helpers\TimeHelper;
use App\Modules\Admin\Controllers\BaseController;
use App\Modules\Admin\Models\RecipeCategoryModel;
use App\Modules\Admin\Models\RecipeModel;
use App\Modules\Admin\Models\RecipeTagModel;
use App\Modules\Admin\Models\SectionModel;
use CodeIgniter\HTTP\ResponseInterface;
use InvalidArgumentException;

class FormController extends BaseController
{
    protected TimeHelper $timeHelper;
    protected RecipeCategoryModel $recipeCategoryModel;
    protected RecipeModel $recipeModel;
    protected RecipeTagModel $recipeTagModel;
    protected SectionModel $sectionModel;

    public function __construct()
    {
        $this->timeHelper = new TimeHelper();
        $this->recipeCategoryModel = new RecipeCategoryModel();
        $this->recipeModel = new RecipeModel();
        $this->recipeTagModel = new RecipeTagModel();
        $this->sectionModel = new SectionModel();
    }

    public function updateSection(): ResponseInterface
    {
        // Validación
        $rules = [
            "id" => "required|numeric",
            "name" => "required|min_length[3]|max_length[255]",
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                "success" => false,
                "errors" => $this->validator->getErrors(),
            ]);
        }

        // Obtener y sanitizar datos
        $id = $this->request->getPost("id", FILTER_SANITIZE_NUMBER_INT);
        $name = esc($this->request->getPost("name"));

        try {
            $this->sectionModel->update($id, [
                "name" => $name,
                "slug" => url_title($name, "-", true),
            ]);

            return $this->response->setJSON([
                "success" => true,
                "message" => "Sección actualizada correctamente",
                "content" => [
                    "id" => $id,
                    "name" => $name,
                    "updated_at" => date("Y-m-d H:i:s"),
                ],
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                "success" => false,
                "message" => "Error al actualizar la sección",
            ]);
        }
    }

    public function createRecipe(): ResponseInterface
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Validación
            $rules = [
                "user_id" => "required|numeric",
                "name" => [
                    "label" => "Titulo",
                    "rules" => "required|min_length[6]|max_length[255]",
                ],
                "description" => [
                    "label" => "Descripción",
                    "rules" => "required|min_length[20]",
                ],
                "portions" => ["label" => "Porciones", "rules" => "required"],
            ];

            if (!$this->request->getPost("recipe_id")) {
                $rules["image"] = [
                        "label" => "Imágen",
                        "rules" =>
                            "uploaded[image]|max_size[image,1024]|is_image[image]",
                ];
            }

            if (!$this->validate($rules)) {
                return $this->response->setJSON([
                    "success" => false,
                    "errors" => $this->validator->getErrors(),
                ]);
            }

            $message = '';

            // Mover la imagen al servidor
            $image = null;
            $file = $this->request->getFile("image");
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(FCPATH . "assets/img/recipes", $newName);
                $image = $newName;
            } else {
                $image = $this->request->getPost("current_image");
            }

            // Status borrador o publicada
            $status = $this->request->getPost("draft") ? "draft" : "published";

            // Obtener y sanitizar datos
            $data = [
                "user_id" => $this->request->getPost(
                    "user_id",
                    FILTER_SANITIZE_NUMBER_INT
                ),
                "name" => esc($this->request->getPost("name")),
                "slug" => url_title($this->request->getPost("name"), "-", true),
                "description" => esc($this->request->getPost("description")),
                "status" => $status,
                "image" => $image,
                "portions" => $this->request->getPost(
                    "portions",
                    FILTER_SANITIZE_STRING
                ),
                "ingredients" => json_encode(
                    $this->request->getPost(
                        "ingredients",
                        FILTER_SANITIZE_STRING
                    )
                ),
                "instructions" => json_encode(
                    $this->request->getPost(
                        "instructions",
                        FILTER_SANITIZE_STRING
                    )
                ),
                "time" => $this->timeHelper->timeToMinutes(
                    $this->timeHelper->formatTime(
                        $this->request->getPost(
                            "time_hour",
                            FILTER_SANITIZE_NUMBER_INT
                        ),
                        $this->request->getPost(
                            "time_min",
                            FILTER_SANITIZE_NUMBER_INT
                        )
                    )
                ),
                "baked" => $this->timeHelper->timeToMinutes(
                    $this->timeHelper->formatTime(
                        $this->request->getPost(
                            "baked_hour",
                            FILTER_SANITIZE_NUMBER_INT
                        ),
                        $this->request->getPost(
                            "baked_min",
                            FILTER_SANITIZE_NUMBER_INT
                        )
                    )
                ),
                "difficulty" => $this->request->getPost(
                    "difficulty",
                    FILTER_SANITIZE_STRING
                ),
                "refrigeration" => $this->timeHelper->timeToMinutes(
                    $this->timeHelper->formatTime(
                        $this->request->getPost(
                            "refrigeration_hour",
                            FILTER_SANITIZE_NUMBER_INT
                        ),
                        $this->request->getPost(
                            "refrigeration_min",
                            FILTER_SANITIZE_NUMBER_INT
                        )
                    )
                ),
                "calories" => $this->request->getPost(
                    "calories",
                    FILTER_SANITIZE_NUMBER_INT
                ),
                "calories_unit" => $this->request->getPost(
                    "calories_unit",
                    FILTER_SANITIZE_STRING
                ),
                "carbohydrates" => $this->request->getPost(
                    "carbohydrates",
                    FILTER_SANITIZE_NUMBER_INT
                ),
                "carbohydrates_unit" => $this->request->getPost(
                    "carbohydrates_unit",
                    FILTER_SANITIZE_STRING
                ),
                "protein" => $this->request->getPost(
                    "protein",
                    FILTER_SANITIZE_NUMBER_INT
                ),
                "protein_unit" => $this->request->getPost(
                    "protein_unit",
                    FILTER_SANITIZE_STRING
                ),
                "fat" => $this->request->getPost(
                    "fat",
                    FILTER_SANITIZE_NUMBER_INT
                ),
                "fat_unit" => $this->request->getPost(
                    "fat_unit",
                    FILTER_SANITIZE_STRING
                ),
            ];

            if ($this->request->getPost("recipe_id")) {
                $data["id"] = $this->request->getPost("recipe_id");
                $recipe_id = $this->recipeModel->updateRecipe($data);
                $message = 'Receta actualizada correctamente';
            } else {
                $recipe_id = $this->recipeModel->setRecipe($data);
                $message = 'Receta guardada correctamente';
            }

            if ($recipe_id === 0) {
                log_message("error", "Error al guardar la receta");
                throw new \RuntimeException("Error al guardar la receta");
            }

            $categories = $this->request->getPost("categories");
            if ($categories) {
                $categoryResult = $this->assignCategories(
                    $recipe_id,
                    $categories
                );
                if (!$categoryResult["success"]) {
                    throw new \RuntimeException($categoryResult["message"]);
                }
            }

            $tags = $this->request->getPost("tags");
            if ($tags) {
                $tagResult = $this->assignTags($recipe_id, $tags);
                if (!$tagResult["success"]) {
                    throw new \RuntimeException($tagResult["message"]);
                }
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \RuntimeException(
                    "Error en la transacción de base de datos"
                );
            }

            return $this->response->setJSON([
                "success" => true,
                "updated" => (bool)$this->request->getPost("recipe_id"),
                "message" => $message,
                "recipe_id" => $recipe_id,
            ]);
        } catch (\Exception $e) {
            $db->transRollback();

            log_message("error", $e->getMessage());
            return $this->response->setJSON([
                "success" => false,
                "message" => $e->getMessage(),
                "recipeData" => $data ?? null,
            ]);
        }
    }

    private function assignCategories($recipe_id, $categories): array
    {
        try {
            $this->recipeCategoryModel->removeExistingCategories($recipe_id);
            foreach ($categories as $category) {
                if (
                    !$this->recipeCategoryModel->setCategory(
                        $recipe_id,
                        $category
                    )
                ) {
                    log_message(
                        "error",
                        "Error al asignar categoría " .
                            $category .
                            " en la receta " .
                            $recipe_id
                    );
                    throw new \RuntimeException("Error al asignar categoría");
                }
            }
            return ["success" => true];
        } catch (\Exception $e) {
            return [
                "success" => false,
                "message" => "Error al asignar categorías: " . $e->getMessage(),
            ];
        }
    }

    private function assignTags($recipe_id, $tags): array
    {
        try {
            $this->recipeTagModel->removeExistingTags($recipe_id);
            foreach ($tags as $tag) {
                if (!$this->recipeTagModel->setTag($recipe_id, $tag)) {
                    log_message(
                        "error",
                        "Error al asignar etiqueta " .
                            $tag .
                            " en la receta " .
                            $recipe_id
                    );
                    throw new \RuntimeException("Error al asignar etiqueta");
                }
            }
            return ["success" => true];
        } catch (\Exception $e) {
            return [
                "success" => false,
                "message" => "Error al asignar etiquetas: " . $e->getMessage(),
            ];
        }
    }

    private function formatTime($hour, $minute): string
    {
        $hour = intval($hour);
        if ($hour < 1) {
            return $minute;
        } else {
            return sprintf("%02d:%02d", $hour, $minute);
        }
    }

    /**
     * Convierte tiempo en formato HH:MM a minutos totales
     * @param string $time Tiempo en formato "H:MM"
     * @return int Minutos totales
     * @throws InvalidArgumentException si el formato es inválido
     */
    public function timeToMinutes(string $time): int
    {
        // Validar el formato
        if (!preg_match('/^(\d+):([0-5]\d)$/', $time, $matches)) {
            throw new InvalidArgumentException(
                "Formato de tiempo inválido. Use H:MM (ejemplo: 1:05, 2:15)"
            );
        }

        $hours = (int) $matches[1];
        $minutes = (int) $matches[2];

        return $hours * 60 + $minutes;
    }

    /**
     * Convierte minutos totales a formato HH:MM
     * @param int $minutes Minutos totales
     * @return string Tiempo en formato "H:MM"
     * @throws InvalidArgumentException si los minutos son negativos
     */
    public function minutesToTime(int $minutes): string
    {
        if ($minutes < 0) {
            throw new InvalidArgumentException(
                "Los minutos no pueden ser negativos"
            );
        }

        $hours = floor($minutes / 60);
        $mins = $minutes % 60;

        return sprintf("%d:%02d", $hours, $mins);
    }
}

<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Controllers\BaseController;
use App\Modules\Admin\Models\CategoryModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;

class CategoryController extends BaseController
{

    private CategoryModel $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function createCategoryView()
    {
        // Logic to create a new category
        $data = [
            'categories' => $this->categoryModel->findAll(),
        ];

        return view('admin/pages/category', $data);
    }

    public function editCategoryView()
    {
        $data = [
            'categories'=> $this->categoryModel->findAll(),
        ];

        return view('admin/pages/edit-categories', $data);
    }

    public function save(): ResponseInterface
    {
        // Reglas de validación
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'cropped_image' => 'uploaded[cropped_image]|max_size[cropped_image,2048]|is_image[cropped_image]'
        ];

        if (! $this->validate($rules)) {
            return $this->response->setJSON(['status' => 'error', 'message' => $this->validator->getErrors()]);
        }

        // Procesa la imagen
        $imageFile = $this->request->getFile('cropped_image');
        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            // Genera un nombre aleatorio para la imagen
            $newName = $imageFile->getRandomName();
            // Mueve la imagen a la carpeta de destino
            $imageFile->move(FCPATH . 'assets/img/categories', $newName);

            // Prepara los datos para guardar en la base de datos
            $dataToSave = [
                'name'  => $this->request->getPost('name'),
                'slug'  => url_title($this->request->getPost('name'), '-', true),
                'image' => $newName
            ];
            
            // Usa tu modelo para guardar los datos
            if ($this->categoryModel->save($dataToSave)) {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Categoría guardada con éxito.']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'No se pudo guardar la categoría en la base de datos.']);
            }
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Ocurrió un error al procesar la imagen.']);
    }

}
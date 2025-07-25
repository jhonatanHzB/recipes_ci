<?php

namespace App\Cells;

use App\Modules\Front\Models\CategoryModel;
use App\Modules\Front\Models\TagModel;
use CodeIgniter\View\Cells\Cell;

class SearchModalCell extends Cell
{
    private CategoryModel $categoryModel;
    private TagModel $tagModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->tagModel = new TagModel();
    }

    public function render(): string
    {
        $data = [
            'categories' => $this->categoryModel->findAll(),
            'tags' => $this->tagModel->limit(10)->orderBy('count', 'DESC')->findAll(),
        ];

        return $this->view('../Views/front/components/modal/search', $data);
    }
}
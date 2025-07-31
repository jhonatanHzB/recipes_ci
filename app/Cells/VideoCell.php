<?php

namespace App\Cells;

use App\Modules\Front\Models\MediaModel;
use CodeIgniter\View\Cells\Cell;

class VideoCell extends Cell
{

    private MediaModel $mediaModel;

    public function __construct()
    {
        $this->mediaModel = new MediaModel();
    }

    public function render(): string
    {
        $data = [
          'videos' => $this->mediaModel->orderBy('position', 'ASC')->limit(3)->findAll()
        ];

        return $this->view('../Views/front/sections/video', $data);
    }

}
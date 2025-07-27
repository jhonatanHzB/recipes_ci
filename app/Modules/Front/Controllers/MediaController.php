<?php

namespace App\Modules\Front\Controllers;

use App\Modules\Front\Controllers\BaseController;
use App\Modules\Front\Models\MediaModel;

class MediaController extends BaseController
{

    private MediaModel $mediaModel;

    public function __construct()
    {
        $this->mediaModel = new MediaModel();
    }

    public function index(): string
    {
        $data = [
            'location' => 'Home',
            'page'     => 'Videos',
            'videos'   => json_encode($this->mediaModel->findAll()),
        ];

        return view('front/pages/media', $data);
    }
}

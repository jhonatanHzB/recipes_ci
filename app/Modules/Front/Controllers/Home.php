<?php
namespace App\Modules\Front\Controllers;

use App\Modules\Front\Controllers\BaseController;

class Home extends BaseController
{
    public function index(): string
    {
        return view('front/pages/index');
    }

    public function privacyNotice(): string
    {
        $data = [
            'location' => 'Home',
            'page'     => 'Aviso de privacidad',
        ];

        return view('front/pages/privacy-notice', $data);
    }
}
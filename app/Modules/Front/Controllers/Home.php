<?php
namespace App\Modules\Front\Controllers;

use App\Modules\Front\Controllers\BaseController;

class Home extends BaseController
{
    public function index(): string
    {
        return '<h1>¡Bienvenido al Frontend!</h1>';
    }
}
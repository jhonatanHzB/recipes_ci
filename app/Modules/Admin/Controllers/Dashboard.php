<?php
namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index(): string
    {
        return '<h1>¡Bienvenido al Panel de Administración!</h1>';
    }
}
<?php

namespace App\Modules\Front\Controllers;

use App\Modules\Front\Controllers\BaseController;
use App\Modules\Front\Models\ContactModel;
use CodeIgniter\HTTP\ResponseInterface;

class ContactController extends BaseController
{

    private ContactModel $contactModel;

    public function __construct()
    {
        $this->contactModel = new ContactModel();
    }

    public function index(): string
    {
        $data = [
            'location' => 'Home',
            'page'     => 'Contacto',
        ];

        return view('front/pages/contact', $data);
    }

    public function sendForm(): ResponseInterface
    {
        $input = $this->request->getJSON();

        $validation = \Config\Services::validation();

        $validation->setRules([
            'full_name' => 'required|min_length[3]',
            'email'     => 'required|valid_email',
            'message'   => 'required',
        ]);

        if (! $validation->run((array) $input)) {
            $errors = $validation->getErrors();
            $this->logger->error('Errores de validación: ' . json_encode($errors));

            return $this->response->setStatusCode(400)
                ->setJSON(['errors' => $errors]);
        }

        $data = [
            'full_name' => $input->full_name,
            'email'     => $input->email,
            'message'   => $input->message,
        ];

        if ($this->contactModel->save($data)) {
            $email = \Config\Services::email();

            $email->setFrom('jhonatanhzb@creativa-logic.com', 'Chef Ana Paula');
            $email->setTo('jhonatanhzb@gmail.com');

            $email->setSubject('Contacto Chef Ana Paula');
            $email->setMessage("Nombre: {$input->full_name}<br>Email: {$input->email}<br>Mensaje: {$input->message}");

            if ($email->send()) {
                $this->logger->info(
                    'Formulario enviado exitosamente y correo electrónico enviado' . json_encode($data)
                );

                return $this->response
                    ->setStatusCode(200)
                    ->setJSON(['message' => 'Hemos enviado tu mensaje, pronto nos pondremos en contacto contigo.']);
            }
            $this->logger->error('Formulario enviado pero correo electrónico no enviado');

            return $this->response
                ->setStatusCode(500)
                ->setJSON(
                    ['message' => 'Guardamos tus datos, pronto nos pondremos en contacto contigo.' . json_encode($data)]
                );
        }
        $this->logger->error('Error al guardar los datos' . json_encode($data));

        return $this->response
            ->setStatusCode(500)
            ->setJSON(['message' => 'Error al guardar los datos, intenta de nuevo más tarde.']);
    }

}
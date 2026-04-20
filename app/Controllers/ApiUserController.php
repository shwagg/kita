<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class ApiUserController extends ResourceController
{
    public function index()
    {
        $model = new UserModel();
        $users = $model->findAll();
        return $this->respond($users);
    }
}

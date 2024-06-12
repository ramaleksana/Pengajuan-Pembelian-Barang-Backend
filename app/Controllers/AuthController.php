<?php

namespace App\Controllers;

use App\Libraries\JWTCI4;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class AuthController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function login()
    {
        helper(['form']);
        $rules = [
            'username' => 'required',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $model = new UserModel();
        $user = $model->where("username", $this->request->getVar('username'))->first();

        if (!$user) {
            return $this->failNotFound('Username Not Found');
        }

        $verify = password_verify($this->request->getVar('password'), $user['password']);

        if (!$verify) {
            return $this->fail('Wrong Password');
        }

        $jwt = new JWTCI4();
        $token = $jwt->token($user['id'], $user['role']);
        $data = [
            'username' => $user['username'],
            'role'     => $user['role'],
            'token'    => $token,
        ];

        return $this->respond(['message' => 'Logged in successfully', 'data' => $data], 200);
    }

    public function logout()
    {
        return $this->respond(['message' => 'Logout success'], 200);
    }

    public function check()
    {
        return $this->respond(['message' => 'Login Active'], 200);
    }

    public function officer()
    {
        $data = $this->request->decoded;

        return $this->respond(['data' => $data]);
    }

    public function manager()
    {
        $data = $this->request->decoded;

        return $this->respond(['data' => $data]);
    }

    public function finance()
    {
        $data = $this->request->decoded;

        return $this->respond(['data' => $data]);
    }
}

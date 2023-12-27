<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Libraries\JWTCI4;
use App\Models\MUsersModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (!$this->validate([
            'email'     => 'required',
            'password'     => 'required|min_length[6]',
        ])) {
            return $this->response->setJSON(['success' => false, 'data' => null, "message" => \Config\Services::validation()->getErrors()]);
        }

        $db = new MUsersModel;
        $user  = $db->where('email', $this->request->getVar('email'))->first();
        if ($user) {
            if (password_verify($this->request->getVar('password'), $user['password'])) {
                $jwt = new JWTCI4;
                $userPayload = [
                    'email' => $user['email']
                ];
                $token = $jwt->token($userPayload);

                return $this->response->setJSON(['success' => true, 'message' => 'Success', 'token' => $token]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Invalid email and password combination'])->setStatusCode(409);
            }
        } else {

            return $this->response->setJSON(['success' => false, 'message' => 'User not found'])->setStatusCode(409);
        }
    }
}

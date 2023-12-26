<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\MUsersModel;
use CodeIgniter\API\ResponseTrait;

class UsersController extends BaseController
{

    use ResponseTrait;

    public function index()
    {
        $db = new MUsersModel();
        $users = $db->findAll();
        return $this->response->setJSON(['success' => true, 'message' => "Success", 'data' => $users]);
    }

    public function create()
    {
        if (!$this->validate([
            'email'     => 'required|is_unique[m_users.email]',
            'password'     => 'required|min_length[6]',
            'name'           => 'required',
            'address'    => 'required',
            'phone'        => 'required'
        ])) {
            return $this->response->setJSON(['success' => false, 'data' => null, "message" => \Config\Services::validation()->getErrors()]);
        }

        $insert = [
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'name' => $this->request->getVar('name'),
            'address' => $this->request->getVar('address'),
            'phone' => $this->request->getVar('phone'),
        ];

        $db = new MUsersModel;
        $save  = $db->insert($insert);

        return $this->setResponseFormat('json')->respondCreated(['sucess' => true, 'mesage' => 'Success']);
    }

    public function show($email)
    {
        $db = new MUsersModel();
        $user = $db->where('email', $email)->first();
        return $this->response->setJSON(['success' => true, 'message' => 'Success', 'data' => $user]);
    }

    public function update($email)
    {
        if (!$this->validate([
            'email' => 'permit_empty|is_unique[m_users.email]',
            'password' => 'permit_empty|min_length[6]',
            'name' => 'permit_empty',
            'address' => 'permit_empty',
            'phone' => 'permit_empty',
        ])) {
            return $this->response->setJSON(['success' => false, "message" => \Config\Services::validation()->getErrors()]);
        }

        $db = new MUsersModel;
        $exist = $db->where('email', $email)->first();

        if (!$exist) {
            return $this->response->setJSON(['success' => false, "message" => 'User not found']);
        }

        $update = [
            'email' => $this->request->getVar('email') ? $this->request->getVar('email') : $exist['email'],
            'password' => $this->request->getVar('password') ? password_hash($this->request->getVar('password'), PASSWORD_DEFAULT) : $exist['password'],
            'name' => $this->request->getVar('name') ? $this->request->getVar('name') : $exist['name'],
            'address' => $this->request->getVar('address')  ? $this->request->getVar('address') : $exist['address'],
            'phone' => $this->request->getVar('phone') ? $this->request->getVar('phone') : $exist['phone']
        ];

        // $db = new UsersModel;
        $save  = $db->update($email, $update);

        return $this->response->setJSON(['success' => true, 'message' => 'Success']);
    }

    public function delete($email)
    {
        $db = new MUsersModel;
        $db->where('email', $email);
        $db->delete();

        return $this->response->setJSON(['sucess' => true, 'mesage' => 'Success']);
    }
}

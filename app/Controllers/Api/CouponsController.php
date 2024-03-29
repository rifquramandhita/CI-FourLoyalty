<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Libraries\GlobalLibrary;
use App\Models\MCouponModel;
use CodeIgniter\API\ResponseTrait;

class CouponsController extends BaseController
{

    use ResponseTrait;

    public function index()
    {
        $globalLib = new GlobalLibrary;
        $email = $globalLib->getEmailFromJWT();

        $db = new MCouponModel;;
        $data = $db->select('m_coupons.*, (CASE WHEN A.user_email = \'' . $email . '\' THEN 1 ELSE 0 END) AS is_claimed')->join('(SELECT * FROM t_usercoupon WHERE user_email = \'' . $email . '\') A', 'A.coupon_id = m_coupons.id', 'left')->where('is_active', '1')->findAll();
        return $this->response->setJSON(['success' => true, 'message' => 'Success', 'data' => $data]);
    }

    public function create()
    {
        if (!$this->validate([
            'title'         => 'required',
            'description'   => 'required',
            'img_path'      => 'required',
            'is_active'     => 'required'
        ])) {
            return $this->response->setJSON(['success' => false, 'data' => null, "message" => \Config\Services::validation()->getErrors()]);
        }

        $insert = [
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'img_path' => $this->request->getVar('imgg_path'),
            'is_active' => $this->request->getVar('is_active'),
        ];

        $db = new MCouponModel;
        $save  = $db->insert($insert);

        return $this->setResponseFormat('json')->respondCreated(['sucess' => true, 'mesage' => 'Success']);
    }

    public function show($id)
    {
        $globalLib = new GlobalLibrary;
        $email = $globalLib->getEmailFromJWT();

        $db = new MCouponModel;;
        $data = $db->select('m_coupons.*, (CASE WHEN A.user_email = \'' . $email . '\' THEN 1 ELSE 0 END) AS is_claimed')->join('(SELECT * FROM t_usercoupon WHERE user_email = \'' . $email . '\') A', 'A.coupon_id = m_coupons.id', 'left')->where('is_active', '1')->where('m_coupons.id', $id)->find();
        return $this->response->setJSON(['success' => true, 'message' => 'Success', 'data' => $data]);
    }

    public function update($id)
    {
        if (!$this->validate([
            'title' => 'required',
            'description' => 'required',
            'img_path' => 'permit_empty',
            'is_active' => 'less_than[2]'
        ])) {
            return $this->response->setJSON(['success' => false, "message" => \Config\Services::validation()->getErrors()]);
        }

        $db = new MCouponModel;
        $exist = $db->where('id', $id)->first();

        if (!$exist) {
            return $this->response->setJSON(['success' => false, "message" => 'Coupon not found']);
        }

        $update = [
            'title' => $this->request->getVar('title') ? $this->request->getVar('title') : $exist['title'],
            'description' => $this->request->getVar('description') ? $this->request->getVar('description') : $exist['description'],
            'img_path' => $this->request->getVar('img_path') ? $this->request->getVar('img_path') : $exist['img_path'],
            'is_active' => $this->request->getVar('is_active') ? $this->request->getVar('is_active') : $exist['is_active'],

        ];

        // $db = new UsersModel;
        $save  = $db->update($id, $update);

        return $this->response->setJSON(['success' => true, 'message' => 'Success']);
    }

    public function delete($id)
    {
        $db = new MCouponModel;
        $db->where('id', $id);
        $db->delete();

        return $this->response->setJSON(['sucess' => true, 'mesage' => 'Success']);
    }
}

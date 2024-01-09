<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Libraries\GlobalLibrary;
use App\Models\MCouponModel;
use App\Models\MUsersModel;
use App\Models\TUserCouponModel;
use CodeIgniter\API\ResponseTrait;
use DateInterval;
use DateTime;

class UserCouponController extends BaseController
{

    use ResponseTrait;

    public function index()
    {
        $db = new TUserCouponModel;
        $data = $db->findAll();
        return $this->response->setJSON(['success' => true, 'message' => 'Success', 'data' => $data]);
    }

    public function create()
    {
        if (!$this->validate([
            'coupon_id'         => 'required',
        ])) {
            return $this->response->setJSON(['success' => false, 'data' => null, "message" => \Config\Services::validation()->getErrors()]);
        }
        $couponId = $this->request->getVar('coupon_id');
        $email = $this->request->getVar('user_email');
        if ($email == null) {
            $globalLib = new GlobalLibrary;
            $email = $globalLib->getEmailFromJWT();
        }

        $dbMUsers = new MUsersModel();
        $user = $dbMUsers->where('email', $email)->findColumn('point');
        $dbMCoupons = new MCouponModel();
        $coupon = $dbMCoupons->where('id', $couponId)->findColumn('fee');
        if ($user[0] < $coupon[0]) {
            return $this->response->setJSON(['success' => false, "message" => 'You don\'t have enough points to claim this coupon']);
        }

        $globalLib = new GlobalLibrary;
        $token = $globalLib->createTokenCoupon();

        $exp_at = new DateTime();
        $exp_at->add(new DateInterval('P15D'));

        $insert = [
            'coupon_id' => $couponId,
            'user_email' => $email,
            'token' => $token,
            'exp_at' => $exp_at->format('Y-m-d H:i:s'),
        ];

        $db = new TUserCouponModel;
        $save  = $db->insert($insert);

        $userNewData = [
            'email' => $email,
            'point' => $user[0] - $coupon[0],
        ];
        $dbMUsers->save($userNewData);

        return $this->setResponseFormat('json')->respondCreated(['success' => true, 'message' => 'Success']);
    }

    public function show($id)
    {
        $db = new TUserCouponModel;
        $user = $db->select('coupon_id, user_email, token, exp_at')->where('id', $id)->first();
        return $this->response->setJSON(['success' => true, 'message' => 'Success', 'data' => $user]);
    }

    public function update($id)
    {
        if (!$this->validate([
            'coupon_id'     => 'required',
            'user_email'    => 'required',
            'token'         => 'required',
            'exp_at'        => 'required',
        ])) {
            return $this->response->setJSON(['success' => false, "message" => \Config\Services::validation()->getErrors()]);
        }

        $db = new TUserCouponModel;
        $exist = $db->where('id', $id)->first();

        if (!$exist) {
            return $this->response->setJSON(['success' => false, "message" => 'Coupon not found']);
        }

        $update = [
            'coupon_id' => $this->request->getVar('coupon_id') ? $this->request->getVar('coupon_id') : $exist['coupon_id'],
            'user_email' => $this->request->getVar('user_email') ? $this->request->getVar('user_email') : $exist['user_email'],
            'token' => $this->request->getVar('token') ? $this->request->getVar('token') : $exist['token'],
            'exp_at' => $this->request->getVar('exp_at') ? $this->request->getVar('exp_at') : $exist['exp_at'],

        ];

        $save  = $db->update($id, $update);

        return $this->response->setJSON(['success' => true, 'message' => 'Success']);
    }

    public function delete($id)
    {
        $db = new TUserCouponModel;
        $db->where('id', $id);
        $db->delete();

        return $this->response->setJSON(['sucess' => true, 'mesage' => 'Success']);
    }

    public function getByUser($email = null)
    {
        if ($email == null) {
            $globalLib = new GlobalLibrary;
            $email = $globalLib->getEmailFromJWT();
        }

        $db = new TUserCouponModel();
        $data = $db->select('t_usercoupon.id, t_usercoupon.coupon_id, t_usercoupon.user_email, t_usercoupon.token, t_usercoupon.exp_at, m_coupons.title, m_coupons.description, m_coupons.img_path')->where('t_usercoupon.user_email', $email)->join('m_coupons', 't_usercoupon.coupon_id = m_coupons.id')->where('m_coupons.is_active', '1')->findAll();

        return $this->response->setJSON(['success' => true, 'message' => 'Success', 'data' => $data]);
    }
}

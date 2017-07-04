<?php

namespace App\Http\Controllers\API;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\RegisterRequest;
use Response;

/**
 * Class RegisterController
 * @package App\Http\Controllers\API
 */

class RegisterAPIController extends AppBaseController
{
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Validate User & Register User
     * POST /login
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(RegisterRequest $request)
    {
        $phone = $request->input('phone');
        $email = $request->input('email');
        $password = $request->input('password');

        if (!$phone && !$email) {
            return exception('请输入手机号码/邮箱');
        }

        if (!$password) {
            return exception('请输入密码');
        }

        if ($phone && $this->userRepository->getUserByPhone($phone)) {
            return exception('手机号码被注册');
        }

        if ($email && $this->userRepository->getUserByEmail($email)) {
            return exception('邮箱被注册');
        }

        $user = $this->userRepository->registerUser($phone, $email, $password);
        if (!$user) {
            return exception('注册失败');
        }
        access()->loginUsingId($user->id);

        return $this->sendResponse($user, '注册成功');
    }
}

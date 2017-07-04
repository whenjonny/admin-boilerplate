<?php

namespace App\Http\Controllers\API;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\LoginRequest;
use Response;

/**
 * Class LoginController
 * @package App\Http\Controllers\API
 */

class LoginAPIController extends AppBaseController
{
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Validate User & Login User
     * POST /login
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(LoginRequest $request)
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

        if ($phone) {
            $user = $this->userRepository->getUserByPhone($phone);
        }

        if ($email) {
            $user = $this->userRepository->getUserByEmail($email);
        }

        if(!$user) {
            return exception('账号/密码错误');
        }

        if ($this->userRepository->checkPassword($user, $password)) {
            access()->loginUsingId((int) $user->id);

            return $this->sendResponse($user, '登录成功');
        }

        return exception('账号/密码错误');
    }

    public function index()
    {
        return expire('hello');
        dd(access()->user());
        #echo 2;exit();
        echo access()->loginUsingId(5);
        echo 1;
        #echo 1;
    }
}

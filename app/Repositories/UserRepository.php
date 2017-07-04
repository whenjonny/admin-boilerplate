<?php

namespace App\Repositories;

use App\Models\Access\User\User;
use InfyOm\Generator\Common\BaseRepository as iBaseRepository;
use Illuminate\Support\Facades\DB;

class UserRepository extends iBaseRepository
{

    public function model()
    {
        return User::class;
    }

    public function getUserByPhone($phone)
    {
        return User::where('phone', $phone)->first();
    }

    public function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function checkPassword($user, $pwd) {
        return \Hash::check($pwd, $user->password);
    }

    public function registerUser($phone, $email, $pwd) {
        $fields = array(
            'name' => $phone ?: $email,
            'phone' => $phone ?: '',
            'email' => $email ?: '',
            'password' => \Hash::make($pwd)
        );

        $user = $this->model;
        foreach ($fields as $key => $val) {
            $user->$key = $val;
        }

        DB::beginTransaction();
        if ($user->save()) {
            DB::commit();
            return $user;
        }

        DB::rollBack();
        return FALSE;
    }

    public function editPassword($phone, $email, $pwd)
    {
        if ($phone) {
            $user = $this->getUserByPhone($phone);
        } elseif ($email) {
            $user = $this->getUserByEmail($email);
        }

        if (!$user) {
            return exception('该账号未注册');
        }

        $user->password = \Hash::make($pwd);
        return $user->save();
    }
}

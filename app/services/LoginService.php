<?php

namespace app\services;

use Valitron\Validator;
use app\models\User;

class LoginService
{
    /**
     * @param array $data
     * @return null
     * @throws \Exception
     */
    public function login(array $data)
    {
        if ($this->validate($data)) {
            $user = User::getByEmail($data['email'])[0];
            if ($user) {
               if (password_verify($data['password'], $user['password'])) {
                   $_SESSION['login'] = true;
                   $_SESSION['id'] = $user['id'];

                   return [
                       'id' => $user['id'],
                       'email' => $user['email']
                   ];
               } else {
                   throw new \Exception('Wrong password', 403);
               }
            } else {
                throw new \Exception('User not found', 403);
            }
        } else {
            throw new \Exception('Validation error', 403);
        }
    }

    /**
     * @return void
     */
    public function logout()
    {
        $_SESSION['login'] = false;
        $_SESSION['id'] = null;
    }

    public function isLogin()
    {
        $isLogin = (bool) $_SESSION['login'];
        if ($isLogin) $user = User::getById($_SESSION['id'])[0];

        return [
            'status' => $isLogin,
            'user' => $user
                ? ['id' => $user['id'], 'email' => $user['email']]
                : null
        ];
    }

    /**
     * @param array $data
     * @return bool
     */
    public function validate(array $data)
    {
        $v = new Validator($data);
        $v->rule('required', ['email', 'password']);
        $v->rule('email', 'email');
        $v->rule('min', ['password', 8]);

        return $v->validate();
    }
}
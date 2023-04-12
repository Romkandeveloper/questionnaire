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
                   session_start();
                   $_SESSION['login'] = true;
                   $_SESSION['id'] = $user['id'];
               } else {
                   throw new \Exception('Wrong password');
               }
            } else {
                throw new \Exception('User not found');
            }
        } else {
            throw new \Exception('Validation error', 403);
        }
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
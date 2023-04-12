<?php

namespace app\services;

use Valitron\Validator;

use app\models\User;

class RegisterService
{
    /**
     * @param array $data
     * @return null
     * @throws \Exception
     */
    public function register(array $data)
    {
        if ($this->validate($data)) {
            $user_id = User::create($data);
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['id'] = $user_id;
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
        $v->rule('required', ['email', 'password', 'password_confirmation']);
        $v->rule('equals', 'password', 'password_confirmation');
        $v->rule('email', 'email');
        $v->rule('min', ['password', 'password_confirmation', 8]);

        return $v->validate();
    }
}
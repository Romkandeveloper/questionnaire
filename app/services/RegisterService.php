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
            User::create($data);
            $user = User::getByEmail($data['email'])[0];
            $_SESSION['login'] = true;
            $_SESSION['id'] = $user['id'];

            return [
                'id' => $user['id'],
                'email' => $user['email']
            ];
        } else {
            throw new \Exception('Validation error', 422);
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

        if (! empty(User::getByEmail($data['email']))) {
            throw new \Exception('Email already exists', 422);
        }

        return $v->validate();
    }
}
<?php

namespace app\services;

use app\models\Questionnaire;
use Valitron\Validator;
use app\models\User;

class QuestionnairesService
{
    /**
     * @param array $data
     * @return null
     * @throws \Exception
     */
    public function store(array $data)
    {
        if ($this->validate($data)) {
            Questionnaire::create($data);
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
        $v->rule('required', ['question', 'answers', 'isPublish']);
        $v->rule('lengthMin', 'question', 1);
        $v->rule('array', 'answers');
        $v->rule('lengthMin', 'settings.*.value', 1);
        $v->rule('min', 'settings.*.votes', 0);
        $v->rule('boolean', 'isPublish');

        return $v->validate();
    }
}
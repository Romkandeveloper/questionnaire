<?php

namespace app\services;

use app\models\Questionnaire;
use Valitron\Validator;
use app\models\User;

class QuestionnairesService
{
//    /**
//     * @return array
//     */
//    public function getAll()
//    {
//        return $this->formatQuestionnaires(Questionnaire::getAll());
//    }

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

    public function getCustom()
    {
        return $this->formatQuestionnaires(Questionnaire::getByUserId($_SESSION['id']));
    }

//    public function destroy()
//    {
//        if ($_SESSION['id'] == Questionnaire::getById();) {
//            Questionnaire::create($data);
//        } else {
//            throw new \Exception('Validation error', 403);
//        }
//    }

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

    /**
     * @param array $items
     * @return array
     */
    public function formatQuestionnaires(array $items)
    {
        $res = [];

        foreach ($items as $item => $params) {
            if (! array_key_exists($params['questionnaire_id'], $res)) {
                $res[$params['questionnaire_id']] = [
                    'id' => $params['questionnaire_id'],
                    'question' => $params['question'],
                    'user_id' => $params['user_id'],
                    'is_publish' => $params['is_publish'],
                    'created_at' => $params['created_at'],
                    'answers' => [[
                        'value' => $params['value'],
                        'votes' => $params['votes']
                    ]]
                ];
            } else {
                $res[$params['questionnaire_id']]['answers'][] = [
                    'value' => $params['value'],
                    'votes' => $params['votes']
                ];
            }
        }

        return array_values($res);
    }
}
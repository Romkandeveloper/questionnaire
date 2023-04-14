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
            throw new \Exception('Validation error', 422);
        }
    }

    /**
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function getQuestionnaire($id) {
        if (isset($id)) {
            $questionnaire = Questionnaire::getById($id);
            if ($questionnaire[0]['user_id'] == $_SESSION['id']) {
                return $this->formatQuestionnaires($questionnaire)[0];
            } else {
                throw new \Exception('Forbidden', 403);
            }
        } else {
            throw new \Exception('Incorrect id value', 422);
        }
    }

    /**
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function updateQuestionnaire($id, array $data) {
        if (isset($id)) {
            $questionnaire = Questionnaire::getById($id);
            if ($questionnaire[0]['user_id'] == $_SESSION['id']) {
                if ($this->validate($data)) {
                    return Questionnaire::update($id, $data);
                }

            } else {
                throw new \Exception('Forbidden', 403);
            }
        } else {
            throw new \Exception('Incorrect id value', 423);
        }
    }

    public function getCustomQuestionnaires()
    {
        return $this->formatQuestionnaires(Questionnaire::getByUserId($_SESSION['id']));
    }

    public function destroy($id)
    {
        if (isset($id)) {
            $questionnaire = Questionnaire::getById($id);
            if ($questionnaire[0]['user_id'] == $_SESSION['id']) {
                return Questionnaire::destroy($id);
            } else {
                throw new \Exception('Forbidden', 403);
            }
        } else {
            throw new \Exception('Incorrect id value', 422);
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
        $v->rule('lengthMin', 'answers.*.value', 1);
        $v->rule('min', 'answers.*.votes', 0);
        $v->rule('integer', 'answers.*.id');
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
                        'votes' => $params['votes'],
                        'id' => $params['id']
                    ]]
                ];
            } else {
                $res[$params['questionnaire_id']]['answers'][] = [
                    'value' => $params['value'],
                    'votes' => $params['votes'],
                    'id' => $params['id']
                ];
            }
        }

        return array_values($res);
    }
}
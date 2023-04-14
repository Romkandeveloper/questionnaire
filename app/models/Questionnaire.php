<?php

namespace app\models;

use core\Model;
use lib\db;

class Questionnaire extends Model
{
    /**
     * @param array $data
     * @return void
     */
    static public function create(array $data)
    {
        //TODO make singleton db
        $db = new Db;

        $id = $db->query('INSERT INTO questionnaires (question, is_publish, user_id) VALUES (:question, :is_publish, :user_id)', [
            'question' => $data['question'],
            'is_publish' => (int) $data['isPublish'],
            'user_id' => (int) $_SESSION['id'],
        ], true);

        //TODO replace with multiple insert
        foreach ($data['answers'] as $answer => $params) {
            $db->query('INSERT INTO answers (value, votes, questionnaire_id) VALUES (:value, :votes, :questionnaire_id)', [
                'value' => $params['value'],
                'votes' => $params['votes'],
                'questionnaire_id' => $id
            ]);
        }
    }

    /**
     * @param int $user_id
     * @return array|false|string
     */
    static public function getByUserId(int $user_id)
    {
        $db = new Db;

        return $db->query(
            'SELECT * FROM questionnaires 
                 LEFT JOIN answers ON answers.questionnaire_id = questionnaires.id
                 WHERE user_id = :user_id',
            ['user_id' => $user_id]
        );
    }

    /**
     * @param int $id
     * @return array|false|string
     */
    static public function getById(int $id)
    {
        $db = new Db;

        return $db->query(
            'SELECT * FROM questionnaires 
                 LEFT JOIN answers ON answers.questionnaire_id = questionnaires.id
                 WHERE questionnaires.id = :id',
            ['id' => $id]
        );
    }

    /**
     * @param int $id
     * @return array|false|string
     */
    public static function destroy(int $id)
    {
        $db = new Db;

        return $db->query(
            'DELETE FROM questionnaires WHERE id = :id',
            ['id' => $id]
        );
    }

//    /**
//     * @return array|false|string
//     */
//    static public function getAll()
//    {
//        $db = new Db;
//
//        return $db->query(
//            'SELECT * FROM questionnaires
//                 LEFT JOIN answers ON answers.questionnaire_id = questionnaires.id
//                 WHERE questionnaires.is_publish = 1',
//        );
//    }
}
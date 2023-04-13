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
        $db = new Db;

        var_dump($data['isPublish']);

        $id = $db->query('INSERT INTO questionnaires (question, is_publish, user_id) VALUES (:question, :is_publish, :user_id)', [
            'question' => $data['question'],
            'is_publish' => (int) $data['isPublish'],
            'user_id' => (int) $_SESSION['id'],
        ], true);

        //TODO replace with multiple insert
        foreach ($data['answers'] as $answer => $params) {
            var_dump($params);
            $db->query('INSERT INTO answers (value, votes, questionnaire_id) VALUES (:value, :votes, :questionnaire_id)', [
                'value' => $params['value'],
                'votes' => $params['votes'],
                'questionnaire_id' => $id
            ]);
        }
    }

//    static public function getByUserId(int $id)
//    {
//        $db = new Db;
//
//        return $db->query('SELECT * FROM users WHERE email = :email', ['email' => $email]);
//    }

//    static public function getAll()
//    {
//        $db = new Db;
//
//        return $db->query('SELECT * FROM users WHERE email = :email', ['email' => $email]);
//    }
}
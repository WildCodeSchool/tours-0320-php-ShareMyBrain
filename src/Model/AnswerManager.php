<?php

namespace App\Model;

class AnswerManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'answer';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectAnswerByQuestion(int $id)
    {
        //prepared request
        $statement = $this->pdo->prepare("SELECT question.content,answer.content,answer.date,username
        FROM answer
        JOIN question ON question.id=answer.id_question
        JOIN user ON user.id=question.id_user
        WHERE question.id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}

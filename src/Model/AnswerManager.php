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

    public function addAnswer(array $answer):int
    {
        $sql = "INSERT INTO " . self::TABLE . " (`content`,`id_user`,`id_question`,date)
        VALUES (:content,:id_user,:id_question,:date)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue('content', $answer['content'], \PDO::PARAM_STR);
        $statement->bindValue('id_user', $answer['id_user'], \PDO::PARAM_INT);
        $statement->bindValue('id_question', $answer['id_question'], \PDO::PARAM_INT);
        $statement->bindValue('date', $answer['date'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }
}

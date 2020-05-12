<?php

namespace App\Model;

class QuestionManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'question';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $question
     * @return int
     */
    public function addQuestion(array $question):int
    {

        $sql= "INSERT INTO " . self::TABLE . " (`content`,`id_theme`,`id_user`,`date`)
        VALUES (:content,:id_theme,:id_user,:date)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue('content', $question['content'], \PDO::PARAM_STR);
        $statement->bindValue('id_theme', $question['id_theme'], \PDO::PARAM_INT);
        $statement->bindValue('id_user', $question['id_user'], \PDO::PARAM_INT);
        $statement->bindValue('date', $question['date'], \PDO::PARAM_STR);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }

    public function selectAllByTheme(int $id)
    {
        //prepared request
        $statement = $this->pdo->prepare("SELECT question.id,name, username,content,date
        FROM question
        JOIN theme ON theme.id=question.id_theme 
        JOIN user ON user.id=question.id_user
        WHERE theme.id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}

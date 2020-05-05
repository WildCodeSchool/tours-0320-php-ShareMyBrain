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
     * @param int $id
     */
    public function selectAllByTheme(int $id)
    {
        //prepared request
        $statement = $this->pdo->prepare("SELECT question.id,name, username,content
        FROM `$this->table`
        JOIN theme ON theme.id=question.id_theme 
        JOIN user ON user.id=question.id_user
        WHERE theme.id=:id");

        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}

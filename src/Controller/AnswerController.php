<?php

namespace App\Controller;

use App\Model\AnswerManager;
use App\Model\QuestionManager;

/**
 * Class AnswerController
 *
 */
class AnswerController extends AbstractController
{

    /**
     * Display answer listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $answerManager = new AnswerManager();
        $answers = $answerManager->selectAll();

        return $this->twig->render('Answer/index.html.twig', ['answers' => $answers]);
    }

    /**
     * Display answer informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $answerManager = new AnswerManager();
        $answer = $answerManager->selectAnswerByQuestion($id);

        $questionManager = new QuestionManager();
        $question = $questionManager->selectOneById($id);

        return $this->twig->render('Answer/show.html.twig', [
            'answers' => $answer,
            'question' => $question]);
    }

    /**
     * Display answer creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add(int $answer)
    {
        $questionManager = new QuestionManager();
        $question = $questionManager->selectOneById($answer);
        $id = $answer;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['content']) && !empty($_POST['id_question'])
                && !empty($_POST['id_user']) && !empty($_POST['date'])) {
                $answerManager = new AnswerManager();
                $answer = [
                    'content' => $_POST['content'],
                    'id_question' => $_POST['id_question'],
                    'id_user' => $_POST['id_user'],
                    'date' => $_POST['date']
                ];

                $answerManager->addAnswer($answer);
                header('Location:/answer/show/'. $id);
            }
        }

        return $this->twig->render('Answer/add.html.twig', [
            'answer' => $answer,
            'question'=> $question]);
    }
}

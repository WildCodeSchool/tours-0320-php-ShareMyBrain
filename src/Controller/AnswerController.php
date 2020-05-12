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
}

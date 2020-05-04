<?php

namespace App\Controller;

use App\Model\QuestionManager;

/**
 * Class QuestionController
 *
 */
class QuestionController extends AbstractController
{
    /**
     * Display question listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $questionManager = new QuestionManager();
        $questions = $questionManager->selectAll();
        return $this->twig->render('Question/index.html.twig', ['questions' => $questions]);
    }
}

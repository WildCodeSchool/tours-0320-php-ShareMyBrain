<?php

namespace App\Controller;

use App\Model\QuestionManager;
use App\Model\ThemeManager;

/**
 * Class QuestionController
 *
 */
class QuestionController extends AbstractController
{
    // A creation page where your can show all questions.
    public function index()
    {
        $questionManager = new QuestionManager();
        $questions = $questionManager->selectAll();
        return $this->twig->render('Question/index.html.twig', ['questions' => $questions]);
    }

    // A creation page where your can add a new question.
    public function add()  : string
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $questionManager = new QuestionManager();
            $question = [
                'content' => $_POST['content'],
                'id_theme' => $_POST['id_theme'],
                'id_user' => $_POST['id_user'],
            ];
            $questionManager->addQuestion($question);
            /* TODO : ICI AJOUTER REDIRECTION */
        }

        $themeManager = new ThemeManager();
        $theme= $themeManager->selectAll();
        return $this->twig->render('Question/add.html.twig', ['themes' => $theme]);
    }

}



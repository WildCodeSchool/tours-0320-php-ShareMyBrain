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

    /**
     * Display question creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['content']) && !empty($_POST['id_theme'])
                && !empty($_POST['id_user']) && !empty($_POST['date'])) {
                $questionManager = new QuestionManager();
                $question = [
                    'content' => $_POST['content'],
                    'id_theme' => $_POST['id_theme'],
                    'id_user' => $_POST['id_user'],
                    'date' => $_POST['date']
                ];
                $questionManager->addQuestion($question);
                header('Location:/Question/add');
            }
        }

        $themeManager = new ThemeManager();
        $theme = $themeManager->selectAll();

        return $this->twig->render('Question/add.html.twig', ['themes' => $theme]);
    }
}

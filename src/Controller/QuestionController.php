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
    public function add()  : string
    {
        $errors = [];
        $question = [];
        $content = '';
        $idTheme = '';
        $idUser = '';
        $date = '';

        if (!empty($_POST)) {
            $content = trim($_POST['content']);
            $idTheme= trim($_POST['id_theme']);
            $idUser = trim($_POST['id_user']);
            $date = trim($_POST['date']);

            $question = [
                'content' => $_POST['content'],
                'id_theme' => $_POST['id_theme'],
                'id_user' => $_POST['id_user'],
                'date' => $_POST['date']
            ];

            if (empty($content)) {
                $errors['content'] = 'Le champ est requis';
            }

            if (empty($idTheme)) {
                $errors['id_theme'] = 'Le champ est requis';
            }

            if (empty($idUser)) {
                $errors['id_user'] = 'Le champ est requis';
            }

            if (empty($date)) {
                $errors['date'] = 'Le champ est requis';
            }

            if (empty($errors)) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $questionManager = new QuestionManager();
                    $questionManager->addQuestion($question);
                    header('Location:/theme/index');
                }
            }
        }

        $themeManager = new ThemeManager();
        $theme= $themeManager->selectAll();

        return $this->twig->render('Question/add.html.twig', [
            'themes' => $theme,
            'errors' => $errors]);
    }
}

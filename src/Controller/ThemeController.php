<?php

namespace App\Controller;

use App\Model\ThemeManager;
use App\Model\QuestionManager;

/**
 * Class ThemeController
 *
 */
class ThemeController extends AbstractController
{

    /**
     * Display theme listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $themeManager = new ThemeManager();
        $themes = $themeManager->selectAll();

        return $this->twig->render('Theme/index.html.twig', ['themes' => $themes]);
    }

    // A creation page where your can show all question by theme.
    public function show(int $id)
    {
        $questionManager = new QuestionManager();
        $questions = $questionManager->selectAllByTheme($id);

        $themeManager = new ThemeManager();
        $theme = $themeManager->selectOneById($id);

        return $this->twig->render('Theme/show.html.twig', [
            'questions' => $questions,
            'theme' => $theme ]);
    }
}

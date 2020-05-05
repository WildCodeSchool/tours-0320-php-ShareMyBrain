<?php

namespace App\Controller;

use App\Model\ThemeManager;

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
}

<?php

use App\Controller\AbstractController;
use App\Model\Manager\ArticleManager;

class HomeController extends AbstractController
{
    /**
     * redirected to homepage
     */
    public function index()
    {
        $data = [];
        $articles = ArticleManager::findAll(6);
        foreach ($articles as $article) {
            $data[] = ['article' => $article];
        }
        $this->render('home/index', $data);
    }
}
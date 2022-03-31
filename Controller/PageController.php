<?php

use App\Controller\AbstractController;
use App\Model\Manager\ArticleManager;

class PageController extends AbstractController
{

    public function index()
    {
        $data = [];
        $articles = ArticleManager::findAll();

        var_dump($articles);
        foreach ($articles as $article) {
            $data[] = ['article' => $article];
        }
        $this->render('pages/adopt', $data);
    }

    public function piercing()
    {
      $this->render('pages/piercing');
    }

    public function achievements()
    {
        $data = [];
        $articles = ArticleManager::findAll();
        foreach ($articles as $article) {
            $data[] = ['article' => $article];
        }
        $this->render('pages/achievements', $data);
    }

    public function admin()
    {
        $this->render('admin/conn');
    }

    public function amt()
    {
        $data = [];
        $articles = ArticleManager::findAll();
        var_dump($articles);
        foreach ($articles as $article) {

            $data[] = ['article' => $article];
        }
        $this->render('pages/amt', $data);
    }
}
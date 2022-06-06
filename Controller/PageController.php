<?php

use App\Controller\AbstractController;
use App\Model\Manager\ArticleManager;
use App\Model\Manager\InfoManager;

class PageController extends AbstractController
{

    public function index()
    {
    }

    public function adopt($id) {
        $data = [];
        $articles = ArticleManager::articleCategory($id);

        foreach ($articles as $article) {
            $data[] = ['article' => $article];
        }
        $this->render('pages/adopt', $data);
    }

    public function piercing()
    {
      $this->render('pages/piercing');
    }

    public function achievements($id)
    {
        $data = [];
        $articles = ArticleManager::articleCategory($id);
        foreach ($articles as $article) {
            $data[] = ['article' => $article];
        }
        $this->render('pages/achievements', $data);
    }

    public function admin()
    {
        $this->render('admin/conn');
    }

    public function amt($id)
    {
        $data = [];
        $articles = ArticleManager::articleCategory($id);
        foreach ($articles as $article) {

            $data[] = ['article' => $article];
        }
        $this->render('pages/amt', $data);
    }

    public function info($id)
    {
        $this->render('admin/info');
    }
}
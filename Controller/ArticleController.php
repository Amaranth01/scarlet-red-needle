<?php

use App\Controller\AbstractController;
use App\Model\Entity\Article;
use App\Model\Manager\ArticleManager;

class ArticleController extends AbstractController
{
    public function index()
    {
        $this->render('admin/add-article');
    }

    public function listAllArticles()
    {

    }

    public function addArticle()
    {
        //Put an element in json format
        $addArt = file_get_contents('php://input');
        $addArt = json_decode($addArt);

        //Throws an error if the parameters are empty
        if (empty($addArt->title) || empty($addArt->content)) {
            http_response_code(400);
            exit();
        }

        //clean data
        $title = $this->clean($addArt->title);
        $content = $this->clean($addArt->content);

        $user = self::getConnectedUser();
        $article = new Article();
        $article->setTitle($title);
        $article->setContent($content);
        $article->setAuthor($user);

        if (ArticleManager::addNewArticle($article)) {
            // Si on le souhaite, on peut renvoyer l'article avec son ID (souvenez vous qu'on lui donne son id après enregistrement)
            echo json_encode([
                'id' => $article->getId(),
                'title' => $article->getTitle(),
                'content' => $article->getContent(),
                'author' => $article->getAuthor()->getUsername(),
            ]);
            http_response_code(200);
            exit;
        }

        http_response_code(200);
        exit;
    }

}
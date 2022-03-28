<?php

use App\Controller\AbstractController;
use App\Model\Entity\Article;
use App\Model\Entity\Category;
use App\Model\Manager\ArticleManager;
use App\Model\Manager\CategoryManager;

class ArticleController extends AbstractController
{
    public function index()
    {
        $this->render('admin/article', [
            'list-article' => ArticleManager::findAll()
        ]);
    }

    public function addPage()
    {
        $this->render('admin/add-article');
    }

    public function listArticle()
    {
        $this->render('admin/list-article');
    }

    public function editArticle()
    {
        $this->render('admin/edit-article');
    }

    /**
     * Encodes article content, secures image data
     */
    public function addArticle()
    {

        //clean data
        $title = $this->clean($this->getFormField('title'));
        $content = $this->clean($this->getFormField('content'));

        $user = self::getConnectedUser();
        $article = new Article();
        $category = CategoryManager::getCategoryByName($_POST['category']);

        $article->setTitle($title);
        $article->setContent($content);
        $article->setImage(self::addImage());
        $article->setAuthor($user);
        $article->setCategory($category);

        ArticleManager::addNewArticle($article);

        $this->render('admin/space-admin');
    }

    public function addImage()
    {
        $error = [];
        if(isset($_FILES['fichierUtilisateur']) && $_FILES['fichierUtilisateur'] ['error'] === 0){

            $allowedMimeTypes = ['image/jpg', 'image/jpeg', 'image/png'];
            if(in_array($_FILES['fichierUtilisateur'] ['type'], $allowedMimeTypes)) {

                $maxSize = 1024 * 1024;
                if ((int)$_FILES['fichierUtilisateur']['size']<=$maxSize) {
                    $tmp_name = $_FILES['fichierUtilisateur'] ['tmp_name'];
                    $name = $this->getRandomName($_FILES['fichierUtilisateur'] ['name']);

                    if(!is_dir('uploads')){
                        mkdir('uploads', '0755');
                    }
                    move_uploaded_file($tmp_name, $name);
                }
                else {
                    $error[] =  "Le poids est trop lourd, maximum autorisé : 1 Mo";
                }
            }
            else {
                $error[] = "Mauvais type de fichier. Seul les formats JPD, JPEG et PNG sont acceptés";
            }
        }
        else {
            $error[] = "Une erreur s'est produite";
        }
    }

    /**
     * @param String $rName
     * @return string
     */
    public function getRandomName(String $rName): string
    {
        $infos = pathinfo($rName);
        try {
            $bytes = random_bytes(15);
        }
        catch (Exception $e) {
            $bytes = openssl_random_pseudo_bytes(15);
        }
        return bin2hex($bytes) . '.' . $infos['extension'];
    }

    public function deleteArticle(int $id)
    {
        if(ArticleManager::articleExist($id)) {
            $deleted = ArticleManager::deleteArticle($id);
            $this->render('admin/space-admin');
        }
    }

    public function updateArticle($id)
    {
        //We check that the input fields are complete
        if (!isset($_POST['title']) || !isset($_POST['content'])) {
            $this->render('home/index');
            exit();
        }

        $newTitle = $this->clean($_POST['title']);
        $newContent = $this->clean($_POST['content']);

        $article= new ArticleManager();
        if ($_SESSION['user']->getId() !== $article->articleExist($id)->getUser()->getId()) {
            $this->render('home/index');
            exit();
        }
        $article->updateArticle($newTitle, $newContent, $id);
    }
}
<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\Article;
use App\Model\Manager\UserManager;
use DateTime;

class ArticleManager
{
    /**
     *Returns the list of articles and create an article
     * @return array
     */
    public static function findAll(): array
    {
        $articles = [];
        $query = DB::getPDO()->query("SELECT * FROM article");
        if($query) {
            $userManager = new UserManager();

            foreach($query->fetchAll() as $articleData) {
                $articles[] = (new Article())
                    ->setId($articleData['id'])
                    ->setAuthor($userManager->getUser($articleData['user_id']))
                    ->setContent($articleData['content'])
                    ->setTitle($articleData['title'])
                ;
            }
        }

        return $articles;
    }

    /**
     * Add a new article into the db.
     * @param Article $article
     * @return void
     */
    public static function addNewArticle(Article &$article): bool
    {
        $stmt = DB::getPDO()->prepare("
            INSERT INTO article (title, content, image, user_id, category_id) 
            VALUES (:title, :content, :image ,:user_id, :category_id)
        ");

        $stmt->bindValue('title', $article->getTitle());
        $stmt->bindValue('content', $article->getContent());
        $stmt->bindValue('image', $article->getImage());
        $stmt->bindValue('user_id', $article->getAuthor()->getId());
        $stmt->bindValue('category_id', $article->getCategory()->getId());

        $result = $stmt->execute();
        $article->setId(DB::getPDO()->lastInsertId());
        return $result;
    }

    /**
     * @param $id
     * @return int|mixed
     */
    public static function articleExist($id)
        {
        $result = DB::getPDO()->query("SELECT count(*) FROM article WHERE id = '$id'");
        return $result ? $result->fetch(): 0;
    }

    /**
     * @param $id
     * @return int|mixed|null
     */
    public static function getArticle($id)
    {
        $result = DB::getPDO()->query("SELECT * FROM article WHERE id = '$id'");
        return  $result ? self::articleExist($result) : null;
    }

    /**
     * @param $id
     * @return false|int
     */
    public static function deleteArticle($id)
    {
        if (self::articleExist($id)) {
            return DB::getPDO()->exec(
                "DELETE FROM article WHERE id = '$id'
            ");
        }
        return false;
    }

    public static function updateArticle()
    {
        $stmt = DB::getPDO()->prepare("UPDATE article 
        SET content = :newContent, title = :newTitle WHERE id = :id");

        $stmt->bindParam('newTitle', $newTitle);
        $stmt->bindParam('newContent', $newContent);
        $stmt->bindParam('id', $id);

        $stmt->execute();
    }
}
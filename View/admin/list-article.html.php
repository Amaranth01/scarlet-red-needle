<?php

if (!UserController::adminConnected() || !UserController::userConnected()) {
    $this->render('home/index');
    exit();
}

?>

<h1 class="title">Modération des articles</h1>

<div class="back-menu">
    <a href="/index.php?c=admin&a=space-admin">Retour à l'espace d'administration</a>
</div>

<table>
    <tbody>
    <?php

    use App\Model\Entity\Article;
    use App\Model\Manager\ArticleManager;

    foreach ($data['article'] as $article) { ?>

            <tr class="listArticleTitle">
                <td>Titre</td>
                <td><?= $article->getTitle()?></td>
            </tr>
        <tr>
            <td>Image</td>
            <td><img src="/asset/uploads/<?= $article->getImage()?>" alt="image" class="imgArticle"></td>
        </tr>
        <tr>
            <td>Modération</td>
            <td> <a href="/index.php?c=article&a=delete-article&id=<?= $article->getId() ?>">Supprimer</a></td>
        </tr>
        <tr>
            <td>Editer un article</td>
            <td><a href="/index.php?c=article&a=edit-article&id=<?= $article->getId() ?>">Editer un article</a></td>
            <?php
        }?>
    </tbody>
</table>
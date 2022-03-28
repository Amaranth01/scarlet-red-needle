<h1 class="title">Modération des articles</h1>

<div class="back-menu">
    <a href="/index.php?c=admin&a=space-admin">Retour à l'espace d'administration</a>
</div>

<div class="title">Editer un article</div>

<div class="title">Supprimer un article</div>

<table>
    <tbody>
    <?php

    use App\Model\Entity\Article;
    use App\Model\Manager\ArticleManager;

    foreach (ArticleManager::findAll()as $article) {
            ?>

            <tr>
                <td>Titre</td>
                <td><?= $article->getTitle() ?></td>
            </tr>
        <tr>
            <td>Contenu</td>
            <td><?= $article->getContent() ?></td>
        </tr>
        <tr>
            <td>Modération</td>
            <td> <a href="/index.php?c=article&a=delete-article&id=<?= $article->getId() ?>">Supprimer</a></td>
        </tr>
        <tr>
            <td>Editer un article</td>
            <td><a href="/index.php?c=article&a=edit-article&id=">Editer un article</a></td>
        </tr>
    <?php
        }
    ?>
    </tbody>
</table>
<?php

use App\Model\Manager\ArticleManager;

if (!UserController::adminConnected() || !UserController::userConnected()) {
    $this->render('home/index');
    exit();
}

?>
    <h1 class="title">Edition d'articles</h1>

<form action="/index.php?c=article&a=update-article&id=<?=ArticleManager::getArticle($data[0])->getId() ?>" method="post" id="form">

    <label for="title">Mise à jour du titre</label>
    <input type="text" name="title" value="<?= ArticleManager::getArticle($data[0])->getTitle() ?>" id="title">

    <label for="content">Mise à jour de l'article</label>
    <textarea name="content" id="content" cols="30" rows="20"><?= ArticleManager::getArticle($data[0])->getContent() ?></textarea>

    <input type="submit" name="submit">
</form>
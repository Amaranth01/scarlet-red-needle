<h2 class="title">Les dernières nouvelles</h2>
<?php

use App\Model\Entity\Article;
use App\Model\Manager\ArticleManager;

foreach (ArticleManager::findAll() as $article) {
    ?>

    <div id="content">
        <div class="article">
            <p class="artTitle"><?= $article->getTitle()?></p>
            <br>
            <p><?=$article->getContent() ?></p>

        </div>
        <br> <br>
    </div>

    <?php
}
?>
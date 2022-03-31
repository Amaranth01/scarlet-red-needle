<h2 class="title">Les dernières nouvelles</h2>
<?php

use App\Model\Entity\Article;
use App\Model\Manager\ArticleManager;
echo "<pre> <br>";
var_dump($data[1]);
echo "</pre> <br>";
foreach ($data as $article) {
    ?>

    <div id="content">
        <div class="article">
            <p class="artTitle"><?= $article['article']->getTitle()?></p>
            <br>
            <img src="/asset/uploads/<?= $article['article']->getImage()?>" alt="coucou">
            <br>
            <p><?=$article['article']->getContent() ?></p>

        </div>
        <br> <br>
    </div>

    <?php
}

?>
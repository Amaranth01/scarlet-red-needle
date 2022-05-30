<h2 class="title">Les dernières nouvelles</h2>

    <div id="actu">
        <h3>L'actu du shop</h3>
            <p id="shop-actu">

            </p>
    </div>

<?php

foreach ($data as $article) {
    ?>

    <div id="content">
        <p class="artTitle"><?= $article['article']->getTitle()?></p>
        <div class="article">

            <div>
                <p class="img"><img src="/asset/uploads/<?= $article['article']->getImage()?>" alt=""></p>
            </div>
            <p class="textContent"><?=$article['article']->getContent() ?></p>
        </div>
    </div>

    <?php
}
?>
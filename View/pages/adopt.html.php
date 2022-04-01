<h2 class="title">Tatouages disponibles</h2>

<?php

foreach ($data as $article) {
    ?>

    <div id="contentBig">
        <div class="article">
            <p class="artTitle"><?= $article['article']->getTitle()?></p>
            <div>
                <p class="imgContent"><img src="/asset/uploads/<?= $article['article']->getImage()?>"  alt=""></p>
            </div>
            <p class="textContent"><?=$article['article']->getContent() ?></p>
        </div>
    </div>

    <?php
}
?>
<h2 class="title">Mes créations</h2>

<?php
foreach ($data as $article) {

    ?>

    <div id="content">
        <p class="artTitle"><?= $article['article']->getTitle()?></p>
        <div class="article">
            
            <div>
                <p class="img"><img src="/asset/uploads/<?= $article['article']->getImage()?>"  alt=""></p>
            </div>
            <p><?=$article['article']->getContent() ?></p>
        </div>
    </div>

    <?php
}
?>
<?php

use App\Model\Manager\InfoManager; ?>

<div id="actu">
   <h2 class="title">L'actu du shop</h2>

        <div id="shop-actu">
            <?=InfoManager::getInfo(1)->getContent()?>
        </div>
</div>

    <h2 class="title">Les derniers tatous et disponibilités</h2>
<?php

foreach ($data as $article) {
    ?>

    <div id="content">
        <p class="artTitle"><?= $article['article']->getTitle()?></p>
        <div class="article">

            <div>
                <p class="img"><img src="/asset/uploads/<?= $article['article']->getImage()?>" alt="image tatous" class="imgIndex"></p>
            </div>
            <p class="textContent"><?=$article['article']->getContent() ?></p>
        </div>
    </div>

    <?php
}
?>
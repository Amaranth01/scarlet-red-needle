<div id="actu">
   <h2 class="title">L'actu du shop</h2>
        <p id="shop-actu">
            Cécile et Julien vous accueillent le Mardi, Jeudi, Vendredi et Samedi de 10H - 18H et le lundi sur RDV avec Julien
            à la boutique Art Mania Tatoo
        </p>
</div>

    <h2 class="title">Les derniers tatous et disponibilités</h2>
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
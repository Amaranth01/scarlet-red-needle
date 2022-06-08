<?php

use App\Model\Manager\InfoManager;

if (!UserController::adminConnected() || !UserController::userConnected()) {
    $this->render('home/index');
    exit();
}

?>

<h2 class="title">Espace Administrateur</h2>

<div id="menu">
    <ul>
        <li><a href="/index.php?c=article&a=index">Gérer un article</a></li>
        <?php
            if(UserController::adminConnected()) {?>
                <li id="under"><a href="/index.php?c=admin&a=user-list">Gestion des utilisateurs</a></li><?php
            } ?>

        <li><a href="/index.php?c=page&a=info&id=<?=InfoManager::getInfo(1)->getId()?>">Message d'accueil</a></li>
    </ul>
</div>
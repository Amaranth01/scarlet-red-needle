<?php

use App\Model\Manager\InfoManager;

if (!UserController::adminConnected() || !UserController::userConnected()) {
    $this->render('home/index');
    exit();
}

?>

<h1 class="title"> Modifier le message d'information</h1>

<form action="/index.php?c=info&a=edit-info&id=<?=InfoManager::getInfo(1)->getId() ?>" method="post" id="formInfo">
    <label for="content">Editer le message d'info</label>
    <textarea name="content" id="content" cols="60" rows="20" required class="textInfo"><?=InfoManager::getInfo(1)->getContent()?></textarea>
    <br>
    <input type="submit" name="submit" class="button" value="Modifier">
</form>
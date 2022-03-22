<h2 class="title">Ajouter un article ou une nouvelle</h2>

<div class="back-menu">
    <a href="/index.php?c=admin&a=space-admin">Retour à l'espace d'administration</a>
</div>

<form action="/index.php?c=article&a=add-article" method="post" id="form">
    <label for="title">Titre</label>
    <input type="text" name="title" id="title">

    <textarea name="content" id="content" cols="30" rows="20"></textarea>

    <input type="submit" id="submit" name="save">
</form>
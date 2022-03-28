<h1 class="title">Edition d'articles</h1>

<form action="/index.php?c=article&a=edit-article&id=" method="post" id="form">

    <label for="title">Mise à jour du titre</label>
    <input type="text" name="title" value="" id="title">

    <label for="content">Mise à jour de l'article</label>
    <textarea name="content" id="content" cols="30" rows="20"></textarea>

    <input type="submit" name="submit">
</form>
<h2 class="title">Ajouter un article</h2>

<div class="back-menu">
    <a href="/index.php?c=admin&a=space-admin">Retour à l'espace d'administration</a>
</div>

<form action="/index.php?c=article&a=add-article" method="post" id="form" enctype="multipart/form-data">

    <label for="category">Choisir la catégorie dans laquelle va l'article</label>
    <select name="category" id="category">
        <option value="null"></option>
        <option value="tatoo_adopt">À adopter</option>
        <option value="tatoo_create">Réalisés</option>
        <option value="art_mania">Art Mania tattoo</option>
    </select>

    <label for="title">Titre</label>
    <input type="text" name="title" id="title">

    <label for="fichier">Insérer une image au format JPG, JPEG ou PNG</label>
    <input type="file" name="img" id="fichier" accept=".jpg, .jpeg, .png">&nbsp;(Max 1Mo)

    <textarea name="content" id="content" cols="30" rows="20" placeholder="Contenu facultatif"></textarea>

    <input type="submit" id="submit" name="save">
</form>
<h2 class="title">Gestion des utilisateurs</h2>

<h3 class="title">La liste des utilisateurs</h3>

<table>
    <tbody> <?php

    use App\Model\Entity\User;
    use App\Model\Manager\UserManager;

    foreach(UserManager::getAll() as $user) {
        /* @var User $user  */?>
        <tr>
            <td>ID</td>
            <td><?= $user->getId() ?></td>
        </tr>
        <tr>
            <td><?= $user->getUsername() ?></td>
            <td>Pseudo</td>
        </tr>
        <tr>
            <td>email</td>
            <td><?= $user->getEmail() ?></td>
        </tr>
        <tr>
            <td>Modération</td>
            <td>
                <a href="/index.php?c=user&a=delete-user&id=<?= $user->getId() ?>">Supprimer</a>
            </td>
        </tr>

        </tr> <?php
    } ?>
    </tbody>
</table>

<h3 class="title">Ajouter un utilisateur</h3>

<form action="/index.php?c=user&a=register" method="post" id="form">
        <label for="email">Email</label>
        <input type="text" name="email" id="email">

        <label for="username">Nom ou pseudo</label>
        <input type="text" name="username" id="username">

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">

        <label for="password-repeat">Password repeat</label>
        <input type="password" name="password-repeat" id="password-repeat">

        <input type="submit" value="Ajouter l'utilisateur" name="save">
</form>
<div class="container mt-4">
    <h2 class="text-center mb-4">Modifier Utilisateur</h2>
    <form action="index.php?action=modifierUtilisateurC&id_utilisateur=<?= htmlspecialchars($utilisateur->getIdUtilisateur()); ?>" method="post" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($utilisateur->getNom()); ?>" required>
            <div class="invalid-feedback">Veuillez entrer un nom.</div>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($utilisateur->getPrenom()); ?>" required>
            <div class="invalid-feedback">Veuillez entrer un prénom.</div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($utilisateur->getEmail()); ?>" required>
            <div class="invalid-feedback">Veuillez entrer une adresse email valide.</div>
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone :</label>
            <input type="text" class="form-control" id="telephone" name="telephone" value="<?= htmlspecialchars($utilisateur->getTelephone()); ?>" required>
            <div class="invalid-feedback">Veuillez entrer un numéro de téléphone.</div>
        </div>

        <div class="mb-3">
            <label for="adresse" class="form-label">adresse</label>
            <input type="adresse" class="form-control" id="adresse" name="adresse"  value="<?= htmlspecialchars($utilisateur->getAdresse()); ?>">
        </div>
        <?php        if (isset($_SESSION['utilisateur']) &&  $_SESSION['utilisateur']->getRole() == 'admin') {?>
        <div class="mb-3">
    <label for="role" class="form-label">Role</label>
    <select class="form-control" id="role" name="role">
        <option value="admin">Admin</option>
        <option value="client">Client</option>
    </select>
</div>
<?php }?>

        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>

<?php include_once "../header.php"; ?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Gestion des Utilisateurs</h2>
    <?php if (!empty($utilisateurs)) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Role</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($utilisateurs as $utilisateur) : ?>
                        <tr>
                            <td><?= htmlspecialchars($utilisateur->getNom()); ?></td>
                            <td><?= htmlspecialchars($utilisateur->getPrenom()); ?></td>
                            <td><?= htmlspecialchars($utilisateur->getEmail()); ?></td>
                            <td><?= htmlspecialchars($utilisateur->getTelephone()); ?></td>
                            <td><?= htmlspecialchars($utilisateur->getRole()); ?></td>
                            <td>
                                <a href="index.php?action=modifierUtilisateurC&id_utilisateur=<?= $utilisateur->getIdUtilisateur(); ?>" 
                                   class="btn btn-primary btn-sm me-2">Modifier</a>
                                <a href="index.php?action=supprimerUtilisateur&id_utilisateur=<?= $utilisateur->getIdUtilisateur(); ?>" 
                                   class="btn btn-danger btn-sm">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <p class="alert alert-warning text-center">Aucun utilisateur trouvé.</p>
    <?php endif; ?>
</div>

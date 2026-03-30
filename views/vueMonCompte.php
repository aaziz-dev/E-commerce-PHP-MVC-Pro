<?php if (isset($utilisateur)) : ?>
<div class="container mt-4">
    <h2 class="text-center mb-4">Mon Compte</h2>
    
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Informations personnelles</h5>
        </div>
        <div class="card-body">
            <p><strong>Nom :</strong> <?= htmlspecialchars($utilisateur->getNom()); ?></p>
            <p><strong>Prénom :</strong> <?= htmlspecialchars($utilisateur->getPrenom()); ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($utilisateur->getEmail()); ?></p>
            <p><strong>Téléphone :</strong> <?= htmlspecialchars($utilisateur->getTelephone()); ?></p>
            <p><strong>adresse :</strong> <?= htmlspecialchars($utilisateur->getAdresse()); ?></p>
            <a href="index.php?action=modifierUtilisateurC&id_utilisateur=<?= $utilisateur->getIdUtilisateur(); ?>" 
                                   class="btn btn-primary btn-sm me-2">Modifier</a>
        </div>
    </div>
    <?php if ($utilisateur->getRole() != 'admin'): ?>
    <h3 class="text-center mb-4">Mes Commandes</h3>
    <?php if (!empty($commandes)) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Numero de commande</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 
                    $i=1;
                    foreach ($commandes as $commande) : ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= htmlspecialchars($commande['prix']); ?>€</td>
                            <td><?= htmlspecialchars($commande['statut']); ?></td>
                            <td><?= htmlspecialchars($commande['date_creation']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
       
    <?php else : ?>
        <p class="alert alert-warning text-center">Aucune commande trouvée.</p>
    <?php endif; ?>
</div>
<?php endif; ?>
<?php else : ?>
<div class="container mt-4">
    <p class="alert alert-danger text-center">Utilisateur non trouvé.</p>
</div>
<?php endif; ?>

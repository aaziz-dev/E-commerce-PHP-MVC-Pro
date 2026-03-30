<?php include_once "../header.php"; ?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Gestion des Commandes</h2>
    <?php if (!empty($commandes)) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                    <th scope="col">Numero</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Quantite</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Date de Creation</th>
                        <th scope="col">Client</th>
                        <th scope="col">Mode de paiment</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;foreach ($commandes as $commande) : ?>
                        <tr>
                        <td><?= $i++; ?></td>
                            <td><?= htmlspecialchars($commande->getPrix()); ?>€</td>
                            <td><?= htmlspecialchars($commande->getQuantite()); ?></td>
                            <td><?= htmlspecialchars($commande->getStatut()); ?></td>
                            <td><?= htmlspecialchars($commande->getDateCreation()); ?></td>
                            <td><?= htmlspecialchars($commande->getEmail()) ?></td>
                            <td><?= htmlspecialchars($commande->getModePaiement()); ?></td>
                            <td>
                               
                                <a href="index.php?action=supprimerCommande&id_Commande=<?= $commande->getIdCommande(); ?>" 
                                   class="btn btn-danger btn-sm">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <p class="alert alert-warning text-center">Aucune commande trouvé.</p>
    <?php endif; ?>
</div>

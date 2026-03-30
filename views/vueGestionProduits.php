<?php include_once "../header.php"; ?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Gestion des Produits</h2>
    <a href="index.php?action=ajouterProduit" class="btn btn-primary btn-sm me-2">Ajouter un Produit</a>
    <?php if (!empty($produits)) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Description</th>
                        <th scope="col">Courte-Description</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits as $produit) : ?>
                        <tr>
                            <td><?= htmlspecialchars($produit->getNom()); ?></td>
                            <td><?= htmlspecialchars($produit->getPrix()); ?>€</td>
                            <td><?= htmlspecialchars($produit->getDescription()); ?></td>
                            <td><?= htmlspecialchars($produit->getCourteDescription()); ?></td>
                            <td><?= htmlspecialchars($produit->getQuantite()); ?></td>
                            <td>
                                <a href="index.php?action=modifierProduit&id_Produit=<?= $produit->getIdProduit(); ?>" 
                                   class="btn btn-primary btn-sm me-2">Modifier</a>
                                <a href="index.php?action=supprimerProduit&id_Produit=<?= $produit->getIdProduit(); ?>" 
                                   class="btn btn-danger btn-sm">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <p class="alert alert-warning text-center">Aucun produit trouvé.</p>
    <?php endif; ?>
</div>

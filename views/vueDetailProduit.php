<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="<?php echo "../". htmlspecialchars($produit->getCheminImage()); ?>" alt="Image du produit" class="img-fluid rounded-start" style="height: 100%; object-fit: cover;">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h2 class="card-title"><?php echo htmlspecialchars($produit->getNom()); ?></h2>
                            <p class="card-text"><strong>Prix :</strong> <?php echo htmlspecialchars($produit->getPrix()); ?>€</p>
                            <p class="card-text"><strong>Description :</strong> <?php echo htmlspecialchars($produit->getDescription()); ?></p>
                            <p class="card-text"><strong>Quantité disponible :</strong> <?php echo htmlspecialchars($produit->getQuantite()); ?></p>
                            <?php if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']->getRole() !== 'admin') : ?>
                            <form action="index.php?action=ajouterPanier" method="post" class="mt-auto">
                                <input type="hidden" name="id_produit" value="<?= $produit->getIdProduit(); ?>">
                                <input type="hidden" name="nom" value="<?= htmlspecialchars($produit->getNom()); ?>">
                                <input type="hidden" name="prix" value="<?= htmlspecialchars($produit->getPrix()); ?>">
                                <div class="d-flex align-items-center">
                                    <label for="quantite_<?= $produit->getIdProduit(); ?>" class="form-label me-2">Quantité :</label>
                                    <input type="number" id="quantite_<?= $produit->getIdProduit(); ?>" name="quantite" class="form-control w-25 me-2" value="1" min="1" required>
                                    <button type="submit" class="btn btn-success">Ajouter au panier</button>
                                </div>
                            </form>
                        <?php endif; ?>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

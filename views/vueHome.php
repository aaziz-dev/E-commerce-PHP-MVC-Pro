<div class="container mt-5">
    <h2 class="text-center mb-4">Nos Produits</h2>
    <div class="row">
        <?php 
        if($produits){
            foreach ($produits as $produit) : ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <?php if ($produit->getCheminImage()) : ?>
                        <img src="../<?= htmlspecialchars($produit->getCheminImage()); ?>" class="card-img-top" alt="Image du produit" style="height: 200px; object-fit: cover;">
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($produit->getNom()); ?></h5>
                        <p class="card-text"><strong>Prix :</strong> <?= htmlspecialchars($produit->getPrix()); ?>€</p>
                        <p class="card-text"><?= htmlspecialchars($produit->getCourteDescription()); ?></p>
                        <a href="index.php?action=detailProduit&id_Produit=<?= $produit->getIdProduit(); ?>" class="btn btn-primary mb-2">Voir les détails</a>
                        
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
        <?php endforeach;
        }else{?>
        <div class="container mt-4">
            <p class="alert alert-danger text-center">Aucun Produit pour le moment.</p>
        </div> <?php } ?>
    </div>
</div>

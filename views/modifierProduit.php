<?php if (isset($produit)) : ?>
<div class="container mt-4">
    <h2 class="text-center mb-4">Modifier Produit</h2>
    <form action="index.php?action=modifierProduit&id_Produit=<?= htmlspecialchars($produit->getIdProduit()) ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($produit->getNom()) ?>" required>
            <div class="invalid-feedback">Veuillez entrer un nom.</div>
        </div>
        
        <div class="mb-3">
            <label for="prix" class="form-label">Prix :</label>
            <input type="text" class="form-control" id="prix" name="prix" value="<?= htmlspecialchars($produit->getPrix()) ?>" required>
            <div class="invalid-feedback">Veuillez entrer un prix.</div>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description :</label>
            <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($produit->getDescription()) ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for="courte_description" class="form-label">Courte Description :</label>
            <input type="text" class="form-control" id="courte_description" name="courte_description" value="<?= htmlspecialchars($produit->getCourteDescription()) ?>">
        </div>
        
        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité :</label>
            <input type="number" class="form-control" id="quantite" name="quantite" value="<?= htmlspecialchars($produit->getQuantite()) ?>" required>
            <div class="invalid-feedback">Veuillez entrer une quantité valide.</div>
        </div>
        
        <div class="mb-3">
            <label for="image" class="form-label">Image :</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>
<?php else : ?>
<div class="container mt-4">
    <p class="alert alert-warning text-center">Produit non trouvé.</p>
</div>
<?php endif; ?>

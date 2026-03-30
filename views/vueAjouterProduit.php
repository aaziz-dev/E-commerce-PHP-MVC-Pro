<div class="container mt-4">
    <h2 class="text-center mb-4">Ajouter un Produit</h2>
    <form method="POST" action="index.php?action=ajouterProduit" enctype="multipart/form-data" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du produit :</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
            <div class="invalid-feedback">Veuillez entrer le nom du produit.</div>
        </div>
        
        <div class="mb-3">
            <label for="prix" class="form-label">Prix :</label>
            <input type="text" class="form-control" id="prix" name="prix" required>
            <div class="invalid-feedback">Veuillez entrer le prix du produit.</div>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description :</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            <div class="invalid-feedback">Veuillez entrer une description pour le produit.</div>
        </div>
        
        <div class="mb-3">
            <label for="courte_description" class="form-label">Courte description :</label>
            <input type="text" class="form-control" id="courte_description" name="courte_description" required>
            <div class="invalid-feedback">Veuillez entrer une courte description.</div>
        </div>
        
        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité :</label>
            <input type="number" class="form-control" id="quantite" name="quantite" required>
            <div class="invalid-feedback">Veuillez entrer une quantité valide.</div>
        </div>
        
        <div class="mb-3">
            <label for="chemin_image" class="form-label">Image du produit :</label>
            <input type="file" class="form-control" id="chemin_image" name="chemin_image" required>
            <div class="invalid-feedback">Veuillez choisir une image pour le produit.</div>
        </div>
        
        <button type="submit" class="btn btn-success">Ajouter le produit</button>
    </form>
</div>

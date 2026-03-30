<?php include_once "../header.php"; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
                    <h4 class="mb-0 text-center">Inscription</h4>
                <div class="card-body">
                    <form method="POST" action="index.php?action=inscription" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom :</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                            <div class="invalid-feedback">Veuillez entrer votre nom.</div>
                        </div>
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom :</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required>
                            <div class="invalid-feedback">Veuillez entrer votre prénom.</div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">Veuillez entrer une adresse email valide.</div>
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone :</label>
                            <input type="text" class="form-control" id="telephone" name="telephone" required>
                            <div class="invalid-feedback">Veuillez entrer un numéro de téléphone valide.</div>
                        </div>
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse :</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" required>
                        </div>
                        <div class="mb-3">
                            <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
                            <div class="invalid-feedback">Veuillez entrer un mot de passe.</div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">S'inscrire</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>


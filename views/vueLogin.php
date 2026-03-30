<?php include_once "../header.php"; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
                    <h4 class="mb-0 text-center">Connexion</h4>
                <div class="card-body">
                    <form method="POST" action="index.php?action=login" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">Veuillez entrer une adresse email valide.</div>
                        </div>
                        <div class="mb-3">
                            <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
                            <div class="invalid-feedback">Veuillez entrer votre mot de passe.</div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <p>Pas encore de compte? <a href="index.php?action=inscription">Inscrivez-vous ici</a></p>
                </div>
            </div>
        </div>
    </div>
</div>



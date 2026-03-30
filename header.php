<?php
include_once "../classes/Utilisateur.php";
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniCap</title>
    <link rel="stylesheet" href="../css/header.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg custom-navbar shadow-sm">
  <div class="container custom-container">
    <a class="navbar-brand custom-brand" href="index.php?action=home">UniCap</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse custom-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 custom-nav">
        <li class="nav-item custom-item">
          <a class="nav-link active custom-link" aria-current="page" href="index.php?action=home">Accueil</a>
        </li>

        <?php if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur'] instanceof Utilisateur): ?>
          <?php $utilisateur = $_SESSION['utilisateur']; ?>
          
          <?php if ($utilisateur->getRole() == 'admin'): ?>
            <li class="nav-item dropdown custom-dropdown">
              <a class="nav-link dropdown-toggle custom-link-dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Gestions
              </a>
              <ul class="dropdown-menu custom-dropdown-menu">
                <li><a class="dropdown-item custom-dropdown-item" href="index.php?action=gestionUtilisateurs">Gestion des utilisateurs</a></li>
                <li><a class="dropdown-item custom-dropdown-item" href="index.php?action=gestionProduits">Gestion des produits</a></li>
                <li><a class="dropdown-item custom-dropdown-item" href="index.php?action=gestionCommandes">Gestion des commandes</a></li>
              </ul>
            </li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>

      <div class="d-flex align-items-center custom-actions">
        <?php if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur'] instanceof Utilisateur): ?>
          <span class="navbar-text me-3 custom-text">
            Bonjour, <strong><?= htmlspecialchars($utilisateur->getNom()) ?></strong> (<?= $utilisateur->getRole() ?>)
          </span>

          <a href="index.php?action=monCompte" class="btn btn-outline-primary btn-sm me-2 custom-button">Mon compte</a>
          <a href="index.php?action=logout" class="btn btn-outline-danger btn-sm custom-button">Déconnexion</a>

          <?php if ($utilisateur->getRole() != 'admin'): ?>
            <a href="index.php?action=afficherPanier" class="btn btn-outline-success btn-sm custom-button">Voir le panier</a>
          <?php endif; ?>

        <?php else: ?>
          <a href="index.php?action=login" class="btn btn-outline-primary btn-sm custom-button">Connexion</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>


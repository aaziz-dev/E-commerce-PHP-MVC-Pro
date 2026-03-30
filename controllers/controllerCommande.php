<?php
include_once "../header.php";
include_once "../classes/Commande.php";
include_once "../modeles/ModeleCommande.php";
class ControllerCommande {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function getCommandeById($id_commande) {
        return $this->model->getCommandeById($id_commande);
    }

    public function getCommandes() {
        return $this->model->getCommandes();
    }

    public function ajouterCommande($quantite, $prix, $statut, $id_utilisateur, $mode_paiement) {
        return $this->model->ajouterCommande($quantite, $prix, $statut, $id_utilisateur, $mode_paiement);
    }

    public function supprimerCommande($id_commande) {
        return $this->model->supprimerCommande($id_commande);
    }

    public function enregistrerCommande($panier, $utilisateur) {
        $id_utilisateur = $utilisateur->getIdUtilisateur();
        $total = array_sum(array_map(fn($item) => $item['prix'] * $item['quantite'], $panier));
        $quantite_totale = array_sum(array_column($panier, 'quantite'));
        if (!empty($panier) && $total > 0) {
            $id_commande = $this->ajouterCommande($quantite_totale, $total, 'Payée', $id_utilisateur, 'PayPal');
            if ($id_commande) {
                return $this->model->ajouterProduitsCommande($id_commande, $panier);
            }
        } else {
            echo "Le panier est vide ou invalide.";
            return false;
        }
    }
}
?>

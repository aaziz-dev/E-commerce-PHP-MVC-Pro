
<?php
class Commande {
    private $id_commande;
    private $quantite;
    private $prix;
    private $statut;
    private $date_creation;
    private $id_utilisateur;
    private $email;
    private $mode_paiement;

    public function __construct($id_commande, $quantite, $prix, $statut, $date_creation, $id_utilisateur,$email, $mode_paiement) {
        $this->id_commande = $id_commande;
        $this->quantite = $quantite;
        $this->prix = $prix;
        $this->statut = $statut;
        $this->date_creation = $date_creation;
        $this->id_utilisateur = $id_utilisateur;
        $this->email=$email;
        $this->mode_paiement = $mode_paiement;
    }

    public function getIdCommande() {
        return $this->id_commande;
    }
    public function getEmail() {
        return $this->email;
    }

    public function getQuantite() {
        return $this->quantite;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getStatut() {
        return $this->statut;
    }

    public function getDateCreation() {
        return $this->date_creation;
    }

    public function getIdUtilisateur() {
        return $this->id_utilisateur;
    }

    public function getModePaiement() {
        return $this->mode_paiement;
    }

    public function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }

    public function setStatut($statut) {
        $this->statut = $statut;
    }

    public function setDateCreation($date_creation) {
        $this->date_creation = $date_creation;
    }

    public function setIdUtilisateur($id_utilisateur) {
        $this->id_utilisateur = $id_utilisateur;
    }

    public function setModePaiement($mode_paiement) {
        $this->mode_paiement = $mode_paiement;
    }
}
?>
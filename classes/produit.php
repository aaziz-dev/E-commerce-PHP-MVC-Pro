<?php
class Produit {
    private $id_Produit;
    private $nom;
    private $prix;
    private $description;
    private $courte_description;
    private $quantite;
    private $chemin_image;

    public function __construct($id_Produit, $nom, $prix, $description, $courte_description, $quantite, $chemin_image) {
        $this->id_Produit = $id_Produit;
        $this->nom = $nom;
        $this->prix = $prix;
        $this->description = $description;
        $this->courte_description = $courte_description;
        $this->quantite = $quantite;
        $this->chemin_image = $chemin_image;
    }

    public function getIdProduit() {
        return $this->id_Produit;
    }
    public function getNom() {
        return $this->nom;
    }
    public function getPrix() {
        return $this->prix;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getCourteDescription() {
        return $this->courte_description;
    }
    public function getQuantite() {
        return $this->quantite;
    }
    public function getCheminImage() {
        return $this->chemin_image;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }
    public function setPrix($prix) {
        $this->prix = $prix;
    }
    public function setDescription($description) {
        $this->description = $description;
    }
    public function setCourteDescription($courte_description) {
        $this->courte_description = $courte_description;
    }
    public function setQuantite($quantite) {
        $this->quantite = $quantite;
    }
    public function setCheminImage($chemin_image) {
        $this->chemin_image = $chemin_image;
    }
}
?>

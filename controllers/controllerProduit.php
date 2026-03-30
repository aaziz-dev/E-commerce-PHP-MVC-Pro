<?php
include_once "../header.php";
include_once "../classes/Produit.php";
include_once "../modeles/ModeleProduit.php";

class ControllerProduit {
    private $model;
    public function __construct($model) {
        $this->model = $model;
    }
    public function getProduits() {
        return $this->model->getProduits();
    }
    public function ajouterProduit($nom, $prix, $description, $courte_description, $quantite, $chemin_image) {
        return $this->model->ajouterProduit($nom, $prix, $description, $courte_description, $quantite, $chemin_image);
    }
    public function getProduitById($id_Produit) {
        return $this->model->getProduitById($id_Produit);
    }
    public function modifierProduit($id_Produit, $nom, $prix, $description, $courte_description, $quantite, $chemin_image = null) {
        return $this->model->modifierProduit($id_Produit, $nom, $prix, $description, $courte_description, $quantite, $chemin_image);
    }
    public function supprimerProduit($id_Produit) {
        return $this->model->supprimerProduit($id_Produit);
    }
        
}
?>
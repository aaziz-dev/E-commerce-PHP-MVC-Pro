<?php
include_once "../header.php";
include_once "../modeles/ModeleUtilisateur.php";

class ControllerUtilisateur {
    private $model;

    public function __construct(ModeleUtilisateur $model) {
        $this->model = $model;
    }

    public function getUtilisateurById($id_utilisateur) {
        return $this->model->getUtilisateurById($id_utilisateur);
    }

    public function getUtilisateurs() {
        return $this->model->getUtilisateurs();
    }

    public function inscription($nom, $prenom, $email, $telephone, $mot_de_passe, $adresse) {
        return $this->model->inscription($nom, $prenom, $email, $telephone, $mot_de_passe, $adresse);
    }

    public function login($email, $mot_de_passe) {
        return $this->model->login($email, $mot_de_passe);
    }

    public function getCommandesUtilisateur($id_utilisateur) {
        return $this->model->getCommandesUtilisateur($id_utilisateur);
    }

    public function modifierUtilisateur($id_utilisateur, $nom, $prenom, $email, $telephone, $adresse,$role) {
        return $this->model->modifierUtilisateur($id_utilisateur, $nom, $prenom, $email, $telephone, $adresse,$role);
    }

    public function supprimerUtilisateur($id_utilisateur) {
        return $this->model->supprimerUtilisateur($id_utilisateur);
    }
    public function getAdressesByUtilisateur($id_utilisateur) {
        return $this->model->getAdressesByUtilisateur($id_utilisateur);
    }
}
?>

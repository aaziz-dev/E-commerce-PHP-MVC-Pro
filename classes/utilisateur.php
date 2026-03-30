<?php
class Utilisateur {
    private $id_utilisateur;
    private $nom;
    private $prenom;
    private $email;
    private $telephone;
    private $role;
    private $mot_de_passe;
    private $adresse;

    public function __construct($id_utilisateur, $nom, $prenom, $email, $telephone, $role, $mot_de_passe, $adresse) {
        $this->id_utilisateur = $id_utilisateur;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->role = $role;
        $this->mot_de_passe = $mot_de_passe;
        $this->adresse = $adresse;
    }

    public function getIdUtilisateur() {
        return $this->id_utilisateur;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getRole() {
        return $this->role;
    }

    public function getMotDePasse() {
        return $this->mot_de_passe;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function setMotDePasse($mot_de_passe) {
        $this->mot_de_passe = $mot_de_passe;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }
}

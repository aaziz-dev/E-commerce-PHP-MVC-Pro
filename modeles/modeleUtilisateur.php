<?php
include_once "../header.php";
include_once "../classes/utilisateur.php";

class ModeleUtilisateur {
    private $db;

    public function __construct(PDO $_db) {
        $this->db = $_db;
    }

    public function getUtilisateurs() {
        try {
            $reponse = $this->db->prepare("SELECT * FROM Utilisateur");
            $reponse->execute();
            $utilisateurs = [];
            while ($row = $reponse->fetch(PDO::FETCH_ASSOC)) {
                $utilisateurs[] = new Utilisateur(
                    $row['id_utilisateur'], 
                    $row['nom'], 
                    $row['prenom'], 
                    $row['email'], 
                    $row['telephone'], 
                    $row['role'], 
                    $row['mot_de_passe'], 
                    $row['adresse']
                );
            }
            return $utilisateurs;
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();
        }
    }

    public function inscription($nom, $prenom, $email, $telephone, $mot_de_passe, $adresse) {
        try {
            $this->db->beginTransaction();
            $reponse = $this->db->prepare("INSERT INTO Utilisateur (nom, prenom, email, telephone, mot_de_passe, role, adresse) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $role = "client";
            $reponse->execute([
                $nom, 
                $prenom, 
                $email, 
                $telephone, 
                password_hash($mot_de_passe, PASSWORD_BCRYPT), 
                $role, 
                $adresse
            ]);
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            echo "Erreur: " . $e->getMessage();
            return false;
        }
    }

    public function getUtilisateurById($id_utilisateur) {
        try {
            $reponse = $this->db->prepare("SELECT * FROM Utilisateur WHERE id_utilisateur = ?");
            $reponse->execute([$id_utilisateur]);
            $row = $reponse->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Utilisateur(
                    $row['id_utilisateur'], 
                    $row['nom'], 
                    $row['prenom'], 
                    $row['email'], 
                    $row['telephone'], 
                    $row['role'], 
                    $row['mot_de_passe'], 
                    $row['adresse']
                );
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return null;
        }
    }

    public function modifierUtilisateur($id_utilisateur, $nom, $prenom, $email, $telephone, $adresse,$role  ) {
        try {
            $this->db->beginTransaction();
            $sql = "UPDATE Utilisateur SET nom = ?, prenom = ?, email = ?, telephone = ?, adresse = ?,role = ? WHERE id_utilisateur = ?";
            $params = [$nom, $prenom, $email, $telephone, $adresse,$role,$id_utilisateur];
          

            $this->db->prepare($sql)->execute($params);
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function supprimerUtilisateur($id_utilisateur) {
        try {
            $this->db->prepare("DELETE FROM Utilisateur WHERE id_utilisateur = ?")->execute([$id_utilisateur]);
            return true;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }

    public function getCommandesUtilisateur($id_utilisateur) {
        try {
            $reponse = $this->db->prepare("SELECT * FROM Commande WHERE id_utilisateur = ?");
            $reponse->execute([$id_utilisateur]);
            return $reponse->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();
            return [];
        }
    }

    public function login($email, $mot_de_passe) {
        try {
            $reponse = $this->db->prepare("SELECT * FROM Utilisateur WHERE email = ?");
            $reponse->execute([$email]);
            $utilisateur = $reponse->fetch(PDO::FETCH_ASSOC);
            if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
                return new Utilisateur(
                    $utilisateur['id_utilisateur'], 
                    $utilisateur['nom'], 
                    $utilisateur['prenom'], 
                    $utilisateur['email'], 
                    $utilisateur['telephone'], 
                    $utilisateur['role'], 
                    $utilisateur['mot_de_passe'], 
                    $utilisateur['adresse']
                );
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();
            return null;
        }
    }
    public function getAdressesByUtilisateur($id_utilisateur) {
        try {
            $stmt = $this->db->prepare("
                SELECT adresse FROM utilisateur where id_utilisateur = ?
            ");
            $stmt->execute([$id_utilisateur]);
    
            
            if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $adresse = $row['adresse'];
            }
            return $adresse;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return null ;
        }
    }
}

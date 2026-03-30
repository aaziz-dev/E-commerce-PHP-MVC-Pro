<?php
include_once "../header.php";
include_once "../classes/produit.php";

class ModeleProduit {
    private $db;
    public function __construct(PDO $_db) {
        $this->db = $_db;
    }
    public function getProduits() {
        try {
            $reponse = $this->db->prepare("SELECT Produit.*, Image.chemin_image FROM Produit LEFT JOIN Image ON Produit.id_Produit = Image.id_Produit");
            $reponse->execute();
            $produits = [];
            while ($row = $reponse->fetch(PDO::FETCH_ASSOC)) {
                $produits[] = new Produit($row['id_Produit'], $row['nom'], $row['prix'], $row['description'], $row['courte_description'], $row['quantite'], $row['chemin_image']);
            }
            return $produits;
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();
        }
    }
    public function getProduitById($id_Produit) {
        try {
            $reponse = $this->db->prepare("SELECT Produit.*, Image.chemin_image FROM Produit LEFT JOIN Image ON Produit.id_Produit = Image.id_Produit WHERE Produit.id_Produit = ?");
            $reponse->execute([$id_Produit]);
            $row = $reponse->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Produit($row['id_Produit'], $row['nom'], $row['prix'], $row['description'], $row['courte_description'], $row['quantite'], $row['chemin_image']);
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();
            return null;
        }
    }   
    public function modifierProduit($id_Produit, $nom, $prix, $description, $courte_description, $quantite, $chemin_image = null) {
        try {
            $this->db->beginTransaction();
    
            $sql = "UPDATE Produit SET nom = ?, prix = ?, description = ?, courte_description = ?, quantite = ? WHERE id_Produit = ?";
            $params = [$nom, $prix, $description, $courte_description, $quantite, $id_Produit];
            $this->db->prepare($sql)->execute($params);
    
            if ($chemin_image) {
                $sqlImage = "UPDATE Image SET chemin_image = ? WHERE id_Produit = ?";
                $this->db->prepare($sqlImage)->execute([$chemin_image, $id_Produit]);
            }
    
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }
        
    public function ajouterProduit($nom, $prix, $description, $courte_description, $quantite, $chemin_image) {
        try {
            $this->db->beginTransaction();
            $reponse = $this->db->prepare("INSERT INTO Produit (nom, prix, description, courte_description, quantite) VALUES (?, ?, ?, ?, ?)");
            $reponse->execute([$nom, $prix, $description, $courte_description, $quantite]);
            $id_Produit = $this->db->lastInsertId();

            $reponseImage = $this->db->prepare("INSERT INTO Image (id_Produit, chemin_image) VALUES (?, ?)");
            $reponseImage->execute([$id_Produit, $chemin_image]);
            
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            echo "Erreur: " . $e->getMessage();
            return false;
        }
    }
    public function supprimerProduit($id_Produit) {
        try {
            $this->db->beginTransaction();
            $reponseImage = $this->db->prepare("DELETE FROM Image WHERE id_Produit = ?");
            $reponseImage->execute([$id_Produit]);

            $reponseProduit = $this->db->prepare("DELETE FROM Produit WHERE id_Produit = ?");
            $reponseProduit->execute([$id_Produit]);
            
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            echo "Erreur: " . $e->getMessage();
            return false;
        }
    }
}
?>

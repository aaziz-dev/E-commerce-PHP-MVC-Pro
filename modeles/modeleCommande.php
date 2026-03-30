<?php
include_once "../header.php";
include_once "../classes/Commande.php";

class ModeleCommande {
    private $db;

    public function __construct( $db) {
        $this->db = $db;
    }

    public function getCommandes() {
        try {
            $reponse = $this->db->prepare("SELECT c.*,email FROM Commande c join Utilisateur u on  c.id_utilisateur = u.id_utilisateur ");
            $reponse->execute();
            $commandes = [];
            while ($row = $reponse->fetch(PDO::FETCH_ASSOC)) {
                $commandes[] = new Commande(
                    $row['id_commande'],
                    $row['quantite'],
                    $row['prix'],
                    $row['statut'],
                    $row['date_creation'],
                    $row['id_utilisateur'],
                    $row['email'],
                    $row['mode_paiement']
                );
            }
            return $commandes;
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();
        }
    }

    public function getCommandeById($id_commande) {
        try {
            $reponse = $this->db->prepare("SELECT c.*,u.email FROM Commande,Utilisateur WHERE  c.id_utilisateur = u.id_utilisateur and id_commande = ?");
            $reponse->execute([$id_commande]);
            $row = $reponse->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Commande(
                    $row['id_commande'],
                    $row['quantite'],
                    $row['prix'],
                    $row['statut'],
                    $row['date_creation'],
                    $row['id_utilisateur'],
                    $row['email'],
                    $row['mode_paiement']
                );
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return null;
        }
    }

    public function ajouterCommande($quantite, $prix, $statut, $id_utilisateur, $mode_paiement) {
        try {
            $this->db->beginTransaction();
            $reponse = $this->db->prepare("INSERT INTO Commande (quantite, prix, statut, date_creation, id_utilisateur, mode_paiement) VALUES (?, ?, ?, NOW(), ?, ?)");
            $reponse->execute([$quantite, $prix, $statut, $id_utilisateur, $mode_paiement]);
            $id_commande = $this->db->lastInsertId();
            $this->db->commit();
            return $id_commande;
        } catch (PDOException $e) {
            $this->db->rollBack();
            echo "Erreur: " . $e->getMessage();
            return false;
        }
    }

    public function supprimerCommande($id_commande) {
        try {
            $this->db->beginTransaction();
            $this->db->prepare("DELETE FROM ProduitCommande WHERE id_commande = ?")->execute([$id_commande]);
            $this->db->prepare("DELETE FROM Commande WHERE id_commande = ?")->execute([$id_commande]);
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }


    public function ajouterProduitsCommande($id_commande, $panier) {
        try {
            $stmtProduit = $this->db->prepare("INSERT INTO ProduitCommande (id_commande, id_Produit, quantite) VALUES (?, ?, ?)");
            foreach ($panier as $item) {
                $stmtProduit->execute([$id_commande, $item['id_produit'], $item['quantite']]);
            }
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de l'enregistrement des produits de la commande : " . $e->getMessage();
            return false;
        }
    }
}
?>
